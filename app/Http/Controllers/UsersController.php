<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index() {
        return view('users.index', ['users' => User::all()]);
    }

    public function makeAdmin(User $user) {
        $user->role = 'admin';
        $user->save();
        return redirect()->back()->with('success', 'User have been promoted to an Admin');
    }
}
