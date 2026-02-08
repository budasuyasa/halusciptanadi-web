<?php

namespace App\Livewire;

use App\Models\News;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Berita - Halus Ciptanadi')]
class NewsList extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.news-list', [
            'articles' => News::query()
                ->published()
                ->latest('published_at')
                ->paginate(9),
        ]);
    }
}
