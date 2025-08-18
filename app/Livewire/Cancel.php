<?php

namespace App\Livewire;

use App\Models\Cancel as ModelsCancel;
use Livewire\Component;
use Livewire\WithPagination;

class Cancel extends Component
{
    use WithPagination;

    // biar bisa pakai bootstrap style
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $perPage = 5;

    public function delete($id)
    {
        $cancel = ModelsCancel::findOrFail($id);
        $cancel->delete();

        $this->dispatch('notify', message: 'Data berhasil dihapus!');
    }
    public function render()
    {
        return view('livewire.cancel', [
            'data' => ModelsCancel::search($this->search)
                ->latest()
                ->paginate($this->perPage),
        ]);
    }
}
