<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EpisodeData extends Model
{
    protected $fillable = ['episode_id', 'scrap_site_id', 'url', 'is_downlodable'];

    protected $casts = [
        'is_downlodable' => 'boolean'
    ];

    public function episode()
    {
        return $this->belongsTo(Episodes::class, 'id');
    }
}
