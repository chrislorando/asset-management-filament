<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table("audit_logs", function (Blueprint $table) {
            // Add indexes for better performance
            $table->index(["model_type", "model_id"], "audit_model_index");
            $table->index("user_id", "audit_user_index");
            $table->index("action", "audit_action_index");
            $table->index("created_at", "audit_created_index");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("audit_logs", function (Blueprint $table) {
            $table->dropIndex("audit_model_index");
            $table->dropIndex("audit_user_index");
            $table->dropIndex("audit_action_index");
            $table->dropIndex("audit_created_index");
        });
    }
};
