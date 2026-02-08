<?php

namespace App\Livewire;

use App\Models\Career;
use Livewire\Component;

class CareerDetail extends Component
{
    public Career $career;

    public function mount(Career $career): void
    {
        if (! $career->is_active) {
            abort(404);
        }

        $this->career = $career;
    }

    public function title(): string
    {
        return $this->career->title . ' - Karir Halus Ciptanadi';
    }

    public function render()
    {
        return view('livewire.career-detail');
    }
}
