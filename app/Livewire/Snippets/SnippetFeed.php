<?php

namespace App\Livewire\Snippets;

use App\Models\Snippet;
use Livewire\Component;

class SnippetFeed extends Component
{
    public $perPage = 10;
    protected $listeners = ['snippet-created' => '$refresh'];

    public function loadMore()
    {
        $this->perPage += 10;
    }

    public function deleteSnippet($id)
    {
        $snippet = Snippet::find($id);
        if ($snippet && $snippet->user_id === auth()->id()) {
            $snippet->delete();
            $this->dispatch('snippet-deleted');
        }
    }

    public function render()
    {
        $total = Snippet::count();
        $snippets = Snippet::with('user')->latest()->take($this->perPage)->get();

        return view('livewire.snippets.snippet-feed', [
            'snippets' => $snippets,
            'total' => $total
        ]);
    }
}
