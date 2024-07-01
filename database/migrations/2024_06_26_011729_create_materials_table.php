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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('kd_brg',10);
            $table->string('nm_brg',100);
            $table->integer('id_cat');
            $table->integer('id_subcat');
            $table->integer('size1');
            $table->integer('size2')->nullable();
            $table->double('thickness1')->nullable();
            $table->double('thickness2')->nullable();
            $table->string('SCH',100)->nullable();
            $table->string('type1',100)->nullable();
            $table->string('type2',100)->nullable();
            $table->string('satuan',50);
            $table->integer('stok');
            $table->text('specification')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};