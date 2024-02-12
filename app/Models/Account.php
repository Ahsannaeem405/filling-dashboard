<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Account extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getEmail()
    {
        return explode(':', $this->description)[0];
    }

    public function getEmailLetter()
    {
        return Str::ucfirst(mb_substr(explode(':', $this->description)[0], 0, 1));
    }
    public function unRead()
    {
     return $unread=$this->conversation()->whereHas('messages',function ($q){
      $q->where('seen','unseen');
      })->count();
    }

    public function conversation(){
    return $this->hasMany(Conversation::class,'account_id');
    }


}
