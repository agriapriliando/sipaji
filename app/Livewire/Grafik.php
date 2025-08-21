<?php

namespace App\Livewire;

use App\Models\Cancel;
use App\Models\Delegation;
use App\Models\Survey;
use Livewire\Component;

class Grafik extends Component
{
    // 🔹 Property untuk grafik
    public $surveys_puas;
    public $surveys_tidak_puas;
    public $jumlah_pembatalan;
    public $jumlah_pelimpahan;
    public $jumlah_survey;
    public $jumlah_surat;

    public function mount()
    {
        $surveyStats = Survey::selectRaw("
        SUM(CASE WHEN kepuasan = '1' THEN 1 ELSE 0 END) as puas,
        SUM(CASE WHEN kepuasan = '0' THEN 1 ELSE 0 END) as belum,
        COUNT(*) as total
    ")->first();

        $this->surveys_puas = $surveyStats->puas;
        $this->surveys_tidak_puas = $surveyStats->tidak_puas;
        $this->jumlah_survey = $surveyStats->total;

        $this->jumlah_pembatalan = Cancel::count();
        $this->jumlah_pelimpahan = Delegation::count();
        $this->jumlah_surat = Cancel::count() + Delegation::count();
    }
    public function render()
    {
        return view('livewire.grafik');
    }
}
