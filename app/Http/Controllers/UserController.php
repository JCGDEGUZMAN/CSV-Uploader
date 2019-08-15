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

    public function importDistributors()
    {
        return User::importDistributors(request()->file('distributor_user_file'));
    }
}
