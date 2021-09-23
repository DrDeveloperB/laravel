<div>
{{--
div 태그가 누락된 경우 root tag 오류 발생
Livewire\Exceptions\RootTagMissingFromViewException
Livewire encountered a missing root tag when trying to render a component. When rendering a Blade view, make sure it contains a root HTML tag.

라이브와이어는 자바스크립트를 쓰지 않고 라라벨과 블레이드로 동적인 프론트 엔드를 만들어주는 꽤 신기한 도구입니다.
라라벨 팀이 주도하는 프로젝트는 아니고 칼렙 포르지오라는 개발자가 진행하는 프로젝트입니다.
매번 서버에 요청을 보내야하기 때문에 모든 Vue 컴포넌트를 대체하기 보다는,
서버와 통신할 일이 있는 컴포넌트만 라이브와이어로 대체하면 좋을 것이라고 합니다.
백엔드용으로 괜찮다는 생각...

작동 순서 : wire:click="resetName('Bingo')"
1. 라이브와이어가 wire:click=”resetName” 클릭을 인식
2. 라이브와이어가 PHP에 AJAX 리퀘스트 전송
3. PHP가 resetName 메서드 호출하고 $name을 업데이트
4. PHP가 블레이드를 다시 렌더링하고 HTML을 되돌려줌
5. 라이브와이어가 응답을 받아서 DOM을 업데이트
--}}

{{--    @dd(session()->all())--}}
    <div>
        <xmp>
            {{ $sessions }}
        </xmp>
    </div>

{{--                include--}}
    <div class="m-10 bg-indigo-50">
{{--        배열 넘김--}}
{{--        @livewire('say-hi', ['names' => $names])--}}

{{--        정상작동--}}
{{--        @livewire('say-hi', ['name2' => $names[0]])--}}
{{--        @livewire('say-hi', ['name2' => $names[1]])--}}
{{--        @livewire('say-hi', ['name2' => $names[2]])--}}

{{--
include 반복 : 정상 작동
key 메소드를 사용하여 wire:id 가 중복되지 않음
반복문 안에서 하나의 태그내에 wire 지시문을 2개이상 적용시 오류 발생
--}}
        @foreach ($contacts as $k => $contact)
            <div>
                <div class="inline-block">
                    {{ $k + 1 }}
                </div>

                @livewire('say-hi', ['contact' => $contact, 'num' => $k], key($contact->id))
{{--                    @livewire('say-hi', ['contact' => $contact], key($contact->name))--}}
{{--                    <button wire:click="removeContact('{{ $contact->id }}')" class="bg-red-300 px-6 py-1">RemovInHello</button>--}}
                {{--            <button wire:click="removeContact('{{ $contact->name }}')" wire:loading.attr="disabled" class="bg-red-300 px-6 py-1">RemovInHello</button>--}}
                {{--            @if ($k == 0) @break @endif--}}
            </div>
        @endforeach
        <hr>
        <div>
{{--
hydrate 메소드 실행됨
자식 레이아웃은 refresh 안됨
$emit 메소드를 직접 사용할 경우 자식 레이어만 refresh 됨
--}}
            <button wire:click="$refresh" class="ring-4 bg-green-300 px-6 py-1">refresh</button>
            {{ now() }}
            <button wire:click="refreshChildren1" class="border-4 border-indigo-600 bg-gray-300 px-6 py-1">Refresh Children</button>
            <button wire:click="refreshChildren2" class="bg-blue-300 px-6 py-1">Refresh Children2</button>
            <button wire:click="refreshChildren3" class="bg-purple-300 px-6 py-1">Refresh Children3</button>
            <button wire:click="$emit('refreshChildren3')" class="bg-indigo-300 px-6 py-1">Refresh Children4</button>
        </div>

{{--
include 반복 : 오류
Uncaught (in promise) TypeError: Cannot read property 'fingerprint' of null
wire:id 값이 DOM 구성 유니크 값인데 (id 속성과 유사) 중복된 값이 발생하여 오류 발생
--}}
{{--        @foreach ($names as $name2)--}}
{{--            @livewire('say-hi', ['name2' => $name2])--}}
{{--        @endforeach--}}
    </div>

    <div class="m-10">
    {{--    포커스아웃--}}
    {{--    <input wire:model.lazy="name" type="text">--}}

    {{--    2초 딜레이--}}
    {{--    <input wire:model.debounce.2000ms="name" type="text">--}}

    {{--    checkbox--}}
        <input wire:model="loud" type="checkbox">

    {{--    주의 : 값 체크시 대소문자 구분됨--}}
        <select wire:model="greeting">
            <option>Hello</option>
            <option>Goodbye</option>
            <option>Adios</option>
        </select>

        <select wire:model="modifier" multiple>
            <option>my</option>
            <option>love</option>
            <option>darling</option>
        </select>
    </div>

    <div class="my-10 mx-2">
        {{--    실시간 XHR 통신--}}
        <div class="mb-1">
            name : <input wire:model="name" type="text">
        </div>

        {{--    defer : XHR 통신 안함--}}
        <div class="mb-1">
            name (defer) : <input wire:model.defer="name" type="text">
        </div>

        {{--            hook : hydrate--}}
        <div class="mb-1">
            triggerValue : <input wire:model="triggerValue" type="text">
        </div>

        {{--            hook : updating--}}
        <div class="mb-1">
            updatingValue : <input wire:model="updatingValue" type="text">
        </div>

        {{--            hook : updated--}}
        <div class="mb-1">
            updatedValue : <input wire:model="updatedValue" type="text">
        </div>
    </div>

    <div class="my-10 mx-2">
        {{ $greeting }} {{ join(',', $modifier) }} {{ $name }} @if ($loud) ! @endif
    </div>

    <div class="mx-2">
        {{--    $set (기본? 컨트롤러에 정의되어 있지 않음) 메소드 사용 = type: "callMethod"
        wire:click="resetName('Bingo')" 과 동일하게 동작
        --}}
        <form action="#" wire:submit.prevent="$set('name', '$set Method Joro')">
            <button class="border-gray-900 bg-green-300 px-6 py-1">Reset Name</button>
        </form>

        {{--    submit 사용--}}
{{--            <form action="#" wire:submit.prevent="resetName('Controller resetName Haribo')">--}}
{{--                <button class="border-gray-900 bg-green-300 px-6 py-1">Reset Name</button>--}}
{{--            </form>--}}

        {{--    mouseenter (mouseover) 메소드 사용--}}
        {{--    <button wire:mouseenter="resetName('Bingo')" class="border-gray-900 bg-green-300 px-6 py-1">Reset Name</button>--}}
        {{--    $event 객체 접근--}}
        {{--    <button wire:click="resetName($event.target.innerText)" class="border-gray-900 bg-green-300 px-6 py-1">Reset Name</button>--}}
        {{--    파라미터 전달--}}
        {{--    <button wire:click="resetName('Bingo')" class="border-gray-900 bg-green-300 px-6 py-1">Reset Name</button>--}}
        {{--    <button wire:click="resetName" class="border-gray-900 bg-green-300 px-6 py-1">Reset Name</button>--}}
    </div>


    <div class="h-16 rounded-md bg-opacity-100 bg-purple-600 font-extrabold text-white flex justify-center items-center my-10">100%</div>





{{--
tailwind test
클래스 변경시 패키지 빌드 (Laravel Mix)
npm run dev 또는 npm run watch
npm run watch 명령은 반복 실행이기때문에 별도 cmd 창에서 실행시키는것을 추천
--}}
    <style>
        .chat-notification {
            display: flex;
            max-width: 24rem;
            margin: 0 auto;
            padding: 1.5rem;
            border-radius: 0.5rem;
            background-color: #fff;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .chat-notification-logo-wrapper {
            flex-shrink: 0;
        }
        .chat-notification-logo {
            height: 3rem;
            width: 3rem;
        }
        .chat-notification-content {
            margin-left: 1.5rem;
            padding-top: 0.25rem;
        }
        .chat-notification-title {
            color: #1a202c;
            font-size: 1.25rem;
            line-height: 1.25;
        }
        .chat-notification-message {
            color: #718096;
            font-size: 1rem;
            line-height: 1.5;
        }
    </style>
    <div class="chat-notification">
        <div class="chat-notification-logo-wrapper">
{{--            <img class="chat-notification-logo" src="/img/logo.svg" alt="ChitChat Logo">--}}
            <div class="flex-shrink-0">
                <svg class="h-12 w-12" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient x1="50%" y1="0%" x2="50%" y2="100%" id="a"><stop stop-color="#2397B3" offset="0%"></stop><stop stop-color="#13577E" offset="100%"></stop></linearGradient><linearGradient x1="50%" y1="0%" x2="50%" y2="100%" id="b"><stop stop-color="#73DFF2" offset="0%"></stop><stop stop-color="#47B1EB" offset="100%"></stop></linearGradient></defs><g fill="none" fill-rule="evenodd"><path d="M28.872 22.096c.084.622.128 1.258.128 1.904 0 7.732-6.268 14-14 14-2.176 0-4.236-.496-6.073-1.382l-6.022 2.007c-1.564.521-3.051-.966-2.53-2.53l2.007-6.022A13.944 13.944 0 0 1 1 24c0-7.331 5.635-13.346 12.81-13.95A9.967 9.967 0 0 0 13 14c0 5.523 4.477 10 10 10a9.955 9.955 0 0 0 5.872-1.904z" fill="url(#a)" transform="translate(1 1)"></path><path d="M35.618 20.073l2.007 6.022c.521 1.564-.966 3.051-2.53 2.53l-6.022-2.007A13.944 13.944 0 0 1 23 28c-7.732 0-14-6.268-14-14S15.268 0 23 0s14 6.268 14 14c0 2.176-.496 4.236-1.382 6.073z" fill="url(#b)" transform="translate(1 1)"></path><path d="M18 17a2 2 0 1 0 0-4 2 2 0 0 0 0 4zM24 17a2 2 0 1 0 0-4 2 2 0 0 0 0 4zM30 17a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" fill="#FFF"></path></g></svg>
            </div>
        </div>
        <div class="chat-notification-content">
            <h4 class="chat-notification-title">ChitChat</h4>
            <p class="chat-notification-message">You have a new message!</p>
        </div>
    </div>

</div>
