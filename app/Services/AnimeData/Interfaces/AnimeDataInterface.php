<?php

namespace App\Services\AnimeData\Interfaces;

use App\Animes;

interface AnimeDataInterface
{
    /**
     * Return an data of animes episodes from source.
     *
     * @param Animes $anime
     *
     * @return \Illuminate\Support\Collection
     */
    public function getEpisodes(Animes $anime);
}
