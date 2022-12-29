<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Person extends Model
{
    use HasFactory;
    use HasApiTokens;
    protected $table="register";
    protected $primarykey="id";
    protected $fillable = [
        'fullname',
        'email',
        'password',
        'phonenumber',
        'jobtitle',
       
    
    ];
}