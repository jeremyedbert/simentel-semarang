<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persetujuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'idAdmin',
        'idStatus'
    ];

    public function pendaftaran(){
        return $this->belongsTo(Pendaftaran::class, 'id', 'id');
    }

    public function admin(){
        return $this->belongsTo(Admin::class, 'idAdmin');
    }

    public function status(){
        return $this->belongsTo(Status::class, 'idStatus');
    }
}
