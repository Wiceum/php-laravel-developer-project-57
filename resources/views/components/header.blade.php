<header class="fixed w-full">
    <nav class="bg-white border-gray-200 py-2.5 dark:bg-gray-900 shadow-md">
        <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
            <a href="/" class="flex items-center">
                    <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">
                        {{__('Task Manager')}}
                    </span>
            </a>
            <div class="flex items-center lg:order-2">
                @guest
                <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="{{ route('login') }}"> {{__('Log in')}} </a>
                <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 ml-2 rounded" href="{{ route('register') }}"> {{__('Registration')}} </a>
                @endguest
                @auth()
                    <form method="post" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Log out') }}
                        </button>
                    </form>
                @endauth
            </div>
            <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1">
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                    <li><a class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0" href="{{ route('tasks.index') }}"> {{__('Tasks')}} </a></li>
                    <li><a class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0" href="{{ route('task_statuses.index') }}"> {{__('Statuses')}} </a></li>
                    <li><a class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0" href="{{ route('labels.index') }}"> {{__('Labels')}} </a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
