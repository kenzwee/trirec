<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function add()
    {
        return view('auth.profile.create');
    }
    
    public function create()
    {
        return view('auth/profile/create');
    }
    
    public function edit()
    {
        return view('auth.profile.edit');
    }
    
    public function update()
    {
        return view('auth/profile/edit')
    }
}
