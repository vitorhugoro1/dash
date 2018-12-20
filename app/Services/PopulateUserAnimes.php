<?php

namespace App\Services;

use App\Animes;
use App\Episodes;
use App\Helpers\Jikan\ListItem;
use App\User;
use Illuminate\Support\Collection;
use Jikan\Jikan;
use Jikan\Model\Anime\Anime;

class PopulateUserAnimes
{
    /**
     * Undocumented variable
     *
     * @var Jikan
     */
    private $jikan;

    public function __construct()
    {
        $this->jikan = new Jikan();
    }

    public function __invoke(User $user)
    {
        $animes = $this->getAnimeList($user->mal_username);

        foreach ($animes as $anime) {
            $saved = $this->saveAnime($anime);

            try {
                $episodes = $this->getEpisodeList($anime['malId']);
            } catch (\Exception $e) {
                continue;
            }

            $maped = $episodes->map(function (array $episode) {
                return [
                    'episode_id' => $episode['episodeId'],
                    'title' => null,
                    'english_title' => $episode['title'],
                    'aired_at' => $episode['aired'],
                ];
            });

            $hasNewEpisodes = Episodes::all();

            if ($hasNewEpisodes->count() < $maped->count()) {
                $maped = $maped->whereNotIn('episode_id', $hasNewEpisodes->pluck('episode_id')->toArray());
                $saved->episodes()->createMany($maped->toArray());
            }
        }
    }

    /**
     * Fill $anime data and save in table
     *
     * @param array $anime
     *
     * @return \App\Animes|null
     */
    private function saveAnime(array $anime): ?Animes
    {
        return Animes::updateOrCreate([
            'anime_id' => $anime['malId'],
            'anime_title' => $anime['title'],
        ], [
            'anime_airing_status' => $anime['airingStatus'],
            'anime_num_episodes' => $anime['totalEpisodes'],
            'num_watched_episodes' => $anime['watchedEpisodes'],
            'score' => $anime['score'],
            'anime_start_date_string' => $anime['startDate'],
            'anime_end_date_string' => $anime['endDate'],
        ]);
    }

    private function getEpisodeList(int $malId)
    {
        $episodes = $this->jikan->AnimeEpisodes($malId);
        $list = collect();

        foreach ($episodes->getEpisodes() as $episode) {
            $list->push(app(ListItem::class)->__invoke($episode));
        }

        return $list;
    }

    /**
     * Get User anime list with collection
     *
     * @param string $username
     *
     * @return \Illuminate\Support\Collection
     */
    private function getAnimeList(string $username): Collection
    {
        $items = $this->jikan->UserAnimeList($username);
        $list = collect();

        foreach ($items as $item) {
            $list->push(app(ListItem::class)->__invoke($item));
        }

        return $list;
    }
}
