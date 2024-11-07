<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Registrant extends Model
{
    protected $fillable = [
        'donor_darah_event_id',
        'name',
        'gender',
        'dob',
        'email',
        'phone',
        'city',
        'phone_emergency',
        'name_emergency',
        'golongan_darah',
        'rhesus',
        'weight',
        'previous_donation',
        'donor_darah_info',
        'donor_darah_info_etc',
        'are_attending',
        'barcode',
        'eticket',
    ];

    public function donor_darah_event()
    {
        return $this->belongsTo(DonorDarahEvent::class);
    }

    public function getPreviousDonationBadgeAttribute()
    {
        return $this->previous_donation ? '<span class="badge bg-success">Ya</span>' : '<span class="badge bg-danger">Tidak</span>';
    }

    public function getAreAttendingBadgeAttribute()
    {
        return $this->are_attending ? '<span class="badge bg-success">Ya</span>' : '<span class="badge bg-danger">Tidak</span>';
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['dob'])->age;
    }
}
