<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Applicant extends Authenticatable
{
    use HasFactory;
    protected $table = "applicants";
    // protected $guarded = ['id'];
    protected $fillable = ['name', 'nohp', 'email', 'password'];
}
