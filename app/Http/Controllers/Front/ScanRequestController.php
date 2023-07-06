<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ScanRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScanRequestController extends Controller
{
    // index
    public function index()
    {
        $scanRequests = ScanRequest::query()->get();
        return view('front.scan-request.index', compact('scanRequests'));
    }
    // store
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required',
            'patient_id' => 'required',
            'clinic_id' => 'required',
            'doctor_id' => 'required',
        ]);
        ScanRequest::query()->create($request->except('_token'));
        return back()->withSuccess('Scan request has been sent successfully');
    }
    // update
    public function update(Request $request, ScanRequest $scanRequest)
    {
        $this->validate($request, [
            'status' => 'required',
        ]);
        $data = $request->except('_token');
        switch ($data['status']) {
            case 'scanned':
                $data['scanned_at'] = Carbon::now()->toDateTimeString();
                break;
            case 'delivered':
                $data['delivered_at'] = Carbon::now()->toDateTimeString();
                break;
        }
        $scanRequest->update($data);
        return back()->withSuccess('Scan request has been updated successfully');
    }
}
