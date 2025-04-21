<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\LivewireWizard\Components\StepComponent;

class Step2Audit extends StepComponent
{
    public function render()
    {
        return view('livewire.step2-audit');
    }
}
