<?php

namespace App\Livewire;

use App\Models\Cancel;
use Livewire\Component;
use Livewire\Attributes\Validate;

class Home extends Component
{
    #[Validate('required|string|max:50|unique:cancels,nomor_porsi')]
    public $nomor_porsi = '';

    #[Validate('required|string|max:100')]
    public $nama = '';

    #[Validate('nullable|string|max:100')]
    public $bin_binti = '';

    #[Validate('required|string|max:100')]
    public $ttl_tempat = '';

    #[Validate('required|date')]
    public $ttl_tanggal = '';

    #[Validate('required|string|max:100')]
    public $pekerjaan = '';

    #[Validate('required|string|max:255')]
    public $alamat = '';

    #[Validate('required|string|max:255')]
    public $alasan_pembatalan = '';

    public function messages()
    {
        return [
            'nomor_porsi.required'   => 'Nomor porsi haji wajib diisi.',
            'nomor_porsi.unique'     => 'Nomor porsi ini sudah terdaftar.',
            'nomor_porsi.max'       => 'Nomor porsi harus 13 Karakter.',

            'nama.required'         => 'Nama wajib diisi.',
            'nama.max'              => 'Nama maksimal 100 karakter.',

            'bin_binti.max'          => 'Bin/Binti maksimal 100 karakter.',

            'ttl_tempat.required'  => 'Tempat lahir wajib diisi.',
            'ttl_tempat.max'       => 'Tempat lahir maksimal 100 karakter.',

            'ttl_tanggal.required' => 'Tanggal lahir wajib diisi.',
            'ttl_tanggal.date'     => 'Format tanggal lahir tidak valid.',

            'pekerjaan.required'    => 'Pekerjaan wajib diisi.',
            'pekerjaan.max'         => 'Pekerjaan maksimal 100 karakter.',

            'alamat.required'       => 'Alamat wajib diisi.',
            'alamat.max'            => 'Alamat maksimal 255 karakter.',

            'alasan_pembatalan.required'       => 'Alasan pembatalan wajib diisi.',
            'alasan_pembatalan.max'            => 'Alasan maksimal 255 karakter.',
        ];
    }

    public function submitPembatalan()
    {
        // Validasi data sebelum menyimpan
        $this->validate();
        // Simpan ke database
        $datainput = $this->all();
        // dd($data);
        // Jika ada field yang tidak perlu disimpan, bisa dihapus dari array $data
        // unset($data['id']); // Misalnya jika ada field id yang tidak perlu disimpan
        // unset($data['created_at']); // Jika ada field created_at yang tidak perlu disimpan
        // Simpan data pembatalan
        $datainput['user_id'] = 1; // Tambahkan user_id
        $data = Cancel::create($datainput);

        // reset form setelah submit
        $this->reset([
            'nomor_porsi',
            'nama',
            'bin_binti',
            'ttl_tempat',
            'ttl_tanggal',
            'pekerjaan',
            'alamat',
            'alasan_pembatalan'
        ]);

        // redirect ke halaman cetak pembatalan
        return redirect()->route('cetak', ['jenis' => 'pembatalan', 'id' => $data->id]);
    }
    public function render()
    {
        return view('livewire.home');
    }
}
