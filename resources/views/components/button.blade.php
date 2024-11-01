@props(['color' => 'primary'])

<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-outline-'.$color.' btn-block font-weight-bold']) }}>
    {{ $slot }}
</button>
