<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Auth;

class Addtask extends Model
{
    use HasFactory;
    protected $table="match";
    protected $primaryKey ="match_id";

protected $fillable = [
    'match_id','date','taskdescription ','othercomments ','assign_id',
];
    public static function putted($req)
    {
        $device = new AddTask;
        $device->date = $req->date;
        $device->taskdescription = $req->taskdescription;
        $device->othercomments = $req->othercomments;
        $device->assign_id = Auth::user()->id;
        $device->save();
    }
    public static function store($req,$match_id)
    {
        $device = Addtask::find($match_id);
        $device->date = $req->date;
        $device->taskdescription = $req->taskdescription;
        $device->othercomments = $req->othercomments;
        $device->assign_id = Auth::user()->id;
        $device->save();
   }
}