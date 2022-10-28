<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-2">
                {{ __('Édition Salle') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-6">
            <div class="bg-white overflow-hidden shadow-sm rounded-sm sm:rounded-lg p-6 flex">
                <x-mod-form-part name="de Salle" button="Éditer">
                    <x-slot name="route">
                        {{ route('partners.structures.edit') }}
                    </x-slot>
                    <x-slot name="back">
                        {{ route('partners.structures.index') }}
                    </x-slot>
                    <x-slot name="content">
                        @csrf
                        <div class="flex">
                            <div>
                                <div class="flex flex-row space-x-1 mt-5">
                                    <p>Nom de la Salle<p class="text-red-500">*</p></p>
                                    <p>:</p>
                                    <div class="p-1"></div>
                                    <input type="text" name="name" id="name" class="-mt-0.5 max-h-7 rounded-md" value="{{ $structure->name }}" required>
                                </div>
                                <div class="flex flex-row space-x-1 mt-5">
                                    <p>Adresse et Complement d'adresse<p class="text-red-500">*</p></p>
                                    <p>:</p>
                                    <div class="p-1"></div>
                                    <input type="text" name="adress" id="adress" class="-mt-0.5 max-h-7 rounded-md" value="{{ $structure->adress }}" required>
                                </div>
                                <div class="flex flex-row space-x-1 mt-5">
                                    <p>Tél.<p class="text-red-500">*</p></p>
                                    <p>:</p>
                                    <div class="p-1"></div>
                                    <input type="text" name="phone" id="phone" class="-mt-0.5 max-h-7 rounded-md" value="{{ $structure->phone }}" required>
                                </div>
                                <div class="flex flex-row space-x-1 mt-5">
                                    <p>URL du Logo<p class="text-red-500">*</p></p>
                                    <p>:</p>
                                    <div class="p-1"></div>
                                    <input type="text" name="logo_url" id="logo_url" class="-mt-0.5 max-h-7 rounded-md" value="{{ $structure->logo_url }}" required>
                                </div>
                                <div class="flex flex-row space-x-2 mt-5">
                                    <p>Partenaire de la Salle<p class="text-red-500">*</p></p>
                                    <p>:</p>
                                    <div class="p-1"></div>
                                    <select name="partner_id" id="partner_id" class="-mt-3 rounded-md" value="{{ $structure->partner_id }}" required>
                                        @foreach ($partners as $partner)
                                        <option value="{{ $partner->id }}">{{ $partner->short_desc }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="id" value="{{ $structure->id }}">
                            </div>
                        </div>
                    </x-slot>
                </x-mod-form-part>
            </div>
        </div>
    </div>
</x-app-layout>
