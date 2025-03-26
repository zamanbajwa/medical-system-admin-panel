<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    protected $table = "users";
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'user_type','session_id','is_approved'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function staff()
    {
        return $this->hasOne('App\HospitalStaff');
    }

    public function hospital()
    {
        return $this->hasOne('App\Hospital');
    }
    
    public function patientInfo()
    {
        return $this->hasOne('App\Patient');
    }

}
