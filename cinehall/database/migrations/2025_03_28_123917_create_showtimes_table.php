<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('showtimes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_id')->constrained()->onDelete('cascade');
            $table->foreignId('theater_id')->constrained()->onDelete('cascade');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->enum('type', ['normal', 'vip']);
            $table->string('language');
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('showtimes');
    }
};