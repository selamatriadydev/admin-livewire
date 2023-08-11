<div class="offcanvas offcanvas-end {{ $showOffcanvas ? 'show' : '' }}">
    <div class="offcanvas-header">
      <h5 id="offcanvasRightLabel">New Role</h5>
      <button type="button" class="btn-close text-reset" wire:click="hideOffcanvas"  data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form >
            <!-- Input -->
            @foreach ($OffcanvasForm as $item)
                <div class="mb-3">
                    <label class="form-label" for="textInput">{{ $item['title'] }}</label>
                        @switch($item['type'])
                            @case('option')
                                    <select wire:model.lazy="{{ $item['model'] }}" class="form-control">
                                        @foreach ($item['data'] as $opt)
                                            <option value="{{ $opt['value'] }}"> {{ $opt['text'] }}</option>
                                        @endforeach
                                    </select>
                                @break
                            @case('textarea')
                                <textarea wire:model.lazy="{{ $item['model'] }}" class="form-control"></textarea>
                                @break
                            @case('number')
                                <input type="number" class="form-control" placeholder="Input {{ $item['title'] }}" wire:model.lazy="{{ $item['model'] }}">
                                @break
                            @default
                            <input type="{{ $item['type'] }}" class="form-control" {{ isset($item['readonly']) ? $item['readonly'] : '' }} placeholder="Input {{ $item['title'] }}" wire:model.lazy="{{ $item['model'] }}">
                        @endswitch
                    @error($item['model']) <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            @endforeach
        </form>
    </div>
    <div class="offcanvas-footer">
        <button type="button" wire:click.prevent="{{ $activeOffcanvasAction }}" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" wire:click="hideOffcanvas" data-bs-dismiss="offcanvas" aria-label="Close">Close</button>
    </div>
</div>