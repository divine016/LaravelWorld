<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Opportunity extends Model
{

    //if i dont want the created at and the updsted at method i should ste it to false here
// public $timestamps = false;

    use HasFactory;
    protected $table = 'opportunities';


    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($opportunity) {
    //         $opportunity->created_by = auth()->user()->name;
    //     });
    // }

}
