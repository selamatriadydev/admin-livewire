<div>
    <main id="main-wrapper" class="main-wrapper">
        <livewire:component.header />
         <!-- Sidebar -->
         <livewire:component.sidebar />
        <!-- Page Content -->
        <div id="app-content">
          <!-- Container fluid -->
          {{-- @livewire('component.content', [
            'title' => 'Role',
            'tableHead' => $tableHead,
            'tableBody' => $tableBody,
            'tableData' => $roleData,
          ]) --}}
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
              <div>
                <!-- row -->
                <div class="row">
                  <div class="col-12">
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
                    <div class="card">
                      <div class="card-header d-md-flex border-bottom-0">
                        <div class="flex-grow-1">
                          <a href="#!" class="btn btn-primary">+ Add Product</a>
                        </div>
                        <div class="mt-3 mt-md-0">
                            {{-- @if ($create) --}}
                                <a href="#!" class="btn btn-primary ms-2" wire:click="toggleOffcanvas"> New Data </a>
                            {{-- @endif --}}
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
                                                <a  href="#!" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-placement="top"
                                                title="Tooltip on top">
                                                    Detail
                                                </a>
                                                <a wire:click="edit('{{ $data->id }}')" href="#!" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" data-placement="top"
                                                title="Tooltip on top">
                                                    Edit
                                                </a>
                                                <a wire:click="delete('{{ $data->id }}')" href="#!" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-placement="top"
                                                title="Tooltip on top">
                                                    Delete
                                                </a>
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
      </main>
</div>