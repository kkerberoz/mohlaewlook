<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use Notifiable;
    // protected $primaryKey = 'user_id';
    protected $guard = "employee";
    protected $table = 'employees';
    public $timestamps = false;
    protected $rememberTokenName = false;

    protected $fillable = [
        'username', 'password', 'title', 'name', 'surname', 'DOB', 'email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];


    public function getAuthPassword()
    {
        return $this->password;
    }
}
