<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = "employee";
    protected $fillable = [
        'role_id',
        'name',
        'profile_pic',
        'email',
        'phone_number',
        'gender',
        'address',
        'status'
    ];  
    
    public function role()
    {

        return $this->belongsTo('App\Models\Role','role_id','id');

    }
}
