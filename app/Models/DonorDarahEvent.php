<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class DonorDarahEvent extends Model
{
    /** @use Illuminate\Database\Eloquent\SoftDeletes */
    use SoftDeletes;

    protected $fillable = [
        'location_id',
        'event_datetime',
        'ticket_price',
        'pic_whatsapp',
        'is_published',
        'registrant_limit',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function registrants()
    {
        return $this->hasMany(Registrant::class);
    }

    public function getEventDateOnlyAttribute()
    {
        return Carbon::parse($this->event_datetime)->format('Y-m-d');
    }

    public function getEventTimeOnlyAttribute()
    {
        return Carbon::parse($this->event_datetime)->format('H:i');
    }

    public function getEventDateIndAttribute()
    {
        return Carbon::parse($this->event_datetime)->format('d F Y');
    }

    public function getEventTimeIndAttribute()
    {
        return Carbon::parse($this->event_datetime)->format('H:i') . ' WIB - Selesai';
    }

    public function getPicWhatsappLinkAttribute()
    {
        return 'https://wa.me/' . $this->pic_whatsapp;
    }

    public function getIsPublishedBadgeAttribute()
    {
        if ($this->is_published) {
            return '<span class="badge bg-success">Aktif</span>';
        }

        return '<span class="badge bg-danger">Tidak Aktif</span>';
    }
}
