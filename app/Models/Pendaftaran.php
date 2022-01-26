<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = "pendaftarans";
    protected $primaryKey = "no_tiket";

    protected $fillable = [
      'no_tiket',
      'idUser',
      'idTower',
      
    ];

    public function tower()
    {
        return $this->belongsTo(Tower::class);
    }
}
