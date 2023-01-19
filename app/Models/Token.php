<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;
    protected $fillable = array('client_id','token','type');
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function clients(){
        return $this->belongsTo('App\Models\Client');

    }
}
