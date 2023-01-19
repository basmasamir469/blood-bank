<?php

namespace App\Http\Controllers\Front;

use App\Models\City;
use App\Models\Client;
use App\Models\BloodType;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    //
    public function profile(){
        $client=Auth::guard('front')->user()->load('city');
        $governorates=Governorate::all();
        $blood_types=BloodType::all();
        $cities=City::where('governorate_id',$client->city->governorate_id)->get();
        return view('front.pages.myprofile',compact('client','cities','blood_types','governorates'));
    }

    public function updateProfile(Request $request){
        $client=auth('front')->user();
        $validator=validator()->make($request->all(),[
            'name'=>'required|unique:clients,name,'.$client->id,
            'email'=>'required|email|unique:clients,email,'.$client->id,
            'password'=>'confirmed',
            'city_id'=>'required',
            'blood_type_id'=>'required',
            'phone'=>'required|unique:clients,phone,'.$client->id.'|regex:/(01)[0-9]{9}/',
            'last_donation_date'=>'required'
       ]);
       if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput();
            }
    // $request->merge(['password'=>bcrypt($request->password)]);
    $input=$request->all();
    if(!empty($input['password'])){
        $input['password'] = Hash::make($input['password']);
        }else{
        $input = array_except($input,array('password'));
        }
        $client->update($input);
        // 'name'=>$request->name,
        // 'email'=>$request->email,
        // 'password'=>$request->password,
        // 'city_id'=>$request->city_id,
        // 'blood_type_id'=>$request->blood_type_id,
        // 'phone'=>$request->phone,
        // 'last_donation_date'=>$request->last_donation_date
        flash('updated successfully')->success();
      return redirect()->back();
    }
}

    

