<?php

namespace App\Http\Controllers;

use App\Models\BloodType;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Models\DonationRequest;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $donation_requests=DonationRequest::with(['city','bloodType'])->paginate(10);
        $blood_types=BloodType::all();
        $governorates=Governorate::all();
        return view('donations.index',compact('donation_requests','blood_types','governorates'));

    }

    public function search(Request $request)
    {
        $blood_types=BloodType::all();
        $governorates=Governorate::all();
    $donation_requests=DonationRequest::query();
    $donation_requests=$donation_requests->when($request->filled('blood_type'), function ($q) use($request) {
         return $q->where('blood_type_id',$request->blood_type );
        })->when($request->filled('search'),function($q){
            return $q->where('patient_name', 'like', '%' . request('search') . '%');
       })->when($request->filled('governorate_id'),function($q){
        return $q->whereHas('city',function($q){
            return $q->where('governorate_id',request('governorate_id') );
        });
            })->paginate(10);

     return view('donations.index',compact('donation_requests','blood_types','governorates'));


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $donation_request=DonationRequest::find($id);
        return view('donations.show',compact('donation_request'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $donation_request=DonationRequest::find($id);
        $donation_request->delete();
        flash('donation deleted successfully')->success();
        return redirect()->route('donations.index');

    }
}
