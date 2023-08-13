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
                                            <button type="button" wire:click="newModul" class="btn btn-primary ms-2" data-bs-toggle="tooltip" data-placement="top" title="Detail data">
                                                New Data
                                            </button>
                                        @endif
                                        {{-- <a href="#!" class="btn btn-outline-white ms-2">Import</a>
                                        <a href="#!" class="btn btn-outline-white ms-2">Export</a> --}}
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div wire:loading.delay wire:target="mount">Processing ...</div>
                                    <div class="accordion" id="parrentId">
                                        @foreach ($tableData as $item)
                                        <x-items-accordion title="{{ $item->title }}" itemId="{{ $item->method }}" toggleAccordion="toggleAccordionParent" accordionActive="{{ $accordionActiveParent }}" parentId="parrentId">
                                            <table class="table table-bordered">
                                                <thead class="table-light">
                                                    <tr>
                                                        @foreach ($tableHead as $head)
                                                            <th scope="col">{{ $head }}</th>
                                                        @endforeach
                                                    <th scope="col" width="20%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        @foreach ($tableBody as $tdata)
                                                            <td>{{ $item->$tdata }}</td>
                                                        @endforeach
                                                        <td>
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
                                                    <tr>
                                                        <td >#</td>
                                                        <td colspan="4">Permission Name</td>
                                                        <td>
                                                            @if ($actCreate)
                                                                <button type="button" wire:click="newPermis('{{ $item->slug }}')" class="btn btn-primary btn-sm ms-2" data-bs-toggle="tooltip" data-placement="top" title="New Permission">
                                                                    New
                                                                </button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @foreach ($item->permisModule() as $permis)
                                                        <tr>
                                                            <th scope="row">{{ $loop->iteration }}</th>
                                                            <td colspan="4">{{ $permis['name'] }}</td>
                                                            <td>
                                                                @if ($actUpdate)
                                                                    <button type="button" wire:click="editPermission('{{ $permis['id'] }}', '{{ $item->slug }}')" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" data-placement="top" title="Edit data">
                                                                        Edit
                                                                    </button>
                                                                @endif
                                                                @if ($actDelete)
                                                                    <button type="button" wire:click="deleteConfirmPermission('{{ $permis['id'] }}', '{{ $item->slug }}')" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-placement="top" title="Delete data">
                                                                            Delete
                                                                        </button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @if ($actCreate)
                                                <button type="button" wire:click="newSub('{{ $item->id }}')" class="btn btn-primary ms-2" data-bs-toggle="tooltip" data-placement="top" title="New Sub Modul">
                                                    New Sub Modul
                                                </button>
                                            @endif
                                            @if ($item->childModule->count())
                                                <div class="accordion" id="parent-{{ $item->method }}" key='sub-{{ $item->id  }}'>
                                                    @foreach ($item->childModule()->get() as $sub)
                                                        <x-items-accordion title="{{ $sub->title }}" itemId="{{ $sub->method }}" toggleAccordion="toggleAccordionSub" accordionActive="{{ $accordionActiveSub }}" parentId="parent-{{ $item->method }}">
                                                            <table class="table table-bordered">
                                                                <thead class="table-light">
                                                                    <tr>
                                                                        @foreach ($tableHead as $head)
                                                                            <th scope="col">{{ $head }}</th>
                                                                        @endforeach
                                                                    <th scope="col" width="20%">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        @foreach ($tableBody as $tdata)
                                                                            <td>{{ $sub->$tdata }}</td>
                                                                        @endforeach
                                                                        <td>
                                                                            @if ($actUpdate)
                                                                                <button type="button" wire:click="edit('{{ $sub->id }}')" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" data-placement="top" title="Edit data">
                                                                                    Edit
                                                                                </button>
                                                                            @endif
                                                                            @if ($actDelete)
                                                                                <button type="button" wire:click="deleteConfirm('{{ $sub->id }}')" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-placement="top" title="Delete data">
                                                                                        Delete
                                                                                    </button>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td >#</td>
                                                                        <td colspan="4">Permission Name</td>
                                                                        <td>
                                                                            @if ($actCreate)
                                                                                <button type="button" wire:click="newPermis('{{ $sub->slug }}')" class="btn btn-primary btn-sm ms-2" data-bs-toggle="tooltip" data-placement="top" title="New Permission">
                                                                                    New
                                                                                </button>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    @foreach ($sub->permisModule() as $permis)
                                                                        <tr>
                                                                            <th scope="row">{{ $loop->iteration }}</th>
                                                                            <td colspan="4">{{ $permis['name'] }}</td>
                                                                            <td>
                                                                                @if ($actUpdate)
                                                                                    <button type="button" wire:click="editPermission('{{ $permis['id'] }}', '{{ $item->slug }}')" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" data-placement="top" title="Edit data">
                                                                                        Edit
                                                                                    </button>
                                                                                @endif
                                                                                @if ($actDelete)
                                                                                    <button type="button" wire:click="deleteConfirmPermission('{{ $permis['id'] }}', '{{ $item->slug }}')" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-placement="top" title="Delete data">
                                                                                            Delete
                                                                                        </button>
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </x-items-accordion>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </x-items-accordion>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('components.off-canvas')
    </main>
    <livewire:component.swal-alert />
</div>
