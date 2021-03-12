<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMagrolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magroles', function (Blueprint $table) {
            $table->id();
            $table->String('name');
            $table->String('slug');
            $table->timestamps();
        });

        DB::table('magroles')->insert(
            array(
                [
                    'name' => 'admin',
                    'slug' => 'admin'
                ],
                [
                    'name' => 'editor',
                    'slug' => 'editor'
                ],
                [
                    'name' => 'user',
                    'slug' => 'user'
                ]

            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('magroles');
    }
}
