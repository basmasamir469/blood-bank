<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Models\Post;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\Category;
use App\Models\BloodType;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function governorates()
    {
        //
        $governorates=Governorate::all();

        return responseJson(1,'success',$governorates);
    }

    public function cities(Request $request){
        $cities=City::where(function($query) use($request){
                if($request->has('governorate_id')){
                    return $query->where('governorate_id',$request->governorate_id);
                }
        })->with('governorate')->get();
        
        return responseJson(1,'success',$cities);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function contactus(Request $request)
    {
        //
        $validator=validator()->make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'subject'=>'required',
            'message'=>'required'
        ]);
        if($validator->fails()){
        return responseJson(0,$validator->errors()->first(),$validator->errors());
            }

        $contact=Contact::create($request->all());
        return responseJson(1,'your message sent',$contact);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bloodTypes()
    {
        //
      $bloodTypes=BloodType::all();
      return responseJson(1,'success',$bloodTypes);
      
    }

    public function settings()
    {
        //
      $settings=Setting::first();
      return responseJson(1,'success',$settings);
      
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function notificationSettings(Request $request)
    {
        //
    //    $settings= Setting::first();
    //    $notification_settings_text=$settings->notification_settings_text;
       $client=Client::where('id',auth('api')->user()->id)->first();
    
       if ($request->isMethod('get')) {
        return responseJson(1,'get notification settings successfully',[
            'client'=>$client,
            // 'notifi_settings_text'=>$notification_settings_text,
            'blood_types'=>$client->bloodTypes()->pluck('bloodtypes.id')->toArray(),
            'governorates'=>$client->governorates()->pluck('governorates.id')->toArray()
           ]);    
       }
       
     
       if ($request->isMethod('post')) {

    //    if($request->has('blood_types'))
    //    {
         $client->bloodTypes()->sync($request->blood_types);
    //    }
    //    if($request->has('governorates'))
    //    {
        $client->governorates()->sync($request->governorates);
    //    }
       return responseJson(1,'notification settings updated successfully',[
        'client'=>$client,
        // 'notifi_settings_text'=>$notification_settings_text,
        'blood_types'=>$client->bloodTypes()->pluck('blood_types.id')->toArray(),
        'governorates'=>$client->governorates()->pluck('governorates.id')->toArray()
   ]);
    }


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

// Client::whereHas('city',function($q){ return $q->where('name','mansoura')})->get();
// return clients who has city=mansoura
