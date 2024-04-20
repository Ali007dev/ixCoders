<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()  {
        $response = User::query()->get();
        $users = $response;
        return view('users.index', compact('users'));

       }

       public function update(Request $request,$id)  {
        $response = User::findOrFail($id);
         $response->update($request->toArray());
        return redirect()->back();

       }
}

