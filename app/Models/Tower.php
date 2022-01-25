<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tower extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'idMenara',
    'operator',
    'idTipeMenara',
    'idKec',
    'idKel',
    'idSite',
    'idJalan',
    'tinggi',
    'latitude',
    'longitude',
    'luas',
    'pemilik',
    'penyewa',
    'nomorIMB'
  ];
}
