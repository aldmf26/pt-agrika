<?php

namespace App\Livewire\Pur;

use App\Models\PurchaseOrder;
use App\Models\PurchaseRequest;
use Livewire\Attributes\On;
use Livewire\Component;

class Detail extends Component
{
    public $no_po;
    public $kategori;
    public $datas = [];
    #[On('showDetail')]
    public function showDetail($no_po)
    {
        if($this->kategori == 'pr') {
            $this->datas = PurchaseRequest::with(['item'])->where('no_pr', $no_po)->get()->toArray();
        } else {
            $this->datas = PurchaseOrder::with(['item', 'purchaseRequest'])->where('no_po', $no_po)->get()->toArray();
        }
    }

    public function render()
    {
        return view('livewire.pur.detail');
    }
}
