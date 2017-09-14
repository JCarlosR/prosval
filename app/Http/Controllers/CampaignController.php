<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CampaignController extends Controller
{

    public function manual()
    {
        return view('campaign.manual');
    }

    public function automatic()
    {
        return view('campaign.automatic');
    }

    public function index()
    {
        return view('campaign.index');
    }

}
