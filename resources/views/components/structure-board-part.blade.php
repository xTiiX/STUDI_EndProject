@props(['structure'])

@if (!$structure->trashed())
<div class="bg-white overflow-hidden shadow-sm rounded-sm sm:rounded-lg mt-3">
@else
<div class="bg-red-400 overflow-hidden shadow-sm rounded-sm sm:rounded-lg mt-3">
@endif
    <div class="p-6">
        <div class="flex">
            <div class="mr-4 mt-2 h-10 w-10">
                <a href="{{ route('partners.structures.index_structure', $structure->id) }}">
                    <img src="{{ $structure->logo_url }}" alt="" class=" bg-gray-500 sm:shadow-sm rounded-full p-1 object-scale-down">
                </a>
            </div>
            <div class="flex grow">
                <div>
                    <p class="text-lg underline">{{ $structure->name }}</p><p class="text-xs">Relier à : {{ $structure->linkPartner()->first()->short_desc }}</p>
                </div>
                <div class="grow"></div>
                @if (auth()->user()->access_level === 0) {{-- Admin --}}
                    @if ($structure->trashed())
                    <div class="bg-gray-800 rounded-sm sm:rounded-lg p-1 ml-2 text-center mt-2">
                        <form action="{{ route('partners.structures.restore', $structure->id) }}" method="post">
                            @csrf
                            <button type="submit" class="text-white sm:shadow-sm">{{-- IMG Activation --}} Acti</button>
                        </form>
                    </div>
                    @else
                    <div class="bg-gray-800 rounded-sm sm:rounded-lg p-1 text-center mt-2">
                        <a href="{{ route('partners.structures.show', $structure->id) }}" class="text-white sm:shadow-sm">
                            {{-- IMG Edition --}} Edit
                        </a>
                    </div>
                    <div class="bg-gray-800 rounded-sm sm:rounded-lg p-1 ml-2 text-center mt-2">
                        <form action="{{ route('partners.structures.delete', $structure->id) }}" method="post">
                            @csrf
                            <button type="submit" class="text-white sm:shadow-sm">{{-- IMG Désactiver --}} Désa</button>
                        </form>
                    </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
