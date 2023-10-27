<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {

        return $request->user()->can('add product') ? 1 : 0;
        return User::all();
    }
}
