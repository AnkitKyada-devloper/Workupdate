<?php

namespace App\Http\Controllers;

use App\Models\Person;

use Illuminate\Http\Request;

class RestController extends Controller
{
    public function store(Request $req)
    {
        $validated = $req->validate([
            'fullname' => 'required|max:255',
            'email' => 'required|unique:register',
            'password' => 'required|min:6',
            'phonenumber' => 'max:10|min:10',
            'jobtitle' => 'required|max:255',
            'date' =>'mm/dd/yyyy',
            'taskdescription' => 'required|max:255',
            'othercomments' => 'requierd|max:255'

        ]);

        $person = new Person;
        $person->fullname = $req->fullname;
        $person->email = $req->email;
        $person->password = MD5($req->password);
        $person->phonenumber = $req->phonenumber;
        $person->jobtitle = $req->jobtitle;
        
        $person->save();
        return response()->json(['message' => 'Successfully Register']);

    }
    public function logged(Request $req)
    {

        $abc = Person::where('email', '=', $req->email)->where('password', '=', MD5($req->password))->first();
        if ($abc) {
            $tokenResult = $abc->createToken('Access Token');
            return response()->json([
                'message' => 'email&password  is correct ',
                'access_token' => $tokenResult->accessToken
            ]);
        } else {
            return response()->json(['message' => 'email&password is incorrect ']);
        }
    }
}