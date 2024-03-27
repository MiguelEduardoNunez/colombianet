<x-app-layout>
    <x-slot:page>
        {{ __('Registrar Elemento') }}
    </x-slot>
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-6">
            <form method="POST" action="{{ route('proyectos.elementos.store', $proyecto) }}">
                @csrf
                <x-card>
                    <x-slot:header>
                        <x-text :value="__('Registrar Stand')" class="text-center" />
                    </x-slot:header>

                    <x-slot:body>
                        <div class="form-group">
                            <x-input-label :value="__('Stand')" for="stand" />
                            <x-input type="text" id="stand" name="stand" :value="old('stand')" />
                            <x-input-error :messages="$errors->get('stand')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Ubicación')" for="ubicacion" />
                            <x-input type="text" id="ubicacion" name="ubicacion" :value="old('ubicacion')" />
                            <x-input-error :messages="$errors->get('ubicacion')" />
                        </div>
                    </x-slot:body>

                    <x-slot:footer>
                        <x-button type="submit">
                            {{ __('Registrar') }}
                        </x-button>
                    </x-slot:footer>
                </x-card>
            </form>
        </div>
    </div>
</x-app-layout>

