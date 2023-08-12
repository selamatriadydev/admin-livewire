@foreach ($modules as $node)
    <div>
        <input
            type="checkbox"
            wire:model="selectedModule"
            value="{{ $node['id'] }}"
            {{-- x-data="{ checked: @entangle('selectedModule').includes('{{ $node['id'] }}') }"
            x-on:click="checked = !checked; $wire.toggleSelection('{{ $node['id'] }}')" --}}
        />
        {{ $node['title'] }}
    </div>
    @if (count($node['childs']))
        <div style="margin-left: 20px;">
            @foreach ($node['childs'] as $child)
                <div>
                    <input
                        type="checkbox"
                        wire:model="selectedModule"
                        value="{{ $child['id'] }}"
                        {{-- x-data="{ checked: @entangle('selectedModule').includes('{{ $node['id'] }}') }"
                        x-on:click="checked = !checked; $wire.toggleSelection('{{ $node['id'] }}')" --}}
                    />
                    {{ $child['title'] }}
                </div>
            @endforeach
        </div>
    @endif
@endforeach