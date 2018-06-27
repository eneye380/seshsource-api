<?php

namespace SeshSource;

use SeshSource\Traits\Uuids;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, Uuids;

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
        'password', 'remember_token', 'type',
    ];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * A list of user types allowed to access business sections
     *
     * @var array
     */
    private $businessTypes = [
        'admin',
        'organizer'
    ];

    /**
     * Checks if user is allowed to access business sections
     *
     * @return string
     */
    public function isBusiness()
    {
        if ( in_array($this->type, $this->businessTypes) )
        {
            return true; 
        }
        else
        {
            return false;
        }
    }


    /**
     * Determines if user is admin or not (true or false)
     *
     * @return boolean
     */
    public function isAdmin() 
    {
        if($this->type == 'admin')
        {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determines if user is organizer or not (true or false)
     *
     * @return boolean
     */
    public function isOrganizer() 
    {
        if($this->type == 'organizer')
        {
            return true;
        } else {
            return false;
        }
    }
}
