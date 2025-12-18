<?php

namespace App\Livewire\Snippets;

use App\Models\Snippet;
use Livewire\Component;

class SnippetFeed extends Component
{
    public $perPage = 10;
    public $userId;
    protected $listeners = ['snippet-created' => '$refresh'];

    public function mount($userId = null)
    {
        $this->userId = $userId;
    }

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
        $query = Snippet::with('user')->latest();

        if ($this->userId) {
            $query->where('user_id', $this->userId);
        }

        $total = $query->count();
        $snippets = $query->take($this->perPage)->get();

        return view('livewire.snippets.snippet-feed', [
            'snippets' => $snippets,
            'total' => $total
        ]);
    }
}
