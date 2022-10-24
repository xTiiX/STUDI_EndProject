<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-2">
                Paramètres
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-6 bg-white shadow-sm rounded-sm sm:rounded-lg mt-3 p-6">
            <h3>Modification de Mot de Passe</h3>
            <br>
            <form action="{{ route('params.storeNewPass') }}" method="post">
                @csrf
                <label for="last_password" class="-mt-3">Entrez votre ancien mot de passe :</label>
                <input type="password" name="last_password" id="last_password" class="max-h-7 rounded-md" required>
                <br>
                <label for="new_password" class="-mt-3">Entrez votre nouveau mot de passe :</label>
                <input type="password" name="new_password" id="new_password" class="max-h-7 rounded-md" required>
                <br>
                <label for="check_password" class="-mt-3">Verification de votre nouveau mot de passe :</label>
                <input type="password" name="check_password" id="check_password" class="max-h-7 rounded-md" required>
                <br>
                <button type="submit" class="text-white bg-gray-800 p-2 rounded-lg mt-5">Enregistrer</button>
            </form>
        </div>
    </div>
</x-app-layout>
