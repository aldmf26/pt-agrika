<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkPengirimanWalet extends Model
{
    protected $table = 'sk_pengiriman_walet';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function getAlamatRumahWaletAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    public function getTujuanIkphAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    public function rumahWalet()
    {
        return $this->belongsTo(RumahWalet::class, 'id_penerimaan');
    }

    public function ikph()
    {
        return $this->belongsTo(Ikph::class, 'id_ikph');
    }
}
