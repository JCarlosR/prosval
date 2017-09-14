<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CampaignDetailController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('campaign.detail');
    }

}
