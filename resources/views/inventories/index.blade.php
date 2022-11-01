<x-admin>
    <div class="container mt-4">
        <div class="card border-0 overflow-hidden shadow rounded-20 mb-5" style="border-radius:20px">
            <div class="card-header bg-secondary"></div>
            <div class="card-body my-3">
                <h1 class="text-primary text-center">Inventory List</h1>
                    <a class="btn btn-outline-primary rounded-pill  mt-2 mb-3 px-4" href="{{ route('inventories.create') }}">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New Item
                    </a>

                <table class="table table-bordered" id="inventoryTable">
                    <thead class="table-info">
                      <tr>
                        <th class="align-middle text-center">ID</th>
                        <th class="align-middle text-center">Item Name</th>
                        <th class="align-middle text-center">Quantity</th>
                        <th class="align-middle text-center">Borrowed By</th>
                        <th class="align-middle text-center">Borrowed From</th>
                        <th class="align-middle text-center">Status</th>
                        <th class="align-middle text-center">Location</th>
                        <th class="align-middle text-center">Additional Notes</th>
                        <th class="align-middle text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($inventories as $inventory)
                        <tr>
                            <th scope="row">{{ $inventory->id }}</th>
                            <td>{{ $inventory->item_name }}</td>
                            <td>{{ $inventory->qty }} </td>
                            <td>{{ $inventory->borrowed_by }} </td>
                            <td>{{ $inventory->borrowed_from }} </td>
                            <td>{{ $inventory->status }} </td>
                            <td>{{ $inventory->location }} </td>
                            <td>{{ $inventory->additional_notes }} </td>
                            <td class="d-flex justify-content-center">
                                <a class="btn btn-primary mx-2" href="{{ route('inventories.edit', $inventory->id) }}" title="Update Data">
                                    <i class="fa fa-edit"></i>
                                </a>
                           
            
                                <form method="post" action="{{ route('inventories.destroy', $inventory->id) }}" accept-charset="UTF-8" style="display:inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger  mx-2" title="Delete data" onclick="return confirm(&quot;Are you sure you want to delete this data?&quot;)">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                  </table>
                
                
           
                </div>


            </div>

        </div>
    </div>

</x-admin>