<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model

{
        use HasFactory;


    /**

     * The attributes that are mass assignable.

     *

     * @var array

    */
     protected $table="messages";
     
    public $fillable = [
        'id',
        'user_id',
        'subject',
        'message',
        'open',
        'updated_at',
        'created_at',
    ];
    

}