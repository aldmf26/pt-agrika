<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    protected $table = 'purchase_requests';
    protected $guarded = [];
    protected $primaryKey = 'id';

    public function item()
    {
        return $this->hasMany(PurchaseRequestItem::class, 'pr_id');
    }
}
