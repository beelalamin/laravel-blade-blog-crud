<x-layout>


    <div class=" mx-auto shadow-md rounded max-w-screen-sm mt-8 p-5">
        <div>
            @if (session('message'))
                <x-flashMsg message="{{ session('message') }}" />
            @elseif (session('failed'))
                <x-flashMsg message="{{ session('deleted') }}" bg="bg-red-500" />
            @endif
            <h1 class="max-w-screen-sm mx-auto mt-4 text-xl font-bold">Verify Your Email</h1>
            <p>Please check your email for verification.</p>
            <h3 class="mt-4 mb-1">Didn't recieved email?</h3>
            <form action="{{ route('verification.send') }}" method="POST">
                @csrf
                <button class="px-4 py-1 text-sm bg-gray-800 text-white rounded-md hover:bg-gray-700">Resend</button>
            </form>
        </div>


    </div>

</x-layout>
