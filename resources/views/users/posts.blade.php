<x-layout>
    <div class="flex items-center ">
        <span class="text-2xl  mb-4 leading-none	"> More Posts By: <b>{{ $user->username }}</b></span>
    </div>
    <div class="grid grid-cols-3 gap-4">
        @foreach ($posts as $post)
            <x-postCard :post="$post" />
        @endforeach

    </div>
    <div class="w-full mt-4">{{ $posts->links() }}</div>
</x-layout>
