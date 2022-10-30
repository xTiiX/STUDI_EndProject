<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-2">
                {{ __('Édition Utilisateur') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-6">
            <div class="bg-white overflow-hidden shadow-sm rounded-sm sm:rounded-lg p-6 flex">
                <x-mod-form-part name="d'Utilisateur" button="Éditer">
                    <x-slot name="route">
                        {{ route('users.edit') }}
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
                                <input type="text" name="first_name" id="first_name" class="-mt-0.5 max-h-7 rounded-md" value="{{ $user->first_name }}" required>
                            </div>
                            <div class="flex flex-row space-x-1 mt-5">
                                <p>Nom<p class="text-red-500">*</p></p>
                                <p>:</p>
                                <div class="p-1"></div>
                                <input type="text" name="last_name" id="last_name" class="-mt-0.5 max-h-7 rounded-md" value="{{ $user->last_name }}" required>
                            </div>
                            <div class="flex flex-row space-x-1 mt-5">
                                <p>Email<p class="text-red-500">*</p></p>
                                <p>:</p>
                                <div class="p-1"></div>
                                <input type="email" name="email" id="email" class="-mt-0.5 max-h-7 rounded-md" value="{{ $user->email }}" required>
                            </div>
                            <div id="access_changment" hidden="false">
                                <div class="flex flex-row space-x-2 mt-5">
                                    <p>Niveau d'accès <p class="text-red-500">* </p></p>
                                    <p>:</p>
                                    <div class="p-1"></div>
                                    <select name="access_level" id="access_level" class="-mt-3 rounded-md" value="{{ $user->access_level }}" required>
                                        <option value="0">Administrateur</option>
                                        <option value="2">Salle</option>
                                    </select>
                                </div>
                                <div class="flex flex-row space-x-2 mt-5">
                                    <p>Lien avec la salle</p>
                                    <p>:</p>
                                    <div class="p-1"></div>
                                    <select name="structure_id" id="structure_id" class="-mt-3 rounded-md" value="{{ $user->structure_id }}" disabled required>
                                        <option value="0">- - -</option>
                                        @foreach ($structures as $structure)
                                        <option value="{{ $structure->id }}">{{ $structure->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{ $user->id }}">
                        </div>
                        <script type="text/javascript">
                            if ( {{$user->access_level}} !== 1) {
                                document.getElementById("access_changment").hidden = false;
                                document.getElementById("access_level").value = {{$user->access_level}};
                                document.getElementById("structure_id").value = {{$structure_id}};
                            } else {
                                document.getElementById("access_changment").hidden = true;
                            }
                        </script>
                    </x-slot>
                </x-mod-form-part>
            </div>
        </div>
    </div>
</x-app-layout>
