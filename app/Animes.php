<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Animes extends Model
{
    use SoftDeletes;

    protected $fillable = ['anime_id', 'anime_title', 'anime_airing_status', 'anime_num_episodes', 'num_watched_episodes', 'anime_start_date_string', 'anime_end_date_string', 'score'];

    protected $dates = ['anime_start_date_string', 'anime_end_date_string'];

    public function episodes()
    {
        return $this->hasMany(Episodes::class, 'anime_id', 'anime_id');
    }
}
