<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{

    protected $table = 'clients';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('email', 'password', 'name', 'd_o_b', 'phone', 'last_donation_date', 'pin_code', 'city_id','blood_type_id');
    protected $hidden = [
        'password',
        'api_token',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function bloodType()
    {
        return $this->belongsTo('App\Models\BloodType');
    }

// bloodtypes in notification-settings 

    public function bloodTypes()
    {
        return $this->belongsToMany('App\Models\BloodType');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function donationRequests()
    {
        return $this->hasMany('App\Models\DonationRequest');
    }
//  governorates in notification-settings
    public function governorates()
    {
        return $this->belongsToMany('App\Models\Governorate');
    }

    public function favPosts()
    {
        return $this->belongsToMany('App\Models\Post');
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Models\Notification')->withPivot('is_seen');
    }
    public function tokens(){
        return $this->hasMany('App\Models\Token');

    }
    public function getActiveAttribute($val){
        if($val==0){
            return 'Not Active';
        }
        elseif($val==1){
            return 'Active';
        }
    }

}