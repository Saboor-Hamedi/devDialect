<?php

namespace App\Livewire\Snippets;

use Livewire\Component;

class SnippetCard extends Component
{
    public $snippet;
    public $isEditing = false;
    public $editTitle;
    public $editContent;
    public $editLanguage;

    public function mount($snippet)
    {
        $this->snippet = $snippet;
        $this->editTitle = $snippet->title;
        $this->editContent = $snippet->content;
        $this->editLanguage = $snippet->language;
    }

    public function edit()
    {
        $this->isEditing = true;
    }

    public function cancelEdit()
    {
        $this->isEditing = false;
        $this->editTitle = $this->snippet->title;
        $this->editContent = $this->snippet->content;
        $this->editLanguage = $this->snippet->language;
    }

    public function update()
    {
        $this->validate([
            'editTitle' => 'required|string|max:255',
            'editContent' => 'required|string',
            'editLanguage' => 'required|string',
        ]);

        $this->snippet->update([
            'title' => $this->editTitle,
            'content' => $this->editContent,
            'language' => $this->editLanguage,
        ]);

        $this->isEditing = false;
        $this->dispatch('snippet-updated');
    }

    public function render()
    {
        return view('livewire.snippets.snippet-card');
    }
}
