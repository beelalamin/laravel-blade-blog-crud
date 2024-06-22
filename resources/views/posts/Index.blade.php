<x-layout>
    <div class="flex justify-between items-baseline ">
        <h1 class="font-bold text-2xl mb-4 leading-none	">Latest Posts</h1>
        <button class="mt-4 bg-gray-800 text-white px-4 py-1 rounded-md transition-all hover:bg-gray-700">
            <a href="{{ route('dashboard') }}">Add Post</a>
        </button>

    </div>
    <div class="grid grid-cols-3 gap-4">
        @foreach ($posts as $post)
            <x-postCard :post="$post" />
        @endforeach

    </div>
    <div class="w-full mt-4">{{ $posts->links() }}</div>
</x-layout>
