@props(['value'])

<textarea {{ $attributes->merge(['rows' => '4', 'class' => 'form-control']) }}>{{ $value }}</textarea>
