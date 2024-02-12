<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $guarded=[];
    use HasFactory;
    public function account()
    {
        return $this->belongsTo(Account::class,'account_id');
    }

    public function getLastMessage()
    {
        return $this->hasOne(Messages::class,'conversation_id')->latest();
    }

       public function getUnreadMessages()
    {
        return $this->hasMany(Messages::class,'conversation_id')->where('seen','unseen');
    }

    public function messages()
    {
        return $this->hasMany(Messages::class,'conversation_id');
    }
}
