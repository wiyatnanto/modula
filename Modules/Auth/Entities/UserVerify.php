<?php

namespace Modules\Auth\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class UserVerify extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Auth\Database\factories\UserVerifyFactory::new();
    }
}
