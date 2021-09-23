<?php

namespace App\Http\Livewire\Auth;

use App\Models\livewire\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Register extends Component
{
    public $users = [];
    public $searchName;
    public $searchName2;

    public function mount()
    {
//        $this->users = User::all();
    }

    public function render()
    {
        $role = $this->searchName ? $this->searchName : $this->searchName2;

//        $this->users = DB::connection('sqlite')->table('users')->when($role, function ($query, $role) {
//            return $query->where('name', 'like', sprintf('%%%s%%', $role));
//        })->get();

        $query = User::query();

//        $query->when($role, function ($query, $role) {
//            return $query->where('name', 'like', sprintf('%%%s%%', $role));
//        })->dump();

        $this->users = $query->when($role, function ($query, $role) {
            return $query->where('name', 'like', sprintf('%%%s%%', $role));
        })->get();

        return view('livewire.auth.register');
//        return view('livewire.auth.register', ['users' => $this->users]);
    }

    public function searchUser()
    {
        $role = $this->searchName2;
        $query = User::query();

//        $this->users = $query->when($role, function ($query, $role) {
//            return $query->where('name', 'like', sprintf('%%%s%%', $role));
//        })->get();

//        $this->updated();     // auto load
//        $refresh;
//        $this->render();

//        dump($this->searchName2);
//        dd($this->searchName2);

        /**
         * 쿼리 디버깅
         * dd()
         * dump()
         * toSql()
         * getQuery()
         * $last_sql = end($sql);
         */
        $sql = $query->when($role, function ($query, $role) {
            return $query->where('name', 'like', sprintf('%%%s%%', $role));
        })->toSql();

//        $bindings = $sql->getBindings();

        $data = [
            'toSql' => $sql,
//            'getBindings' => $bindings,
        ];
        dump($data);

//        DB::connection('sqlite')->enableQueryLog();
//        DB::connection('sqlite')->table('users')->when($role, function ($query, $role) {
//            return $query->where('name', 'like', sprintf('%%%s%%', $role));
//        })->get();
//        Log::info(DB::connection('sqlite')->getQueryLog());
//        dump(DB::connection('sqlite')->getQueryLog());
    }

    public function updated()
    {
        $refresh;
    }

}
