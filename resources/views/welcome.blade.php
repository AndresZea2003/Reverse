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

    <div class="h-full flex justify-center items-center">
        <div class="flex-col bg-gray-300 p-5 rounded-md">
            <div>Esta es la vista Welcome</div>
            <div class="font-paytone text-center">
                <a href="{{route('login')}}">Login</a>
            </div>
            <div class="font-paytone text-center">
                <a href="{{route('register')}}">Register</a>
            </div>
        </div>
    </div>

</div>
@vite('resources/js/app.js')
</body>
</html>
