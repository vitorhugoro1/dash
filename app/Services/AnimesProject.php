<?php

namespace App\Services;

use App\Animes;
use Goutte\Client;
use Illuminate\Support\Collection;
use Symfony\Component\DomCrawler\Crawler;
use App\Console\Commands\UpdateEpisodeData;


class AnimesProject
{
    const SCRAP_SITE_ID = 1;

    /**
     * @var Client
     */
    private $goutte;

    /**
     * @var string
     */
    private $home = "https://anidex.net/";

    /**
     * @var string
     */
    private $punchSubs = "https://punchsubs.net/";

    /**
     * @var \GuzzleHttp\Client
     */
    private $guzzle;

    /**
     * Undocumented variable
     *
     * @var UpdateEpisodeData
     */
    private $command;

    public function __construct(UpdateEpisodeData $command)
    {
        $this->command = $command;
        $this->goutte = new Client();
        $this->guzzle = new \GuzzleHttp\Client([
            'base_uri' => $this->home
        ]);

        $this->goutte->setClient($this->guzzle);
    }

    public function getEpisodes(Animes $anime)
    {
        $search = $this->searchIn($anime->anime_title);

        if ($search->isEmpty()) {
            return collect();
        }

        $episodes = $anime->episodes;

        foreach ($search as $finded) {
            $onlineEpisodes = $this->getTvEpisodes($finded);
            $onlineEpisodes = $onlineEpisodes->whereNotIn('episode_id', $episodes->pluck('data.0.episode_id')->toArray());
            if ($onlineEpisodes->isNotEmpty()) {
                foreach ($episodes as $episode) {
                    $online = $onlineEpisodes->where('episode_id', $episode->episode_id)->first();

                    if (!$online) {
                        continue;
                    }

                    $episode->data()->updateOrCreate([
                        'scrap_site_id' => self::SCRAP_SITE_ID,
                        'episode_id' => $online['episode_id']
                    ], $online);
                }
            }
        }
    }

    /**
     * Get TV episodes from results
     * if not has tv episodes, nothing will catched
     *
     * @param array $finded
     * @return Collection
     */
    private function getTvEpisodes(array $finded): Collection
    {
        $viewOnline = collect();
        $crawler = $this->goutte->request('GET', $finded['link']);

        $crawler->filter('#this-serie-tv > a')
            ->each(function (Crawler $node) use (&$viewOnline) {
                $link = $node->link();

                $viewOnline->push([
                    'title' => '',
                    'url' => $link->getUri(),
                    'episode_id' => (int) str_replace("Episódio ", "", $node->text()),
                    'is_downlodable' => false,
                    'scrap_site_id' => self::SCRAP_SITE_ID
                ]);
            });

        return $viewOnline;
    }

    /**
     * Find in this anime source
     *
     * @param string $title
     * @return Collection
     */
    private function searchIn(string $title): Collection
    {
        $links = collect();

        $response = $this->guzzle->post('seriesBusca.php', [
            'form_params' => [
                'v' => $title
            ]
        ]);

        $crawler = new Crawler((string)$response->getBody());

        $crawler->filter('li.search-result')
            ->each(function (Crawler $node) use (&$links) {
                $links->push([
                    'name' => $node->text(),
                    'link' => $node->filter('a')->attr('href')
                ]);
            });

        return $links->whereSimilar('name', $title, 80);
    }
}