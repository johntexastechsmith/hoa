<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * gets tickets user has opened.
     *
     * @return Ticket|null
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'id', 'opened_by');
    }

    /**
     * gets the notes the user has created
     *
     * @return TicketNote|null
     */
    public function notes()
    {
        return $this->hasMany(TicketNote::class, 'id', 'created_by');
    }

    /**
     * gets the owner if user is a owner.
     *
     * @return Owner|null
     */
    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    /**
    * gets the board member if user is a baord member.
    *
    * @return BoardMember|null
    */
    public function boardmember()
    {
        return $this->belongsTo(BoardMember::class);
    }   
}
