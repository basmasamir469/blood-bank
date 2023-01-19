<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BloodType extends Model 
{

    protected $table = 'blood_types';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name');

    public function clients()
    {
        return $this->hasMany('App\Models\Client');
    }

    public function manyclients()
    {
        return $this->belongsToMany('App\Models\Client');
    }

    public function donationRequests()
    {
        return $this->hasMany('App\Models\DonationRequest');
    }

}