<div class="inline-block">
{{-- 배열 수신 --}}
{{--    <div>--}}
{{--    @foreach ($names as $k => $name)--}}
{{--    <div class="mb-1">--}}
{{--        name {{ $k }} : <input wire:model="names.{{ $k }}" type="text"> Hello {{ $name }}--}}
{{--    </div>--}}
{{--    @endforeach--}}
{{--    </div>--}}

{{--    단일 데이터 수신--}}
    {{--    <div>--}}
{{--    <input wire:model="name2" type="text">--}}
{{--    Hello {{ $name2 }}--}}
    {{--    </div>--}}

{{--    부모 레이아웃에서 include 반복--}}
    <div>
{{--        {{ $num }} ::--}}
        ID = {{ $contact->id }} :: Hello {{ $contact->name }} :: {{ now() }}

{{--
부모 레이아웃은 refresh 안됨
하나의 태그내에 wire 지시문을 2개이상 적용하고 부모 레이아웃에서 반복하여 include 하면 오류 발생
Uncaught SyntaxError: missing ) after argument list
--}}
        <button wire:click="$refresh" class="bg-purple-300 px-6 py-1">refresh</button>
        <button wire:click="removeContact('{{ $contact->id }}')" class="bg-red-300 px-6 py-1">RemoveInHi</button>
{{--        <button wire:click="removeContact('{{ addslashes($contact->name) }}')" class="bg-red-300 px-6 py-1">RemoveInHi</button>--}}
        {{--        <button wire:click="removeContact('{{ $contact->name }}')" wire:loading.attr="disabled" class="bg-red-300 px-6 py-1">Remove</button>--}}

        <button wire:click="refreshParent1" class="bg-gray-300 px-6 py-1">Refresh Parent1</button>
        <button wire:click="refreshParent2" class="bg-blue-300 px-6 py-1">Refresh Parent2</button>
        <button wire:click="refreshParent3" class="bg-purple-300 px-6 py-1">Refresh Parent3</button>
    </div>


</div>
