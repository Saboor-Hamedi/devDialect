<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;

    public $content = '';
    public $image;

    public function save()
    {
        $this->validate([
            'content' => 'required|min:1|max:2000',
            'image' => 'nullable|image|max:1024', // 1MB Max
        ]);

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('posts', 'public');
        }

        auth()->user()->posts()->create([
            'content' => trim($this->content),
            'image_path' => $imagePath,
        ]);

        $this->reset(['content', 'image']);

        $this->dispatch('post-created');
    }

    public function render()
    {
        return view('livewire.posts.create-post');
    }
}
