<?php

namespace App\Livewire;

use App\Models\Delegation as ModelsDelegation;
use Livewire\Component;
use Livewire\WithPagination;

class Delegation extends Component
{
    use WithPagination;

    // biar bisa pakai bootstrap style
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $perPage = 5;

    public function delete($id)
    {
        $delegations = ModelsDelegation::findOrFail($id);
        $delegations->delete();

        $this->dispatch('deleted-success', message: 'Data Pelimpahan berhasil dihapus!');
    }
    public function render()
    {
        return view('livewire.delegation', [
            'data' => ModelsDelegation::search($this->search)
                ->latest()
                ->paginate($this->perPage),
        ]);
    }
}
