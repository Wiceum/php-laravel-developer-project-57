<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Менеджер задач</title>
</head>
<body>
<div id="app">
    <header class="fixed w-full">
        <nav class="bg-white border-gray-200 py-2.5 dark:bg-gray-900 shadow-md">
            <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
                <a href="#" class="flex items-center">
                    <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">
                        Менеджер задач
                    </span>
                </a>
                <div class="flex items-center lg:order-2">
                    <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"> Вход </a>
                    <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 ml-2 rounded"> Регистрация </a>
                </div>
                <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1">
                    <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0"></ul>
                </div>
            </div>
        </nav>
     </header>
</div>
</body>
</html>
