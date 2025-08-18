<?php

namespace App\Livewire;

use App\Models\Cancel;
use App\Models\Delegation;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Cetak extends Component
{
    #[Layout('components.layouts.appcetak')]
    public $jenis;
    public $id;

    public function mount($jenis, $id)
    {
        $this->jenis = $jenis;
        $this->id = $id;
    }
    public function render()
    {
        // Ambil data surat berdasarkan jenis
        if ($this->jenis === 'pembatalan') {
            $datasurat = Cancel::whereId($this->id)->first();
        } elseif ($this->jenis === 'pelimpahan') {
            $datasurat = Delegation::whereId($this->id)->first();
        } else {
            abort(404, 'Jenis surat tidak ditemukan.');
        }
        return view('livewire.cetak', [
            'datasurat' => $datasurat,
        ]);
    }
}
