<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeMenara extends Model
{
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */

	public $timelapse = false;
	protected $fillable = [
		'name'
	];

	public function tower()
	{
		return $this->hasMany(Tower::class, 'idTipeMenara');
	}
}
