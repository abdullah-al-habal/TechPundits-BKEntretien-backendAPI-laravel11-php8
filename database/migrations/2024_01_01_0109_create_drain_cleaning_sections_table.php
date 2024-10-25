<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        Schema::create('drain_cleaning_sections', static function (Blueprint $table): void {
            $table->id();
            $table->foreignId('drain_cleaning_id')->constrained('drain_cleanings')->cascadeOnDelete();
            $table->string('title');
            $table->text('description');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('drain_cleaning_sections');
    }
};
