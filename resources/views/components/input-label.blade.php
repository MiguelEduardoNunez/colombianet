@props(['value', 'obligatorio' => true])

<label {{ $attributes }}>
    @if ($obligatorio)
        <span class="text-danger" data-toggle="tooltip" title="Campo Obligatorio">*</span>
    @endif
    {{ $value }}
</label>
