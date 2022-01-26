<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersetujuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persetujuans', function (Blueprint $table) {
            $table->string('no_tiket')->primary();
            $table->foreign('no_tiket')->references('no_tiket')->on('pendaftarans');
            // $table->string('no_tiket')->unique();
            $table->foreignId('idAdmin')->nullable()->constrained('admins');
            $table->foreignId('idStatus')->default(1)->constrained('statuses');
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
        Schema::dropIfExists('persetujuans');
    }
}
