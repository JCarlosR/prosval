<?php

namespace App\Http\Controllers;

use App\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function manual()
    {
        return view('campaign.create-manual');
    }

    public function store(Request $request)
    {
        $campaign = new Campaign();
        $campaign->name = $request->name;
        $campaign->status = 'Pendiente';
        $campaign->type = $request->type;
        $campaign->save();
        return redirect('/campaigns/edit/'.$campaign->id);
    }

    public function edit(Campaign $campaign)
    {
        return view('campaign.edit-manual')->with(compact('campaign'));
    }

    public function automatic()
    {
        return view('campaign.automatic');
    }

    public function index()
    {
        $campaigns = Campaign::all();
        return view('campaign.index')->with(compact('campaigns'));
    }

    public function schedule(Campaign $campaign)
    {
        $campaign->status = 'Programado';
        $campaign->save();

        return redirect('/campaigns');
    }

}
