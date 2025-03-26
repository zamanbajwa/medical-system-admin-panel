<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    public $table = 'reminder';

    protected $fillable = [
        'id', '	patient_id', 'reminder_name','reminder_value'
    ];
}
