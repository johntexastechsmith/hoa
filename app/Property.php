<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'properties';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * Get the HOA that this property belongs to
     */
    public function hoa()
    {
        return $this->belongsTo(Hoa::class);
    }

    /**
     * Get the tickets related to this property
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function getStreetAddressAttribute()
    {
        return "{$this->street_number} {$this->street_name}";
    }

    public function getFullAddressAttribute()
    {
        return "{$this->street_number} {$this->street_name}, {$this->city}, {$this->state} {$this->zip}";
    }
}
