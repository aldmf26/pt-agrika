<?php

namespace App\Livewire\Pur;

use App\Models\PurchaseOrder;
use Livewire\Attributes\On;
use Livewire\Component;

class Detail extends Component
{
    public $no_po;
    public $datas = [];
    #[On('showDetail')]
    public function showDetail($no_po)
    {
        $this->datas = PurchaseOrder::with(['item', 'purchaseRequest'])->where('no_po', $no_po)->get()->toArray();
    }

    public function render()
    {
        return view('livewire.pur.detail');
    }
}
