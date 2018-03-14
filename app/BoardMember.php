<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BoardMember extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'board_members';
  
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
     * Get the HOA that this board member belongs to
     *
     * @return Hoa
     */
    public function hoa()
    {
        return $this->belongsTo(Hoa::class);
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
