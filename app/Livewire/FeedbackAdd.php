<?php

namespace App\Livewire;

use App\Models\Feedback;
use Livewire\Attributes\Validate;
use Livewire\Component;

class FeedbackAdd extends Component
{
    #[Validate('required|string|min:3|max:100')]
    public string $nama = '';

    // Regex longgar untuk nomor HP (angka, spasi, +, (), -), silakan perketat jika perlu
    #[Validate('required|string|min:8|max:20|regex:/^[0-9+\s\-\(\)]{8,20}$/', as: 'nomor HP')]
    public string $nomor_hp = '';

    #[Validate('required|string|min:10|max:1000')]
    public string $pesan = '';

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function save()
    {
        $this->validate();

        Feedback::create([
            'nama' => $this->nama,
            'nohp' => $this->nomor_hp, // ganti ke 'nomor_hp' jika kolom kamu bernama 'nomor_hp'
            'pesan' => $this->pesan,
        ]);

        // reset form
        $this->reset(['nama', 'nomor_hp', 'pesan']);

        // Kirim event sukses (bisa ditangkap untuk toast/notif)
        $this->dispatch('savesuccess', message: 'Terima kasih! Kritik & saran berhasil dikirim.');
        session()->flash('message', 'Kritik & saran berhasil dikirim.');
    }
    public function render()
    {
        return view('livewire.feedback-add');
    }
}
