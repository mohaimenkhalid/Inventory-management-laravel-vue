<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'salary', 'address', 'nid', 'joining_date', 'photo', 'gender'
    ];

    const IMAGE_PATH = '/uploads/employee/';
}
