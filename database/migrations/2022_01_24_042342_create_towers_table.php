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
            $table->string('idMenara')->unique(); // bukan primary
            $table->string('operator')->nullable();
            $table->foreignId('idTipeMenara')->constrained('tipe_menaras');
            $table->foreignId('idKec')->constrained('kecamatans');
            $table->foreignId('idKel')->constrained('kelurahans');
            $table->foreignId('idSite')->constrained('tipe_sites');
            $table->foreignId('idJalan')->constrained('tipe_jalans');
            $table->float('tinggi',4,1);
            $table->float('latitude',10,7);
            $table->float('longitude',10,7);
            $table->string('luas');
            $table->string('pemilik');
            $table->string('penyewa')->nullable();
            $table->string('nomorIMB')->nullable();
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
