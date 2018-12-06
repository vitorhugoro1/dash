<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('anime_id');
            $table->string('anime_title');
            $table->integer('anime_airing_status');
            $table->integer('anime_num_episodes')->default(0);
            $table->integer('num_watched_episodes')->nullable();
            $table->date('anime_start_date_string')->nullable();
            $table->date('anime_end_date_string')->nullable();
            $table->integer('score')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animes');
    }
}
