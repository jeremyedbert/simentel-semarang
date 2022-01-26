<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persetujuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_tiket',
        'idAdmin',
        'idStatus'
    ];

    public function pendaftaran(){
        return $this->belongsTo(Pendaftaran::class, 'no_tiket', 'no_tiket');
    }

    public function admin(){
        return $this->belongsTo(Admin::class, 'idAdmin');
    }

    public function status(){
        return $this->belongsTo(Status::class, 'idStatus');
    }
}
