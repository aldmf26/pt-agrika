<?php

namespace App\Traits;

trait WithAlert
{
    public function alert($type, $message)
    {
        $this->dispatch('showAlert', [
            'type' => $type,
            'message' => $message
        ]);
    }
}
