<?php

namespace App\Http\Livewire;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\livewire\User;
use Livewire\Component;

class LivewireTest extends Component
{
    public $name = 'jelly';

    public function render()
    {
//        $this->users = User::all();
        return view('livewire.livewire-test');
//        return view('livewire.livewire-test', ['users' => $this->users]);
    }
}
