<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\Addtask;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class taskController extends Controller
{
    public function task(Request $req)
    {
        $validated = $req->validate([
            'fullname' => 'required|max:255',
            'email' => 'required|unique:authtask',
            'password' => 'required|min:6',
            'phonenumber' => 'max:10|min:10',
            'jobtitle' => 'required|max:255',
        ]);

        Task::add($req);   //ADD DATA CODE IN MODEL
         $res_message = 'Successfully Register';
        return response()->json(['mes' => $res_message],200);

    }
    public function add1(Request $req,$match_id=null)
    {
        $validated = $req->validate([
            'date' => 'required|date:YYYY-MM-DD',
            'taskdescription' => 'required|max:255',
            'othercomments' => 'required|max:255'
        ]);
        if (is_null($match_id)) {
            Addtask::putted($req);
            return response()->json(['mes' => 'Successfully Added'],200);
        }else{
            Addtask::store($req,$match_id);
        }
            return response()->json(['mes' => 'Successfully Updated'],200);
    }
//1
    public function match(Request $req)
    {
        $abc = Task::where('email', '=', $req->email)->where('password', '=', MD5($req->password))->first(); 
        {
            if ($abc) {
                $tokenResult = $abc->createToken('Access Token');
                return response()->json([
                    'message' => 'email&password  is correct ',
                    'access_token' => $tokenResult->accessToken
                ]);
            } else {
                return response()->json(['mes' => 'email&password is incorrect ']);
            }
        }
    }

    public function taskgrp()
    {
        $data = Addtask::where('assign_id', Auth::user()->id)->groupBy('date')->get();
        return response()->json([$data],200);
    }

    public function gett(Request $req,$date)
    {
        $call = Addtask::select('taskdescription', 'date')->where('date', $date)->get();
        return response()->json(['mes' =>'Successfully Get',$call]);

    }

    public function store(Request $req,$match_id)
    {
        $abc = Addtask::select('date', 'taskdescription', 'assign_id', 'othercomments')->where('match_id', '=', $req->match_id)->get();
        return response()->json([$abc]);
    }

    public function update(Request $req,$match_id)
    {
     Addtask::store($req,$match_id);
     return response()->json(['mes' => 'Successfully update'], 200);
    }

    public function clear($match_id)
    {
        $remove1 = Addtask::find($match_id);
        if ($remove1) {
            $remove1->delete();
            return response()->json(['mes' => 'Successfully delete'], 200);
        }
        return response()->json(['mes' => 'fail'], 404);
    }

    public function list(Request $req,$date)
    {
        $list = Addtask::where('date', $date)->get();
        return response()->json(['mes' => 'Successfully Get',$list],200);
    }


    // public function forgot(Request $req)
    // {
    //     $validator = $req->validate([
    //         'email' => 'required|unique:authask'
    //     ]);

    // }
}
