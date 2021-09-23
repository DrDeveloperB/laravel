<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;

class LifecycleHooks extends Component
{
    public $name = 'jelly';
    public $triggerValue = 'a';

    public $names = ['Jelly', 'Man', 'Chico'];

    public $contacts;

    public function mount($name)
    {
        $this->name = $name;
        $this->contacts = User::all();
    }

    public function hydrate()
    {
        $this->triggerValue = 'Its Hydrated';
    }

    public function render()
    {
        return view('livewire.lifecycle-hooks');
    }

    public function resetName($name = 'Chico')
    {
        $this->name = $name;
    }
}
