<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\BloodType;
use App\Models\Governorate;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clients=Client::with('bloodType')->paginate(10);
        $governorates=Governorate::all();
        $blood_types=BloodType::all();
        return view('clients.index',compact('clients','blood_types','governorates'));

    }
  
    public function changestatus(Request $request){
        $client=Client::find($request->user_id);
        $client->active=$request->status;
        $client->save();
        return response()->json(['success'=>'Status change successfully.','status'=>$client->active]);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
    $blood_types=BloodType::all();
    $governorates=Governorate::all();
    $clients=Client::query();
    $clients=$clients->when($request->filled('blood_type'), function ($q) use($request) {
         return $q->where('blood_type_id',$request->blood_type );
        })->when($request->filled('search'),function($q){
            return $q->where('name', 'like', '%' . request('search') . '%')
                     ->orWhere('email', 'like', '%' . request('search') . '%');
       })->when($request->filled('governorate_id'),function($q){
        return $q->whereHas('city',function($q){
            return $q->where('governorate_id',request('governorate_id') );
        });
       })->paginate(10);

     return view('clients.index',compact('clients','blood_types','governorates'));


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
        $client=Client::with('city','bloodType')->find($id);
        return view('clients.show',compact('client'));
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
        $client=Client::find($id);
        $client->delete();
        flash('client deleted successfully')->success();
        return redirect()->route('clients.index');
        //
    }
}
