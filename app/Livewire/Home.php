<?php

namespace App\Livewire;

use App\Models\Cancel;
use App\Models\Delegation;
use App\Models\InfoOption;
use App\Models\Survey;
use Illuminate\Console\View\Components\Info;
use Livewire\Component;
use Livewire\Attributes\Validate;

class Home extends Component
{
    public $jenissurat = 'pembatalan';

    // 🔹 Property untuk pembatalan
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
    public $nama_asal;
    public $bin_binti_asal;
    public $nama_penerima;
    public $bin_binti_penerima;
    public $nomor_hp;
    public $alasan_pelimpahan;
    public $jenis_persyaratan;

    public $target_type;
    public $target_id = null;
    public $layanan;
    public $kepuasan;
    public $kritik_saran;

    public $showSurveyModal;
    public $idsurat;

    public function rules_survey()
    {
        return [
            'target_type' => 'nullable|string|max:255',
            'target_id'   => 'nullable|integer',
            'layanan'     => 'required',
            'kepuasan'    => 'required|in:puas,tidak_puas',
            'kritik_saran' => 'nullable|string|max:1000',
        ];
    }

    public function addSurvey()
    {
        $data = $this->validate($this->rules_survey());

        if ($this->layanan == 'Pembatalan Porsi Haji') {
            $data['target_type'] = Cancel::class;
        } elseif ($this->layanan == 'Pelimpahan Porsi Haji') {
            $data['target_type'] = Delegation::class;
        } else {
            $data['target_type'] = 'Pendaftaran Haji';
        }
        $data['target_id'] = 'homepage';

        Survey::create($data);

        $this->reset([
            'layanan',
            'kepuasan',
            'kritik_saran',
        ]);

        if ($this->showSurveyModal) {
            return redirect()->route('cetak', ['jenis' => $this->jenissurat, 'id' => $this->idsurat]);
        }

        $this->dispatch('survey-success', message: 'Terima Kasih Telah Mengisi Survey Kepuasan!');
    }
    /*************  ✨ Windsurf Command ⭐  *************/
    /**
     * Rules for validating form data of survey with Pembatalan Porsi Haji layanan.
     *
     * @return array<string, string>
     */
    /*******  ca75ae17-460b-4c10-89d7-1a4b2e90a44d  *******/
    public function rules_pembatalan()
    {
        return [
            'nomor_porsi'       => 'required|string|unique:cancels,nomor_porsi',
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
            'nomor_porsi'        => 'required|string|unique:delegations,nomor_porsi',
            'nama_asal'          => 'required|string|max:100',
            'bin_binti_asal'     => 'nullable|string|max:100',
            'nama_penerima'      => 'required|string|max:100',
            'bin_binti_penerima' => 'nullable|string|max:100',
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

    // Validasi live per field saat diketik (wire:model.live)
    // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName);
    // }

    // public function updatedJenissurat()
    // {
    //     dd($this->jenissurat);
    // }

    public function resetsurvey()
    {
        $this->reset([
            'layanan',
            'kepuasan',
            'kritik_saran',
        ]);
    }

    public function tutupmodal()
    {
        $this->showSurveyModal = false;
    }

    public function submitPembatalan()
    {
        // Validasi seluruh field
        $validated = $this->validate($this->rules_pembatalan(), $this->messages_pembatalan());

        // Tambahkan user_id (pakai auth jika ada, fallback 1)
        $validated['user_id'] = 1;

        // Simpan data (pastikan kolom fillable di model Cancel sudah benar)
        $data = Cancel::create($validated);

        $this->idsurat = $data->id;


        $this->reset([
            'layanan',
            'kepuasan',
            'kritik_saran',
        ]);

        $this->showSurveyModal = true;

        $this->addSurvey();

        // Reset form
        $this->reset([
            'nomor_porsi',
            'nama',
            'bin_binti',
            'jenis_kelamin',
            'ttl_tempat',
            'ttl_tanggal',
            'pekerjaan',
            'alamat',
            'alasan_pembatalan',
        ]);
        // Redirect ke cetak
        return redirect()->route('cetak', ['jenis' => 'pembatalan', 'id' => $data->id]);
    }

    public function submitPelimpahan()
    {
        // Validasi data sebelum menyimpan
        $validated = $this->validate($this->rules_pelimpahan(), $this->messages_pelimpahan());

        // dd($validated);
        // Simpan data Pelimpahan
        $validated['user_id'] = 1; // Tambahkan user_id
        // Simpan ke database
        $data = Delegation::create($validated);

        $this->idsurat = $data->id;


        $this->reset([
            'layanan',
            'kepuasan',
            'kritik_saran',
        ]);

        $this->showSurveyModal = true;

        $this->addSurvey();

        // reset form setelah submit
        $this->reset([
            'nomor_porsi',
            'nama_asal',
            'bin_binti_asal',
            'nama_penerima',
            'bin_binti_penerima',
            'ttl_tempat',
            'ttl_tanggal',
            'pekerjaan',
            'alamat',
            'nomor_hp',
            'alasan_pelimpahan',
            'jenis_persyaratan',
        ]);
        // redirect ke halaman cetak pelimpahan
        return redirect()->route('cetak', ['jenis' => 'pelimpahan', 'id' => $data->id]);
    }

    public function render()
    {
        return view('livewire.home', [
            'informasi' => InfoOption::all(),
        ]);
    }
}
