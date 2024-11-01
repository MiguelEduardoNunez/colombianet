<x-app-layout>
    <x-slot:page>
        {{ __('Gestionar Permisos') }}
    </x-slot>
    <div class="row">
        <div class="col-1 d-none d-lg-flex">
            <a href="{{ route('perfiles.index') }}">
                <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
            </a>
        </div>
        <div class="col-12 col-md-10 col-lg-6 offset-md-1 offset-lg-2">
            <form method="POST" action="{{ route('permisos.update', $perfil) }}">
                @csrf
                @method('PUT')
                <x-card>
                    <x-slot:header>
                        <x-text :value="__('Gestionar Permisos')" class="text-center" />
                    </x-slot:header>

                    <x-slot:body>
                        @foreach ($modulos as $moduloPadre)
                            <div class="icheck-primary mt-4">
                                <input type="checkbox" id="{{ $moduloPadre->modulo }}" name="permisos[]" value="{{ $moduloPadre->id_modulo }}"
                                    @foreach ($permisos as $permiso)
                                        @if ($moduloPadre->id_modulo == $permiso->modulo_id)
                                            checked
                                        @endif
                                    @endforeach
                                >
                                <label for="{{ $moduloPadre->modulo }}">
                                    <i class="{{ $moduloPadre->icono }} text-primary"></i>
                                    {{ $moduloPadre->modulo }}
                                </label>
                            </div>
                            @if($moduloPadre->moduloHijo != null)
                                @foreach($moduloPadre->moduloHijo as $moduloHijo)
                                    <div class="icheck-primary ml-4">
                                        <input type="checkbox" id="{{ $moduloHijo->modulo }}" name="permisos[]" value="{{ $moduloHijo->id_modulo }}"
                                            @foreach ($permisos as $permiso)
                                                @if ($moduloHijo->id_modulo == $permiso->modulo_id)
                                                    checked
                                                @endif
                                            @endforeach
                                        >
                                        <label for="{{ $moduloHijo->modulo }}">
                                            <i class="{{ $moduloHijo->icono }} text-primary"></i>
                                            {{ $moduloHijo->modulo }}
                                        </label>
                                    </div> 

                                    @if($moduloHijo->moduloHijo != null)
                                        @foreach($moduloHijo->moduloHijo as $item)
                                            <div class="icheck-primary ml-5">
                                                <input type="checkbox" id="{{ $item->modulo }}" name="permisos[]" value="{{ $item->id_modulo }}"
                                                    @foreach ($permisos as $permiso)
                                                        @if ($item->id_modulo == $permiso->modulo_id)
                                                            checked
                                                        @endif
                                                    @endforeach
                                                >
                                                <label for="{{ $item->modulo }}">
                                                    {{ $item->modulo }}
                                                </label>
                                            </div> 
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif 
                        @endforeach
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
