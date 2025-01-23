<?php

namespace App\Livewire\Hrga10;

use App\Models\Tamu;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class FormTamu extends Component
{
    // General Information
    public $date,                // Tanggal
        $name,                // Nama
        $time_in,             // Jam Masuk
        $time_out,            // Jam Keluar
        $purpose,             // Keperluan

        // Health Condition
        $fever,               // Apakah demam?
        $flu,                 // Apakah flu?
        $cough,               // Apakah batuk?
        $diare,            // Apakah diare?
        $sore_throat,         // Apakah radang tenggorokan?
        $difficulty_breathing, // Apakah kesulitan bernafas?

        // Tracing
        $area_covid,          // Berpergian ke wilayah merah
        $penderita_covid,     // Kontak dengan penderita COVID-19

        // Signature
        $visitor_signature,   // Tanda Tangan Pengunjung
        $recipient_signature; // Tanda Tangan Penerima

    public function mount()
    {
        $this->date = date('Y-m-d');

        // Health Condition defaults
        $this->fever = 'tidak';
        $this->flu = 'tidak';
        $this->cough = 'tidak';
        $this->diare = 'tidak';
        $this->sore_throat = 'tidak';
        $this->difficulty_breathing = 'tidak';

        // Tracing defaults
        $this->area_covid = 'tidak';
        $this->penderita_covid = 'tidak';
    }

    public function signatureUpdated($type, $data)
    {
        if ($type === 'visitor') {
            $this->visitor_signature = $data;
        } else {
            $this->recipient_signature = $data;
        }
    }

    public function signatureCleared($type)
    {
        if ($type === 'visitor') {
            $this->visitor_signature = null;
        } else {
            $this->recipient_signature = null;
        }
    }

    public function simpan()
    {
        $visitorSignaturePath = $this->storeSignature($this->visitor_signature, 'visitor_signature');
        $recipientSignaturePath = $this->storeSignature($this->recipient_signature, 'recipient_signature');

        Tamu::create([
            'date' => $this->date,
            'name' => $this->name,
            'time_in' => $this->time_in,
            'time_out' => $this->time_out,
            'purpose' => $this->purpose,
            'flu' => $this->flu,
            'cough' => $this->cough,
            'diare' => $this->diare,
            'fever' => $this->fever,
            'sore_throat' => $this->sore_throat,
            'difficulty_breathing' => $this->difficulty_breathing,
            'area_covid' => $this->area_covid,
            'penderita_covid' => $this->penderita_covid,
            'visitor_signature' => $visitorSignaturePath,
            'recipient_signature' => $recipientSignaturePath,
        ]);

        // Reset form setelah berhasil disimpan
        $this->reset();

        // Flash message
        session()->flash('success', 'Data successfully saved!');
    }
    protected function storeSignature($signature, $prefix)
    {
        // Decode Base64
        dd($signature);
        $signature = str_replace('data:image/png;base64,', '', $signature);
        $signature = str_replace(' ', '+', $signature);
        $image = base64_decode($signature);

        // Generate unique filename
        $fileName = $prefix . '_' . time() . '.png';

        // Path untuk menyimpan file
        $filePath = 'signatures/' . $fileName;

        // Simpan file ke storage
        Storage::disk('public')->put($filePath, $image);
        return $filePath; // Kembalikan path untuk disimpan ke database
    }

    public function render()
    {
        return view('livewire.hrga10.form-tamu');
    }
}
