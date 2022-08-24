<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body>
<div class="h-screen">
    <div class="h-full flex justify-center items-center bg-sky-100">
        <div class="bg-gray-300 p-5 rounded-md">
            <span class="font-bold text-xl">Esta es la vista Home</span>
            <div class="flex justify-center">
                <span class="font-bold">Estas logueado!</span>
            </div>
            <div class="flex justify-center">
                <a href="{{ route('payment.index') }}">
                    <button2 class="text-gray-900">Payments</button2>
                </a>
            </div>
            <div class="flex justify-center">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">
                        <button2 class="text-gray-900">Cerrar Sesion</button2>
                    </button>
                </form>
            </div>
        </div>
    </div>
    {{ auth()->user() }}

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <a href="{{route('payment.index')}}">Payments</a>
    <div id="app"></div>
</div>
@vite('resources/js/app.js')
</body>
</html>
