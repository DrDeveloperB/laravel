<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;

class HelloWorld extends Component
{
    public $sessions;
    public $name = 'jelly';
    public $loud = false;
    public $greeting = 'Goodbye';
    public $modifier = ['my'];
    public $triggerValue = '';
    public $updatingValue = '';
    public $updatedValue = '';

    public $names = ['Jelly', 'Man', 'Chico'];
    public $contacts;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'refreshParent1' => '$refresh',
        'refreshParent2' => '$refresh',
        'refreshParent3' => '$refresh',
    ];

    /**
     * __construct
     * 클래스 호출시 파라미터 전달
     * @livewire('hello-world', ['name' => 'luffy'])
     * $_REQUEST 객체 메소드 사용
     */
    public function mount(Request $request, $name)
    {
        session(['status' => true], array());
        $this->sessions = print_r($request->session()->all(), true);
//        dd($this->sessions);

        // $request->input(key, default)
        $this->name = $request->input('name', $name);
        $this->contacts = User::all();
    }
//    public function mount($name)
//    {
//        $this->name = $name;
//    }

    public function refreshChildren1()
    {
        $this->emit('refreshChildren1', 'foo');
    }

    public function refreshChildren2()
    {
        $this->emit('refreshChildren2');
    }

    public function refreshChildren3()
    {
        $this->emit('refreshChildren3');
    }

    public function removeContact($id)
    {
        User::whereId($id)->first()->delete();
//        User::whereName($name)->first()->delete();
        $this->contacts = User::all();
    }

    /**
     * hook : hydrate
     * 선언된 속성과 같은 구성요소가 준비되고
     * render 또는 호출된 method 가 실행되기전에 실행됨
     */
    public function hydrate()
    {
        $this->triggerValue = 'Its Hydrated';
        $this->triggerValue = strtoupper($this->triggerValue);
    }

    /**
     * hook : updating
     * wire:model 을 사용한 경우
     * 선언된 속성과 같은 구성요소의 데이터가 업데이트되기전에 실행됨
     */
    public function updating()
    {
        $this->updatingValue = 'Its Updating';
        $this->updatingValue = strtoupper($this->updatingValue);
    }

    /**
     * hook : updated
     * wire:model 을 사용한 경우
     * 선언된 속성과 같은 구성요소의 데이터가 업데이트된 후 실행됨
     * 지정돤 구성요소가 있다면 해당 구성요소의 데이터가 업데이트된 후 실행됨
     * updatedName 또는 updated($name) 메소드는 구성요소중 name 속성의 데이터가 업데이트된 후 실행됨
     */
    public function updatedName($name)
    {
        // $_REQUEST('name')
        $this->updatedValue = $name;
    }
//    public function updated($name)
//    {
//        // $name 값을 전달 받지 못한 경우 뷰에서 액션이 일어난 Dom Name 을 할당
//        $this->updatedValue = $name;
//    }
//    public function updated()
//    {
//        $this->updatedValue = 'Its Updated';
//        $this->updatedValue = strtoupper($this->updatedValue);
//    }

    /**
     * index
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.hello-world');
        // 뷰에 데이터 전달
//        return view('livewire.hello-world',
//            ['name' => 'jelly']
//        );
    }

    /**
     * 이름 초기화
     */
    // hydrate 메소드만 호출됨
    public function resetName($name = 'Chico')
    {
        $this->name = $name;
    }
    // hydrate, updating, updated 메소드 호출됨
//    public function resetName()
//    {
//        $this->name = 'Chico';
//    }

}
