<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Heading extends Model
{
    protected $table = 'ia_headings';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function subHeadings()
    {
        return $this->hasMany(SubHeading::class);
    }
}
