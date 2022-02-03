<?php

use App\Models\Status;
use App\Models\User;
use App\Models\Admin;
use App\Models\Tower;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            // $table->id();
            $table->unsignedBigInteger('id')->primary();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('admin_id')->nullable();
            $table->foreign('admin_id')->references('id')->on('admins');

            $table->unsignedBigInteger('tower_id');
            $table->foreign('tower_id')->references('id')->on('towers');

            $table->unsignedBigInteger('status_id')->default(1);
            $table->foreign('status_id')->references('id')->on('statuses');

            // $table->foreignId('admin_id')->nullable();
            // $table->foreignId('tower_id');
            // $table->foreignId('status_id')->default(1);
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
        Schema::dropIfExists('pendaftarans');
    }
}
