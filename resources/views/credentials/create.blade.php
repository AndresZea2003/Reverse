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
    <div class="min-h-full w-full bg-sky-100">
        <div class="bg-sky-600 shadow-2xl px-5 py-5 flex grid grid-cols-3">
            <div class="flex items-center">
                <span class="text-gray-300 font-bold text-xl">Place<span class="text-orange-400">To</span>Pay</span>
                <span class="font-bold mx-2 text-2xl"> - </span>
                <span class="text-stone-800 font-bold text-xl">Reverso masivo</span>
            </div>
            <div class="flex items-center border-stone-800 border-l-2">
                <div class="px-10">
                    <a href="{{route('payment.index')}}">
                        <button2 class="text-gray-900">Pagos</button2>
                    </a>
                </div>
                <div class="px-10">
                    <a href="{{route('credential.index')}}">
                        <button2 class="text-gray-900">Credenciales</button2>
                    </a>
                </div>
            </div>
            <div class="flex justify-end">
                <div>
                    <span class="text-gray-300 font-bold">Hola! {{ auth()->user()->name }}</span>
                    <div class="flex justify-end">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit">
                                <button2 class="text-gray-900">Cerrar Sesion</button2>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-col mx-60 mt-5">
            <div class="flex justify-center">
                <span class="font-bold">Agregar un nuevo sitio</span>
            </div>

            <div class="flex justify-center mt-5">
                <form action="{{route('credential.store')}}" method="POST" enctype="multipart/form-data" class="w-full max-w-lg bg-gray-400 p-10">
                    @csrf
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                   for="grid-first-name">
                                Secret Key
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                id="secret_key" name="secret_key" type="text" placeholder="Secret_Key" required>
                            <p class="text-red-500 text-xs italic">Please fill out this field.</p>
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                   for="grid-last-name">
                                Endpoint
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="url" name="url" type="text"  placeholder="https://test.placetopay.com/rest" required>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                   for="grid-password">
                                Login
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="login" name="login" type="text" placeholder="******************" required>
                            <p class="text-gray-600 text-xs italic">Escribe las credenciales que correspondan con el
                                sitio que deseas agregar</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                   for="grid-state">
                                Local
                            </label>
                            <div class="relative">
                                <select
                                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="local" name="local" required>
                                    <option>Colombia</option>
                                    <option>Ecuador</option>
                                    <option>Puerto Rico</option>
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path
                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0 flex items-center mt-6">
                            <button type="submit" class="bg-green-400 px-2 py-1 w-full rounded-md">Agregar</button>
                        </div>
                    </div>
                </form>

                <form action="{{route('credential.store')}}" method="post">
                    @csrf
                    <input id="ola" type="text">
                    <button type="submit">Enviar</button>
                </form>
            </div>

        </div>
    </div>
</div>
@vite('resources/js/app.js')
</body>
</html>
