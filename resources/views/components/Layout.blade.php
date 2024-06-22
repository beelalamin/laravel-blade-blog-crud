<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css'])
</head>

<body>
    <nav class="bg-gray-800 text-gray-200 w-full">
        <div class="max-w-screen-2xl mx-auto flex justify-between py-4 align-baseline">

            <div class="uppercase font-bold">
                <a href="{{ route('posts.index') }}">LARAVEL</a>
            </div>

            @auth
                <div x-data="{ open: false }">
                    <div class="flex gap-5 ">

                        <p class="capitalize mt-1"> {{ auth()->user()->username }}</p>
                        <div class="flex align-middle gap-2 cursor-pointer text-sm " @click="open = !open">

                            <img src="https://picsum.photos/200/300" alt=""
                                class="w-8 h-8 rounded-full ring-gray-300 ring-offset-1 ring-1 cursor-pointer block">

                            <svg class="w-4 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </div>
                    </div>

                    <div x-show="open" @click.outside="open = false"
                        class="absolute bg-gray-700  rounded-md top-16 right-28 text-sm">
                        <a class=" px-5 py-2 hover:bg-gray-600" href="{{ route('dashboard') }}">Dashboard</a>



                        <form action="{{ route('logout') }}" method='post'>

                            @csrf
                            <button class="
                            px-5 py-2 hover:bg-gray-600 ">Logout</button>

                        </form>
                    </div>

                </div>
            @endauth

            @guest
                <div>

                    <a href='{{ route('login') }}'
                        class="uppercase font-semibold text-sm transition-all hover:bg-gray-700 px-3 py-2 rounded">Login</a>
                    <a href='{{ route('register') }}'
                        class="uppercase font-semibold text-sm transition-all hover:bg-gray-700 px-3 py-2 rounded">Register</a>
                </div>
            @endguest
        </div>
    </nav>
    <main class="max-w-screen-2xl mx-auto mt-8">
        {{ $slot }}
    </main>
</body>

</html>
