<?php

namespace App\Livewire;

use App\Models\Cancel;
use App\Models\Delegation;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Edit extends Component
{
    public $jenis;
    public $id;

    public $cancel = null;

    public $nomor_porsi;
    public $nama;
    public $bin_binti;
    public $ttl_tempat;
    public $ttl_tanggal;
    public $pekerjaan;
    public $alamat;
    public $alasan_pembatalan;


    public function rules_pembatalan()
    {
        return [
            'nomor_porsi'       => 'required|string|size:13|unique:cancels,nomor_porsi,' . $this->id,
            'nama'              => 'required|string|max:100',
            'bin_binti'         => 'nullable|string|max:100',
            'ttl_tempat'        => 'required|string|max:100',
            'ttl_tanggal'       => 'required|date',
            'pekerjaan'         => 'required|string|max:100',
            'alamat'            => 'required|string|max:255',
            'alasan_pembatalan' => 'required|string|max:255',
        ];
    }

    public function messages_pembatalan()
    {
        return [
            'nomor_porsi.required' => 'Nomor porsi haji wajib diisi.',
            'nomor_porsi.unique'   => 'Nomor porsi ini sudah terdaftar.',
            'nomor_porsi.size'     => 'Nomor porsi harus 13 Karakter.',

            'nama.required'        => 'Nama wajib diisi.',
            'nama.max'             => 'Nama maksimal 100 karakter.',

            'bin_binti.max'        => 'Bin/Binti maksimal 100 karakter.',

            'ttl_tempat.required'  => 'Tempat lahir wajib diisi.',
            'ttl_tempat.max'       => 'Tempat lahir maksimal 100 karakter.',

            'ttl_tanggal.required' => 'Tanggal lahir wajib diisi.',
            'ttl_tanggal.date'     => 'Format tanggal lahir tidak valid.',

            'pekerjaan.required'   => 'Pekerjaan wajib diisi.',
            'pekerjaan.max'        => 'Pekerjaan maksimal 100 karakter.',

            'alamat.required'      => 'Alamat wajib diisi.',
            'alamat.max'           => 'Alamat maksimal 255 karakter.',

            'alasan_pembatalan.required' => 'Alasan pembatalan wajib diisi.',
            'alasan_pembatalan.max'      => 'Alasan maksimal 255 karakter.',
        ];
    }

    public function mount($jenis, $id)
    {
        $this->jenis = $jenis;
        $this->id = $id;

        // Ambil data surat berdasarkan jenis
        if ($this->jenis === 'pembatalan') {
            $cancel = Cancel::whereId($this->id)->first();
            $this->cancel           = $cancel;
            $this->nomor_porsi      = $cancel->nomor_porsi;
            $this->nama             = $cancel->nama;
            $this->bin_binti        = $cancel->bin_binti;
            $this->ttl_tempat       = $cancel->ttl_tempat;
            $this->ttl_tanggal      = $cancel->ttl_tanggal->format('Y-m-d'); // untuk input date
            $this->pekerjaan        = $cancel->pekerjaan;
            $this->alamat           = $cancel->alamat;
            $this->alasan_pembatalan = $cancel->alasan_pembatalan;
        } elseif ($this->jenis === 'pelimpahan') {
            $delegation = Delegation::whereId($this->id)->first();
        } else {
            abort(404, 'Jenis surat tidak ditemukan.');
        }
    }

    public function update()
    {
        if ($this->jenis === 'pembatalan') {
            $this->validate($this->rules_pembatalan(), $this->messages_pembatalan());
            $this->cancel->update([
                'nomor_porsi'       => $this->nomor_porsi,
                'nama'              => $this->nama,
                'bin_binti'         => $this->bin_binti,
                'ttl_tempat'        => $this->ttl_tempat,
                'ttl_tanggal'       => $this->ttl_tanggal,
                'pekerjaan'         => $this->pekerjaan,
                'alamat'            => $this->alamat,
                'alasan_pembatalan' => $this->alasan_pembatalan,
            ]);
            // redirect ke halaman cetak pembatalan
            return redirect()->route('cetak', ['jenis' => 'pembatalan', 'id' => $this->id]);
        }

        session()->flash('success', 'Data pembatalan berhasil diperbarui.');

        return redirect()->route('cancels.index'); // sesuaikan dengan route index-mu
    }

    public function render()
    {
        return view('livewire.edit');
    }
}
