<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
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
     *
     * @return Hoa
     */
    public function hoa()
    {
        return $this->belongsTo(Hoa::class);
    }

    /**
     * Get the tickets related to this property
     *
     * @return Collection
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    /**
     * Get all owners related to this property
     *
     * @return Collection
     */
    public function owners()
    {
        return $this->belongsToMany(Owner::class);
    }

    /**
     * @return string
     */
    public function getStreetAddressAttribute()
    {
        return "{$this->street_number} {$this->street_name}";
    }

    /**
     * @return string
     */
    public function getFullAddressAttribute()
    {
        return "{$this->street_number} {$this->street_name}, {$this->city}, {$this->state} {$this->zip}";
    }
}
