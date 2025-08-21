<?php

namespace App\Livewire;

use App\Models\Cancel;
use App\Models\Delegation;
use App\Models\Survey;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Cetak extends Component
{
    #[Layout('components.layouts.appcetak')]
    public $jenis;
    public $id;

    public $jenis_persyaratan;

    #[Validate('required')]
    public string $kepuasan = '';

    public function mount($jenis, $id)
    {
        $this->jenis = $jenis;
        $this->id = $id;

        // Inisialisasi jenis_persyaratan jika ada
        if ($jenis === 'pelimpahan') {
            $delegation = Delegation::find($id);
            $this->jenis_persyaratan = $delegation->jenis_persyaratan;
        }
    }

    // public function updatedJenisPersyaratan($value)
    public function savepersyaratan($value)
    {
        $this->jenis_persyaratan = $value;
        // dd($this->jenis_persyaratan);
        Delegation::whereId($this->id)->update(['jenis_persyaratan' => $value]);
    }

    // kode untuk save survey
    public function submitSurvey()
    {
        $this->validate();

        // dd($this->kepuasan, $this->jenis, $this->id);

        // Update data Cancel atau Delegation
        if ($this->jenis === 'pembatalan') {
            Survey::create([
                'target_type' => Cancel::class,
                'target_id'   => $this->id,
                'kepuasan'    => $this->kepuasan, // 'puas' | 'tidak_puas'
            ]);
            $cancel = Cancel::find($this->id);
            $cancel->update([
                'status_cetak' => true,
                'status_surveys' => $this->kepuasan,
            ]);
        } elseif ($this->jenis === 'pelimpahan') {
            Survey::create([
                'target_type' => Delegation::class,
                'target_id'   => $this->id,
                'kepuasan'    => $this->kepuasan, // 'puas' | 'tidak_puas'
            ]);
            $delegation = Delegation::find($this->id);
            $delegation->update([
                'status_cetak' => true,
                'status_surveys' => $this->kepuasan,
            ]);
        }

        // Reset form agar siap untuk pemakaian berikutnya
        $this->reset('kepuasan');

        // Browser event → akan ditangkap JS untuk menutup modal & cetak
        $this->dispatch('survey-saved', message: 'Terima kasih atas feedback Anda!');
    }

    public function render()
    {
        // Ambil data surat berdasarkan jenis
        if ($this->jenis === 'pembatalan') {
            $title = 'Surat Pembatalan';
            $datasurat = Cancel::whereId($this->id)->first();
        } elseif ($this->jenis === 'pelimpahan') {
            $title = 'Surat Pelimpahan';
            $datasurat = Delegation::whereId($this->id)->first();
        } else {
            $title = 'Surat Tidak Dikenal';
            abort(404, 'Jenis surat tidak ditemukan.');
        }
        return view('livewire.cetak', [
            'datasurat' => $datasurat,
            'title' => $title,
        ])->layout('components.layouts.appcetak', [
            'title' => $title
        ]);
    }
}
