<?php

namespace App\Livewire\Layout;

use App\Models\Post;
use App\Models\Snippet;
use Livewire\Component;

class CommandPalette extends Component
{
    public $search = '';
    public $results = [];

    public function updatedSearch()
    {
        if (strlen($this->search) < 2) {
            $this->results = [];
            return;
        }

        $posts = Post::query()
            ->where('content', 'like', '%' . $this->search . '%')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => 'Post by ' . $post->user->name,
                    'description' => \Illuminate\Support\Str::limit($post->content, 50),
                    'url' => route('user.profile') . '?post=' . $post->id,
                    'type' => 'post',
                    'icon' => 'fa-newspaper',
                    'color' => 'bg-blue-500'
                ];
            });

        $snippets = Snippet::query()
            ->where('title', 'like', '%' . $this->search . '%')
            ->orWhere('content', 'like', '%' . $this->search . '%')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($snippet) {
                return [
                    'id' => $snippet->id,
                    'title' => $snippet->title,
                    'description' => 'Snippet in ' . $snippet->language,
                    'url' => route('user.profile') . '?snippet=' . $snippet->id,
                    'type' => 'snippet',
                    'icon' => 'fa-code',
                    'color' => 'bg-indigo-500'
                ];
            });

        $this->results = $posts->concat($snippets)->toArray();
    }

    public function render()
    {
        return view('livewire.layout.command-palette');
    }
}