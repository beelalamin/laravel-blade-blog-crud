<h1>Welcome {{ $user->username }}</h1>

<p>Your post {{ $post->title }} is Live now</p>
<p>{{ $post->body }}</p>

<img width="300" src="{{ $message->embed('storage/' . $post->image) }}" alt="">
