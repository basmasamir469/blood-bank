<?php

namespace App\Http\Controllers\Api;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    //
    public function profile(){
        try{
    $profile=auth('api')->user();
    return responseJson(1,'success',$profile);
        }
        catch(\Exception $e){
            return responseJson(1,$e->getMessage());
        }
    }

    public function updateProfile(Request $request){
        $client=auth('api')->user();
        $validator=validator()->make($request->all(),[
            'name'=>'required|unique:clients,name,'.$client->id,
            'email'=>'required|email|unique:clients,email,'.$client->id,
            'password'=>'required',
            'city_id'=>'required',
            'blood_type_id'=>'required',
            'phone'=>'required',
            'last_donation_date'=>'required'
       ]);
       if($validator->fails()){
        return responseJson(0,$validator->errors()->first(),$validator->errors());
            }
    $request->merge(['password'=>bcrypt($request->password)]);
     $client->update([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>$request->password,
        'city_id'=>$request->city_id,
        'blood_type_id'=>$request->blood_type_id,
        'phone'=>$request->phone,
        'last_donation_date'=>$request->last_donation_date
      ]);
      return responseJson(1,'successfully updated',[
        'profile'=>$client->fresh()->load('city.governorate','bloodType'),
        'city'=>$client->city->id
    ]);

    }
}
