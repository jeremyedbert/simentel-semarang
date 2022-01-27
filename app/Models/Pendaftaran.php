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
        return $this->hasOne(Tower::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    public function persetujuan()
    {
        return $this->hasOne(Persetujuan::class);
    }
}
