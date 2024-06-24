@props(['message', 'bg' => 'bg-green-500'])
<div>
    <p class="p-2 rounded-md mt-1 mb-1 text-white text-sm {{ $bg }}">{{ $message }}</p>
</div>
