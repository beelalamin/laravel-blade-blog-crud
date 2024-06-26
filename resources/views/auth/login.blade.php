<x-layout>

    <h1 class="max-w-screen-sm mx-auto mt-4 text-xl font-bold">Welcome Back</h1>

    <div class=" mx-auto shadow-md rounded max-w-screen-sm mt-8">
        @if (session('status'))
            <x-flashMsg message="{{ session('status') }}" />
        @endif
        <form action="/login" method="post" class="p-5">

            @csrf
            {{-- Email --}}

            <div class="mb-4 ">
                <label for="email" class="text-sm ">Email</label> <br>
                <input type="text" name="email" value="{{ old('email') }}"
                    class="w-full block outline-none border rounded-md py-1 px-1
                 @error('email')
                border-red-600
            @enderror " />
                @error('email')
                    <p class="text-red-600 text-xs">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}

            <div class="mb-4 ">
                <label for="password" class="text-sm ">Password</label> <br>
                <input type="password" name="password"
                    class="w-full block outline-none border rounded-md py-1 px-1
                 @error('password')
                    border-red-600
                @enderror
                " />
                @error('password')
                    <p class="text-red-600 text-xs">{{ $message }}</p>
                @enderror
            </div>

            {{-- Remember me --}}

            <div class="flex justify-between items-center">
                <div>

                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember_me" class="text-xs remember-me">Remember me</label>
                </div>
                <a href="{{ route('password.request') }}" class="text-xs text-blue-500">Forgot Password?</a>
            </div>


            @error('failed')
                <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
            @enderror

            <button
                class="mt-4 bg-gray-800 text-white px-4 py-1 rounded-md transition-all hover:bg-gray-700">login</button>


        </form>
    </div>
</x-layout>
