<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = ['name','email','status','user_id'];


    public function owner() : BelongsTo{
        return $this->belongsTo(User::class,'user_id');
    }


    public function isOwnedByCurrentUser() : bool {
        
        return ($this->user_id !== auth()->id()) ? false : true ;
    }
    
}
