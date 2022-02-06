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
      'user_id',
      'tower_id',
      'status_id',
      'admin_id',
    ];

    public function scopeSearching($query){
        if (request('search')) {
            $query->where('id', 'like', request('search') . '%');
        }
    }

    public function tower()
    {
        return $this->belongsTo(Tower::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}
