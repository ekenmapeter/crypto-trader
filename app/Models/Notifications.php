<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model

{
        use HasFactory;


    /**

     * The attributes that are mass assignable.

     *

     * @var array

    */
     protected $table="notifications";
     
    public $fillable = [
        'id',
        'subject',
        'message',
        'open',
        'updated_at',
        'created_at',
    ];
    

}