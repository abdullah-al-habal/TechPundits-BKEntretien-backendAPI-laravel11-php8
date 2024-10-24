<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('photo_gallery_section_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('photo_gallery_section_id')->constrained()->cascadeOnDelete();
            $table->string('image');
            $table->string('alt_text');
            $table->text('description');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('photo_gallery_section_images');
    }
};
