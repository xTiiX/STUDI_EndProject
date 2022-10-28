<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-2">
                {{ __('Création Salle') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-6">
            <div class="bg-white overflow-hidden shadow-sm rounded-sm sm:rounded-lg p-6 flex">
                <x-add-form-part name="de Partenaire" button="Ajouter">
                    <x-slot name="route">
                        {{ route('partners.structures.store') }}
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
                                    <input type="text" name="name" id="name" class="-mt-0.5 max-h-7 rounded-md" required>
                                </div>
                                <div class="flex flex-row space-x-1 mt-5">
                                    <p>Adresse et Complement d'adresse<p class="text-red-500">*</p></p>
                                    <p>:</p>
                                    <div class="p-1"></div>
                                    <input type="text" name="adress" id="adress" class="-mt-0.5 max-h-7 rounded-md" required>
                                </div>
                                <div class="flex flex-row space-x-1 mt-5">
                                    <p>Tél.<p class="text-red-500">*</p></p>
                                    <p>:</p>
                                    <div class="p-1"></div>
                                    <input type="text" name="phone" id="phone" class="-mt-0.5 max-h-7 rounded-md" required>
                                </div>
                                <div class="flex flex-row space-x-1 mt-5">
                                    <p>URL du Logo<p class="text-red-500">*</p></p>
                                    <p>:</p>
                                    <div class="p-1"></div>
                                    <input type="text" name="logo_url" id="logo_url" class="-mt-0.5 max-h-7 rounded-md" required>
                                </div>
                                <div class="flex flex-row space-x-2 mt-5">
                                    <p>Partenaire de la Salle<p class="text-red-500">*</p></p>
                                    <p>:</p>
                                    <div class="p-1"></div>
                                    <select name="partner_id" id="partner_id" class="-mt-3 rounded-md" required>
                                        @foreach ($partners as $partner)
                                        <option value="{{ $partner->id }}">{{ $partner->short_desc }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- Big Screen Services => A déplacer et ne pas laisser ici ! -> Modification des permissions de service directement dans le  --}}
                            {{-- <div class="grow ml-4 invisible sm:visible">
                                <p class="text-lg underline underline-offset-2">Services</p>
                                <div class="overflow-y-visible overflow-x-scroll max-h-96 min-w-full p-2 ml-4 mt-5">
                                    <x-toggle-button id="id example 1" label="This is a Service"></x-toggle-button>
                                    <x-toggle-button id="id example 2" label="This is a loooong service here"></x-toggle-button>
                                    <x-toggle-button id="id example 3" label="This is a  reeeeeeeeeeeeally loooong service here"></x-toggle-button>
                                    <x-toggle-button id="id example 4" label="Service 4"></x-toggle-button>
                                    <x-toggle-button id="id example 5" label="Service 5"></x-toggle-button>
                                    <x-toggle-button id="id example 6" label="Service 6"></x-toggle-button>
                                    <x-toggle-button id="id example 7" label="Service 7"></x-toggle-button>
                                    <x-toggle-button id="id example 7" label="Service 7"></x-toggle-button>
                                    <x-toggle-button id="id example 7" label="Service 7"></x-toggle-button>
                                    <x-toggle-button id="id example 7" label="Service 7"></x-toggle-button>
                                    <x-toggle-button id="id example 7" label="Service 7"></x-toggle-button>
                                    <x-toggle-button id="id example 7" label="Service 7"></x-toggle-button>
                                    <x-toggle-button id="id example 7" label="Service 7"></x-toggle-button>
                                    <x-toggle-button id="id example 7" label="Service 7"></x-toggle-button>
                                    <x-toggle-button id="id example 7" label="Service 7"></x-toggle-button>
                                    <x-toggle-button id="id example 7" label="Service 7"></x-toggle-button>
                                    <x-toggle-button id="id example 7" label="Service 7"></x-toggle-button>
                                </div>
                            </div> --}}
                        </div>
                    </x-slot>
                </x-add-form-part>
            </div>
        </div>
    </div>
</x-app-layout>
