<x-app-layout>
    <x-slot:page>
        {{ __('Registrar Categoria') }}
    </x-slot>

    <h1>Hola mundo</h1>
    
    {{-- Mostrar el empleado que se seleccionó --}}
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Empleado: {{ $empleado->nombres_completos }} {{ $empleado->arl->nombre_arl }}</h1>
            </div>
        </div>
    </div>
</x-app-layout>