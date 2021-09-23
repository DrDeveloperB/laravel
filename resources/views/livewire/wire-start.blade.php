<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Livewire Screencasts</title>
    @livewireStyles
</head>

<body>
{{--
livewire 지시어를 통해 호출된 경우에만 호출된 view 의 컨트롤러에서 선언한 public 변수를 view 에서 사용 가능
기본적으로 라라벨에서는 컨트롤러에서 public 으로 선언한 변수도 view 호출시 파라미터 필드를 통해 전달해야됨
--}}
{{-- 클래스에 파라미터 전달 --}}
    @livewire('hello-world', ['name' => 'luffy'])

{{--Livewire\Exceptions\ComponentNotFoundException--}}
{{--Unable to find component: [HelloWorld]--}}
{{--    @livewire('HelloWorld', ['name' => 'luffy'])--}}

{{--    @livewire('lifecycle-hooks', ['name' => 'nico'])--}}

{{--    @livewire('livewire-test')--}}

    @livewireScripts
</body>
</html>
