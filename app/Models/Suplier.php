<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'id';
    protected $guarded = [];
    
    public function penerimaan()
    {
        return $this->hasMany(PenerimaanHeader::class, 'id_supplier');
    }
}
