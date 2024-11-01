@props(['elements', 'identifier', 'label'])

<select {{ $attributes->merge(['class' => 'form-control select2', 'style' => 'width: 100%']) }}>
    {{ $slot }}
    @foreach ($elements as $element)
        <option value="{{ $element->$identifier }}">{{ $element->$label }}</option>
    @endforeach
</select>
