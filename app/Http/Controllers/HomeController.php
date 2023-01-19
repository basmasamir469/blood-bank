<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function edit()
    {
        $settings=Setting::first();
        return view('settings.edit',compact('settings'));
    }
    public function update(Request $request)
    {          
         $settings=Setting::first();

        $settings->update($request->all());
        flash('Settings updated successfully')->success();
        return redirect()->route('settings.edit');
    }


}
