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
       Schema::create('children', function (Blueprint $table): void {
            $table->id();

            $table->string('name');
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth');
            $table->string('gender', 10)->nullable();

            $table->string('father')->nullable();
            $table->string('mother')->nullable();
            $table->text('address')->nullable();

            $table->timestamps();

            $table->index('name');
            $table->index('date_of_birth');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('childrens');
    }
};
