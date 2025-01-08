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

    public function donor_darah_events()
    {
        return $this->hasMany(DonorDarahEvent::class);
    }

    public function registrants()
    {
        return $this->hasManyThrough(Registrant::class, DonorDarahEvent::class);
    }

    public function getGmapEmbedUrlShortAttribute()
    {
        return substr($this->gmap_embed_url, 0, 20) . '...';
    }
}
