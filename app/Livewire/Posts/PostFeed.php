<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\On;

class PostFeed extends Component
{
    public $perPage = 10;

    #[On('post-created')]
    public function render()
    {
        $total = Post::count();
        $posts = Post::with('user')->latest()->take($this->perPage)->get();

        return view('livewire.posts.post-feed', [
            'posts' => $posts,
            'total' => $total
        ]);
    }

    public function loadMore()
    {
        $this->perPage += 10;
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
