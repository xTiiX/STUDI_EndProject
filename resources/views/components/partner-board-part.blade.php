@props(['partner'])

@php
$attributes = (!$partner->trashed()) ?
    "bg-white overflow-hidden shadow-sm rounded-sm sm:rounded-lg mt-3"
    : "bg-red-400 overflow-hidden shadow-sm rounded-sm sm:rounded-lg mt-3" ;
@endphp

<div class="{{ ($attributes) }}">
    <div class="p-6">
        <div class="flex">
            <div class="mr-4 mt-3">
                <a href="">
                    <img src="{{ $partner->logo_url }}" alt="" class="bg-gray-500 sm:shadow-sm rounded-full p-3">
                </a>
            </div>
            <div class="flex grow">
                <div>
                    <p class="text-lg underline">{{ $partner->short_desc }}</p><p class="text-xs">Relier à : {{ $partner->linkUser()->first()->first_name }} {{ $partner->linkUser()->first()->last_name }}</p>
                </div>
                <div class="grow"></div>
                @if (auth()->user()->access_level === 0) {{-- Admin --}}
                    @if ($partner->trashed())
                    <div class="bg-gray-800 rounded-sm sm:rounded-lg p-1 ml-2 text-center mt-2">
                        <form action="{{ route('partners.restore', $partner->id) }}" method="post">
                            @csrf
                            <button type="submit" class="text-white sm:shadow-sm">{{-- IMG Activation --}} Acti</button>
                        </form>
                    </div>
                    @else
                    <div class="bg-gray-800 rounded-sm sm:rounded-lg p-1 text-center mt-2">
                        <a href="{{ route('partners.show', $partner->id) }}" class="text-white sm:shadow-sm">
                            {{-- IMG Edition --}} Edit
                        </a>
                    </div>
                    <div class="bg-gray-800 rounded-sm sm:rounded-lg p-1 ml-2 text-center mt-2">
                        <form action="{{ route('partners.delete', $partner->id) }}" method="post">
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
