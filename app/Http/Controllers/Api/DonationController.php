<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Models\Token;
use App\Models\Client;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\DonationRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $donations=DonationRequest::query();
        $donations=$donations->when($request->filled('governorate_id'), function ($q) use($request) {
                return $q->whereHas('city',function($q) use($request){
                return $q->where('governorate_id',$request->get('governorate_id'));
            });

           })->when($request->filled('blood_type_id'),function($q) use($request){
            return $q->where('blood_type_id',$request->get('blood_type_id'));
          })->get();
     if($donations){
       return count($donations) > 0?responseJson(1,'success',$donations):responseJson(1,'no results',$donations);
    }
     else{
        return responseJson(0,'failed');
     }
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
        $validator=validator()->make($request->all(),[
            'patient_name'=>'required',
            'patient_phone'=>'required|regex:/(01)[0-9]{9}/',
            'patient_age'=>'required',
            'bags_num'=>'required',
            'city_id'=>'required',
            'blood_type_id'=>'required',
            'hospital_address'=>'required',
            'details'=>'required',
            'longitude'=>'required',
            'latitude'=>'required',
       ]);
       if($validator->fails()){
           return responseJson(0,$validator->errors()->first(),$validator->errors());
       }
        // DB::beginTransaction();
        $donation=DonationRequest::create([
            'patient_name' =>$request->patient_name,
            'patient_phone'=>$request->patient_phone,
            'city_id'=>$request->city_id,
            'hospital_name'=>$request->hospital_name,
            'blood_type_id'=>$request->blood_type_id,
            'patient_age' =>$request->patient_age,
            'bags_num'=>$request->bags_num,
            'hospital_address'=>$request->hospital_address,
            'details'=>$request->details,
            'longitude'=>$request->longitude,
            'latitude' =>$request->latitude,
            'client_id'=>$request->user()->id
    
        ]);
        $notification=$donation->notification()->create([
            'title'=>'يوجد حالة تبرع',
            'content'=>$donation->patient_name.' make a donation request'
             ]);
        $clientids=$donation->city->governorate->clients()->whereHas('bloodTypes',function($q) use($donation){
             return $q->where('blood_types.id',$donation->blood_type_id);
        })->pluck('clients.id')->toArray();
        $notification->clients()->attach($clientids,['is_seen'=>0]);
            $tokens=Token::whereIn('client_id',$clientids)->where('token','!=',null)->pluck('token')->toArray();
            if(count($tokens)>0){
            $title=$notification->title;
            $body=$notification->content;
            $data=[
                'donation_request_id'=>$donation->id
            ];
            $send=notifyByFirebase($title,$body,$tokens,$data);
            }

        return responseJson(1,'donation request send successfully',$donation);
    }

     public function notifications(){
         $client=auth('api')->user();
        return responseJson(1,'your notifications',$client->notifications);
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
    $donation=Donation::find($id);
    if($donation){
    return responseJson(1,'success',$donation);
    }
    else{
    return responseJson(0,'faild');

    }

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
    }
}
