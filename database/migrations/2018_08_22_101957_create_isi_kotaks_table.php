<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIsiKotaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('isi_kotaks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('kotak_id')->nullable();
            $table->unsignedInteger('obat_id')->nullable();
            $table->boolean('expired')->default(false);
            $table->date('tgl_expired')->nullable();
            $table->boolean('ada')->default(false);
            $table->foreign('kotak_id')->references('id')->on('kotaks');
            $table->foreign('obat_id')->references('id')->on('obats');
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
        Schema::dropIfExists('isi_kotaks');
    }
}
