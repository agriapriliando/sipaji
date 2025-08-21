<?php

namespace App\Livewire;

use App\Models\Feedback as ModelsFeedback;
use Livewire\Component;
use Livewire\WithPagination;

class Feedback extends Component
{
    use WithPagination;

    // biar bisa pakai bootstrap style
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $perPage = 5;

    public function delete($id)
    {
        $cancel = ModelsFeedback::findOrFail($id);
        $cancel->delete();

        $this->dispatch('deleted-success', message: 'Data Pembatalan berhasil dihapus!');
    }
    public function render()
    {
        return view('livewire.feedback', [
            'data' => ModelsFeedback::search($this->search)
                ->latest()
                ->paginate($this->perPage),
        ]);
    }
}
