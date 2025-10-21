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
        Schema::create('peserta_ujians', function (Blueprint $table) {
            $table->id();
            $table->string('nis');
            $table->foreign('nis')->references('nis')->on('siswas')->onDelete('cascade');
            $table->unsignedBigInteger('id_ujian');
            $table->foreign('id_ujian')->references('id_ujian')->on('ujians')->onDelete('cascade');
            $table->integer('nilai')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_ujians');
    }
};
