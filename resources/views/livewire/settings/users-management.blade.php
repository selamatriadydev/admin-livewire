<div>
    <div class="bg-primary pt-10 pb-21"></div>
    <div class="container-fluid mt-n22 px-6">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Page header -->
                <div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="mb-2 mb-lg-0">
                            <h3 class="mb-0  text-white">Users</h3>
                        </div>
                        <div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb " >
                                  <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                                  <li class="breadcrumb-item"><a class="text-white" href="#">Manajemen Aplikasi</a></li>
                                  <li class="breadcrumb-item active" aria-current="page">Users</li>
                             </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <x-box-card title="Ditambahkan Bulan ini" total="{{ $user_now }}"/>
            <x-box-card title="Jumlah online" total="8"/>
            <x-box-card title="Jumlah aktif" total="8"/>
            <x-box-card title="Jumlah tidak aktif" total="8"/>
        </div>
        <!-- row  -->
        <div class="row mt-6">
            <div class="col-md-12 col-12">
                <!-- card  -->
                <div class="card">
                    <!-- card header  -->
                    <div class="card-header">
                        <div class="row">
                            <div class=" col-lg-3 col-md-6">
                                <input type="search" class="form-control" wire:model="filterName" placeholder="Cari Nama">
                            </div>
                            <div class="col-lg-4 col-md-6 d-flex align-items-center mt-3 mt-md-0">
                                <label class="form-label me-2 mb-0">Status</label>
                                <select class="form-select" wire:model="filterStatus" aria-label="Default select example">
                                    <option value="">All</option>
                                    <option value="1">Offline</option>
                                    <option value="2">Online</option>
                                </select>
                            </div>
                            <div class="col-lg-5 text-lg-end mt-3 mt-lg-0">
                                @if ($actCreate)
                                    <a href="#!" wire:click="toggleOffcanvas" class="btn btn-primary me-2" data-bs-toggle="tooltip" data-placement="top" title="New data">+ Add New Data</a>
                                @endif
                                <a href="#!" class="btn btn-light ">Export</a>
                                @if (count($selectedItems))
                                    <a href="#!" class="btn btn-danger " wire:click="deleteSelectedItemsConfirm" data-bs-toggle="tooltip" data-placement="top" title="Delete Selected data">Delete Selected {{ count($selectedItems) }} Data</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- table  -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" width="6%">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" wire:model="checkAll" id="checkAll">
                                                <label class="form-check-label" for="checkAll"></label>
                                            </div>
                                        </th>
                                        <th scope="col" width="5%">#</th>
                                        @foreach ($tableHead as $head)
                                            <th scope="col">{{ $head }}</th>
                                        @endforeach
                                        <th scope="col" width="20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $item)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" wire:model="selectedItems.{{ $item->id }}" id="checkbox{{ $item->id }}" wire:click="toggleCheckbox('{{ $item->id }}')">
                                                    <label class="form-check-label" for="checkbox{{ $item->id }}"></label>
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
                    </div>
                    <!-- card footer  -->
                    <div class="card-footer bg-white text-center">
                        {{ $users->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('components.off-canvas')
    <livewire:component.swal-alert />
</div>
@push('scripts')
    <script>
    </script>
@endpush
