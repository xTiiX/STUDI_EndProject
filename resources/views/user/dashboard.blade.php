<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-2">
                {{ 'Utilisateurs' }}
            </h2>
            <div class="grow"></div>
            @if (auth()->user()->access_level === 0) {{-- Admin --}}
            <div class="text-gray-100 bg-gray-800 p-2 rounded-lg">
                <a href="{{ route('users.create') }}">Ajouter un Utilisateur</a>
            </div>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-6">
            @if (auth()->user()->access_level === 0) {{-- Admin --}}
            <div class="flex items-center p-6 sm:p-0 bg-white border-b border-gray-200 sm:border-none shadow-sm sm:shadow-none overflow-hidden text-center sm:bg-transparent">
                <div class="sm:grow"></div>
                <div class="sm:p-6 sm:bg-white sm:border-b sm:border-gray-200 sm:shadow-sm sm:overflow-hidden sm:text-center sm:rounded-lg">
                    {{ count($users) }} Utilisateur(s)
                </div>
                <div class="grow"></div>
                <div class="sm:p-6 sm:bg-white sm:border-b sm:border-gray-200 sm:shadow-sm sm:overflow-hidden sm:text-center sm:rounded-lg">
                    {{ count($partners) }} Partenaire(s)
                </div>
                <div class="grow"></div>
                <div class="sm:p-6 sm:bg-white sm:border-b sm:border-gray-200 sm:shadow-sm sm:overflow-hidden sm:text-center sm:rounded-lg">
                    {{ count($structures) }} Salle(s)
                </div>
                <div class="sm:grow"></div>
            </div>
            @endif
            <div class="p-4"></div>
            <div class="pt-2 relative mx-full text-gray-600">
                <button type="submit" class="absolute left-0 top-0 mt-5 mr-4">
                    <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                        viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                        width="512px" height="512px">
                        <path
                        d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                    </svg>
                </button>
                <input class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="search" id="search" name="search"></input>
            </div>
            <div class="p-4"></div>
            <div id="list">
                @foreach ($users as $user)
                    <x-user-board-part :user="$user"/>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
<script type="text/javascript">
    var list = document.getElementById('list');
    $('#search').on('keyup', function () {
        $value = $(this).val();
        $.ajax({
            type: 'get',
            url: '{{ route('users.search') }}',
            data: { 'search': $value },
            success: function (data) {
                list.innerHTML = data;
            }
        });
    })
</script>
<script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken': '{{ csrf_token() }}' } });
</script>
