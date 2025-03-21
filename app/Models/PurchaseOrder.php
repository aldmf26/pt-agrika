<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $table = 'purchase_orders';
    protected $guarded = [];
    protected $primaryKey = 'id';

    public function item()
    {
        return $this->hasMany(PurchaseRequestItem::class, 'pr_id', 'pr_id');
    }
}
