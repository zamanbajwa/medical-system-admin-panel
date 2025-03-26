<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MedicalHistory extends Authenticatable
{
    use Notifiable;
    public $table = 'medical_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                'patient_id','illness_name','illness_detail','doctor_id','date','images'
    ];

    public function documents()
    {
        return $this->hasMany('App\MedicalHistoryDocument');
    }
    public function doctor()
    {
        return $this->belongsTo('App\ReferenceDoctor');
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
