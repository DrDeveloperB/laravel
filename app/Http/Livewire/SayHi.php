<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SayHi extends Component
{
    public $names;
    public $name2;
    public $contact;
    public $num;

    /**
     * 응답 대기
     * refreshChildren 이 호출되면 refreshMe 메소드를 호출함
     * 호출되는 메소드와 클래스내 메소드명이 동일하면 값 생략 가능
     * $refresh 변수? 는 새로고침 기능
     *
     * 같은 페이지에서 로딩되는 모든 컨트롤러의 이벤트와 리스너가 사용됨
     * emit('refreshParent1') 이벤트는 모든 리스너와 ($listeners->refreshParent1) 통신함
     * 현재 컨트롤러의 리스너에 먼저 대응하고 부모 컨트롤러의 리스너에 대응함
     * @var string[]
     */
    protected $listeners = [
        'refreshChildren1' => 'refreshMe',
        'refreshChildren2',
        'refreshChildren3' => '$refresh',
        'refreshParent1' => '$refresh',
    ];

    public function mount($names = [], $name2 = 'defaultName', User $contact, $num = 0)
//    public function mount(?array $names = null, ?string $name2 = null, User $contact, $num = 0)
    {
        $this->names = $names;
        $this->name2 = $name2;
        $this->contact = $contact;
        $this->num = $num + 1;
    }

    public function render()
    {
        return view('livewire.say-hi');
    }

    public function removeContact(User $id)
    {
//        dd($name);
        $id->delete();
//        User::whereId($id)->first()->delete();
        $this->emit('refreshParent');

//        User::whereName($name)->first()->delete();

//        DB::enableQueryLog();
////        $name = "Yessenia O'Hara";
////        $getUser = User::where("name", "=", $name)->get();
//        $getUser = User::whereName($name)->first()->get();
////        $getUser = User::whereName("Yessenia O'Hara")->first()->get();
//        print_r(DB::getQueryLog());
//        print_r($getUser);
    }

    public function refreshMe($someVariable)
    {
        dd($someVariable);
    }

    public function refreshChildren2()
    {
//        dd($someVariable);
    }

    /**
     * 부모와 자식들 리스너에 refreshParent1 이 모두 존재하여 모두 refresh 됨
     * refresh 순서
     * 1. 호출한 자식 레이어
     * 2. 호출한 자식 레이어와 같은 컨트롤러를 사용하는 자식들 레이어
     * 3. 부모 레이어
     */
    public function refreshParent1()
    {
        $this->emit('refreshParent1');
    }

    /**
     * 부모 리스너에만 존재하여 호출한 자식과 부모만 refresh 됨
     * refresh 순서
     * 1. 호출한 자식 레이어
     * 3. 부모 레이어
     */
    public function refreshParent2()
    {
        $this->emit('refreshParent2');
    }

    /**
     * 부모 리스너만 호출하여 호출한 자식과 부모만 refresh 됨
     * refreshParent2 메소드 동작과 동일
     */
    public function refreshParent3()
    {
        $this->emitUp('refreshParent3');
    }
}
