<x-app-layout>
    <x-slot name="page">
        {{ __('Editar Entrega de Elementos') }}
    </x-slot>
    <div class="row">
        <div class="col-1 d-none d-lg-flex">
            <a href="{{ route('proyectos.entregas-elementos.index', $proyecto->id_proyecto) }}">
                <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
            </a>
        </div>
        <div class="col-12 col-md-10 col-lg-6 offset-md-1 offset-lg-2">
            <form method="POST"
                action="{{ route('proyectos.entregas-elementos.update', [$proyecto->id_proyecto, $entrega_elemento->id_entrega_elemento]) }}">
                @csrf
                @method('PUT')
                <x-card>
                    <x-slot name="header">
                        <x-text :value="__('Actualizar Entrega de Elementos')" class="text-center" />
                    </x-slot>

                    <x-slot name="body">
                        <div class="form-group">
                            <x-input-label :value="__('Proyecto')" for="proyecto" />
                            <x-input type="text" id="proyecto" name="proyecto" :value="$entrega_elemento->proyecto->proyecto" disabled />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Empleado')" for="empleado" />
                            <x-input type="text" id="empleado" name="empleado" :value="$entrega_elemento->empleado->nombres_completos" disabled />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Fecha de Entrega')" for="fecha_entrega" />
                            <x-input type="date" id="fecha_entrega" name="fecha_entrega" :value="$entrega_elemento->fecha_entrega"
                                disabled />
                        </div>

                        <hr>

                        @foreach ($detalle_entrega_elementos as $detalle_entrega_elemento)
                            <div class="form-check d-flex align-items-center">
                                <input class="form-check-input elemento-checkbox" type="checkbox"
                                    id="checkbox_{{ $detalle_entrega_elemento->elemento->item->id_item }}"
                                    name="elementos_seleccionados[]" value="{{ $detalle_entrega_elemento->elemento->item->id_item }}"
                                    data-cantidad-entregada="{{ $detalle_entrega_elemento->cantidad }}"
                                    data-input-id="input_{{ $detalle_entrega_elemento->elemento->item->id_item }}">
                                <label class="form-check-label col-6 mb-0"
                                    for="checkbox_{{ $detalle_entrega_elemento->elemento->item->id_item }}">
                                    {{ $detalle_entrega_elemento->elemento->item->item }} 
                                    <br/>
                                    (Cantidad Entregada:{{ $detalle_entrega_elemento->cantidad }})
                                </label>

                                <div class="col-6">
                                    <div class="form-group mb-0">
                                        <x-input-label :value="__('Cantidad a devolver')" for="input_{{ $detalle_entrega_elemento->elemento->item->id_item }}" />
                                        <x-input type="number" id="input_{{ $detalle_entrega_elemento->elemento->item->id_item }}" name="cantidades[]" disabled />
                                        <x-input-error :messages="$errors->get('input_{{ $detalle_entrega_elemento->elemento->item->id_item }}')" />
                                    </div>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('elementos_seleccionados')" />
                            <hr>
                        @endforeach
                    </x-slot>

                    <x-slot name="footer">
                        <x-button type="submit">
                            {{ __('Actualizar') }}
                        </x-button>
                    </x-slot>
                </x-card>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.elemento-checkbox');
        const selectedElements = [];

        checkboxes.forEach(checkbox => {
            const cantidadInputId = checkbox.dataset.inputId;
            const cantidadInput = document.getElementById(cantidadInputId);

            checkbox.addEventListener('change', function () {
                cantidadInput.disabled = !this.checked;
                cantidadInput.value = ''; // Limpiar el valor del input al desactivar el checkbox

                if (this.checked) {
                    cantidadInput.addEventListener('input', updateArray);
                    addToSelectedElements(checkbox.value, cantidadInput.value);
                } else {
                    cantidadInput.removeEventListener('input', updateArray);
                    removeFromSelectedElements(checkbox.value);
                }
            });

            function updateArray() {
                const elementoId = checkbox.dataset.inputId.split('_')[1]; // Obtener el ID de entrega del elemento
                const cantidad = cantidadInput.value;
                updateSelectedElements(elementoId, cantidad);
            }

            function addToSelectedElements(elementoId, cantidad) {
                selectedElements.push({ elementoId, cantidad });
                console.log(selectedElements);
            }

            function removeFromSelectedElements(elementoId) {
                const index = selectedElements.findIndex(el => el.elementoId === elementoId);
                if (index > -1) {
                    selectedElements.splice(index, 1);
                }
                console.log(selectedElements);
            }

            function updateSelectedElements(elementoId, cantidad) {
                const element = selectedElements.find(el => el.elementoId === elementoId);
                if (element) {
                    element.cantidad = cantidad;
                } else {
                    addToSelectedElements(elementoId, cantidad);
                }
                console.log(selectedElements);
            }
        });
    });
</script>
