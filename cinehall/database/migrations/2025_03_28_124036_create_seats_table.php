<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('theater_id')->constrained()->onDelete('cascade');
            $table->string('row');
            $table->integer('number');
            $table->enum('type', ['single', 'couple']);
            $table->enum('status', ['available', 'maintenance'])->default('available');
            $table->timestamps();
            
            $table->unique(['theater_id', 'row', 'number']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('seats');
    }
};