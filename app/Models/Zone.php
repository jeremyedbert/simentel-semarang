<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
  protected $fillable = [
		'id',
    'name',
    'kecamatan_id',
    'latitude',
    'longitude',
    'radius'
	];

    use HasFactory;

    public function kecamatan()
    {
      return $this->belongsTo(Kecamatan::class);
    }
}
