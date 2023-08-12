<div class="accordion-item">
    <h2 class="accordion-header" id="heading{{ $itemId }}">
        <button class="accordion-button {{ isset($accordionActive) && $accordionActive === $itemId ? '' : 'collapsed' }}"
        data-bs-toggle="collapse" data-bs-target="#collapse{{ $itemId }}"
        aria-expanded="{{ isset($accordionActive) && $accordionActive === $itemId ? 'true' : 'false' }}"
        type="button" wire:click="{{ $toggleAccordion }}('{{ $itemId }}')" aria-controls="collapse{{ $itemId }}">
            {{ $title }}
        </button>
    </h2>
    <div id="collapse{{ $itemId }}" class="accordion-collapse collapse {{ isset($accordionActive) && $accordionActive === $itemId ? 'show' : '' }}" aria-labelledby="heading{{ $itemId }}" data-bs-parent="#{{ $parentId }}" >
        <div class="accordion-body">
            {!! $slot !!}
        </div>
    </div>
</div>