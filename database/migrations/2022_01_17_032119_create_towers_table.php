<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('towers', function (Blueprint $table) {
            $table->id();
            $table->string('idmenara');
            $table->string('nama');
            $table->string('operator');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('tipeSite');
            $table->string('tipeJalan');
            $table->float('tinggi',4,1);
            $table->float('latitude',10,7);
            $table->float('longitude',10,7);
            $table->string('luas');
            $table->string('pemilik');
            $table->string('penyewa');
            $table->string('nomorIMB');
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
        Schema::dropIfExists('towers');
    }
}
