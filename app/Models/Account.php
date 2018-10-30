<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ['amount'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
