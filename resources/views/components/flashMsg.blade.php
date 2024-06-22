@props(['message', 'bg' => 'bg-green-500'])
<div>
    <p class="p-2 rounded-md text-white text-sm {{ $bg }}">{{ $message }}</p>
</div>
