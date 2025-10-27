<?php

namespace App\Livewire\Pur;

use App\Models\PurchaseRequest;
use App\Models\PurchaseRequestItem;
use App\Models\Suplier;
use Livewire\Component;
use Livewire\Attributes\Url;

class CreatePo extends Component
{
    public $selectedPr = '';

    #[Url]
    public $id_pr = '';

    public function mount()
    {
        if (!empty($this->id_pr)) {
            $this->selectedPr = $this->id_pr;
        }
    }

    public function render()
    {
        $getPr = '';
        if (!empty($this->selectedPr)) {
            $getPr = PurchaseRequestItem::with('barang')->where('pr_id', $this->selectedPr)->get();
        }
        $data = [
            'no_pr' => PurchaseRequest::whereNotIn('id', function ($query) {
                $query->select('pr_id')->from('purchase_orders');
            })->latest()->get(),
            'getPr' => $getPr,
            'suppliers' => Suplier::whereNot('kategori', 'sbw')->latest()->get(),
        ];
        return view('livewire.pur.create-po', $data);
    }
}
