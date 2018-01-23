<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OwnerAddress extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'owner_addresses';

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
    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }
}
