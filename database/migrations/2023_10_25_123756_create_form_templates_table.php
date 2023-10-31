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
        Schema::create('form_templates', function (Blueprint $table) {
            $table->id();
            $table->integer('author_id');
            $table->string('title')->default('Заголовок');
            $table->mediumText('description');
            $table->boolean('published')->default(false);
            $table->boolean('removed')->default(false);
            $table->string('user_remove')->default('unknown');
            $table->longText('data_json');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_templates');
    }
};