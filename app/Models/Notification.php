<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model 
{

    protected $table = 'notifications';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('title', 'content', 'donation_request_id');

    public function donationRequest()
    {
        return $this->belongsTo('App\Models\DonationRequest');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }

}