<?php

namespace VitorHugo\Jikan\Models;

use Illuminate\Support\Collection;
use Jikan\Jikan;

class Anime
{
    /**
     * Jikan Wrapper
     *
     * @var \Jikan\Jikan
     */
    private $jikan;

    public function __construct()
    {
        $this->jikan = new Jikan();
    }

    public static function find(int $id): \Illuminate\Support\Collection
    {
        $anime = $this->jikan->Anime($id);

        return new Collection();
    }
}
