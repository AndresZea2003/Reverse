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
            <div class="flex grid grid-cols-2">
                <div>
                    <a href="{{route('credential.create')}}">
                        <button class="bg-gray-400 px-3 py-2 rounded-md font-bold hover:bg-gray-500">Agregar nueva
                            credencial
                        </button>
                    </a>
                </div>
                <div class="flex justify-end items-center font-bold px-5">
                    Actualmente tienes {{$count}} sitios guardados
                </div>
            </div>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-5">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-2 text-center">
                        ID
                    </th>
                    <th scope="col" class="py-3 px-2">
                        Login
                    </th>
                    <th scope="col" class="py-3 px-2">
                        SecretKey
                    </th>
                    <th scope="col" class="py-3 px-2">
                        EndPoint
                    </th>
                    <th scope="col" class="py-3 px-2">
                        Local
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($credentials as $credential)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="py-4 px-2 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                            {{$credential->id}}
                        </th>
                        <th class="py-4 px-2">
                            {{$credential->login}}
                        </th>
                        <td class="py-4 px-2 ">
                            {{$credential->secret_key}}
                        </td>
                        <td class="py-4 px-2">
                            {{$credential->url}}
                        </td>
                        <td class="py-4 px-2">
                            {{$credential->local}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@vite('resources/js/app.js')
</body>
</html>
