<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registrant extends Model
{
    protected $fillable = [
        'poundfit_event_id',
        'name',
        'gender',
        'email',
        'phone',
        'city',
        'phone_emergency',
        'name_emergency',
        'bring_ripstix',
        'poundfit_info',
        'poundfit_info_etc',
        'are_attending',
        'barcode',
        'eticket',
    ];

    public function poundfit_event()
    {
        return $this->belongsTo(PoundfitEvent::class);
    }

    public function getBringRipstixBadgeAttribute()
    {
        return $this->bring_ripstix ? '<span class="badge bg-success">Ya</span>' : '<span class="badge bg-danger">Tidak</span>';
    }

    public function getAreAttendingBadgeAttribute()
    {
        return $this->are_attending ? '<span class="badge bg-success">Ya</span>' : '<span class="badge bg-danger">Tidak</span>';
    }
}
