<?php

namespace App\Services;

use App\Models\Notif;
use Livewire\Features\SupportQueryString\BaseUrl;

class NotifiService
{
    public static function create($routeName, $departemen, $program, $month, $year)
    {
        $query = Notif::where('departemen', $departemen)
            ->where('nama', $program)
            ->where('month', $month)
            ->where('year', $year);

        $cekAda = $query->exists();
        if ($cekAda) {
            $query->delete();
        } else {
            Notif::create(
                [
                    'user_id' => auth()->user()->id,
                    'departemen' => $departemen,
                    'nama' => $program,
                    'month' => $month,
                    'year' => $year,
                    'route_name' => $routeName
                ]
            );
        }
        event(new \Illuminate\Broadcasting\BroadcastEvent('notification-added'));
    }

    public static function getActiveNotification()
    {
        $currentMonth = date('n');
        $currentYear = date('Y');

        $notif = Notif::where([
            ['user_id', auth()->user()->id],
            ['is_read', 0],
            ['month', $currentMonth],
            ['year', $currentYear]
        ])
            ->groupBy('departemen', 'user_id')
            ->orderBy('created_at', 'desc')
            ->get();

        return $notif;
    }

    public static function readNotification($bulan, $departemen)
    {
        Notif::where(
            [
                ['nama', $departemen],
                ['month', $bulan]
            ]
        )->update(
            ['is_read' => 1]
        );
    }
}
