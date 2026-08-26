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
        Schema::create('treatment_certificates', function (Blueprint $table) {
            $table->id();

    $table->foreignId('child_id')
        ->constrained('children')
        ->cascadeOnDelete();

    // $table->string('letter_number')->nullable();

    $table->date('letter_date');

    $table->string('diagnosis')->nullable();

    $table->text('statement')->nullable();

    $table->foreignId('created_by')
        ->nullable()
        ->constrained('users')
        ->nullOnDelete();

    $table->string('signer_name')->nullable();

    $table->string('signer_title')
        ->default('Penanggung Jawab Layanan TUMBANG Smart Kids RSIB');

    $table->timestamps();

    $table->index([
        'child_id',
        'letter_date',
    ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatment_certificates');
    }
};
