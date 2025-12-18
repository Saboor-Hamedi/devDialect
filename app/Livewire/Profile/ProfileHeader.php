<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileHeader extends Component
{
    use WithFileUploads;

    public User $user;
    public $profilePhoto;
    public $coverPhoto;
    public $bio;

    protected $rules = [
        'profilePhoto' => 'nullable|image|max:1024',
        'coverPhoto' => 'nullable|image|max:2048',
        'bio' => 'nullable|string|max:1000',
    ];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->bio = $user->bio;
    }

    public function updatedProfilePhoto()
    {
        $this->validateOnly('profilePhoto');

        if ($this->user->profile_photo_path) {
            Storage::disk('public')->delete($this->user->profile_photo_path);
        }

        $path = $this->profilePhoto->store('profile-photos', 'public');
        $this->user->update(['profile_photo_path' => $path]);
        $this->dispatch('profile-updated', [
            'name' => $this->user->name,
            'profile_photo_url' => Storage::url($path)
        ]);
    }

    public function updatedCoverPhoto()
    {
        $this->validateOnly('coverPhoto');

        if ($this->user->cover_photo_path) {
            Storage::disk('public')->delete($this->user->cover_photo_path);
        }

        $path = $this->coverPhoto->store('cover-photos', 'public');
        $this->user->update(['cover_photo_path' => $path]);
        $this->dispatch('profile-updated');
    }

    public function saveBio()
    {
        $this->validateOnly('bio');
        $this->user->update(['bio' => $this->bio]);
        session()->flash('bio-saved', 'Bio updated!');
    }

    public function render()
    {
        return view('livewire.profile.profile-header');
    }
}
