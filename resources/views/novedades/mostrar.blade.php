<x-app-layout>
    <x-slot:page>
        {{ __('Detalles Novedad') }}
    </x-slot>
    <div class="row">
        <div class="col-1 d-none d-lg-flex">
            <a href="{{ route('elementos.novedades.index', $elemento->id_elemento) }}" type="button">
                <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
            </a>
        </div>
        <div class="col-12 col-md-10 col-lg-6 offset-md-1 offset-lg-2">
            <x-card>
                <x-slot:header>
                    <x-text :value="__('Detalles Novedad')" class="text-center" />
                </x-slot:header>

                <x-slot:body>
                    <x-text size="h6" color="black" :value="__('Proyecto')" class="mt-4"/>
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$elemento->proyecto->proyecto" />

                    <x-text size="h6" color="black" :value="__('Stand')" class="mt-4"/>
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$elemento->stand->stand" />

                    <x-text size="h6" color="black" :value="__('Categoria')" class="mt-4"/>
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$elemento->item->subcategoria->categoria->categoria" />

                    <x-text size="h6" color="black" :value="__('Subcategoria')" class="mt-4"/>
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$elemento->item->subcategoria->subcategoria" />
                        
                    <x-text size="h6" color="black" :value="__('Item')" class="mt-4"/>
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$elemento->item->item" />

                    <x-text size="h6" color="black" :value="__('Marca')" class="mt-4"/>
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$elemento->marca" />

                    <x-text size="h6" color="black" :value="__('Modlo')" class="mt-4"/>
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$elemento->modelo" />

                    <x-text size="h6" color="black" :value="__('Serial')" class="mt-4"/>
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$elemento->serial" />

                    <x-text size="h6" color="black" :value="__('Tipo Novedad')" class="mt-4"/>
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$novedad->tipoNovedad->tipo_novedad" />

                    <x-text size="h6" color="black" :value="__('Empleado')" class="mt-4"/>
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$novedad->empleado->nombres_completos" />

                    <x-text size="h6" color="black" :value="__('Novedad')" class="mt-4"/>
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$novedad->novedad" />

                    <x-text size="h6" color="black" :value="__('Fecha Reporte')" class="mt-4"/>
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$novedad->fecha_reporte" />

                    <x-text size="h6" color="black" :value="__('Fecha Cierre')" class="mt-4"/>
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$novedad->fecha_cierre" />
                </x-slot:body>
                <x-slot:footer>
                </x-slot:footer>
            </x-card>
        </div>
    </div>
</x-app-layout>