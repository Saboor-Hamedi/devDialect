<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\On;

class PostFeed extends Component
{
    public $perPage = 10;
    public $layout = 'list';
    public $perPageBatch = 10;
    public $userId;

    public function mount($perPage = 10, $layout = 'list', $userId = null)
    {
        $this->perPage = $perPage;
        $this->perPageBatch = $perPage; // Set batch size to initial size
        $this->layout = $layout;
        $this->userId = $userId;
    }

    #[On('post-created')]
    public function render()
    {
        $query = Post::with('user')->latest();

        if ($this->userId) {
            $query->where('user_id', $this->userId);
        }

        $total = $query->count();
        $posts = $query->take($this->perPage)->get();

        return view('livewire.posts.post-feed', [
            'posts' => $posts,
            'total' => $total
        ]);
    }

    public function loadMore()
    {
        $this->perPage += $this->perPageBatch;
    }

    public function delete($id)
    {
        $post = Post::find($id);
        // Ensure user owns the post
        if ($post && $post->user_id === auth()->id()) {
            if ($post->image_path) {
                Storage::disk('public')->delete($post->image_path);
            }
            $post->delete();
        }
    }
}
