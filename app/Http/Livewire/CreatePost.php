<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class CreatePost extends Component
{

    public $open = false;

    public $title, $content;

    protected $rules = [
        'title' => 'required|max:10',
        'content' => 'required'
    ];

    // Validation in real time
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.create-post');
    }

    public function save()
    {
        $this->validate();

        Post::create([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        // Reset values
        $this->reset(['open', 'title', 'content']);

        // Emit signal to other component, signal will be named as "render"
        // $this->emit('render');
        $this->emit('alert', 'El post se creó correctamente');

        // To emit signal to a specific component
        $this->emitTo('show-posts', 'render');
    }
}
