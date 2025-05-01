<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    protected $table = 'purchase_requests';
    protected $guarded = [];
    protected $primaryKey = 'id';

    public function getDimintaOlehAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    public function getPosisiAttribute($value)
    {
        return ucwords($value);
    }

    public function getDepartemenAttribute($value)
    {
        return strtoupper($value);
    }

    public function getManagerDepartemenAttribute($value)
    {
        return ucfirst($value);
    }

    public function getAlasanPermintaanAttribute($value)
    {
        return ucfirst($value);
    }
    public function item()
    {
        return $this->hasMany(PurchaseRequestItem::class,'id');
    }
}
