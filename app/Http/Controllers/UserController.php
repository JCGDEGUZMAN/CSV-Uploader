<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function importAdminUsers()
    {
        return User::importAdminUsers(request()->file('admin_user_file'));
    }
}
