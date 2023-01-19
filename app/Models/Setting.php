<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model 
{

    protected $table = 'settings';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('notification_settings_text', 'about_app', 'phone', 'email', 'fb_link', 'tw_link', 'insta_link');

}