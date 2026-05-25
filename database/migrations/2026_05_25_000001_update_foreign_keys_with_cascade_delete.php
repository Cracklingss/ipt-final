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
        Schema::table('events', function (Blueprint $table) {
            // Drop the existing foreign key
            $table->dropForeign(['event_organizer_id']);
            
            // Recreate with cascadeOnDelete
            $table->foreign('event_organizer_id')
                ->references('id')
                ->on('event_organizers')
                ->cascadeOnDelete();
        });

        Schema::table('participants', function (Blueprint $table) {
            // Drop the existing foreign key
            $table->dropForeign(['event_id']);
            
            // Recreate with cascadeOnDelete
            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->cascadeOnDelete();
        });

        Schema::table('notifications', function (Blueprint $table) {
            // Drop the existing foreign key
            $table->dropForeign(['event_id']);
            
            // Recreate with cascadeOnDelete
            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['event_organizer_id']);
            $table->foreign('event_organizer_id')
                ->references('id')
                ->on('event_organizers')
                ->nullOnDelete();
        });

        Schema::table('participants', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->nullOnDelete();
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->nullOnDelete();
        });
    }
};
