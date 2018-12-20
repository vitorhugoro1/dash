<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episodes extends Model
{
    protected $fillable = ['anime_id', 'episode_id', 'title', 'english_title', 'aired_at'];

    protected $dates = ['aired_at'];

    public function anime()
    {
        return $this->belongsTo(Animes::class, 'anime_id', 'anime_id');
    }

    public function data()
    {
        return $this->hasMany(EpisodeData::class, 'episode_id');
    }
}
