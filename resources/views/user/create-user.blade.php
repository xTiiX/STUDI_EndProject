<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-2">
                {{ __('Création Utilisateur') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-6">
            <div class="bg-white overflow-hidden shadow-sm rounded-sm sm:rounded-lg p-6 flex">
                <x-add-form-part name="de Utilisateur" button="Ajouter">
                    <x-slot name="route">
                        {{ route('users.store') }}
                    </x-slot>
                    <x-slot name="back">
                        {{ route('users.index') }}
                    </x-slot>
                    <x-slot name="content">
                        @csrf
                        <div>
                            <div class="flex flex- space-x-1">
                                <p>Prénom<p class="text-red-500">*</p></p>
                                <p>:</p>
                                <div class="p-1"></div>
                                <input type="text" name="first_name" id="first_name" class="-mt-0.5 max-h-7 rounded-md" required>
                            </div>
                            <div class="flex flex-row space-x-1 mt-5">
                                <p>Nom<p class="text-red-500">*</p></p>
                                <p>:</p>
                                <div class="p-1"></div>
                                <input type="text" name="last_name" id="last_name" class="-mt-0.5 max-h-7 rounded-md" required>
                            </div>
                            <div class="flex flex-row space-x-1 mt-5">
                                <p>Email<p class="text-red-500">*</p></p>
                                <p>:</p>
                                <div class="p-1"></div>
                                <input type="email" name="email" id="email" class="-mt-0.5 max-h-7 rounded-md" required>
                            </div>
                            <div class="flex flex-row space-x-2 mt-5">
                                <p>Niveau d'accès <p class="text-red-500">* </p></p>
                                <p>:</p>
                                <div class="p-1"></div>
                                <select name="access_level" id="access_level" class="-mt-3 rounded-md" onchange="structureDiv(this)" required>
                                    <option value="0">Administrateur</option>
                                    <option value="2">Salle</option>
                                </select>
                            </div>
                            <div class="flex flex-row space-x-2 mt-5">
                                <p>Lien avec la salle</p>
                                <p>:</p>
                                <div class="p-1"></div>
                                <select name="structure_id" id="structure_id" class="-mt-3 rounded-md" disabled required>
                                    <option value="0">- - -</option>
                                    @foreach ($structures as $structure)
                                    <option value="{{ $structure->id }}">{{ $structure->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <script>
                            function structureDiv(selection) {
                                if (selection.value == 2) {
                                    document.getElementById("structure_id").disabled = false;
                                } else {
                                    document.getElementById("structure_id").disabled = true;
                                    document.getElementById("structure_id").value = 0;
                                }
                            };
                        </script>
                    </x-slot>
                </x-add-form-part>
            </div>
        </div>
    </div>
</x-app-layout>
