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

    public function scopeFilter($query, array $filters)
    {
      // if (isset($filters['kecamatan_id']) ? $filters['kecamatan_id'] : false) {
      // 	return $query->where('kecamatan_id', '=', $filters['kecamatan_id']);
      // }

      $query->when($filters['kecamatan_id'] ?? false, function($query, $kecamatan_id){
        return $query->where(function($query) use ($kecamatan_id){
          $query->where('kecamatan_id', '=', $kecamatan_id);
        });
      });

    }

    public function kecamatan()
    {
      return $this->belongsTo(Kecamatan::class);
    }
}
