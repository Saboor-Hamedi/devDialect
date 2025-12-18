<?php

namespace App\Livewire\Snippets;

use Livewire\Component;

class CreateSnippet extends Component
{
    public $title = '';
    public $content = '';
    public $language = 'markdown';
    public $is_public = true;

    protected $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'language' => 'required|string',
    ];

    public function save()
    {
        $this->validate();

        auth()->user()->snippets()->create([
            'title' => $this->title,
            'content' => $this->content,
            'language' => $this->language,
            'is_public' => $this->is_public,
        ]);

        $this->reset(['title', 'content', 'language']);
        $this->dispatch('snippet-created');
        session()->flash('snippet-saved', 'Snippet published!');
    }

    public function render()
    {
        return view('livewire.snippets.create-snippet');
    }
}
