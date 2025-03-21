<?php

namespace App\Livewire\Pur;

use App\Models\PurchaseRequest;
use App\Models\PurchaseRequestItem;
use Livewire\Component;

class CreatePo extends Component
{
    public $selectedPr = '';


    public function render()
    {
        $getPr = '';
        if (!empty($this->selectedPr)) {
            $getPr = PurchaseRequestItem::where('pr_id',$this->selectedPr)->get();
        }
        $data = [
            'no_pr' => PurchaseRequest::whereNotIn('id', function($query) {
                $query->select('pr_id')->from('purchase_orders');
            })->latest()->get(),
            'getPr' => $getPr
        ];
        return view('livewire.pur.create-po',$data);
    }
}
