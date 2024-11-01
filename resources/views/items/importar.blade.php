<x-app-layout>
    <x-slot:page>
        {{ __('Importar Items') }}
    </x-slot>
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-6">
            <form method="POST" action="{{ route('items.storeImport') }}" enctype="multipart/form-data">
                @csrf
                <x-card>
                    <x-slot:header>
                        <x-text :value="__('Importar Items')" class="text-center" />
                    </x-slot:header>

                    <x-slot:body>
                        <div class="form-group">
                            <x-input-label :value="__('Archivo Excel')" for="archivo_excel" />
                            <x-input type="file" id="archivo_excel" name="archivo_excel" :value="old('archivo_excel')" />
                            <x-input-error :messages="$errors->get('archivo_excel')" />
                        </div>
                    </x-slot:body>

                    <x-slot:footer>
                        <x-button type="submit">
                            {{ __('Importar') }}
                        </x-button>
                    </x-slot:footer>
                </x-card>
            </form>
        </div>
    </div>
</x-app-layout>
