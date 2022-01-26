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

	use HasFactory;

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
		return $this->belongsTo(TipeSite::class);
	}

	public function tipejalan()
	{
		return $this->belongsTo(TipeJalan::class);
	}

	public function tipemenara()
	{
		return $this->belongsTo(TipeMenara::class);
	}

	public function pendaftaran(){
		return $this->hasOne(Pendaftaran::class);
	}
}
