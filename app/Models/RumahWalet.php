<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RumahWalet extends Model
{
    protected $table = 'rumah_walet';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function getAlamatAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    public function evaluasi()
    {
        return $this->hasMany(Evaluasi::class, 'rumah_walet_id');
    }

    public function seleksi()
    {
        return $this->hasOne(SeleksiSupplier::class, 'supplier_id');
    }
}
