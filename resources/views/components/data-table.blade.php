@props(['headers'])

<table {{ $attributes->merge(['class' => 'table table-head-fixed table-hover text-nowrap', 'id' => 'datatable']) }}>
    <thead>
        <tr>
            @foreach ($headers as $header)
                @if ($header == 'Acciones')
                    <th class="text-center">{{ $header }}</th>
                @else
                    <th>{{ $header }}</th>
                @endif
            @endforeach
        </tr>
    </thead>
    <tbody>
        {{ $slot }}
    </tbody>
</table>
