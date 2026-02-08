<?php

namespace App\Livewire;

use App\Models\News;
use Livewire\Component;

class NewsDetail extends Component
{
    public News $news;

    public function mount(News $news): void
    {
        if (! $news->is_published) {
            abort(404);
        }

        $this->news = $news->load('author');
    }

    public function title(): string
    {
        return $this->news->title . ' - Halus Ciptanadi';
    }

    public function render()
    {
        return view('livewire.news-detail', [
            'recentArticles' => News::query()
                ->published()
                ->where('id', '!=', $this->news->id)
                ->latest('published_at')
                ->limit(5)
                ->get(),
        ]);
    }
}
