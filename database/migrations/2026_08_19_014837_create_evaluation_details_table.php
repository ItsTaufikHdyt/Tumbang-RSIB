<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('evaluation_details', function (Blueprint $table): void {
            $table->id();

            $table->foreignId('session_id')
                ->constrained('evaluation_sessions')
                ->cascadeOnDelete();

            $table->foreignId('activity_id')
                ->constrained('child_activities')
                ->cascadeOnDelete();

            $table->unsignedSmallInteger('score');
            $table->timestamps();

            $table->unique(
                ['session_id', 'activity_id'],
                'evaluation_details_session_activity_unique'
            );
        });

        /*
         * Check constraint menggunakan raw SQL agar tetap jelas.
         *
         * PostgreSQL dan MySQL modern mendukung CHECK constraint.
         * Validasi aplikasi tetap diterapkan pada modal Filament.
         */
        DB::statement(
            'ALTER TABLE evaluation_details
             ADD CONSTRAINT evaluation_details_score_check
             CHECK (score IN (0, 3, 7, 10))'
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_details');
    }
};
