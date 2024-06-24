<x-layout>
    <div class="max-w-screen-sm mx-auto mt-4">


        <h1 class=" text-xl font-bold mb-2">Edit Post</h1>
        <a href="{{ route('dashboard') }}" class="mt-2 text-blue-500"> &larr; Go to dashboard</a>
        <div class=" mx-auto shadow-md rounded max-w-screen-sm mt-8">

            <form action="{{ route('posts.update', $post) }}" method="post" class="p-5" enctype="multipart/form-data"
                x-data="formSubmit" @submit.prevent="submit">
                @csrf
                @method('PUT')

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
                    <input type="text" name="title" value="{{ $post->title }}"
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
                    <textarea rows="10"
                        name="body" "
                                                                                                                                                                                                                                class="w-full block outline-none border rounded-md py-1 px-1

                 @error('body')
                border-red-600
            @enderror ">{{ $post->body }} </textarea>

                    @error('body')
                        <p class="text-red-600 text-xs">{{ $message }}</p>
                    @enderror
                </div>


                @if ($post->image)
                    <div class=" mt-2 mb-2">
                        <label for="">Current Cover Image</label>
                        <img src="{{ asset('storage/' . $post->image) }}" alt="" class="rounded-lg">
                    </div>
                @endif

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

                <button x-ref="btn"
                    class="w-1/6 mt-4 bg-gray-800 text-white px-4 py-1 rounded-md transition-all hover:bg-gray-700">Update
                </button>
            </form>


        </div>
    </div>
</x-layout>
