<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\CampaignDetail;
use Illuminate\Http\Request;

class CampaignDetailController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Campaign $campaign)
    {
        return view('campaign.details')->with(compact('campaign'));
    }

    public function store(Request $request, Campaign $campaign)
    {
        $rules = [
            'phone' => 'required'
        ];
        $this->validate($request, $rules);

        $detail = new CampaignDetail();
        $detail->campaign_id = $campaign->id;
        $detail->schedule_date = $request->schedule_date;
        $detail->schedule_time = $request->schedule_time;
        $detail->name = $request->name;
        $detail->phone = $request->phone;
        $detail->property = $request->property;
        $detail->message = $request->message;
        $detail->link = $request->link;
        $detail->status = 'Pendiente';
        $detail->save();

        return back();
    }

    public function destroy(CampaignDetail $detail)
    {
        $detail->delete();
        return back();
    }

    public function update(Request $request)
    {
        $rules = [
            'phone' => 'required'
        ];
        $this->validate($request, $rules);

        $detail = CampaignDetail::find($request->input('detail_id'));
        $detail->schedule_date = $request->schedule_date;
        $detail->schedule_time = $request->schedule_time;
        $detail->name = $request->name;
        $detail->phone = $request->phone;
        $detail->property = $request->property;
        $detail->message = $request->message;
        $detail->link = $request->link;
        $detail->status = 'Pendiente';
        $detail->save();

        return back();
    }
}
