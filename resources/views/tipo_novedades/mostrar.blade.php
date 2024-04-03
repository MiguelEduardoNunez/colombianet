<x-app-layout>
    <x-slot:page>
        {{ __('Detalles Tipo Novedad') }}
    </x-slot>
    <div class="row">
        <div class="col-1 d-none d-lg-flex">
            <a href="{{ route('tipo_novedades.index') }}">
                <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
            </a>
        </div>
        <div class="col-12 col-md-10 col-lg-6 offset-md-1 offset-lg-2">
            <x-card>
                <x-slot:header>
                    <x-text :value="__('Detalles Tipo Novedad')" class="text-center" />
                </x-slot:header>

                <x-slot:body>
                    <x-text size="h6" color="black" :value="__('Tipo de Novedad')" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$tipoNovedad->tipo_novedad" />

                    <x-text size="h6" color="black" :value="__('Descripción')" class="mt-4" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$tipoNovedad->descripcion" />
                </x-slot:body>

                <x-slot:footer>
                </x-slot:footer>
            </x-card>
        </div>
    </div>
</x-app-layout>
