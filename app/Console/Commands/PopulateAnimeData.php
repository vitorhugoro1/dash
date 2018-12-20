<?php

namespace App\Console\Commands;

use App\Services\PopulateUserAnimes;
use App\User;
use Illuminate\Console\Command;

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
        $users = app(User::class)->where('is_active', true)->get();

        $users->each(function ($user) {
            app(PopulateUserAnimes::class)->__invoke($user);
        });
    }
}
