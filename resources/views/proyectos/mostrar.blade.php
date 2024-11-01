<x-app-layout>
    <x-slot:page>
        {{ __('Detalles Proyecto') }}
    </x-slot>
    <div class="row">
        <div class="col-1 d-none d-lg-flex">
            <a href="{{ route('proyectos.index') }}">
                <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
            </a>
        </div>
        <div class="col-12 col-md-10 col-lg-6 offset-md-1 offset-lg-2">
            <x-card>
                <x-slot:header>
                    <x-text :value="__('Detalles Proyecto')" class="text-center" />
                </x-slot:header>

                <x-slot:body>
                    <x-text size="h6" color="black" :value="__('Proyecto')" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$proyecto->proyecto" />

                    <x-text size="h6" color="black" :value="__('Descripcion')" class="mt-4" />
                    @if ($proyecto->descripcion != null)
                        <x-text size="h6" style="font-weight-normal" color="black" :value="$proyecto->descripcion" />
                    @else
                        {{ __('No registrada') }}
                    @endif

                    <x-text size="h6" color="black" :value="__('Fecha Inicio')" class="mt-4" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$proyecto->fecha_inicio" />

                    <x-text size="h6" color="black" :value="__('Fecha Fin')" class="mt-4" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$proyecto->fecha_fin" />

                    <x-text size="h6" color="black" :value="__('Responsable del proyecto')" class="mt-4" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$proyecto->responsable_proyecto" />

                    <x-text size="h6" color="black" :value="__('Correo Electronico')" class="mt-4" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$proyecto->correo_responsable" />

                    <x-text size="h6" color="black" :value="__('Telefono')" class="mt-4" />
                    @if ($proyecto->telefono_responsable != null)
                        <x-text size="h6" style="font-weight-normal" color="black" :value="$proyecto->telefono_responsable" />
                    @else
                        {{ __('No registrado') }}
                    @endif

                    <x-text size="h6" color="black" :value="__('Dirección')" class="mt-4" />
                    @if ($proyecto->direccion_cliente != null)
                        <x-text size="h6" style="font-weight-normal" color="black" :value="$proyecto->direccion_cliente" />    
                    @else
                        {{ __('No registrada') }}
                    @endif
                </x-slot:body>

                <x-slot:footer>
                </x-slot:footer>
            </x-card>
        </div>
    </div>
</x-app-layout>
