<?php

namespace App\Livewire;

use App\Models\Career;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Title('Karir - Halus Ciptanadi')]
class CareerList extends Component
{
    #[Url]
    public string $location = '';

    public function render()
    {
        $query = Career::query()->active();

        if ($this->location) {
            $query->where('location', $this->location);
        }

        return view('livewire.career-list', [
            'careers' => $query->latest()->get(),
        ]);
    }
}
