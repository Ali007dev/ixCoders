<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    //show users
    public function index()  {
        $response = User::query()->get();
        $users = $response;
        return view('users.index', compact('users'));

       }


}

