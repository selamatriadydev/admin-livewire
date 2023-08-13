<div>
    <main id="main-wrapper" class="main-wrapper">
        <livewire:component.header />
         <!-- Sidebar -->
         <livewire:component.sidebar />
        <!-- Page Content -->
        <div id="app-content">
            <div class="app-content-area">
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
                                              <li class="breadcrumb-item"><a class="text-white" href="#">Library</a></li>
                                              <li class="breadcrumb-item active" aria-current="page">Data</li>
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
                                <div class="card-header d-md-flex border-bottom-0">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title h3">Manajemen Role</h5>
                                    </div>
                                    <div class="mt-3 mt-md-0">
                                        @if ($actCreate)
                                            <button type="button" wire:click="toggleOffcanvas" class="btn btn-primary ms-2" data-bs-toggle="tooltip" data-placement="top" title="Detail data">
                                                New Data
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                <!-- table  -->
                                <div class="table-responsive">
                                    <table class="table text-nowrap mb-0">
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
                                            @forelse ($users as $item)
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
                                <!-- card footer  -->
                                <div class="card-footer bg-white text-center">
                                    {{ $users->links() }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@push('scripts')
    <script>
    </script>
@endpush
