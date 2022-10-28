@props(['name', 'button'])

<div>
    <p class="text-lg underline underline-offset-2">Modification {{ $name }}</p>
    <form action="{{ $route }}" method="post" class="mt-5 ml-4">
        {{ $content }}
        <button type="submit" class="text-white bg-gray-800 p-2 rounded-sm sm:rounded-lg mt-5 -ml-4">{{ $button }}</button>
        <a href="{{ $back }}" class="text-white bg-gray-800 p-2 rounded-sm sm:rounded-lg mt-5">Annuler</a>
    </form>
</div>
