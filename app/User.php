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
    * gets the board member if user is a board member.
    *
    * @return BoardMember|null
    */
    public function boardMember()
    {
        return $this->belongsTo(BoardMember::class);
    }   

    /**
     * tests if the user is a boardmember
     *
     * @return bool
     */
    public function isBoardMember()
    {
        if ($this->boardMember instanceof BoardMember) {
            return true;
        }

        return false;
    }

    /**
     * gets the ComplianceOfficer entity if user is a Compliance Officer.
     *
     * @return ComplianceOfficer|null
     */
    public function complianceOfficer()
    {
        return $this->belongsTo(ComplianceOfficer::class);
    }

    /**
     * Check if User is a Compliance Officer
     *
     * @return bool
     */
    public function isComplianceOfficer()
    {
        if ($this->complianceOfficer instanceof ComplianceOfficer) {
            return true;
        }

        return false;
    }
}
