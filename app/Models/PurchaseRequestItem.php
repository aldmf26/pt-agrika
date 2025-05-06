<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequestItem extends Model
{
    protected $table = 'purchase_request_items';
    protected $guarded = [];
    protected $primaryKey = 'id';

    public function po()
    {
        return $this->belongsTo(PurchaseRequest::class, 'pr_id');
    }
}
