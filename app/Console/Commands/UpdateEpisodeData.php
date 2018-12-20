<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Animes;
use App\Services\AnimesProject;

class UpdateEpisodeData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'anime:episodes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Active Anime Database Services
     *
     * @var array
     */
    private $services = [
        AnimesProject::class
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $animes = Animes::has('episodes')->with('episodes', 'episodes.data')->get();

        foreach ($animes as $anime) {
            $this->info("Anime: {$anime->anime_title}");
            foreach ($this->services as $service) {
                $data = app($service)->getEpisodes($anime);
            }
        }
    }
}
