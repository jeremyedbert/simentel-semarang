<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Applicant extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'applicants';
    protected $guard = 'applicant';
    // protected $guarded = ['id'];
    protected $fillable = ['name', 'nohp', 'email', 'password'];
}
