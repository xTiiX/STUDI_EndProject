<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-2">
                {{ __('Partenaires') }}
            </h2>
            <div class="grow"></div>
            @if (auth()->user()->access_level === 0) {{-- Admin --}}
            <div class="text-gray-100 bg-gray-800 p-2 rounded-lg">
                <a href="{{ route('partners.create') }}">Ajouter un Partenaire</a>
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
                    X Salle(s)
                </div>
                <div class="sm:grow"></div>
            </div>
            @endif
            <div class="p-4"></div>
            <div class="form-group">
                <input type="text" class="form-controller" id="search" name="search"></input>
            </div>
            <div class="p-4"></div>
            <div id="list">
                @foreach ($partners as $partner)
                    <x-partner-board-part :partner="$partner"/>
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
            url: '{{ route('search') }}',
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
