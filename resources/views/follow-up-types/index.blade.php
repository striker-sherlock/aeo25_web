<x-admin>
    <div class="container mt-4">
        <div class="card border-0 overflow-hidden shadow rounded-20 mb-5" style="border-radius:20px">
            <div class="card-header bg-secondary"></div>
            <div class="card-body my-3">
                <h1 class="text-primary text-center">Follow Up Type</h1>
                <a class="btn btn-outline-theme rounded-pill  mt-2 mb-3 px-4"
                    href="{{ route('follow-up-types.create') }}">
                    <i class="fa fa-plus" aria-hidden="true"></i> Add New Follow Up Type
                </a>
                <div class="table-responsive py-2">
                    <table class="table table-bordered" >
                        <thead class="table-info">
                            <tr>
                                <th class="align-middle text-center">ID</th>
                                <th class="align-middle text-center">Name</th>
                                <th class="align-middle text-center">Action</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($followUpTypes as $followUpType)
                                <tr>
                                    <th scope="row">{{ $followUpType->id }}</th>
                                    <td>{{ $followUpType->name }}</td>
                                    <td class="d-flex justify-content-center">
                                        <a class="btn btn-primary mx-2"
                                            href="{{ route('follow-up-types.edit', $followUpType->id) }}" title="Update Data">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <form method="post" action="{{ route('follow-up-types.destroy', $followUpType->id) }}"
                                            accept-charset="UTF-8" style="display:inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger  mx-2" title="Delete data"
                                                onclick="return confirm(&quot;Are you sure you want to delete this data?&quot;)">
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
    </div>
</x-admin>
