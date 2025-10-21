<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanAuditInternal extends Model
{
    protected $guarded = [];

    public function getPerbaikanAttribute()
    {
        $tindakan = $this->tindakan ?? '';
        $separatorPos = strpos($tindakan, "\n\n");
        if ($separatorPos !== false) {
            $perbaikanPart = substr($tindakan, 0, $separatorPos);
            return trim(str_replace('Perbaikan :', '', $perbaikanPart)); // Hilangkan prefix
        }
        return trim(str_replace('Perbaikan :', '', $tindakan)); // Fallback
    }

    // EDIT: Accessor untuk pisah pencegahan (load saat akses $laporan->pencegahan)
    public function getPencegahanAttribute()
    {
        $tindakan = $this->tindakan ?? '';
        $separatorPos = strpos($tindakan, "\n\n");
        if ($separatorPos !== false) {
            $pencegahanPart = substr($tindakan, $separatorPos + 2);
            return trim(str_replace('Pencegahan :', '', $pencegahanPart)); // Hilangkan prefix
        }
        return ''; // Fallback kosong kalau nggak ada separator
    }

    public function getDivisiAttribute($value)
    {
        return strtoupper($value);
    }

    public function getStatusAttribute($value)
    {
        return ucwords($value);
    }
    public function getTindakanAttribute($value)
    {
        return $value;
    }
}
