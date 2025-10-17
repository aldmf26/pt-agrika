<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluasi extends Model
{
    protected $table = 'pur3_tb_evaluasi';
    protected $guarded = [''];
    protected $primaryKey = 'id';

    public function supplier()
    {
        return $this->belongsTo(Suplier::class, 'supplier_id', 'id');
    }

    public function rumahWalet()
    {
        return $this->belongsTo(RumahWalet::class, 'rumah_walet_id', 'id');
    }

    public function detail()
    {
        return $this->hasMany(DetailKetidaksesuaian::class, 'evaluasi_id', 'id');
    }
}
