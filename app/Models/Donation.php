<?php

namespace App\Models;

use App\Models\District;
use App\Models\DonationType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'donation_type_id',
        'phone',
        'add_line_1',
        'add_line_2',
        'add_line_3',
        'latitude',
        'longitude',
        'district_id',
        'state',
        'nic',
        'image_url_1',
        'image_url_2',
        'donater_id',
        'driver_id'
    ];

    protected $appends = [
        'donation_type',
        'district',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function donationType()
    {
        return $this->belongsTo(DonationType::class);
    }

    public function getDistrictAttribute()
    {
        return ($this->district()->first())?($this->district()->first()->name):(null);
    }

    public function getDonationTypeAttribute()
    {
        return ($this->donationType()->first())?($this->donationType()->first()->name):(null);
    }
}
