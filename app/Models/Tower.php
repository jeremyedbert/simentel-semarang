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
		return $this->belongsTo(Kecamatan::class, 'idKec');
	}

	public function kelurahan()
	{
		return $this->belongsTo(Kelurahan::class, 'idKel');
	}

	public function tipesite()
	{
		return $this->belongsTo(TipeSite::class, 'idSite');
	}

	public function tipejalan()
	{
		return $this->belongsTo(TipeJalan::class, 'idJalan');
	}

	public function tipemenara()
	{
		return $this->belongsTo(TipeMenara::class, 'idTipeMenara');
	}

	public function pendaftaran(){
		return $this->hasOne(Pendaftaran::class);
	}
}
