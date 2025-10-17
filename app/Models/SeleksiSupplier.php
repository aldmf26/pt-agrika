<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeleksiSupplier extends Model
{
    protected $guarded = ['id'];

    public function supplier()
    {
        return $this->belongsTo(Suplier::class, 'supplier_id', 'id');
    }

    public function rumahWalet()
    {
        return $this->belongsTo(RumahWalet::class, 'supplier_id', 'id');
    }
}
