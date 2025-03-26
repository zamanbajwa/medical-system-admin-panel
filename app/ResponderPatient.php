<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ResponderPatient extends Model
{
       use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = 'responder_patient';

    protected $fillable = [
        'id', '	respondent_id', 'patient_id','status','lat','lng'
    ];

    public function patientInfo()
    {
        return $this->hasOne('App\Patient','id', 'patient_id');
    }

    public function responderInfo()
    {
        return $this->hasOne('App\FirstResponderDetail','user_id', 'respondent_id');
    }

    public function hospitalRespoder()
    {
        return $this->hasOne('App\HospitalStaff','user_id', 'respondent_id');
    }

    



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];
}
