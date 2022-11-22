<x-admin>
    <div class="container mt-4">
        <div class="card border-0 overflow-hidden shadow  mb-5" style="border-radius:20px">
            <div class="card-header bg-secondary"></div>
            <div class="card-body my-3">
                <h1 class="text-primary text-center">Access Controls</h1>
                <a class="btn btn-outline-primary rounded-pill  mt-2 mb-3 px-4"
                    href="{{ route('access-controls.create') }}">
                    <i class="fa fa-plus" aria-hidden="true"></i> Add New Access Control
                </a>

                <table class="table table-bordered" id="AccessControlTable">
                    <thead class="table-info">
                        <tr>
                            <th class="align-middle text-center">ID</th>
                            <th class="align-middle text-center">Access Name</th>
                            <th class="align-middle text-center">Admin</th>
                            <th scope="col" class="align-middle text-center">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($accessControls as $accessControl)
                            <tr>
                                <td class="align-middle text-center">
                                    {{ $accessControl->id }}</td>
                                <td class="align-middle text-center">
                                    {{ $accessControl->access->name }}</td>
                                <td class="align-middle text-center">
                                    {{ $accessControl->admin->name }}</td>
                                <td class="align-middle">
                                    <div class="btn-toolbar flex-nowrap justify-content-center" role="toolbar"
                                        aria-label="Toolbar">
                                        <div class="btn-group me-2" role="group" aria-label="link">
                                            <a class="btn btn-warning text-white rounded me-2"
                                                href="{{ route('access-controls.edit', $accessControl->id) }}"
                                                title="Edit">
                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                            </a>

                                            <form method="post" action="{{ route('access-controls.destroy', $accessControl->id) }}" accept-charset="UTF-8" style="display:inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger  mx-2" title="Delete data" onclick="return confirm(&quot;Are you sure you want to delete this data?&quot;)">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
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
