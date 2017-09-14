<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function data()
    {
        return view('contact.data');
    }

    public function spam()
    {
        return view('contact.spam');
    }

}
