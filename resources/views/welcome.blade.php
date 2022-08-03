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
        <div class="bg-red-200 h-full flex justify-center items-center">
            <div>
                <div class="flex justify-center">
                    <span class="text-2xl font-bold">Reverso masivo</span>
                </div>

                <div class="bg-stone-800 mt-5 rounded-md p-5 grid grid-cols-2 gap-5">
                    <button class="bg-gray-200 rounded-md p-2">Subir archivos</button>
                    <button class="bg-gray-200 rounded-md p-2">Subir archivos</button>
                </div>

                <form action="https://checkout-test.placetopay.com/api/session" method="POST">
                    <input type="text" id="login">
                    <button type="submit">Enviar</button>
                </form>
            </div>
            <div id="app"></div>
        </div>

    </div>

    @vite('resources/js/app.js')
</body>
</html>
