<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class HospitalStaff extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = 'hospital_staffs';

    protected $fillable = [
       'id', 'user_id','hospital_id','user_type','first_name','last_name', 'user_image','is_approved'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function hospital()
    {
        return $this->belongsTo('App\Hospital');
    }
    public function documents()
    {
        return $this->hasMany('App\hospital_staff_document','staff_id');
    }


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}