<x-app-layout>
    <x-slot:page>
        {{ __('Detalles Entrega de Elementos') }}
    </x-slot>
    <div class="row">
        <div class="col-1 d-none d-lg-flex">
            <a href="{{ route('proyectos.entregas-elementos.index', $proyecto->id_proyecto) }}">
                <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
            </a>
        </div>
        <div class="col-12 col-md-10 col-lg-6 offset-md-1 offset-lg-2">
            <x-card>
                <x-slot:header>
                    <x-text :value="__('Detalles Entrega de Elementos')" class="text-center" />
                </x-slot:header>

                <x-slot:body>
                    <x-text size="h6" color="black" :value="__('Proyecto')" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$proyecto->proyecto" />

                    <x-text size="h6" color="black" :value="__('Empleado')" class="mt-4" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$entrega_elemento->empleado->nombres_completos" />

                    <x-text size="h6" color="black" :value="__('Fecha de Entrega')" class="mt-4" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$entrega_elemento->fecha_entrega" />

                    @foreach ($detalle_entrega_elementos as $detalle_entrega_elemento)
                        <div class="border-top border-primary mt-4">
                            <x-text size="h6" color="black" :value="__('Stand')" class="mt-4" />
                            <x-text size="h6" style="font-weight-normal" color="black" :value="$detalle_entrega_elemento->elemento->stand->stand" />

                            <x-text size="h6" color="black" :value="__('Elemento')" class="mt-4" />
                            <x-text size="h6" style="font-weight-normal" color="black" :value="$detalle_entrega_elemento->elemento->item->item" />
                            
                            <x-text size="h6" color="black" :value="__('Marca')" class="mt-4" />
                            <x-text size="h6" style="font-weight-normal" color="black" :value="$detalle_entrega_elemento->elemento->marca" />

                            <x-text size="h6" color="black" :value="__('Modelo')" class="mt-4" />
                            <x-text size="h6" style="font-weight-normal" color="black" :value="$detalle_entrega_elemento->elemento->modelo" />

                            <x-text size="h6" color="black" :value="__('Tipo de Cantidad')" class="mt-4" />
                            <x-text size="h6" style="font-weight-normal" color="black" :value="$detalle_entrega_elemento->elemento->tipoCantidad->tipo_cantidad" /> 

                            <x-text size="h6" color="black" :value="__('Cantidad Entregada')" class="mt-4" />
                            <x-text size="h6" style="font-weight-normal" color="black" :value="$detalle_entrega_elemento->cantidad" />  
                        </div>
                    @endforeach
                </x-slot:body>

                <x-slot:footer>
                </x-slot:footer>
            </x-card>
        </div>
    </div>
</x-app-layout>
