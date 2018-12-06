<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEpisodeDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episode_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('episode_id');
            $table->unsignedInteger('scrap_site_id');
            $table->string('url');
            $table->boolean('is_downlodable')->default(0);
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
        Schema::dropIfExists('episode_datas');
    }
}
