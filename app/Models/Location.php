<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'name',
        'address',
        'gmap_embed_url',
    ];

    public function poundfit_events()
    {
        return $this->hasMany(PoundfitEvent::class);
    }

    public function getGmapEmbedUrlShortAttribute()
    {
        return substr($this->gmap_embed_url, 0, 20) . '...';
    }
}
