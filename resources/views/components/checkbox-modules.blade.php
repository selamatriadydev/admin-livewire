@foreach ($modules as $node)
    <div>
        <input type="checkbox" wire:model="selectedModule.{{ $node['id'] }}"/>
        {{ $node['title'] }}
    </div>
    @if (count($node['permissions']))
        <div style="margin-left: 20px;">
            @foreach ($node['permissions'] as $keyPermis=> $permis)
                <div wire:key="{{ $keyPermis }}">
                    <input type="checkbox" wire:model="selectedModule.{{ $node['id'] }}.permis.{{ $keyPermis }}" />
                    {{ $permis }}
                </div>
            @endforeach
        </div>
    @endif
    @if (count($node['childs']))
        <div style="margin-left: 20px;">
            @foreach ($node['childs'] as $child)
                <div wire:key="{{ $child['id'] }}" >
                    <input type="checkbox" wire:model="selectedModule.{{ $node['id'] }}.sub.{{ $child['id'] }}" />
                    {{ $child['title'] }}
                </div>
                @if (count($child['permissions']))
                    <div style="margin-left: 20px;">
                        @foreach ($child['permissions'] as $keyPermis=> $permis)
                            <div wire:key="{{ $keyPermis }}">
                                <input type="checkbox" wire:model="selectedModule.{{ $node['id'] }}.sub.{{ $child['id'] }}.permis.{{ $keyPermis }}" />
                                {{ $permis }}
                            </div>
                        @endforeach
                    </div>
                @endif
            @endforeach
        </div>
    @endif
@endforeach