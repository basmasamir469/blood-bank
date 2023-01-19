<?php

namespace App\Http\Controllers;

use App\Models\Governorate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreGovernorateRequest;
use App\Http\Requests\UpdateGovernorateRequest;

class GovernorateController extends Controller
{
    //
    public function index()
    {
        //
        $governorates=Governorate::paginate(10);
        return view('governorates.index',compact('governorates'));

    }

    public function create()
    {

     return view('governorates.create');

    }

    public function store(StoreGovernorateRequest $request)
    {

        Governorate::create($request->all());
        flash('Governorate stored successfully')->success();
        return Redirect::to('/admin/governorates');
    }

    public function edit($id)
    {
        $governorate=Governorate::find($id);
        return view('governorates.edit',compact('governorate'));
    }


    public function update(UpdateGovernorateRequest $request,$id)
    {
        $governorate=Governorate::find($id);
        $governorate->update($request->all());
        flash('Governorate updated successfully')->success();
        return Redirect::to('/admin/governorates');
    }

    public function destroy($id)
    {
        $governorate=Governorate::find($id);
        $governorate->delete();
        flash('Governorate deleted successfully')->success();
        return Redirect::to('/admin/governorates');
    }




}
