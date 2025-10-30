<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scripts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            $table->string('topic');
            $table->text('script');
            $table->string('status')->default('generated');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scripts');
    }
};