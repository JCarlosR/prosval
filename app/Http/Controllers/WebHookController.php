<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebHookController extends Controller
{
    public function webHook(Request $request)
    {
        Log::info($request->all());
        return "OK";
    }
}
