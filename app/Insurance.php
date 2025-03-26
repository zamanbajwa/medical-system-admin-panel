<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
	public $table = 'insurances';
    protected $fillable = ['patient_id','name','policy_number','carrier_number','category','expiry_date','providers','insurance_pcp','insurance_pharmacy'];

        /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
}
