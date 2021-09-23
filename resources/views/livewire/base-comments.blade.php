<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    {{--    livewire 태그 : laravel 7 부터 지원--}}
    <livewire:styles>
    {{--    @livewireStyles--}}

    <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        </head>

<body>

{{--<xmp>--}}
{{--    {{ $comments = 'aaaaq' }}--}}
{{--    {{ print_r($comments) }}--}}
{{--</xmp>--}}

{{--<livewire:comments :initialComments="$comments">--}}
<livewire:comments>
{{--    @livewire('comments')--}}

<livewire:scripts>
{{--    @livewireScripts--}}
</body>
</html>
