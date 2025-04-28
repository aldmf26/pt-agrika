<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $table = 'ia_pertanyaan';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function subHeading()
    {
        return $this->belongsTo(SubHeading::class);
    }

    public function hasilChecklist()
    {
        return $this->hasMany(HasilChecklist::class);
    }
}
