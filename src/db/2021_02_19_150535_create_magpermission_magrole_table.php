<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagpermissionMagroleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magpermission_magrole', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('magpermission_id');
            $table->unsignedBigInteger('magrole_id');
            $table->foreign('magpermission_id')->references('id')->on('magpermissions');
            $table->foreign('magrole_id')->references('id')->on('magroles');
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
        Schema::dropIfExists('magpermission_magrole');
    }
}
