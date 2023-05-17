<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Message extends Model
{

    use HasFactory, Notifiable;

    protected $fillable = [
        'content',
        'sender_id',
        'receiver_id',
        'annonce_id',
        'id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}