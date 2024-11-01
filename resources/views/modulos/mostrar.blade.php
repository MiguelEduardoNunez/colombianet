<x-app-layout>
    <x-slot:page>
        {{ __('Detalles Modulos') }}
    </x-slot>
    <div class="row">
        <div class="col-1 d-none d-lg-flex">
            <a href="{{ route('modulos.index') }}">
                <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
            </a>
        </div>
        <div class="col-12 col-md-10 col-lg-6 offset-md-1 offset-lg-2">
            <x-card>
                <x-slot:header>
                    <x-text :value="__('Detalles Modulo')" class="text-center" />
                </x-slot:header>

                <x-slot:body>
                    <x-text size="h6" color="black" :value="__('Modulo Padre')" />
                    @if ($modulo->moduloPadre != null)
                        <x-text size="h6" style="font-weight-normal" color="black" :value="$modulo->moduloPadre->modulo" />
                    @else
                        {{ __('No registrado') }}
                    @endif

                    <x-text size="h6" color="black" :value="__('Modulo')" class="mt-4" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$modulo->modulo" />

                    <x-text size="h6" color="black" :value="__('Ruta')" class="mt-4" />
                    @if ($modulo->ruta != null)
                        <x-text size="h6" style="font-weight-normal" color="black" :value="$modulo->ruta" />
                    @else
                        {{ __('No registrada') }}
                    @endif

                    <x-text size="h6" color="black" :value="__('Icono')" class="mt-4" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$modulo->icono" />

                    <x-text size="h6" color="black" :value="__('Orden')" class="mt-4" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$modulo->orden" />
                </x-slot:body>

                <x-slot:footer>
                </x-slot:footer>
            </x-card>
        </div>
    </div>
</x-app-layout>
