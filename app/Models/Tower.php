<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tower extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */

	protected $fillable = [
		'id',
		'idMenara',
		'operator',
		'tipe_menara_id',
		'kecamatan_id',
		'kelurahan_id',
		'tipe_site_id',
		'tipe_jalan_id',
		'tinggi',
		'latitude',
		'longitude',
		'kondisi',
		'luas',
		'pemilik',
		'penyewa',
		'nomorIMB'
	];

	use HasFactory;

	public function scopeSearching($query)
	{
		if (request('search')) {
			$query->where('idMenara', 'like', '%' . request('search') . '%');
		}
	}

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

    $query->when($filters['kelurahan_id'] ?? false, function($query, $kelurahan_id){
      return $query->where(function($query) use ($kelurahan_id){
        $query->where('kelurahan_id', '=', $kelurahan_id);
      });
    });
	}

	public function pendaftaran()
	{
		return $this->hasOne(Pendaftaran::class, 'tower_id');
	}

	public function kecamatan()
	{
		return $this->belongsTo(Kecamatan::class);
	}

	public function kelurahan()
	{
		return $this->belongsTo(Kelurahan::class);
	}

	public function tipesite()
	{
		return $this->belongsTo(TipeSite::class, 'tipe_site_id');
	}

	public function tipejalan()
	{
		return $this->belongsTo(TipeJalan::class, 'tipe_jalan_id');
	}

	public function tipemenara()
	{
		return $this->belongsTo(TipeMenara::class, 'tipe_menara_id');
	}
}
