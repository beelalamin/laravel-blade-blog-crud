<x-layout>
    <div class="w-full flex">
        <div>

            <h1 class="mt-4">Verify Email</h1>
            <p>Please check your email for verification.</p>
            <h3 class="mt-4 mb-1">Didn't recieved email?</h3>
            <form action="{{ route('verification.send') }}">
                <button class="px-4 py-1 text-sm bg-gray-800 text-white rounded-md hover:bg-gray-700">Resend</button>
            </form>
        </div>


    </div>

</x-layout>
