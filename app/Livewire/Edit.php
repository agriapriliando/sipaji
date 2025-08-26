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

    // 🔹 Property untuk pembatalan
    public $cancel = null;
    public $nomor_porsi;
    public $nama;
    public $bin_binti;
    public $jenis_kelamin;
    public $ttl_tempat;
    public $ttl_tanggal;
    public $pekerjaan;
    public $alamat;
    public $alasan_pembatalan;

    // 🔹 Property untuk pelimpahan
    public $delegation = null;
    public $nama_asal;
    public $bin_binti_asal;
    public $nama_penerima;
    public $bin_binti_penerima;
    public $nomor_hp;
    public $alasan_pelimpahan;
    public $jenis_persyaratan;

    public function rules_pembatalan()
    {
        return [
            'nomor_porsi'       => 'required|string|unique:cancels,nomor_porsi,' . $this->id,
            'nama'              => 'required|string|max:100',
            'bin_binti'         => 'nullable|string|max:100',
            'jenis_kelamin'      => 'required|string',
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

            'nama.required'        => 'Nama wajib diisi.',
            'nama.max'             => 'Nama maksimal 100 karakter.',

            'bin_binti.max'        => 'Bin/Binti maksimal 100 karakter.',

            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',

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

    public function rules_pelimpahan()
    {
        return [
            'nomor_porsi'        => 'required|string|unique:delegations,nomor_porsi,' . $this->id,
            'nama_asal'          => 'required|string|max:100',
            'bin_binti_asal'     => 'nullable|string|max:100',
            'nama_penerima'      => 'required|string|max:100',
            'bin_binti_penerima' => 'nullable|string|max:100',
            'jenis_kelamin'      => 'required|string',
            'ttl_tempat'         => 'required|string|max:100',
            'ttl_tanggal'        => 'required|date',
            'pekerjaan'          => 'required|string|max:100',
            'alamat'             => 'required|string|max:200',
            'nomor_hp'           => 'required|string|max:15',
            'alasan_pelimpahan'  => 'required|string|max:255',
            'jenis_persyaratan'  => 'required|string|max:50',
        ];
    }

    public function messages_pelimpahan()
    {
        return [
            'nomor_porsi.required'        => 'Nomor porsi wajib diisi.',
            'nomor_porsi.unique'          => 'Nomor porsi ini sudah terdaftar.',

            'nama_asal.required'          => 'Nama asal wajib diisi.',
            'nama_asal.max'               => 'Nama asal maksimal 100 karakter.',

            'bin_binti_asal.max'          => 'Bin/Binti asal maksimal 100 karakter.',

            'nama_penerima.required'      => 'Nama penerima wajib diisi.',
            'nama_penerima.max'           => 'Nama penerima maksimal 100 karakter.',

            'bin_binti_penerima.max'      => 'Bin/Binti penerima maksimal 100 karakter.',

            'jenis_kelamin.required'      => 'Jenis kelamin wajib diisi.',

            'ttl_tempat.required'         => 'Tempat lahir wajib diisi.',
            'ttl_tempat.max'              => 'Tempat lahir maksimal 100 karakter.',

            'ttl_tanggal.required'        => 'Tanggal lahir wajib diisi.',
            'ttl_tanggal.date'            => 'Tanggal lahir harus berupa format tanggal yang valid.',

            'pekerjaan.required'          => 'Pekerjaan wajib diisi.',
            'pekerjaan.max'               => 'Pekerjaan maksimal 100 karakter.',

            'alamat.required'             => 'Alamat wajib diisi.',
            'alamat.max'                  => 'Alamat maksimal 200 karakter.',

            'nomor_hp.required'           => 'Nomor HP wajib diisi.',
            'nomor_hp.max'                => 'Nomor HP maksimal 15 digit.',

            'alasan_pelimpahan.required'  => 'Alasan pelimpahan wajib diisi.',
            'alasan_pelimpahan.max'       => 'Alasan pelimpahan maksimal 255 karakter.',

            'jenis_persyaratan.required'  => 'Jenis persyaratan wajib diisi.',
            'jenis_persyaratan.max'       => 'Jenis persyaratan maksimal 50 karakter.',
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
            $this->jenis_kelamin    = $cancel->jenis_kelamin;
            $this->ttl_tempat       = $cancel->ttl_tempat;
            $this->ttl_tanggal      = $cancel->ttl_tanggal->format('Y-m-d'); // untuk input date
            $this->pekerjaan        = $cancel->pekerjaan;
            $this->alamat           = $cancel->alamat;
            $this->alasan_pembatalan = $cancel->alasan_pembatalan;
        } elseif ($this->jenis === 'pelimpahan') {
            $delegation = Delegation::whereId($this->id)->first();
            $this->delegation         = $delegation;
            $this->nomor_porsi        = $delegation->nomor_porsi;
            $this->nama_asal          = $delegation->nama_asal;
            $this->bin_binti_asal     = $delegation->bin_binti_asal;
            $this->nama_penerima      = $delegation->nama_penerima;
            $this->bin_binti_penerima = $delegation->bin_binti_penerima;
            $this->jenis_kelamin      = $delegation->jenis_kelamin;
            $this->ttl_tempat         = $delegation->ttl_tempat;
            $this->ttl_tanggal        = $delegation->ttl_tanggal->format('Y-m-d'); // untuk input date
            $this->pekerjaan          = $delegation->pekerjaan;
            $this->alamat             = $delegation->alamat;
            $this->nomor_hp           = $delegation->nomor_hp;
            $this->alasan_pelimpahan  = $delegation->alasan_pelimpahan;
            $this->jenis_persyaratan  = $delegation->jenis_persyaratan;
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
                'jenis_kelamin'     => $this->jenis_kelamin,
                'ttl_tempat'        => $this->ttl_tempat,
                'ttl_tanggal'       => $this->ttl_tanggal,
                'pekerjaan'         => $this->pekerjaan,
                'alamat'            => $this->alamat,
                'alasan_pembatalan' => $this->alasan_pembatalan,
            ]);
            // redirect ke halaman cetak pembatalan
            return redirect()->route('cetak', ['jenis' => 'pembatalan', 'id' => $this->id]);
        } elseif ($this->jenis === 'pelimpahan') {
            $this->validate($this->rules_pelimpahan(), $this->messages_pelimpahan());
            $this->delegation->update([
                'nomor_porsi'        => $this->nomor_porsi,
                'nama_asal'          => $this->nama_asal,
                'bin_binti_asal'     => $this->bin_binti_asal,
                'nama_penerima'      => $this->nama_penerima,
                'bin_binti_penerima' => $this->bin_binti_penerima,
                'jenis_kelamin'      => $this->jenis_kelamin,
                'ttl_tempat'         => $this->ttl_tempat,
                'ttl_tanggal'        => $this->ttl_tanggal,
                'pekerjaan'          => $this->pekerjaan,
                'alamat'             => $this->alamat,
                'nomor_hp'           => $this->nomor_hp,
                'alasan_pelimpahan'  => $this->alasan_pelimpahan,
                'jenis_persyaratan'  => $this->jenis_persyaratan,
            ]);
            // redirect ke halaman cetak pelimpahan
            return redirect()->route('cetak', ['jenis' => 'pelimpahan', 'id' => $this->id]);
        } else {
            abort(404, 'Jenis surat tidak ditemukan.');
        }
    }

    public function render()
    {
        return view('livewire.edit');
    }
}
