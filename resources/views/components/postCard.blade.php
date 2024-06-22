@props(['post', 'full' => false])
<div class=" px-8 py-4 rounded-lg shadow-lg">

    @if ($post->image)
        <div>
            <img src="{{ asset('storage/' . $post->image) }}" alt="" class="w-full h-60">
        </div>
    @else
        <div>
            <img src="{{ asset('storage/post_images/default.jpg') }}" alt="" class="w-full">
        </div>
    @endif

    <span class="font-bold text-md">{{ $post->title }}</span>
    <div class="flex justify-start items-center mb-4">

        <p class="text-sm mb-1">Posted {{ $post->created_at->diffForHumans() }}

        </p> &nbsp;
        <p class="text-sm mb-1">
            by
            <a href="{{ route('users.posts', $post->user) }}"
                class="text-blue-500 capitalize">{{ $post->user->username }}</a>
        </p>
    </div>
    @if ($full)
        <p>{{ $post->body }}</p>
    @else
        <p>{{ Str::words($post->body, 10, '...') }}</p>
        <span><a href="{{ route('posts.show', $post) }}" class="text-blue-500 text-sm">Read More &rarr; </a></span>
    @endif

    {{ $slot }}
</div>
