<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        Schema::create('home_page_sections', static function (Blueprint $table): void {
            $table->id();
            $table->foreignId('home_page_id')->constrained('home_pages')->cascadeOnDelete();
            $table->string('title');
            $table->text('description');
            $table->string('image');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_page_sections');
    }
};
