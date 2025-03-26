<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable
{
    use Notifiable;

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'user_name' => 'string',
        'first_name' => 'string',
        'last_name' => 'string',
        'thumb_id' => 'string',
        'user_image' => 'string',
        'phone_number' => 'string',
        'blood_type' => 'string',
        'age' => 'integer',
        'gender' => 'string',
        'ssn' => 'string',
        'location' => 'string',
        'lat' => 'float',
        'lng' => 'float',
        'state' => 'string',
        'city' => 'string',
        'street' => 'string',
        'dl_number' => 'string',
        'dnr' => 'string',
    ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = 'patients';
    protected $fillable = [
        'user_id','user_name','phone_number','blood_type','age','ssn','gender','location','state','dl_number','dnr', 'fb_id','user_image','city','street'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function medicalHistory()
    {
        return $this->hasMany('App\MedicalHistory');
    }

    public function patientReminder()
    {
        return $this->hasMany('App\Reminder');
    }

     public function patientInsurance()
    {
        return $this->hasOne('App\Insurance');
    }

    
    protected $hidden = [
        'password', 'remember_token',
    ];
}
