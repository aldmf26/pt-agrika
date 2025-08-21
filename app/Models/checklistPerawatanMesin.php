<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class checklistPerawatanMesin extends Model
{
    protected $guarded = [];

    public function item()
    {
        return $this->belongsTo(ItemMesin::class, 'item_mesin_id');
    }
    public function kriteria()
    {
        return $this->belongsTo(KriteriaModel::class, 'kriteria_id');
    }
}
