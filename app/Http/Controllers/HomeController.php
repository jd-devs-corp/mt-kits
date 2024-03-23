<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();

        if ($user) {
            $userRole = $user->role; // Assuming 'admin' or 'supplier'
        } else {
            $userRole = null;
        }

        return view('welcome', compact('userRole'));
    }


}
