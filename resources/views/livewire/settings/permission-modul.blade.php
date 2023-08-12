<div>
    <button type="button" wire:click="createPermis('{{ $modulSlug }}')" class="btn btn-primary ms-2" data-bs-toggle="tooltip" data-placement="top" title="Detail data">
        New Permission
    </button>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th scope="col" width="5%">#</th>
                <th scope="col">Name</th>
                <th scope="col" width="20%">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permission as $item)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $item->name }}</td>
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
            @endforeach
        </tbody>
    </table>
</div>
