<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-2">
                {{ 'Salle ' . $structure->name }}
            </h2>
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
            <div class="p-6">
                <div class="p-4 bg-white overflow-hidden shadow-sm rounded-sm sm:rounded-lg mt-3 grow">
                    <p class="text-xl">Salle {{$structure->name}}</p>
                    @if ($structure->adress)
                        <p class="mt-1 text-sm">{{ $structure->adress }}</p>
                    @endif
                    <p class="mt-5">Contacts :</p>
                    <p class="ml-2 text-sm">Tel : {{$structure->phone}}</p>
                    {{-- Services --}}
                    <form class="p-3" action="{{ route('partners.structures.service_store') }}" method="post">
                        @csrf
                        <div class="mt-5">
                            <p class="text-lg underline">Services :</p>
                            @foreach ($services as $service)
                                <x-toggle-button  :service="$service"/>
                            @endforeach
                        </div>
                        <input type="hidden" name="structure_id" value="{{ $structure->id }}">
                        <button class="mt-1 mb-4 p-2 rounded-sm sm:rounded-lg text-white bg-gray-800" type="submit">Enregistrer les services</button>
                    </form>
                    <div class="flex flex-col">
                        @if ($structure->trashed())
                            @if (auth()->user()->access_level < 2) {{-- Admin --}}
                            <div class="bg-gray-800 rounded-sm sm:rounded-lg p-1 ml-2 text-center mt-2">
                                <form action="{{ route('partners.structures.restore', $structure->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="text-white sm:shadow-sm"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 30 30" width="30px" height="30px">
                                    <g id="surface9629428">
                                        <path style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,100%,100%);fill-opacity:1;" d="M 15 3 C 8.914062 3 3.878906 7.554688 3.113281 13.4375 C 3.054688 13.800781 3.195312 14.164062 3.484375 14.390625 C 3.773438 14.613281 4.160156 14.664062 4.496094 14.519531 C 4.832031 14.375 5.0625 14.0625 5.09375 13.699219 C 5.734375 8.789062 9.910156 5 15 5 C 17.765625 5 20.25 6.128906 22.058594 7.941406 L 20 10 L 26 11 L 25 5 L 23.46875 6.527344 C 21.300781 4.359375 18.308594 3 15 3 Z M 25.910156 15.417969 C 25.398438 15.410156 24.964844 15.792969 24.90625 16.300781 C 24.265625 21.210938 20.089844 25 15 25 C 11.976562 25 9.296875 23.648438 7.464844 21.535156 L 9 20 L 3 19 L 4 25 L 6.046875 22.953125 C 8.246094 25.421875 11.4375 27 15 27 C 21.085938 27 26.121094 22.445312 26.886719 16.5625 C 26.925781 16.277344 26.84375 15.988281 26.65625 15.769531 C 26.472656 15.550781 26.199219 15.421875 25.910156 15.417969 Z M 25.910156 15.417969 "/>
                                    </g>
                                </svg></button>
                                </form>
                            </div>
                            @endif
                        @else
                        <div class="flex flex-row">
                            <div class="bg-gray-800 rounded-sm sm:rounded-lg p-1 text-center mt-2 grow">
                                <form action="{{ route('partners.structures.show', $structure->id) }}" method="get">
                                    @csrf
                                    <button type="submit" class="text-white sm:shadow-sm"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 26 26" width="26px" height="26px">
                                        <g id="surface9644317">
                                            <path style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,100%,100%);fill-opacity:1;" d="M 20.09375 0.25 C 19.5 0.246094 18.917969 0.457031 18.46875 0.90625 L 17.46875 1.9375 L 24.0625 8.5625 L 25.0625 7.53125 C 25.964844 6.628906 25.972656 5.164062 25.0625 4.25 L 21.75 0.9375 C 21.292969 0.480469 20.6875 0.253906 20.09375 0.25 Z M 16.34375 2.84375 L 14.78125 4.34375 L 21.65625 11.21875 L 23.25 9.75 Z M 13.78125 5.4375 L 2.96875 16.15625 C 2.71875 16.285156 2.539062 16.511719 2.46875 16.78125 L 0.15625 24.625 C 0.0507812 24.96875 0.144531 25.347656 0.398438 25.601562 C 0.652344 25.855469 1.03125 25.949219 1.375 25.84375 L 9.21875 23.53125 C 9.582031 23.476562 9.882812 23.222656 10 22.875 L 20.65625 12.3125 L 19.1875 10.84375 L 8.25 21.8125 L 3.84375 23.09375 L 2.90625 22.15625 L 4.25 17.5625 L 15.09375 6.75 Z M 16.15625 7.84375 L 5.1875 18.84375 L 6.78125 19.1875 L 7 20.65625 L 18 9.6875 Z M 16.15625 7.84375 "/>
                                        </g>
                                    </svg></button>
                                </form>
                            </div>
                            @if (auth()->user()->access_level < 2) {{-- Admin --}}
                            <div class="bg-gray-800 rounded-sm sm:rounded-lg p-1 ml-2 text-center mt-2 grow">
                                <form action="{{ route('partners.structures.delete', $structure->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="text-white sm:shadow-sm"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24" width="24px" height="24px">
                                    <g id="surface9649430">
                                        <path style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,100%,100%);fill-opacity:1;" d="M 4.992188 3.992188 C 4.582031 3.992188 4.21875 4.238281 4.0625 4.613281 C 3.910156 4.992188 4 5.421875 4.292969 5.707031 L 10.585938 12 L 4.292969 18.292969 C 4.03125 18.542969 3.925781 18.917969 4.019531 19.265625 C 4.109375 19.617188 4.382812 19.890625 4.734375 19.980469 C 5.082031 20.074219 5.457031 19.96875 5.707031 19.707031 L 12 13.414062 L 18.292969 19.707031 C 18.542969 19.96875 18.917969 20.074219 19.265625 19.980469 C 19.617188 19.890625 19.890625 19.617188 19.980469 19.265625 C 20.074219 18.917969 19.96875 18.542969 19.707031 18.292969 L 13.414062 12 L 19.707031 5.707031 C 20.003906 5.417969 20.089844 4.980469 19.929688 4.601562 C 19.769531 4.21875 19.394531 3.976562 18.980469 3.988281 C 18.71875 3.996094 18.472656 4.105469 18.292969 4.292969 L 12 10.585938 L 5.707031 4.292969 C 5.519531 4.097656 5.261719 3.992188 4.992188 3.988281 Z M 4.992188 3.992188 "/>
                                    </g>
                                </svg></button>
                                </form>
                            </div>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
