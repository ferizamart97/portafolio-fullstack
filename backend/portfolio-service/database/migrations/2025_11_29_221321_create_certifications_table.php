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
        Schema::create('certifications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('short_description');
            $table->string('name_institution')->nullable();
            $table->string('url_institution')->nullable();
            $table->string('slug')->unique();
            $table->string('main_image_path')->nullable();
            $table->date('date_certification');
            $table->date('date_end_certification')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certifications');
    }
};
