<x-app-layout>
    <x-slot:page>
        {{ __('Detalles Elemento') }}
    </x-slot>
    <div class="row">
        <div class="col-1 d-none d-lg-flex">
            <a href="{{ route('proyectos.elementos.index', $proyecto->id_proyecto) }}">
                <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
            </a>
        </div>
        <div class="col-12 col-md-10 col-lg-6 offset-md-1 offset-lg-2">
            <x-card>
                <x-slot:header>
                    <x-text :value="__('Detalles Elemento')" class="text-center" />
                </x-slot:header>

                <x-slot:body>
                    <x-text size="h6" color="black" :value="__('Proyecto')" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$proyecto->proyecto" />

                    <x-text size="h6" color="black" :value="__('Stand')" class="mt-4" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$elemento->stand->stand" />

                    <x-text size="h6" color="black" :value="__('Categoria')" class="mt-4" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$elemento->item->subcategoria->categoria->categoria" />

                    <x-text size="h6" color="black" :value="__('Subcategoria')" class="mt-4" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$elemento->item->subcategoria->subcategoria" />

                    <x-text size="h6" color="black" :value="__('Elemento')" class="mt-4" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$elemento->item->item" />

                    <x-text size="h6" color="black" :value="__('Marca')" class="mt-4" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$elemento->marca" />

                    <x-text size="h6" color="black" :value="__('Modelo')" class="mt-4" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$elemento->modelo" />

                    <x-text size="h6" color="black" :value="__('Serial')" class="mt-4" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$elemento->serial" />

                    <x-text size="h6" color="black" :value="__('Span')" class="mt-4" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$elemento->span" />

                    <x-text size="h6" color="black" :value="__('Codigo de Barras')" class="mt-4" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$elemento->codigo_barras" />

                    <x-text size="h6" color="black" :value="__('Grosor')" class="mt-4" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$elemento->grosor" />

                    <x-text size="h6" color="black" :value="__('Peso')" class="mt-4" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$elemento->peso" />

                    <x-text size="h6" color="black" :value="__('Tipo de Cantidad')" class="mt-4" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$elemento->tipoCantidad->tipo_cantidad" />

                    <x-text size="h6" color="black" :value="__('Cantidad')" class="mt-4" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$elemento->cantidad" />

                    <x-text size="h6" color="black" :value="__('Cantidad Minima')" class="mt-4" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$elemento->cantidad_minima" />
                </x-slot:body>

                <x-slot:footer>
                </x-slot:footer>
            </x-card>
        </div>
    </div>
</x-app-layout>
