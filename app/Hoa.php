<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hoa extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hoa';

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
     * Get the properties in the HOA
     */
    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    /**
     * Get the properties in the HOA
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
