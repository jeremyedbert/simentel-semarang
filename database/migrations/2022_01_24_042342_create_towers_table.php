<?php

use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\TipeJalan;
use App\Models\TipeMenara;
use App\Models\TipeSite;
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

            $table->unsignedBigInteger('kecamatan_id');
            $table->foreign('kecamatan_id')->references('id')->on('kecamatans');

            $table->unsignedBigInteger('kelurahan_id');
            $table->foreign('kelurahan_id')->references('id')->on('kelurahans');
            
            $table->unsignedBigInteger('tipe_menara_id');
            $table->foreign('tipe_menara_id')->references('id')->on('tipe_menaras');
            
            $table->unsignedBigInteger('tipe_site_id');
            $table->foreign('tipe_site_id')->references('id')->on('tipe_sites');
            
            $table->unsignedBigInteger('tipe_jalan_id');
            $table->foreign('tipe_jalan_id')->references('id')->on('tipe_jalans');
            // $table->foreignId('kecamatan_id');
            // $table->foreignId('kelurahan_id');
            // $table->foreignId('tipe_site_id');
            // $table->foreignId('tipe_jalan_id');
            // $table->foreignId('tipe_menara_id');
            $table->float('tinggi',4,1);
            $table->decimal('latitude',10,7);
            $table->decimal('longitude',10,7);
            $table->string('luas');
            $table->string('pemilik');
            $table->string('penyewa')->nullable();
            $table->string('nomorIMB')->nullable();
            $table->text('kondisi')->nullable();
            $table->string('url_file')->nullable();
            $table->date('accDate')->nullable();
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
