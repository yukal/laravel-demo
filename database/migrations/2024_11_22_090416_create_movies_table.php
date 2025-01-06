<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('name', length: 80);
            $table->string('poster', length: 160)->nullable();
            $table->boolean('published')->default(false);
            // $table->timestamps();
        });

        DB::statement('ALTER SEQUENCE movies_id_seq RESTART WITH 1 CACHE 1');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
