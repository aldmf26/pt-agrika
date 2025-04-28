<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubHeading extends Model
{
    protected $table = 'ia_sub_headings';
    protected $primaryKey = 'id';
    protected $guarded = [];
    
    public function heading()
    {
        return $this->belongsTo(Heading::class);
    }

    public function pertanyaan()
    {
        return $this->hasMany(Pertanyaan::class);
    }

}
