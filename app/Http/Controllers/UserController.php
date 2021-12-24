<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function register(request $req)
    {
        $user = new User;
        $user->name= $req->input('name');
        $user->email= $req->input('email');
        $user->password= $req->input('password');
        $user->save();
        return $user;
    }
    function login(request $req){
        $user = User::where('email', $req->input('email'))->first();
        if(!$user || !Hash::check($req->input('password') , $user->password)){
            return ['status' => false];
        }return $user;
    }
}
