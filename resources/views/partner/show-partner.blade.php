<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-2">
                {{ __('Édition Partenaire') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-6">
            <div class="bg-white overflow-hidden shadow-sm rounded-sm sm:rounded-lg p-6 flex">
                <x-mod-form-part name="de Partenaire" button="Éditer">
                    <x-slot name="route">
                        {{ route('partners.edit') }}
                    </x-slot>
                    <x-slot name="back">
                        {{ route('partners.index') }}
                    </x-slot>
                    <x-slot name="content">
                        @csrf
                        <div class="flex">
                            <div>
                                <div class="flex flex-row space-x-1 mt-5">
                                    <p>URL du Logo<p class="text-red-500">*</p></p>
                                    <p>:</p>
                                    <div class="p-1"></div>
                                    <input type="text" name="logo_url" id="logo_url" class="-mt-0.5 max-h-7 rounded-md" value="{{ $partner->logo_url }}" required>
                                </div>
                                <div class="flex flex-row space-x-1 mt-5">
                                    <p>Description courte<p class="text-red-500">*</p></p>
                                    <p>:</p>
                                    <div class="p-1"></div>
                                    <input type="text" name="short_desc" id="short_desc" class="-mt-0.5 max-h-7 rounded-md" value="{{ $partner->short_desc }}" required>
                                </div>
                                <div class="flex flex-row space-x-1 mt-5">
                                    <p>Description complète</p>
                                    <p>:</p>
                                    <div class="p-1"></div>
                                    <textarea name="full_desc" id="full_desc" class="rounded-md">{{ $partner->full_desc }}</textarea>
                                </div>
                                <div class="flex flex-row space-x-1 mt-5">
                                    <p>DPO du Partenaire</p>
                                    <p>:</p>
                                    <div class="p-1"></div>
                                    <input type="text" name="dpo" id="dpo" class="-mt-0.5 max-h-7 rounded-md" value="{{ $partner->dpo }}">
                                </div>
                                <div class="flex flex-row space-x-1 mt-5">
                                    <p>Contact technique</p>
                                    <p>:</p>
                                    <div class="p-1"></div>
                                    <input type="text" name="technical_contact" id="technical_contact" class="-mt-0.5 max-h-7 rounded-md" value="{{ $partner->technical_contact }}">
                                </div>
                                <div class="flex flex-row space-x-1 mt-5">
                                    <p>Contact commercial</p>
                                    <p>:</p>
                                    <div class="p-1"></div>
                                    <input type="text" name="commercial_contact" id="commercial_contact" class="-mt-0.5 max-h-7 rounded-md" value="{{ $partner->commercial_contact }}">
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{ $partner->id }}">
                        </div>
                    </x-slot>
                </x-mod-form-part>
            </div>
        </div>
    </div>
</x-app-layout>
