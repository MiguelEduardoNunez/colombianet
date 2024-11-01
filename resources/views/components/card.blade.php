@props(['color' => 'primary'])

<div {{ $attributes->merge(['class' => 'card card-outline card-'.$color.' shadow']) }}>
    <div {{ $header->attributes->merge(['class' => 'card-header']) }}>
        {{ $header }}
    </div>

    <div {{ $body->attributes->merge(['class' => 'card-body']) }}>
        {{ $body }}
    </div>

    <div {{ $footer->attributes->merge(['class' => 'card-footer bg-transparent mb-2']) }}>
        {{ $footer }}
    </div>
</div>
