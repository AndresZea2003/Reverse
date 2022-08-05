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

            <div class="flex-col">
                <div class="flex justify-center">
                    <div class="bg-green-500 px-10 pt-3 pb-10 rounded-lg flex-col">
                        <div class="flex justify-center">
                            <span class="text-green-200 font-bold text-xl">Process</span>
                        </div>
                        <div>
                            <span>Genera un proceso introduciendo una tarjeta</span>

                            <div class="mt-5">
                                <form action="{{route('payment.store')}}" method="POST">
                                    @csrf
                                    <label for="" class="font-bold">Number: </label>
                                    <input type="number" name="cardNumber" id="cardNumber" required>
                                    <button type="submit" class="bg-gray-200 rounded-md p-1">Enviar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-5">
                    <div class="bg-blue-500 px-16 pt-3 pb-10 rounded-lg flex-col">
                        <div class="flex justify-center">
                            <span class="text-green-200 font-bold text-xl">Process Massive</span>
                        </div>
                        <div>
                            <div class="flex justify-center">
                                <span>Descarga todos los pagos sin reversar</span>
                            </div>
                            <div class="mt-5">
                                <form action="{{route('payment.update', 6)}}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="flex justify-center">
                                        <button type="submit" class="bg-gray-200 rounded-md p-1">Descargar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-5">
                    <div class="bg-red-500 px-10 pt-3 pb-10 rounded-lg flex-col">
                        <div class="flex justify-center">
                            <span class="text-green-200 font-bold text-xl">Reverso Masivo</span>
                        </div>
                        <div>
                            <span>Reversa varios pagos atravez de excel</span>
                            <div class="mt-5">
                                <form action="{{route('payment.store')}}" method="POST">
                                    @csrf
                                    <label for="" class="font-bold">Archivo: </label><br>
                                    <div class="flex justify-center">
                                    <input type="file" name="cardNumber" id="cardNumber" required><br>
                                        <button type="submit" class="bg-gray-200 rounded-md p-1">Enviar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <div>
                <div class="flex justify-center mb-5 text-xl">
                    <span>Registros actuales -</span>
                    <span class="font-bold">-{{$count}}--</span>
                </div>

                <table>
                    <thead>
                    <tr>
                        <th class="px-5">ID</th>
                        <th class="px-5">Internal Reference</th>
                        <th class="px-5">Status</th>
                        <th class="px-5">Reverse</th>
                        <th>Delete</th>
                        <th>Reverse</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($payments as $payment)
                        <tr>
                            <td class="px-5">{{$payment->id}}</td>
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
