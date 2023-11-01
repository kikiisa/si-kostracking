<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapings', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid',100)->unique();
            $table->foreignId('user_id');
            $table->foreignId("bahari_id");
            $table->string('nama_titik',75);
            $table->string('latitude',75);
            $table->string('longitude',75);
            $table->text('deskripsi');
            $table->text("deskripsi_full");
            $table->string('price')->nullable();
            $table->string('diskon')->nullable();
            $table->time('jam_buka')->nullable();
            $table->time('jam_tutup')->nullable();
            $table->string('image');
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
        Schema::dropIfExists('mapings');
    }
}
