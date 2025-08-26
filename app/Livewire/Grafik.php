<?php

namespace App\Livewire;

use App\Models\Cancel;
use App\Models\Delegation;
use App\Models\Survey;
use Livewire\Component;

class Grafik extends Component
{
    // 🔹 Property untuk grafik keseluruhan
    public $surveys_puas;
    public $surveys_tidak_puas;
    public $jumlah_pembatalan;
    public $jumlah_pelimpahan;
    public $jumlah_survey;
    public $jumlah_surat;

    public $pendaftaran_puas;
    public $pendaftaran_tidak_puas;
    public $pendaftaran_total;

    public $pembatalan_puas;
    public $pembatalan_tidak_puas;
    public $pembatalan_total;

    public $pelimpahan_puas;
    public $pelimpahan_tidak_puas;
    public $pelimpahan_total;

    public function mount()
    {
        $surveyStats = Survey::selectRaw("
        SUM(CASE WHEN kepuasan = 'puas' THEN 1 ELSE 0 END) as puas,
        SUM(CASE WHEN kepuasan = 'tidak_puas' THEN 1 ELSE 0 END) as belum,
        COUNT(*) as total
    ")->first();

        $this->surveys_puas = $surveyStats->puas;
        $this->surveys_tidak_puas = $surveyStats->tidak_puas;
        $this->jumlah_survey = $surveyStats->total;

        $this->jumlah_pembatalan = Cancel::count();
        $this->jumlah_pelimpahan = Delegation::count();
        $this->jumlah_surat = Cancel::count() + Delegation::count();

        // 🔹 Survey Pendaftaran
        $pendaftaran = Survey::selectRaw("
            SUM(CASE WHEN kepuasan = 'puas' THEN 1 ELSE 0 END) as puas,
            SUM(CASE WHEN kepuasan = 'tidak_puas' THEN 1 ELSE 0 END) as tidak_puas,
            COUNT(*) as total
        ")->where('layanan', 'Pendaftaran Haji')->first();

        $this->pendaftaran_puas = $pendaftaran->puas ?? 0;
        $this->pendaftaran_tidak_puas = $pendaftaran->tidak_puas ?? 0;
        $this->pendaftaran_total = $pendaftaran->total ?? 0;

        // 🔹 Survey Pembatalan
        $pembatalan = Survey::selectRaw("
            SUM(CASE WHEN kepuasan = 'puas' THEN 1 ELSE 0 END) as puas,
            SUM(CASE WHEN kepuasan = 'tidak_puas' THEN 1 ELSE 0 END) as tidak_puas,
            COUNT(*) as total
        ")->where('layanan', 'Pembatalan Porsi Haji')->first();

        $this->pembatalan_puas = $pembatalan->puas ?? 0;
        $this->pembatalan_tidak_puas = $pembatalan->tidak_puas ?? 0;
        $this->pembatalan_total = $pembatalan->total ?? 0;

        // 🔹 Survey Pelimpahan
        $pelimpahan = Survey::selectRaw("
            SUM(CASE WHEN kepuasan = 'puas' THEN 1 ELSE 0 END) as puas,
            SUM(CASE WHEN kepuasan = 'tidak_puas' THEN 1 ELSE 0 END) as tidak_puas,
            COUNT(*) as total
        ")->where('layanan', 'Pelimpahan Porsi Haji')->first();

        $this->pelimpahan_puas = $pelimpahan->puas ?? 0;
        $this->pelimpahan_tidak_puas = $pelimpahan->tidak_puas ?? 0;
        $this->pelimpahan_total = $pelimpahan->total ?? 0;
    }
    public function render()
    {
        return view('livewire.grafik');
    }
}
