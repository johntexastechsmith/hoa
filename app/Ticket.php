<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tickets';

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
        'updated_at',
        'opened_at',
        'closed_at'
    ];

    /**
     * Get the property this ticket is for
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get the HOA that this ticket is a member of
     */
    public function hoa()
    {
        return $this->belongsTo(Hoa::class);
    }

    public function notes()
    {
        return $this->hasMany(TicketNote::class);
    }

    public function opener()
    {
        return $this->belongsTo(User::class, 'opened_by', 'id')->withDefault();
    }

    public function closer()
    {
        return $this->belongsTo(User::class, 'closed_by', 'id')->withDefault();
    }
}
