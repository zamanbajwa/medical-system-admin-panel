<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

//use Illuminate\Foundation\Auth\User as Authenticatable;



class hospital_staff_document extends Model

{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = 'hospital_staff_documents';

    protected $fillable = [
        'id', 'staff_id', 'document_path'
    ];

    public function staff()
    {
        return $this->belongsTo('App\HospitalStaff', 'staff_id');
    }



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

}
