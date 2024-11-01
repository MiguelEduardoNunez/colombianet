<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <x-card>
            <x-slot:header>
                {{-- <x-text size="h2" :value="__('SIGMAF')" class="text-center" data-toggle="tooltip" title="Sistema de Información para la Gestion y Control de Materiales de Formación" /> --}}
                <x-text size="h2" :value="__('SIGPOT')" class="text-center" data-toggle="tooltip" title="Sistema de Información y Gestión para la Operación en Telecomunicaciones" />
            </x-slot:header>

            <x-slot:body class="login-card-body">
                <x-text size="h6" style="font-weight-normal" color="dark" :value="__('Hola Bienvenid@')" class="login-box-msg mb-2" />
                
                <x-input-group>
                    <x-input type="email" id="email" name="email" :value="old('email')" placeholder="Correo Electrónico" required autofocus />
                    <x-slot:icon>
                        <i class="fas fa-envelope"></i>
                    </x-slot:icon>
                </x-input-group>
                <x-input-error :messages="$errors->get('email')" />

                <x-input-group class="mt-4 mb-2">
                    <x-input type="password" id="password" name="password" placeholder="Contraseña" required />
                    <x-slot:icon>
                        <i class="fas fa-lock"></i>
                    </x-slot:icon>
                </x-input-group>
                <x-input-error :messages="$errors->get('password')" />
            </x-slot:body>

            <x-slot:footer>
                <x-button type="submit">
                    {{ __('Iniciar Sesion') }}
                </x-button>
            </x-slot:footer>
        </x-card>
    </form>
</x-guest-layout>
