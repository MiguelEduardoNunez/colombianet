<x-app-layout>
    <x-slot:page>
        {{ __('Migrar Elementos') }}
        </x-slot>

        <div class="row">
            <div class="col-auto d-none d-lg-flex">
                <a href="{{ route('proyectos.elementos.index', $proyecto->id_proyecto) }}">
                    <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
                </a>
            </div>

            <div class="col-lg-6 offset-md-1 offset-lg-2">
                <form method="POST" action="{{ route('proyectos.migrar.elementos.store', $proyecto->id_proyecto) }}">
                    @csrf
                    <x-card>
                        <x-slot:header>
                            <x-text :value="__('Migrar Elementos')" class="text-center" />
                        </x-slot:header>

                        <x-slot:body>
                            <h4 class="text-center text-primary">{{ $proyecto->proyecto }}</h4>

                            <div class="container">

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="seleccionarTodos" onclick="seleccionarTodos()">
                                    <label class="form-check-label" for="seleccionarTodos">Seleccionar todos</label>
                                </div>
                                
                                <hr>

                                @foreach ($elementos as $elemento)
                                    <div class="form-check d-flex align-items-center">
                                        <input class="form-check-input elemento-checkbox" type="checkbox" id="elemento{{ $elemento->id_elemento }}" name="elementos_seleccionados[]" value="{{ $elemento->id_elemento }}">
                                        <label class="form-check-label col-6 mb-0" for="elemento{{ $elemento->id_elemento }}">
                                            {{ $elemento->item->item }} (Disponible: {{ $elemento->cantidad }})
                                        </label>
                                
                                        <div class="col-6">
                                            <div class="form-group mb-0">
                                                <x-input-label :value="__('Cantidad a migrar')" for="cantidad{{ $elemento->id_elemento }}" />
                                                <x-input type="number" id="cantidad{{ $elemento->id_elemento }}" name="cantidades[]" disabled />
                                                <x-input-error :messages="$errors->get('cantidad')" />
                                            </div>
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('elementos_seleccionados')" />
                                    <hr>
                                @endforeach

                                <div class="form-group mt-4">
                                    <x-input-label :value="__('Proyecto De Destino')" for="proyecto_destino" />
                                    <x-select :elements="$proyectos" identifier="id_proyecto" label="proyecto" id="proyecto_destino" name="proyecto_destino">
                                        <option selected disabled>{{ __('Seleccionar') }}</option>
                                    </x-select>
                                    <x-input-error :messages="$errors->get('proyecto_destino')" />
                                </div>
                            </div>
                        </x-slot:body>

                        <x-slot:footer>
                            <x-button type="submit">
                                {{ __('Migrar') }}
                            </x-button>
                        </x-slot:footer>
                    </x-card>
                </form>
            </div>
        </div>
</x-app-layout>

<script>
    document.getElementById('seleccionarTodos').addEventListener('change', function() {
        var checkTodos = document.querySelectorAll('.elemento-checkbox');
        checkTodos.forEach(function(checkbox) {
            checkbox.checked = document.getElementById('seleccionarTodos').checked;
            const cantidadInput = checkbox.closest('.form-check').querySelector('input[type="number"]');
            cantidadInput.disabled = !checkbox.checked;
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.elemento-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const cantidadInput = this.closest('.form-check').querySelector('input[type="number"]');
                cantidadInput.disabled = !this.checked;
            });
        });
    });
</script>

