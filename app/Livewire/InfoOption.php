<?php

namespace App\Livewire;

use App\Models\InfoOption as ModelsInfoOption;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class InfoOption extends Component
{
    use WithFileUploads;

    public $infoOptionsId;
    public $judul_informasi;
    public $isi;
    public $tipe_informasi = 'informasi';
    public $gambar; // untuk file baru
    public $existing_gambar; // untuk path lama dari DB

    public $openform = false;

    protected $rules = [
        'judul_informasi' => 'required|string|max:255',
        'isi'             => 'nullable|string',
        'tipe_informasi'  => 'required|in:informasi,gambar,slide',
        'gambar'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:512',
    ];

    public function loadData($id)
    {
        $info = \App\Models\InfoOption::findOrFail($id);
        $this->openform       = true;
        $this->infoOptionsId  = $info->id;
        $this->judul_informasi = $info->judul_informasi;
        $this->isi            = $info->isi_informasi;
        $this->tipe_informasi = $info->tipe_informasi;
        $this->existing_gambar = $info->gambar; // simpan path lama
        $this->gambar         = null;          // reset file baru
    }

    public function update()
    {
        $this->validate();

        // Ambil data lama dari DB agar aman (termasuk path gambar lama)
        $info = \App\Models\InfoOption::findOrFail($this->infoOptionsId);

        $path = $info->gambar; // default: pakai path lama

        if ($this->gambar) {
            // Simpan gambar baru
            $newPath = $this->gambar->store('info_options', 'public');

            // Hapus gambar lama jika ada dan berbeda
            if (!empty($path)) {
                Storage::disk('public')->delete($path);
            }

            $path = $newPath;
            $this->tipe_informasi = 'gambar';
        }

        $info->update([
            'judul_informasi' => $this->judul_informasi,
            'isi_informasi'   => $this->isi,
            'tipe_informasi'  => $this->tipe_informasi,
            'gambar'          => $path,
        ]);

        // Opsional: bersihkan input file agar tidak tertahan di memori
        $this->reset('gambar');

        $this->existing_gambar = $path;

        session()->flash('success', 'Informasi berhasil disimpan.');
    }
    public function render()
    {
        return view('livewire.info-option');
    }
}
