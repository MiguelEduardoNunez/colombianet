@props(['size' => 'h4', 'style' => 'font-weight-bold', 'color' => 'primary', 'value'])

<p {{ $attributes->merge(['class' => $size.' '.$style.' text-'.$color]) }}>
    {{ $value }}
</p>
