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
        <div class="bg-sky-600">
            <nav class="container px-5 py-5 flex grid grid-cols-2">
                <div>
                    <span class="text-white font-bold text-xl">PlaceToPay - </span>
                    <span class="text-stone-800 font-bold text-xl">Reverso masivo</span>
                </div>
            </nav>
        </div>
        <div class="flex justify-center grid grid-cols-12">

            <div class="col-span-3">
                <div class="bg-sky-600 border-t-2 border-white px-5 pt-2 pb-5 flex-col">
                    <div class="flex justify-center">
                        <span class="font-black text-2xl">-----------------</span>
                    </div>
                    <div class="flex justify-center">
                        <span class="text-gray-200 font-bold text-xl">Pagos</span>
                    </div>
                    <div class="flex justify-center">
                        <span class="font-black text-2xl">-----------------</span>
                    </div>
                    <div class="bg-sky-200 rounded-md p-2">
                        <div class="flex justify-center">
                            <span class="text-gray-800 font-bold">Con cantidad</span>
                        </div>
                        <form action="{{route('payment.store')}}" method="POST">
                            @csrf
                            <div class="flex justify-center">
                                <span>Genera la cantidad de pagos deseados</span>
                            </div>
                            <div class="flex justify-center my-3">
                                <input type="number" name="countPayment" placeholder="Ejemplo: 18" required>
                            </div>
                            <div class="flex justify-center my-3">
                                <button type="submit" class="bg-gray-100 hover:bg-gray-400 rounded-md p-1">
                                    Enviar
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="flex justify-center">
                        <span>--------------------------------</span>
                    </div>
                    <div class="bg-sky-200 rounded-md p-2">
                        <div class="flex justify-center">
                            <span class="text-gray-800 font-bold">Con Tarjeta</span>
                        </div>
                        <form action="{{route('payment.store')}}" method="POST">
                            @csrf
                            <div class="flex justify-center">
                                <span>Genera 1 pago con la tarjeta deseada</span>
                            </div>
                            <div class="flex justify-center my-3">
                                <input type="number" name="card" placeholder="Ejemplo: 36545400008"
                                       required>
                            </div>
                            <div class="flex justify-center my-3">
                                <button type="submit" class="bg-gray-100 hover:bg-gray-400 rounded-md p-1">
                                    Enviar
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="flex justify-center">
                        <span>--------------------------------</span>
                    </div>
                    <div class="bg-sky-200 rounded-md p-2">
                        <div class="flex justify-center">
                            <span class="text-gray-800 font-bold">Pago Excel</span>
                        </div>
                        <form action="{{route('payment.import')}}" enctype="multipart/form-data"
                              method="POST">
                            @csrf
                            <div class="flex justify-center">
                                <span>Genera multiples pagos transacciones atraves de un archivo excel</span>
                            </div>
                            <input class="mt-5" type="file" name="payments" required>
                            <div class="flex justify-center">
                                <button type="submit"
                                        class="bg-gray-100 hover:bg-gray-400 rounded-md p-1 mt-5">Enviar
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="flex justify-center">
                        <span class="font-black text-2xl">-----------------</span>
                    </div>
                    <div class="flex justify-center">
                        <span class="text-gray-200 font-bold text-xl">Reversos</span>
                    </div>
                    <div class="flex justify-center">
                        <span class="font-black text-2xl">-----------------</span>
                    </div>
                    <div class="bg-sky-200 rounded-md p-2">
                        <div class="flex justify-center">
                            <span class="text-gray-800 font-bold">Reverso Excel</span>
                        </div>
                        <form action="{{route('payment.reverse')}}" enctype="multipart/form-data"
                              method="POST">
                            @csrf
                            <div class="flex justify-center">
                                <span>Reversa multiples transacciones atraves de un archivo excel</span>
                            </div>
                            <input class="mt-5" type="file" name="payments" required>
                            <div class="flex justify-center">
                                <button type="submit"
                                        class="bg-gray-100 hover:bg-gray-400 rounded-md p-1 mt-5">Enviar
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="flex justify-center">
                        <span class="font-black text-2xl">-----------------</span>
                    </div>
                    <div class="flex justify-center">
                        <span class="text-gray-200 font-bold text-xl">Validaciones</span>
                    </div>
                    <div class="flex justify-center">
                        <span class="font-black text-2xl">-----------------</span>
                    </div>
                    <div class="bg-sky-200 rounded-md p-2">
                        <div class="flex justify-center">
                            <span class="text-gray-800 font-bold">Validacion Excel</span>
                        </div>
                        <form action="" enctype="multipart/form-data"
                              method="POST">
                            @csrf
                            <div class="flex justify-center">
                                <span>Valida un archivo excel para ser reversado en el metodo <span class="font-bold">Reverso Excel</span></span>
                            </div>
                            <input class="mt-5" type="file" name="payments" required>
                            <div class="flex justify-center">
                                <button type="submit"
                                        class="bg-gray-100 hover:bg-gray-400 rounded-md p-1 mt-5">Enviar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-span-9 flex justify-center">
                <div class="overflow-x-auto relative sm:rounded-lg">
                    <div class="mt-5">
                        <div class="flex grid grid-cols-2 py-2 rounded-t-lgc ">
                            <div class="mr-24">
                                <a href="{{route('payment.export')}}">
                                    <button
                                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20">
                                            <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/>
                                        </svg>
                                        <span>Download</span>
                                    </button>
                                </a>
                            </div>
                            <div class="flex self-center justify-end">
                                <span>Registros actuales -</span>
                                <span class="font-bold">-{{$count}}--</span>
                            </div>
                        </div>
                    </div>
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                ID
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Internal Reference
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Status
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Amount
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Currency
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Reverse
                            </th>
                            <th scope="col" colspan="2" class="py-3 px-6 text-center">
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($payments as $payment)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                    {{$payment->id}}
                                </th>
                                <th class="py-4 px-6 text-center">
                                    {{$payment->internal_reference}}
                                </th>
                                <td class="py-4 px-6 text-green-300">
                                    {{$payment->status}}
                                </td>
                                <td class="py-4 px-6 ">
                                    {{$payment->amount}}
                                </td>
                                <td class="py-4 px-6">
                                    {{$payment->currency}}
                                </td>
                                <td class="py-4 px-6">
                                    @if($payment->reverse == 'true')
                                        <span class="text-green-400">{{$payment->reverse}}</span>
                                    @elseif($payment->reverse == 'false')
                                        <span class="text-red-600">{{$payment->reverse}}</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <form action="{{route('payment.destroy', $payment->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <form action="{{route('payment.update', $payment->id) }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        @if($payment->reverse == 'false')
                                            <button type="submit"
                                                class="font-medium text-green-600 dark:text-green-500 hover:underline">
                                            Reverse
                                        </button>
                                        @endif
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

