<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
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
     * Get all the properties related to the owner
     *
     * @return Collection
     */
    public function properties()
    {
        return $this->belongsToMany(Property::class);
    }

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
    public function addresses()
    {
        return $this->hasMany(OwnerAddress::class);
    }

    /**
     * Gets the associated user. one to one relationship
     *
     * @return User|null
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
