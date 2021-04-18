<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class ShowPosts extends Component
{

    public $search;
    public $sort = 'id';
    public $direction = 'desc';

    // Listen events, when the event "render" (the first) is captured,
    // the method "render" (the second) is executed
    protected $listeners = ['render' => 'render'];

    public function render()
    {
        $posts = Post::where('title', 'like', '%' . $this->search . '%')
                ->orWhere('content', 'like', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->get();

        return view('livewire.show-posts', compact('posts'));
    }

    public function order($sort)
    {
        if($this->sort == $sort)
        {
            if($this->direction == 'desc')
            {
                $this->direction = 'asc';
            }else
            {
                $this->direction = 'desc';
            }
        }else
        {
            $this->sort = $sort;
            $this->direction = 'desc';
        }
        $this->sort = $sort;
    }
}
