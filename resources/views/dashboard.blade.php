<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-2">
                {{ __('Partenaires') }}
            </h2>
            <div class="grow"></div>
            <div class="text-gray-100 bg-gray-800 p-2 rounded-lg">
                <a href="{{ route('partners.create') }}">Ajouter un Partenaire</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-6">
            <div class="flex items-center">
                <div class="grow"></div>
                <div class="p-6 bg-white border-b border-gray-200 shadow-sm overflow-hidden text-center sm:rounded-lg">
                    {{ count($users) }} Utilisateur(s)
                </div>
                <div class="grow"></div>
                <div class="p-6 bg-white border-b border-gray-200 shadow-sm overflow-hidden text-center sm:rounded-lg">
                    {{ count($partners) }} Partenaire(s)
                </div>
                <div class="grow"></div>
                <div class="p-6 bg-white border-b border-gray-200 shadow-sm overflow-hidden text-center sm:rounded-lg">
                    X Salle(s)
                </div>
                <div class="grow"></div>
            </div>
            <div class="p-4"></div>
            @foreach ($partners as $partner)
                <x-partner-board-part :partner="$partner"/>
            @endforeach
        </div>
    </div>
</x-app-layout>
