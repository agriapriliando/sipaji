<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;

class Survey extends Component
{
    #[Validate('required')]
    public string $kepuasan = '';

    public string $targetType = 'cetak_surat';
    public int|string|null $targetId = null;

    public function mount($targetId, $targetType)
    {
        $this->targetId   = $targetId;
        $this->targetType = $targetType;
    }

    public function submitSurvey()
    {
        $this->validate();

        // Update data Cancel atau Delegation
        if ($this->targetType === 'pembatalan') {
            Survey::create([
                'target_type' => Cancel::class,
                'target_id'   => $this->targetId,
                'kepuasan'    => $this->kepuasan, // 'puas' | 'tidak_puas'
            ]);
            $cancel = Cancel::find($this->targetId);
            $cancel->update([
                'status_cetak' => true,
                'status_surveys' => $this->kepuasan,
            ]);
        } elseif ($this->targetType === 'pelimpahan') {
            Survey::create([
                'target_type' => Delegation::class,
                'target_id'   => $this->targetId,
                'kepuasan'    => $this->kepuasan, // 'puas' | 'tidak_puas'
            ]);
            $delegation = Delegation::find($this->targetId);
            $delegation->update([
                'status_cetak' => true,
                'status_surveys' => $this->kepuasan,
            ]);
        }

        // Reset form agar siap untuk pemakaian berikutnya
        $this->reset('kepuasan');

        // Browser event → akan ditangkap JS untuk menutup modal & cetak
        $this->dispatch('survey-saved', message: 'Terima kasih atas feedback Anda!');
    }
    public function render()
    {
        return view('livewire.survey');
    }
}
