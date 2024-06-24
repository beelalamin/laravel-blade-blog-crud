<x-layout>

    <h1 class="max-w-screen-sm mx-auto mt-4 text-xl font-bold">Reset Your Password</h1>
    <div class=" mx-auto shadow-md rounded max-w-screen-sm mt-8">
        @if (session('status'))
            <x-flashMsg message="{{ session('status') }}" />
        @endif


        <form action='{{ route('password.request') }}' method="post" class="p-5">

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

            <button
                class="mt- bg-gray-800 text-white px-4 py-1 rounded-md transition-all hover:bg-gray-700 text-sm">Send
                Verification Link</button>


        </form>
    </div>
</x-layout>
