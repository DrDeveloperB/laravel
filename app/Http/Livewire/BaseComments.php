<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BaseComments extends Component
{
//    public array $comments;
//
//    public function mount($comments)
//    {
//        $this->comments = $comments;
//        dd($this->comments);
//    }

    public function render()
    {
        return view('livewire.base-comments');
    }
}
