<?php

use App\Models\Asset;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test("audit logs are created when asset is created", function () {
    $user = User::factory()->create();
    $asset = Asset::factory()->create();

    $this->actingAs($user)
        ->assertDatabaseHas("audit_logs", [
            "user_id" => $user->id,
            "action" => "create",
            "model_type" => Asset::class,
            "model_id" => $asset->id,
        ]);
});

test("audit logs are created when asset is updated", function () {
    $user = User::factory()->create();
    $asset = Asset::factory()->create(["name" => "Original Name"]);
    
    $this->actingAs($user);
    
    $asset->update(["name" => "Updated Name"]);

    $this->assertDatabaseHas("audit_logs", [
        "user_id" => $user->id,
        "action" => "update",
        "model_type" => Asset::class,
        "model_id" => $asset->id,
    ]);
});

test("audit logs are created when asset is deleted", function () {
    $user = User::factory()->create();
    $asset = Asset::factory()->create();
    
    $this->actingAs($user);
    
    $asset->delete();

    $this->assertDatabaseHas("audit_logs", [
        "user_id" => $user->id,
        "action" => "delete",
        "model_type" => Asset::class,
        "model_id" => $asset->id,
    ]);
});

test("audit logs include old and new values for updates", function () {
    $user = User::factory()->create();
    $asset = Asset::factory()->create([
        "name" => "Original Name",
        "status" => "available",
    ]);
    
    $this->actingAs($user);
    
    $asset->update(["name" => "Updated Name"]);

    $auditLog = \App\Models\AuditLog::where("action", "update")
        ->where("model_type", Asset::class)
        ->where("model_id", $asset->id)
        ->first();

    expect($auditLog->new_values)->toHaveKey("name");
    expect($auditLog->new_values["name"])->toBe("Updated Name");
    expect($auditLog->old_values)->toHaveKey("name");
    expect($auditLog->old_values["name"])->toBe("Original Name");
});
