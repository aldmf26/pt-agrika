<?php

namespace App\Livewire;

use App\Models\Notif;
use App\Services\NotifiService;
use Livewire\Component;

class HeaderNotification extends Component
{
    protected $listeners = ['refresh' => '$refresh'];

    public function route($route,$departemen)
    {
        // NotifiService::readNotification($departemen);
        return $this->redirectRoute($route, navigate:true);
    }

    public function render()
    {
        $get = NotifiService::getActiveNotification();
        $data = [
            'notifications' => $get
        ];
        return view('livewire.header-notification',$data);
    }
}
