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
    <div class="bg-sky-100 h-full flex flex-col justify-center items-center">
        <div class="font-paytone">
            <span class="text-gray-500 text-5xl">Place<span class="text-orange-400">To</span>Pay</span><br>
        </div>
        <div class="font-paytone text-2xl">
            <span>Reverso masivo</span>
        </div>
        {{--        <div class="loader">--}}
        {{--            <span>PlaceToPay</span>--}}
        {{--            <span>PlaceToPay</span>--}}
        {{--        </div>--}}
        <form action="{{ route('register') }}" method="POST"
              class="mt-10 bg-gray-200 shadow-2xl rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="flex justify-center font-paytone text-2xl">
                <span>Register</span>
            </div>
            <div class="input-group my-5">
                <input required="" autocomplete="off" class="input" name="name" id="name"
                       value="{{ old('name') }}" type="text">
                <label class="user-label">Name</label>
            </div>

            <div class="input-group my-5">
                <input required="" autocomplete="off" class="input" name="email" id="email"
                       value="{{ old('email') }}" type="text">
                <label class="user-label">Email</label>
            </div>

            <div class="input-group my-5">
                <input required="" autocomplete="off" class="input" name="password" id="password"
                       type="password">
                <label class="user-label">Password</label>
            </div>

            <div class="input-group my-5">
                <input required="" autocomplete="off" class="input" name="password_confirmation"
                       id="password_confirmation"
                       type="password">
                <label class="user-label">Password Confirmation</label>
            </div>
            <div class="flex justify-center">
                <div>
                    <button type="submit">
                        <button type="submit">
                            <button1>
                                <span>Continue</span>
                                <svg width="34" height="34" viewBox="0 0 74 74" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="37" cy="37" r="35.5" stroke="black" stroke-width="3"></circle>
                                    <path
                                        d="M25 35.5C24.1716 35.5 23.5 36.1716 23.5 37C23.5 37.8284 24.1716 38.5 25 38.5V35.5ZM49.0607 38.0607C49.6464 37.4749 49.6464 36.5251 49.0607 35.9393L39.5147 26.3934C38.9289 25.8076 37.9792 25.8076 37.3934 26.3934C36.8076 26.9792 36.8076 27.9289 37.3934 28.5147L45.8787 37L37.3934 45.4853C36.8076 46.0711 36.8076 47.0208 37.3934 47.6066C37.9792 48.1924 38.9289 48.1924 39.5147 47.6066L49.0607 38.0607ZM25 38.5L48 38.5V35.5L25 35.5V38.5Z"
                                        fill="black"></path>
                                </svg>
                            </button1>
                        </button>
                    </button>
                    <div class="pt-5 flex justify-center">
                        <a class="inline-block align-baseline text-gray-400 font-bold text-sm hover:text-black"
                           href="/">
                            Back to welcome
                        </a>
                    </div>
                </div>
            </div>
        </form>
        <p class="text-center text-xs">
            &copy; Evertec - PlaceToPay
        </p>
        @error('email')
        <div class="bg-red-300 rounded-md px-2 font-bold text-red-600 text-center my-4">
            {{ $message }}
        </div>
        @enderror
        @error('password')
        <div class="bg-red-300 rounded-md px-2 font-bold text-red-600 text-center my-4">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
@vite('resources/js/app.js')
</body>
</html>


<form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="{{ route('register') }}" method="POST">
    @csrf
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
            Username
        </label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="username" type="text" name="name" value="{{ old('name') }}" placeholder="name...">
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">
            Email
        </label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            type="email" name="email" value="{{ old('email') }}" placeholder="Email...">
        @error('email')
        <div>{{ $message }}</div> @enderror
    </div>
    <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
            Password
        </label>
        <input
            class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
            id="password" name="password" type="password" placeholder="******************">
        <p class="text-red-500 text-xs italic">Please choose a password.</p>
        @error('password')
        <div>{{ $message }}</div> @enderror
    </div>
    <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
            Password Confirmation
        </label>
        <input
            class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
            id="password" name="password_confirmation" type="password" placeholder="******************">
    </div>
    <div class="flex items-center justify-between">
        <button
            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            type="submit" value="register">
            Register
        </button>
        <a class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-gray-800 pl-5"
           href="{{route('login')}}">
            do you already have an account?
        </a>
    </div>
</form>
