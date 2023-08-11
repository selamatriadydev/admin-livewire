<div class="accordion-item">
    <h2 class="accordion-header" id="heading{{ $itemId }}">
        <button class="accordion-button {{ isset($accordionActive) && in_array($itemId, $accordionActive) ? '' : 'collapsed' }}"
        data-bs-toggle="collapse" data-bs-target="#collapse{{ $itemId }}"
        aria-expanded="{{ isset($accordionActive) && in_array($itemId, $accordionActive) ? 'true' : 'false' }}"
         type="button" wire:click="toggleAccordion('{{ $itemId }}')" aria-controls="collapse{{ $itemId }}">
            {{ $title }}
            {{ in_array($itemId, $accordionActive) }}
        </button>
    </h2>
    <div id="collapse{{ $itemId }}" class="accordion-collapse collapse {{ isset($accordionActive) && in_array($itemId, $accordionActive) ? 'show' : '' }}" aria-labelledby="heading{{ $itemId }}" data-bs-parent="#{{ $parentId }}" >
        <div class="accordion-body">
            {!! $slot !!}
        </div>
    </div>
</div>
