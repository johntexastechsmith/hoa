<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'owners';

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
     * Get the property that this property belongs to
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

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
    public function addresses()
    {
        return $this->hasMany(OwnerAddress::class);
    }
}
