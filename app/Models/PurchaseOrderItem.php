<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    protected $table = 'purchase_order_items';
    protected $guarded = [];
    protected $primaryKey = 'id';

    public function po()
    {
        return $this->belongsTo(PurchaseOrder::class, 'po_id');
    }
}
