<?php

namespace App\Http\Controllers\Front;

use App\Models\City;
use App\Models\Post;
use App\Models\Contact;
use App\Models\BloodType;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Models\DonationRequest;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    //
    public function home()
    {
        $posts=Post::take(3)->get();
        $cities=City::all();
        $blood_types=BloodType::all();
        $donation_requests=DonationRequest::with('bloodType','city')->take(4)->get();
        return view('front.pages.home',compact('posts','donation_requests','cities','blood_types'));
    }
    
    public function about()
    {
        return view('front.pages.about');
    }

    public function contactus()
    {
        return view('front.pages.contact-us');
    }

    public function contact(Request $request)
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
            return redirect()->back()->withErrors($validator)->withInput();
            }

        $contact=Contact::create($request->all());
        flash('your message is sent successfully')->success();
        return redirect()->back();


    }

    // public function notificationsettings()
    //    {

    //   return view('front.pages.notificationsettings');

    //     }


        public function notificationsettings(Request $request)
        {
           $client=auth('front')->user();
           $blood_types=BloodType::all();
           $governorates=Governorate::all();
           if ($request->isMethod('get')) {

            return view('front.pages.notificationsettings',compact('blood_types','governorates','client'));
           }
           
         
           if ($request->isMethod('patch')) {
             $client->bloodTypes()->sync($request->blood_types);
            $client->governorates()->sync($request->governorates);
            flash('settings updated successfully')->success();
        return view('front.pages.notificationsettings',compact('blood_types','governorates','client'));
           }
        }
    


    }
