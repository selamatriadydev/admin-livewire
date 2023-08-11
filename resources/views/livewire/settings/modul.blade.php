<div>
    <main id="main-wrapper" class="main-wrapper">
        <livewire:component.header />
         <!-- Sidebar -->
         <livewire:component.sidebar />
        <!-- Page Content -->
        <div id="app-content">
            <div class="app-content-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="mb-5">
                                <h3 class="mb-0">Module</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-md-flex border-bottom-0">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title h3">Manajemen Module</h5>
                                    </div>
                                    <div class="mt-3 mt-md-0">
                                        @if ($actCreate)
                                            <button type="button" wire:click="toggleOffcanvas" class="btn btn-primary ms-2" data-bs-toggle="tooltip" data-placement="top" title="Detail data">
                                                New Data
                                            </button>
                                        @endif
                                        @if (count($selectedItems))
                                            <button type="button" wire:click="deleteSelectedItemsConfirm" class="btn btn-danger ms-2" data-bs-toggle="tooltip" data-placement="top" title="Detail data">
                                                Delete Selected {{ count($selectedItems) }} Data
                                            </button>
                                        @endif
                                        {{-- <a href="#!" class="btn btn-outline-white ms-2">Import</a>
                                        <a href="#!" class="btn btn-outline-white ms-2">Export</a> --}}
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive table-card" >
                                        <table class="table table-bordered">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col" width="6%">Check</th>
                                                    <th scope="col" width="5%">#</th>
                                                    @foreach ($tableHead as $head)
                                                        <th scope="col">{{ $head }}</th>
                                                    @endforeach
                                                <th scope="col" width="20%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($tableData as $item)
                                                    <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" wire:model="selectedItems" value="{{ $item->id }}">
                                                            </div>
                                                        </td>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                            @foreach ($tableBody as $tdata)
                                                                <td>{{ $item->$tdata }}</td>
                                                            @endforeach
                                                            <td>
                                                                @if ($actDetail)
                                                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-placement="top" title="Detail data">
                                                                        Detail
                                                                    </button>
                                                                @endif
                                                                @if ($actUpdate)
                                                                    <button type="button" wire:click="edit('{{ $item->id }}')" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" data-placement="top" title="Edit data">
                                                                        Edit
                                                                    </button>
                                                                @endif
                                                                @if ($actDelete)
                                                                    <button type="button" wire:click="deleteConfirm('{{ $item->id }}')" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-placement="top" title="Delete data">
                                                                            Delete
                                                                        </button>
                                                                @endif
                                                            </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center">Data tidak tersedia</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    {{ $tableData->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="offcanvas offcanvas-end {{ $showOffcanvas ? 'show' : '' }}">
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
        </div> --}}
        @include('components.off-canvas')
    </main>
    <livewire:component.swal-alert />
</div>
