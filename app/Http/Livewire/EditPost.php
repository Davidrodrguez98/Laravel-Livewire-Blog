<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class EditPost extends Component
{
    public $post;
    public $open = false;

    protected $rules = [
        'post.title' => 'required',
        'post.content' => 'required'
    ];

    public function save()
    {
        $this->validate();

        $this->post->save();

         // Reset values
         $this->reset(['open']);

        // Emit signal to other component, signal will be named as "render"
        // $this->emit('render');
        $this->emit('alert', 'El post se actualizó correctamente');

        // To emit signal to a specific component
        $this->emitTo('show-posts', 'render');
    }

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.edit-post');
    }
}
