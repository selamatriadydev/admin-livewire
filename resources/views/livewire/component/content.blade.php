<div>
    <div class="app-content-area">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
              <!-- Page header -->
              <div class="mb-5">
                <h3 class="mb-0">{{ $title }}</h3>
              </div>
            </div>
          </div>
          <div>
            <!-- row -->
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header d-md-flex border-bottom-0">
                    <div class="flex-grow-1">
                      <a href="#!" class="btn btn-primary">+ Add Product</a>
                    </div>
                    <div class="mt-3 mt-md-0">
                        @if ($create)
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
                        {{ $tableData->links() }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
