<x-app-layout>
    <x-slot:page>
        {{ __('Detalles Stand') }}
    </x-slot>
    <div class="row">
        <div class="col-1 d-none d-lg-flex">
            <a href="{{ route('stands.index') }}">
                <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
            </a>
        </div>
        <div class="col-12 col-md-10 col-lg-6 offset-md-1 offset-lg-2">
            <x-card>
                <x-slot:header>
                    <x-text :value="__('Detalles Stand')" class="text-center" />
                </x-slot:header>

                <x-slot:body>
                    <x-text size="h6" color="dark" :value="__('Stand')" />
                    <x-text size="h6" style="font-weight-normal" color="dark" :value="$stand->stand" />

                    <x-text size="h6" color="dark" :value="__('Ubicación')" class="mt-4" />
                    <x-text size="h6" style="font-weight-normal" color="dark" :value="$stand->ubicacion" />
                </x-slot:body>

                <x-slot:footer>
                </x-slot:footer>
            </x-card>
        </div>
    </div>
</x-app-layout>
