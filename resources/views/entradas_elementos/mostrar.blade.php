<x-app-layout>
    <x-slot:page>
        {{ __('Detalles Entrega') }}
        </x-slot>
        <div class="row">
            <div class="col-1 d-none d-lg-flex">
                <a href="{{ route('entrada_elementos.index', $proyecto->id_proyecto) }}">
                    <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
                </a>
            </div>
            <div class="col-12 col-md-10 col-lg-6 offset-md-1 offset-lg-2">
                <x-card>
                    <x-slot:header>
                        <x-text :value="__('Detalles Entrega')" class="text-center" />
                    </x-slot:header>

                    <x-slot:body>
                        <x-text size="h6" color="black" :value="__('Proyecto')" />
                        <x-text size="h6" style="font-weight-normal" color="black" :value="$entrada->proyecto->proyecto" />

                        <x-text size="h6" color="black" :value="__('Categoria')" class="mt-4" />
                        <x-text size="h6" style="font-weight-normal" color="black" :value="$entrada->elemento->item->subcategoria->categoria->categoria" />

                        <x-text size="h6" color="black" :value="__('Subcategoria')" class="mt-4" />
                        <x-text size="h6" style="font-weight-normal" color="black" :value="$entrada->elemento->item->subcategoria->subcategoria" />

                        <x-text size="h6" color="black" :value="__('Elemento')" class="mt-4"/>
                        <x-text size="h6" style="font-weight-normal" color="black" :value="$entrada->elemento->item->item" />
                        
                        <x-text size="h6" color="black" :value="__('Cantidad')" class="mt-4" />
                        <x-text size="h6" style="font-weight-normal" color="black" :value="$entrada->cantidad" />

                        <x-text size="h6" color="black" :value="__('Fecha de Entrada')" class="mt-4" />
                        <x-text size="h6" style="font-weight-normal" color="black" :value="$entrada->fecha_entrada" />
                                
                        <x-text size="h6" color="black" :value="__('Descripcion')" class="mt-4" />
                        @if ($entrada->descripcion != null)
                        <x-text size="h6" style="font-weight-normal" color="black" :value="$entrada ->descripcion" />
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