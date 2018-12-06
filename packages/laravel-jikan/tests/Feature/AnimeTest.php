<?php

use Orchestra\Testbench\TestCase;
use VitorHugo\Jikan\Models\Anime;

/**
 * AnimeTest
 * @group Feature
 */
class AnimeTest extends TestCase
{
    /** @test */
    public function find_anime_function()
    {
        $model = new Anime();

        $anime = $model->find(1);

        $this->assertInstanceOf('Illuminate\Support\Collection', $anime);
    }
}
