<div>
    <style>
        .offcanvas-footer{
            padding: 1rem 1rem;
            border-top: 1px solid #dee2e6;
        }
    </style>
    <div id="db-wrapper" class="main-wrapper">
        <livewire:component.sidebar />
        <div id="page-content">
            <livewire:component.header />
            <!-- Container fluid -->
            <div class="bg-primary pt-10 pb-21"></div>
            <div class="container-fluid mt-n22 px-6">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <!-- Page header -->
                        <div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mb-2 mb-lg-0">
                                    <h3 class="mb-0  text-white">Projects</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row  -->
                <div class="row mt-6">
                    <div class="col-md-12 col-12">
                        @if (session()->has('success'))
                        <!-- Dismissing alert -->
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Holy guacamole!</strong> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Holy guacamole!</strong> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <!-- card  -->
                        <div class="card">
                            <div class="card-header d-md-flex border-bottom-0">
                                <div class="flex-grow-1">
                                    <h4 class="mb-0">Role</h4>
                                  {{-- <a href="#!" class="btn btn-primary">+ Add Product</a> --}}
                                </div>
                                <div class="mt-3 mt-md-0">
                                  <a href="#!" class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip" data-template="settingOne">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings icon-xs"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                                    <div id="settingOne" class="d-none">
                                      <span>Setting</span>
                                    </div>
                                  </a>
                                  <a href="#!" class="btn btn-primary ms-2" wire:click="toggleOffcanvas">
                                    New Role
                                  </a>
            
                                  <a href="#!" class="btn btn-outline-white ms-2">Import</a>
                                  <a href="#!" class="btn btn-outline-white ms-2">Export</a>
                                </div>
                              </div>
                            <!-- table  -->

                            <!-- placement on bottom -->
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
                                        @foreach ($roleData as $role)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                    @foreach ($tableData as $data)
                                                        <td>{{ $role->$data }}</td>
                                                    @endforeach
                                                    <td>
                                                        <a  href="#!" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-placement="top"
                                                        title="Tooltip on top">
                                                            Detail
                                                        </a>
                                                        <a wire:click="edit('{{ $role->id }}')" href="#!" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" data-placement="top"
                                                        title="Tooltip on top">
                                                            Edit
                                                        </a>
                                                        <a wire:click="delete('{{ $role->id }}')" href="#!" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-placement="top"
                                                        title="Tooltip on top">
                                                            Delete
                                                        </a>
                                                    </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    </table>
                                    {{ $roleData->links() }}
                                </div>
                            </div>
                            <!-- card footer  -->
                            <div class="card-footer bg-white text-center">
                                <a href="#" class="link-primary">View All Projects</a>

                            </div>
                        </div>

                    </div>
                </div>
                <!-- row  -->
            </div>
        </div>
        <div id="offcanvasRight" class="offcanvas offcanvas-end {{ $showOffcanvas ? 'show' : '' }}">
            <div class="offcanvas-header">
              <h5 id="offcanvasRightLabel">New Role</h5>
              <button type="button" class="btn-close text-reset" wire:click="hideOffcanvas"  data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <form >
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Enter Name" wire:model.lazy="name">
                        @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </form>
            </div>
            <div class="offcanvas-footer">
                <button type="button" wire:click.prevent="{{ $showOffcanvasAction }}" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" wire:click="hideOffcanvas" data-bs-dismiss="offcanvas" aria-label="Close">Close</button>
            </div>
          </div>
    </div>
</div>

@push('script')
    <script type="text/javascript">
        window.livewire.on('userStore', () => {
            $('body').css();
            $('#offcanvasRight').removeClass('show');
            // $('#exampleModal').modal('hide');
        });
    </script>
@endpush