<x-layout>

    <div class="max-w-screen-sm mx-auto mt-4">

        <h1 class=" text-xl font-bold">Add New Post</h1>
        <div class=" mx-auto shadow-md rounded max-w-screen-sm mt-8">

            <form action="{{ route('posts.store') }}" method="post" class="p-5" enctype="multipart/form-data">
                @csrf

                <div class="mb-2">
                    @if (session('message'))
                        <x-flashMsg message="{{ session('message') }}" />
                    @elseif (session('deleted'))
                        <x-flashMsg message="{{ session('deleted') }}" bg="bg-red-500" />
                    @endif
                </div>

                {{-- Post Title --}}
                <div class="mb-4 ">
                    <label for="title" class="text-sm ">Title</label> <br>
                    <input type="text" name="title"
                        class="w-full block outline-none border rounded-md py-1 px-1
                @error('title')
                    border-red-600
                @enderror
                " />

                    @error('title')
                        <p class="text-red-600 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Post Body --}}

                <div class="mb-4 ">
                    <label for="body" class="text-sm ">Body</label> <br>
                    <textarea rows="5" name="body"
                        class="w-full block outline-none border rounded-md py-1 px-1

                 @error('body')
                border-red-600
            @enderror "> </textarea>

                    @error('body')
                        <p class="text-red-600 text-xs">{{ $message }}</p>
                    @enderror
                </div>


                {{-- Post Cover Image --}}

                <div class="mb-4 ">
                    <label for="image" class="text-sm ">Cover Image</label> <br>
                    <input type="file" name="image" id="image"
                        class="w-full block outline-none text-sm border rounded-md py-1 px-1
                        @error('image')
                        border-red-600
                        @enderror " />

                    @error('image')
                        <p class="text-red-600 text-xs">{{ $message }}</p>
                    @enderror
                </div>


                <button
                    class="mt-4 bg-gray-800 text-white px-4 py-1 rounded-md transition-all hover:bg-gray-700">Create</button>
            </form>


        </div>


        <div class="flex justify-between items-baseline mt-8 mb-4">
            <h1 class="font-bold text-2xl mb-4 leading-none	">My Posts</h1>


        </div>
        <div class="grid grid-cols-1 gap-4">
            @foreach ($posts as $post)
                <x-postCard :post="$post">

                    <div class="flex justify-end">

                        <a href="{{ route('posts.edit', $post) }}"
                            class="text-white bg-green-600 px-2 py-1 text-sm rounded-md mr-2">Update</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="post">
                            @csrf
                            @method('DELETE')


                            <button class="text-white bg-red-500 px-2 py-1 text-sm rounded-md">Delete</button>
                        </form>
                    </div>
                </x-postCard>
            @endforeach

            <div class="mb-4">{{ $posts->links() }}</div>
        </div>
    </div>

</x-layout>
