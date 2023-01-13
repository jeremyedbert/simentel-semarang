<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Kelurahan extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */

  public $timestamps = false;

  protected $fillable = [
    'name',
    'idKec'
  ];

  public function tower()
  {
    return $this->hasMany(Tower::class);
  }

  public function kecamatan()
  {
    return $this->belongsTo(Kecamatan::class);
  }
}
