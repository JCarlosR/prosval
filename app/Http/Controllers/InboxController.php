<?php

namespace App\Http\Controllers;

class InboxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('inbox');
    }

}
