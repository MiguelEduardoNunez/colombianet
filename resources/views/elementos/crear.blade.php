<!-- I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison -->
<x-app-layout>
    <x-slot:page>
        {{ __('Registrar Elemento') }}
    </x-slot>
    <div class="row">
        <div class="col-1 d-none d-lg-flex">
            <a href="{{ route('proyectos.elementos.index', $proyecto) }}">
                <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
            </a>
        </div>
        <div class="col-12 col-md-10 col-lg-6 offset-md-1 offset-lg-2">
            <form method="POST" action="{{ route('proyectos.elementos.store', $proyecto) }}">
                @csrf
                <x-card>
                    <x-slot:header>
                        <x-text :value="__('Registrar Elemento')" class="text-center" />
                    </x-slot:header>    

                    <x-slot:body>
                        <div class="form-group">
                            <x-input-label :value="__('Stand')" for="stand" />
                            <x-select :elements="$stands" identifier="id_stand" label="stand" id="stand" name="stand">
                                <option selected disabled>{{ __('Seleccionar') }}</option>
                            </x-select>
                            <x-input-error :messages="$errors->get('stand')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Categoria')" for="categoria" />
                            <x-select :elements="$categorias" identifier="id_categoria" label="categoria" id="categoria" name="categoria">
                                <option selected disabled>{{ __('Seleccionar') }}</option>
                            </x-select>
                            <x-input-error :messages="$errors->get('categoria')" />
                        </div>
                        
                        <div class="form-group">
                            <x-input-label :value="__('Subcategoria')" for="subcategoria" />
                            <x-select :elements="$subcategorias" identifier="id_subcategoria" label="subcategoria" id="subcategoria" name="subcategoria">
                                <option selected disabled>{{ __('Seleccionar') }}</option>
                            </x-select>
                            <x-input-error :messages="$errors->get('subcategoria')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Item')" for="item" />
                            <x-select :elements="$items" identifier="id_item" label="item" id="item" name="item">
                                <option selected disabled>{{ __('Seleccionar') }}</option>
                            </x-select>
                            <x-input-error :messages="$errors->get('item')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Marca')" for="marca" />
                            <x-input type="text" id="marca" name="marca" :value="old('marca')" />
                            <x-input-error :messages="$errors->get('marca')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Modelo')" for="modelo" />
                            <x-input type="text" id="modelo" name="modelo" :value="old('modelo')" />
                            <x-input-error :messages="$errors->get('modelo')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Serial')" for="serial" />
                            <x-input type="text" id="serial" name="serial" :value="old('serial')" />
                            <x-input-error :messages="$errors->get('serial')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Span')" for="span" />
                            <x-input type="text" id="span" name="span" :value="old('span')" />
                            <x-input-error :messages="$errors->get('span')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Codigo de Barras')" for="codigo_barras" />
                            <x-input type="text" id="codigo_barras" name="codigo_barras" :value="old('codigo_barras')" />
                            <x-input-error :messages="$errors->get('codigo_barras')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Grosor')" for="grosor" />
                            <x-input type="text" id="grosor" name="grosor" :value="old('grosor')" />
                            <x-input-error :messages="$errors->get('grosor')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Peso')" for="peso" />
                            <x-input type="text" id="peso" name="peso" :value="old('peso')" />
                            <x-input-error :messages="$errors->get('peso')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Cantidad')" for="cantidad" />
                            <x-input type="number" id="cantidad" name="cantidad" :value="old('cantidad')" />
                            <x-input-error :messages="$errors->get('cantidad')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Cantidad Minima')" for="cantidad_minima" />
                            <x-input type="number" id="cantidad_minima" name="cantidad_minima" :value="old('cantidad_minima')" />
                            <x-input-error :messages="$errors->get('cantidad_minima')" />
                        </div>
                    </x-slot:body>

                    <x-slot:footer>
                        <x-button type="submit">
                            {{ __('Registrar') }}
                        </x-button>
                    </x-slot:footer>
                </x-card>
            </form>
        </div>
    </div>
</x-app-layout>
