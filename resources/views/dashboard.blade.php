<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Utilisateurs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-6">
            <div class="flex items-center">
                <div class="grow"></div>
                <div class="p-6 bg-white border-b border-gray-200 shadow-sm overflow-hidden text-center sm:rounded-lg">
                    X Utilisateurs
                </div>
                <div class="grow"></div>
                <div class="p-6 bg-white border-b border-gray-200 shadow-sm overflow-hidden text-center sm:rounded-lg">
                    X Partenaires
                </div>
                <div class="grow"></div>
                <div class="p-6 bg-white border-b border-gray-200 shadow-sm overflow-hidden text-center sm:rounded-lg">
                    X Salles
                </div>
                <div class="grow"></div>
            </div>
            <div class="p-4"></div>
            @foreach ($partners as $partner)
                <x-partner-board-part :partner="$partner" />
            @endforeach
        </div>
    </div>
</x-app-layout>
