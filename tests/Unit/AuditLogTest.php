<?php

use App\Models\AuditLog;
use App\Models\Asset;
use App\Models\User;

test("audit log formatted action returns correct text", function () {
    $auditLog = new AuditLog(["action" => "create"]);
    expect($auditLog->formatted_action)->toBe("Created");

    $auditLog = new AuditLog(["action" => "update"]);
    expect($auditLog->formatted_action)->toBe("Updated");

    $auditLog = new AuditLog(["action" => "delete"]);
    expect($auditLog->formatted_action)->toBe("Deleted");
});

test("audit log model name returns class base name", function () {
    $auditLog = new AuditLog(["model_type" => Asset::class]);
    expect($auditLog->model_name)->toBe("Asset");
});

test("audit log changes description works correctly", function () {
    $auditLog = new AuditLog([
        "action" => "create",
        "model_type" => Asset::class,
        "model_id" => 1,
    ]);
    expect($auditLog->changes_description)->toContain("Created new Asset with ID: 1");

    $auditLog = new AuditLog([
        "action" => "update",
        "model_type" => Asset::class,
        "model_id" => 1,
        "old_values" => ["name" => "Old Name"],
        "new_values" => ["name" => "New Name"],
    ]);
    expect($auditLog->changes_description)->toContain("name: Old Name → New Name");
});

test("audit log relationship methods work", function () {
    $user = User::factory()->create();
    $asset = Asset::factory()->create();
    
    $auditLog = AuditLog::log("create", Asset::class, $asset->id);
    
    expect($auditLog->user)->toBeInstanceOf(User::class);
    expect($auditLog->auditable)->toBeInstanceOf(Asset::class);
});
