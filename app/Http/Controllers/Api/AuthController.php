<?php

namespace App\Http\Controllers\Api;

use App\Models\Client;
use App\Mail\ResetPassword;
use Illuminate\Http\Request;
use App\Models\Token;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function register(Request $request){
        $validator=validator()->make($request->all(),[
             'name'=>'required|unique:clients',
             'email'=>'required|email|unique:clients',
             'password'=>'required',
             'city_id'=>'required',
             'blood_type_id'=>'required',
             'phone'=>'required|unique:clients|regex:/(01)[0-9]{9}/',
             'last_donation_date'=>'required'
        ]);
        if($validator->fails()){
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
        $request->merge(['password'=>bcrypt($request->password)]);
        DB::beginTransaction();
        $client=Client::create($request->all());
        if($client){
        // $client->city()->associate($client->city_id);
         $client->governorates()->attach($client->city->governorate_id);
         $client->bloodTypes()->attach($client->blood_type_id);
        $client->api_token=str_random(60);
        $client->save();
        }
        else{
            DB::rollback();
            return responseJson(0,'faild');
        }
        DB::commit();
        return responseJson(1,'successfully added',[
            'api_token'=>$client->api_token,
            'client'=>$client,
        ]);

    }
    public function login(Request $request){
        $validator=validator()->make($request->all(),[
            'phone'=>'required',
            'password'=>'required',
        ]);
        if($validator->fails()){
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }
        $client=Client::where('phone',$request->phone)->first();
        if($client){
            if(Hash::check($request->password,$client->password)){
                return responseJson(1,'login successfully',[
                    'api_token'=>$client->api_token,
                    'client'=>$client->bloodTypes
                ]);

            }
            else{
                return responseJson(0,'faild to login');

            }
        }
        else{
            return responseJson(0,'faild to login');
        }
        }

    public function reset(Request $request){
        $validator=Validator::make($request->all(),[
            'phone'=>'required'
        ]);
        if($validator->fails()){
        return responseJson(0,$validator->errors()->first());
        }
        $client=Client::where('phone',$request->phone)->first();
        if($client){
          $pin_code=rand(1111,9999);
          $update_code=$client->update(['pin_code'=>$pin_code]);
          if($update_code){
            Mail::to($client->email)
                 ->bcc("basmaelazony@gmail.com")
                 ->send(new ResetPassword($client));

            return responseJson(1,'check your email');
          }
          else{
            return responseJson(0,'there is a problem please try again');
          }
        }
        else{
            return responseJson(0,'this phone is not found please sure that you enter it correctly');
        }
    }
    public function newpassword(Request $request){
        $validator=Validator::make($request->all(),[
            'pin_code'=>'required',
            'password'=>'required|confirmed|min:6'
        ]);
        if($validator->fails()){
        return responseJson(0,$validator->errors()->first());
        }
        $client=Client::where('pin_code',$request->pin_code)->first();
        if($client){
          $client->password=bcrypt($request->password);
          $client->pin_code=null;
          if($client->save()){
            return responseJson(1,'your password is updated successfully',$client);
          }
          else{
            return responseJson(0,' sorry your password is failed to update');
          }
        }
        else{
            return responseJson(0,'this code is not valid');
        }

    }
    public function registerToken(Request $request){
        $validator=validator()->make($request->all(),[
            'token'=>'required',
            'type'=>'required|in:ios,android'
       ]);
       if($validator->fails()){
           return responseJson(0,$validator->errors()->first(),$validator->errors());
       }
       Token::where('token',$request->token)->delete();
       $request->user()->tokens()->create($request->all());
       return responseJson(1,'registered successfully',$request->user()->tokens);


    }

    public function removeToken(Request $request){
        $validator=validator()->make($request->all(),[
            'token'=>'required',
       ]);
       if($validator->fails()){
           return responseJson(0,$validator->errors()->first(),$validator->errors());
       }
       Token::where('token',$request->token)->delete();
       return responseJson(1,'removed successfully');


    }

}
