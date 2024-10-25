<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        Schema::create('unlocking_sections', static function (Blueprint $table): void {
            $table->id();
            $table->foreignId('unlocking_id')->constrained('unlockings')->cascadeOnDelete();
            $table->string('title');
            $table->text('description');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('unlocking_sections');
    }
};
