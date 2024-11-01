<x-app-layout>
    <x-slot:page>
        {{ __('Actualizar Item') }}
    </x-slot>
    <div class="row">
        <div class="col-1 d-none d-lg-flex">
            <a href="{{ route('items.index') }}">
                <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
            </a>
        </div>
        <div class="col-12 col-md-10 col-lg-6 offset-md-1 offset-lg-2">
            <form method="POST" action="{{ route('items.update', $item->id_item) }}">
                @csrf
                @method('PUT')
                <x-card>
                    <x-slot:header>
                        <x-text :value="__('Actualizar Item')" class="text-center" />
                    </x-slot:header>

                    <x-slot:body>

                        <div class="form-group">
                            <x-input-label :value="__('Categoria')" for="categoria" />
                            <x-select :elements="$categorias" identifier="id_categoria" label="categoria" id="categoria"
                                name="categoria">

                                <option value="{{ $item->subcategoria->categoria->categoria }}" selected>
                                    {{ $item->subcategoria->categoria->categoria }}</option>

                            </x-select>

                            <x-input-error :messages="$errors->get('categoria')" />
                        </div>


                        <div class="form-group">
                            <x-input-label :value="__('Subcategoria')" for="subcategoria" />
                            <x-select :elements="$subcategorias" identifier="id_subcategoria" label="subcategoria" id="subcategoria" name="subcategoria">
                                <option value="{{ $item->subcategoria_id }}" selected> {{ $item->subcategoria->subcategoria }}</option>
                            </x-select>
                            <x-input-error :messages="$errors->get('subcategoria')" />
                        </div>


                        <div class="form-group">
                            <x-input-label :value="__('Item')" for="item" />
                            <x-input type="text" id="item" name="item" :value="$item->item" />
                            <x-input-error :messages="$errors->get('item')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Descripcion')" for="descripcion" :obligatorio="false" />
                            <x-text-area id="descripcion" name="descripcion" :value="$item->descripcion" />
                            <x-input-error :messages="$errors->get('descripcion')" />
                        </div>


                    </x-slot:body>

                    <x-slot:footer>
                        <x-button type="submit">
                            {{ __('Actualizar') }}
                        </x-button>
                    </x-slot:footer>
                </x-card>
            </form>
        </div>
    </div>
</x-app-layout>
<script>
    $(function() {
        // Select dinamic
        var subcategorias = {{ Js::from($subcategorias) }};
        $("#categoria").on("change", function() {
            $("#subcategoria").empty()
            $("#subcategoria").prepend("<option selected disabled>Seleccionar</option>")

            $("#elemento").empty()
            $("#elemento").prepend("<option selected disabled>Seleccionar</option>")

            var categoria = $(this).val()
            const resultado = subcategorias.filter(function(subcategoria) {
                return subcategoria.categoria_id == categoria
            })

            resultado.forEach(function(res) {
                $("#subcategoria").append("<option value=" + res.id_subcategoria + ">" + res
                    .subcategoria + "</option>")
            })
        });
    })
</script>
