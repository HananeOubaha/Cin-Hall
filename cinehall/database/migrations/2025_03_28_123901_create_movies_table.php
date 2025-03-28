<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->integer('duration'); // in minutes
            $table->integer('minimum_age');
            $table->string('trailer_url')->nullable();
            $table->string('poster_url');
            $table->string('genre');
            $table->date('release_date');
            $table->enum('status', ['upcoming', 'showing', 'ended'])->default('upcoming');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('movies');
    }
};