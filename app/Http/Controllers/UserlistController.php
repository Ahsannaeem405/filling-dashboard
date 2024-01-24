<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserlistController extends Controller
{
    public function index()
    {
        $users = User::where('role','user')->get();
        $register = $users->count();
        $active = User::whereNot('role','admin')->where('status','active')->count();
        $pending = User::whereNot('role','admin')->where('status','in-active')->count();

        

        return view('admin.userlist',compact('users','register','active','pending'));
    }
}
