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
        Schema::create('detail_stockouts', function (Blueprint $table) {
            $table->id();
            $table->integer('id_stockout');
            $table->integer('id_barang');
            $table->integer('id_area');
            $table->integer('id_line');
            $table->integer('id_drawing');
            $table->integer('jumlah');
            $table->string('satuan',50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_stockouts');
    }
};