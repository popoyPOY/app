<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Tokens extends Model
{
    use HasApiTokens, HasFactory;

    protected  $table = 'personal_access_tokens';

    protected $column = 'token';

    protected $fillable = [
        'token',
        'email'
    ];
}
