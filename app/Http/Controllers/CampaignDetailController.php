<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CampaignDetailController extends Controller
{

    public function index()
    {
        return view('campaign.detail');
    }

}
