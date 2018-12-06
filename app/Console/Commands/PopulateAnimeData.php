<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Jikan\Jikan;

class PopulateAnimeData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:anime';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get active users and get you informations from MAL';

    /**
     * @var Jikan
     */
    private $jikan;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->jikan = new Jikan();
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = app(User::class)->where('is_active', true)->get();

        $users->each(function (User $user) {
            $animes = $this->jikan->UserAnimeList($user->mal_username);


            dd();
        });
    }
}
