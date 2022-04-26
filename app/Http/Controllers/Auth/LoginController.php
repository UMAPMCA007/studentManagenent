<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //logout 
    public function logout(Request $request)
    {
        // logout controller
        $request->session()->invalidate();
        return redirect('/');


    }


}
