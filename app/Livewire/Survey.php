<?php

namespace App\Livewire;

use App\Models\Survey as ModelsSurvey;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;

class Survey extends Component
{
    use WithPagination;

    // biar bisa pakai bootstrap style
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $perPage = 5;
    public $searchlayanan = '';

    public function delete($id)
    {
        $survey = ModelsSurvey::findOrFail($id);
        $survey->delete();

        $this->dispatch('deleted-success', message: 'Data Survey berhasil dihapus!');
    }

    public function exportPdf()
    {
        $q = ModelsSurvey::select('layanan', 'kepuasan', 'kritik_saran', 'created_at')->layanan($this->searchlayanan)->latest();

        $surveys = $q->get();

        $pdf = Pdf::loadView('pdf.surveys', [
            'surveys' => $surveys,
            'layanan' => $this->searchlayanan,
        ])->setPaper('a4', 'potrait'); // Bisa 'portrait' jika mau

        $filename = 'surveys_' . $this->searchlayanan . now()->format('Ymd_His') . '.pdf';

        // Kirim langsung sebagai download
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $filename);
    }
    public function render()
    {
        return view('livewire.survey', [
            'data' => ModelsSurvey::search($this->search)
                ->latest()
                ->layanan($this->searchlayanan)
                ->paginate($this->perPage),
        ]);
    }
}
