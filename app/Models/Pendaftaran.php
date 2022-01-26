<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = "pendaftarans";
    protected $primaryKey = "id";

    protected $fillable = [
      'id',
      'idUser',
      'idTower',
    ];

    public function tower()
    {
        return $this->belongsTo(Tower::class, 'idTower');
    }

    public function user(){
        return $this->belongsTo(User::class, 'idUser');
    }

    public function persetujuan(){
        return $this->hasOne(Persetujuan::class, 'id', 'id');
    }
}
