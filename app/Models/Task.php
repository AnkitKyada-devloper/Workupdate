<?php

namespace App\Models;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;



class Task extends Authenticatable
{
    use HasFactory;
    use HasApiTokens;
    protected $table="authtask";
    protected $primarykey="id";
    protected $fillable = [
        'fullname', 'email','password','phonenumber','jobtitle', ];
    public static function add($req,$id=null){
        $person = new Task;
        $person->fullname = $req->fullname;
        $person->email = $req->email;
        $person->password = MD5($req->password);
        $person->phonenumber = $req->phonenumber;
        $person->jobtitle = $req->jobtitle;
        $person->save();
    } 
}
