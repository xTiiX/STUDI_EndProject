<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-2">
                {{ __('Création Service') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-6">
            <div class="bg-white overflow-hidden shadow-sm rounded-sm sm:rounded-lg p-6 flex">
                <x-add-form-part name="de Service" button="Ajouter">
                    <x-slot name="route">
                        {{ route('services.store') }}
                    </x-slot>
                    <x-slot name="back">
                        {{ route('services.index') }}
                    </x-slot>
                    <x-slot name="content">
                        @csrf
                        <div class="flex">
                            <div class="flex flex-row space-x-1 mt-5">
                                <p>Nom du service<p class="text-red-500">*</p></p>
                                <p>:</p>
                                <div class="p-1"></div>
                                <input type="text" name="name" id="name" class="-mt-0.5 max-h-7 rounded-md" required>
                            </div>
                        </div>
                    </x-slot>
                </x-add-form-part>
            </div>
        </div>
    </div>
</x-app-layout>
