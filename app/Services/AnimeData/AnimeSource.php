<?php

namespace App\Services\AnimeData;

use App\Animes;
use Illuminate\Support\Collection;
use App\Console\Commands\UpdateEpisodeData;
use App\Services\AnimeData\Interfaces\AnimeDataInterface;

abstract class AnimeSource implements AnimeDataInterface
{
    /**
     * @var UpdateEpisodeData
     */
    protected $command;

    public function __construct(UpdateEpisodeData $command)
    {
        $this->command = $command;
    }

    /**
     * Search in source.
     *
     * @param string $title
     *
     * @return Collection
     */
    protected function searchIn(string $title): Collection
    {
    }

    /**
     * Save or update episodes data.
     *
     * @param Animes          $anime
     * @param Collection|null $episodes
     */
    protected function saveEpisodes(Animes $anime, ?Collection $episodes): void
    {
        if (optional($episodes)->isEmpty()) {
            return;
        }

        $hasFromSource = $animes->episodes->data->where('scrap_site_id', self::SCRAP_SITE_ID)
                                ->pluck('episode_id')->toArray();

        $filtered = $episodes->whereNotIn('episode_id', $hasFromSource);

        foreach ($anime->episodes as $anime_episode) {
            $new = $filtered->where('episode_id', $anime_episode->episode_id)->first();

            if (!$new) {
                continue;
            }

            $episode->data()->updateOrCreate([
                'scrap_site_id' => self::SCRAP_SITE_ID,
                'episode_id' => $new['episode_id'],
            ], $new);
        }
    }
}
