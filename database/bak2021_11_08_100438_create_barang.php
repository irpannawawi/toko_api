<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->integer('id_barang')->unsigned()->autoIncrement();
            $table->string('nama_barang');
            $table->unsignedInteger('kategori');
            $table->integer('stok');
            $table->timestamps();
            $table->foreign('kategori')->references('id_kategori')->on('kategori');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
}
