<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        Schema::create('contact_uses', static function (Blueprint $table): void {
            $table->id();
            $table->string('banner_image');
            $table->string('banner_image_alt_text');
            $table->text('banner_image_text');
            $table->string('main_image');
            $table->string('main_image_alt_text');
            $table->text('first_description');
            $table->text('second_description');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_uses');
    }
};
