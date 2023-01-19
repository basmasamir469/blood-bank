<?php

namespace App\Http\Controllers\Front;

use App\Models\City;
use App\Models\Client;
use App\Models\BloodType;
use App\Mail\ResetPassword;
use App\Models\Governorate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function signin(){
        return view('front.auth.login');
    }
    public function register(){
        $governorates=Governorate::all();
        $blood_types=BloodType::all();
        $cities=City::all();
        return view('front.auth.register',compact('governorates','blood_types','cities'));
    }
   
    public function store(Request $request){
    $validator=validator()->make($request->all(),[
        'name'=>'required|unique:clients',
        'email'=>'required|email|unique:clients',
        'password'=>'required|confirmed|min:8',
        'city_id'=>'required',
        'd_o_b'=>'required',
        'blood_type_id'=>'required',
        'phone'=>'required|unique:clients|regex:/(01)[0-9]{9}/',
        'last_donation_date'=>'required'
   ]);
   if($validator->fails()){
      return redirect()->back()->withErrors($validator)->withInput();
     }
   $request->merge(['password'=>bcrypt($request->password)]);
   DB::beginTransaction();
   $client=Client::create($request->all());
   if($client){
   // $client->city()->associate($client->city_id);
    $client->governorates()->attach($client->city->governorate_id);
    $client->bloodTypes()->attach($client->blood_type_id);
   $client->save();
   }
   else{
       DB::rollback();
       flash('can not register something error is happened')->error();
   }
   DB::commit();
   flash('registered successfully')->success();
   return redirect()->route('front-home');
}
public function login(Request $request){
   $validator=validator()->make($request->all(),[
       'phone'=>'required',
       'password'=>'required',
   ]);
   if($validator->fails()){
    return redirect()->back()->withErrors($validator)->withInput();
   }
       if (!Auth::guard('front')->attempt(['phone' => $request->phone, 'password' => $request->password])) {
        flash('failed to login')->error();
        return redirect()->back();
    }
            flash('login successfully')->success();
             return redirect()->route('front-home');


//    $client=Client::where('phone',$request->phone)->first();
//    if($client){
//        if(Hash::check($request->password,$client->password)){
//             flash('login successfully')->success();
//             return redirect()->route('front-home');

//        }
//        else{
//         flash('password is not correct')->error();
//          return redirect()->back();
//        }
//    }
//    else{
//     flash('failed to login')->error();
//     return redirect()->back();
//    }
   }
   public function forgetpassword(){
    return view('front.auth.forgetpassword');

   }

   public function reset(Request $request){
    $validator=Validator::make($request->all(),[
        'phone'=>'required'
    ]);
    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput();
    }
    $client=Client::where('phone',$request->phone)->first();
    if($client){
      $pin_code=rand(1111,9999);
      $update_code=$client->update(['pin_code'=>$pin_code]);
      if($update_code){
        Mail::to($client->email)
             ->bcc("basmaelazony@gmail.com")
             ->send(new ResetPassword($client));
       flash('check your mail')->success();
       return redirect()->back();
      }
      else{
        flash('there is a problem please try again')->error();
        return redirect()->back();
      }
    }
    else{
        flash('this phone is not found please sure that you enter it correctly')->error();
        return redirect()->back();
    }
}

public function changepassword(){
    return view('front.auth.resetpassword');
}

public function newpassword(Request $request){
    $validator=Validator::make($request->all(),[
        'pin_code'=>'required',
        'password'=>'required|confirmed|min:6'
    ]);
    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput();
    }
    $client=Client::where('pin_code',$request->pin_code)->first();
    if($client){
      $client->password=bcrypt($request->password);
      $client->pin_code=null;
      if($client->save()){
        flash('your password is updated successfully')->success();
        return redirect()->route('signin');
      }
      else{
        flash(' sorry your password is failed to update')->error();
        return redirect()->back();
      }
    }
    else{
        flash('this code is not valid')->error();
        return redirect()->back();
    }

}

   public function destroy()
   {
       Auth::guard('front')->logout();
       
       return redirect()->route('signin');
   }

}

