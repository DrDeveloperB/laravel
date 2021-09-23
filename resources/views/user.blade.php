<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>User</title>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body>
<div class="main-div">
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="sub-div-1">
        <div class="sub-div-2">
            <div class="sub-div-3">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </div>
        </div>
    </div>

    <div class="sub-div-1">
        <a href="{{route('user.show', ['id' => 123])}}">test show</a>
        <br>
        <br>
    </div>

    <div class="sub-div-1">
        {{session()->get('_token')}}
    </div>
</div>
</body>
</html>
