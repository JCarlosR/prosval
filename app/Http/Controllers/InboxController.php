<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    public function webHook(Request $request)
    {
        Log::info($request->all());
        return "OK";
    }
}
