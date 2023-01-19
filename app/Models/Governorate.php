<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Governorate extends Model 
{
    use HasFactory;


    protected $table = 'governorates';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name');

    public function cities()
    {
        return $this->hasMany('App\Models\City');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }

}