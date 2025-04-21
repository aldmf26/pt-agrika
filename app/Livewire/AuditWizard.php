<?php

namespace App\Livewire;

use App\Livewire\Pur\CreatePo;
use Livewire\Component;
use Livewire\Attributes\Url;
use Spatie\LivewireWizard\Components\WizardComponent;
class AuditWizard extends Component
{
    #[Url] 
    public $h = 1;

    public function step($tipe)
    {
        $this->h = $tipe == 'lanjut' ? $this->h + 1 : $this->h - 1;
    }

    public function render()
    {
        return view('livewire.audit-wizard');
    }

    
}
