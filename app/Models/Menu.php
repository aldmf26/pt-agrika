<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'icon', 'link', 'parent_id', 'order'];

    // Relasi untuk mendapatkan submenu
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id')->orderBy('order');
    }
}
