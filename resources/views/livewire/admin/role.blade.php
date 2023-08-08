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
                        <!-- Page header -->
                            <div class="mb-5">
                                <h3 class="mb-0">Role</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-12">
                        <div class="card">
                        <div class="card-header d-md-flex border-bottom-0">
                            <div class="flex-grow-1">
                                <h5 class="card-title h3">Manajemen Role</h5>
                            </div>
                            <div class="mt-3 mt-md-0">
                                @if ($actCreate)
                                    <a href="#!" class="btn btn-primary ms-2" wire:click="toggleOffcanvas"> New Data </a>
                                @endif
                                <a href="#!" class="btn btn-outline-white ms-2">Import</a>
                                <a href="#!" class="btn btn-outline-white ms-2">Export</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-card" >
                                <table class="table">
                                    <thead >
                                        <tr>
                                            <th scope="col">#</th>
                                            @foreach ($tableHead as $head)
                                                <th scope="col">{{ $head }}</th>
                                            @endforeach
                                        <th scope="col" width="20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tableData as $data)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                    @foreach ($tableBody as $tdata)
                                                        <td>{{ $data->$tdata }}</td>
                                                    @endforeach
                                                    <td>
                                                        @if ($actDetail)
                                                            <a  href="#!" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-placement="top"
                                                            title="Tooltip on top">
                                                                Detail
                                                            </a>
                                                        @endif
                                                        @if ($actUpdate)
                                                            <a wire:click="edit('{{ $data->id }}')" href="#!" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" data-placement="top"
                                                            title="Tooltip on top">
                                                                Edit
                                                            </a>
                                                        @endif
                                                        @if ($actDelete)
                                                            <a wire:click="deleteConfirm('{{ $data->id }}')" href="#!" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-placement="top"
                                                                title="Tooltip on top">
                                                                    Delete
                                                                </a>
                                                        @endif
                                                    </td>
                                            </tr>
                                        @endforeach
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
        <div id="offcanvasRight" class="offcanvas offcanvas-end {{ $showOffcanvas ? 'show' : '' }}">
            <div class="offcanvas-header">
              <h5 id="offcanvasRightLabel">New Role</h5>
              <button type="button" class="btn-close text-reset" wire:click="hideOffcanvas"  data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <form >
                    <!-- Input -->
                    <div class="mb-3">
                        <label class="form-label" for="textInput">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Input Name" wire:model.lazy="name">
                        @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </form>
            </div>
            <div class="offcanvas-footer">
                <button type="button" wire:click.prevent="{{ $showOffcanvasAction }}" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" wire:click="hideOffcanvas" data-bs-dismiss="offcanvas" aria-label="Close">Close</button>
            </div>
        </div>
    </main>
</div>

@push('script')
    <script type="text/javascript">
        // window.livewire.on('userStore', () => {
        //     $('body').css();
        //     $('#offcanvasRight').removeClass('show');
        //     // $('#exampleModal').modal('hide');
        // });
        window.addEventListener('swal:alert', event => { 
            swal({
                title: event.detail.message,
                text: event.detail.text,
                icon: event.detail.type,
            });
        });
        window.addEventListener('swal:confirm', event => { 
            swal({
                title: event.detail.message,
                text: event.detail.text,
                icon: event.detail.type,
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.livewire.emit('deleteData', event.detail.id);
                }
            });
        });
    </script>
@endpush