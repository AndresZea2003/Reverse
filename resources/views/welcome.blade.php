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
    <div class="min-h-full w-full">
        <div class="bg-blue-500">
            <nav class="container mx-auto px-28 py-5">
                <span class="text-white font-bold text-xl">PlaceToPay - </span>
                <span class="text-stone-800 font-bold text-xl">Reverso masivo</span>
            </nav>
        </div>
        <div class="flex justify-center mt-10 grid grid-cols-2">

            <div class="grid grid-cols-2 mx-10 gap-2">

                <div class="flex-col justify-center">
                    <div>
                        <div class="bg-gray-300 px-10 pt-3 pb-3 rounded-lg flex-col shadow-2xl">
                            <div class="flex justify-center">
                                <span class="font-bold text-xl">Pago masivo</span>
                            </div>
                            <div>
                                <span>Escribe el numero de cuantos pagos o transacciones desea realizar</span>

                                <div class="mt-5">
                                    <form action="{{route('payment.store')}}" method="POST">
                                        @csrf
                                        {{--                                    <label for="" class="font-bold">Number: </label>--}}
                                        <div class="flex justify-center">
                                            <input type="number" name="countPayment" placeholder="Ejemplo: 18" required>
                                        </div>
                                        <div class="flex justify-center mt-3">
                                            <button type="submit" class="bg-gray-100 hover:bg-gray-400 rounded-md p-1">
                                                Enviar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5">
                        <div class="bg-gray-300 px-4 pt-3 pb-3 rounded-lg flex-col shadow-2xl">
                            <div class="flex justify-center">
                                <span class="font-bold text-xl">Pago masivo</span>
                            </div>
                            <div>
                                <span>Realiza varios pagos atravez de un arhivo excel</span>

                                <div class="mt-5">
                                    <form action="{{route('payment.import')}}" enctype="multipart/form-data"
                                          method="POST">
                                        @csrf
                                        {{--                                    <label for="" class="font-bold">Number: </label>--}}
                                        <input type="file" name="payments" required>
                                        <div class="flex justify-center">
                                            <button type="submit"
                                                    class="bg-gray-100 hover:bg-gray-400 rounded-md p-1 mt-5">Enviar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="flex-col justify-center">
                    <div>
                        <div class="bg-gray-300 px-10 pt-3 pb-3 rounded-lg flex-col shadow-2xl">
                            <div class="flex justify-center">
                                <span class="font-bold text-xl">Pago con tarjeta</span>
                            </div>
                            <div>
                                <span>Escribe el numero de la tarjeta de prueba que deseas usar</span>

                                <div class="mt-5">
                                    <form action="{{route('payment.store')}}" method="POST">
                                        @csrf
                                        {{--                                    <label for="" class="font-bold">Number: </label>--}}
                                        <div class="flex justify-center">
                                            <input type="number" name="card" placeholder="Ejemplo: 36545400008"
                                                   required>
                                        </div>
                                        <div class="flex justify-center mt-3">
                                            <button type="submit" class="bg-gray-100 hover:bg-gray-400 rounded-md p-1">
                                                Enviar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5">
                        <div class="bg-gray-300 px-4 pt-3 pb-3 rounded-lg flex-col shadow-2xl">
                            <div class="flex justify-center">
                                <span class="font-bold text-xl">Reverso masivo</span>
                            </div>
                            <div>
                                <span>Reversa varios reversos atravez de un arhivo excel</span>

                                <div class="mt-5">
                                    <form action="{{route('payment.reverse')}}" enctype="multipart/form-data"
                                          method="POST">
                                        @csrf
                                        {{--                                    <label for="" class="font-bold">Number: </label>--}}
                                        <input type="file" name="payments" required>
                                        <div class="flex justify-center">
                                            <button type="submit"
                                                    class="bg-gray-100 hover:bg-gray-400 rounded-md p-1 mt-5">Enviar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div>
                <div class="flex justify-center text-xl">
                    <div class="flex bg-gray-400 px-28 py-2 rounded-t-lgc shadow-2xl">
                        <div class="mr-24 bg-gray-300">
                            <button class="bg-green-100 hover:bg-gray-300 py-1 px-3 rounded-md">Descargar</button>
                        </div>
                        <div>
                            <span>Registros actuales -</span>
                            <span class="font-bold">-{{$count}}--</span>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center">
                    <table class="bg-gray-100 shadow-2xl">
                        <thead>
                        <tr>
                            <th class="pl-8 pr-5">ID</th>
                            <th class="px-5">Internal Reference</th>
                            <th class="px-5">Status</th>
                            <th class="px-5">Reverse</th>
                            <th class="px-5">Delete</th>
                            <th class="pl-5 pr-8">Reverse</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td class="pl-6 pr-5">{{$payment->id}}</td>
                                <td class="px-5">{{$payment->internal_reference}}</td>
                                <td class="px-5">{{$payment->status}}</td>
                                <td class="px-5 font-bold">
                                    @if($payment->reverse == 'true')
                                        <span class="text-green-400">{{$payment->reverse}}</span>
                                    @elseif($payment->reverse == 'false')
                                        <span class="text-red-600">{{$payment->reverse}}</span>
                                    @endif

                                </td>
                                <td class="px-5">
                                    <form action="{{route('payment.destroy', $payment->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 rounded-md px-2 py-1">X</button>
                                    </form>
                                </td>
                                <td class="px-5">
                                    <form action="{{route('payment.update', $payment->id)}}" method="POST">
                                        @method('PATCH')
                                        @csrf
                                        <div class="flex justify-center">
                                            <button type="submit" class="bg-green-300 rounded-md px-2 py-1">R</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div id="app"></div>

        <div class="flex justify-center items-center mt-16">
            <div class="grid grid-cols-3 gap-5">


            </div>
        </div>
    </div>
</div>
@vite('resources/js/app.js')
</body>
</html>
