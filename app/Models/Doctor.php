<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Doctor extends Model
{   
    protected $fillable = [
        'name',
        'country_code',
        'phone_number',
        'email',
        'password',
        'status'
    ];


   
}
