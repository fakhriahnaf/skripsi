<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qrs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('barang_id');
            $table->string('KodeBarang')->nullable();
            $table->string('JenisBarang')->nullable();
            $table->string('NamaBarang')->nullable();
            $table->string('TanggalPembelian')->nullable();
            $table->string('SatuanBarang')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qrs');
    }
}
