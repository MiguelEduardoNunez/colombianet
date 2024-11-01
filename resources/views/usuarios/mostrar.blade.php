<x-app-layout>
    <x-slot:page>
        {{ __('Detalles Usuario') }}
    </x-slot>
    <div class="row">
        <div class="col-1 d-none d-lg-flex">
            <a href="{{ route('usuarios.index') }}">
                <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
            </a>
        </div>
        <div class="col-12 col-md-10 col-lg-6 offset-md-1 offset-lg-2">
            <x-card>
                <x-slot:header>
                    <x-text :value="__('Detalles Usuario')" class="text-center" />
                </x-slot:header>

                <x-slot:body>
                    <x-text size="h6" color="black" :value="__('Perfil')" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$usuario->perfil->perfil" />

                    <x-text size="h6" color="black" :value="__('Identificación')" class="mt-4" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$usuario->identificacion" />

                    <x-text size="h6" color="black" :value="__('Nombres')" class="mt-4" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$usuario->nombres" />

                    <x-text size="h6" color="black" :value="__('Telefono')" class="mt-4" />
                    @if ($usuario->telefono != null)
                        <x-text size="h6" style="font-weight-normal" color="black" :value="$usuario->telefono" />
                    @else
                        {{ __('No registrado') }}
                    @endif

                    <x-text size="h6" color="black" :value="__('Correo Electronico')" class="mt-4" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$usuario->email" />
                </x-slot:body>

                <x-slot:footer>
                </x-slot:footer>
            </x-card>
        </div>
    </div>
</x-app-layout>
