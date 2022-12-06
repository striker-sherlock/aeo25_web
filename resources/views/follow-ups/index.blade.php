<x-admin>
    <div class="container mt-4">
        <x-card>
            <h3 class="text-uppercase fw-bold display-6 text-gradient mb-4" style="letter-spacing: 0.1em">Follow ups </h3>
            @if ($type == 'national')
                <a class="btn btn-outline-theme rounded-pill  mt-2 mb-3 px-4"
                    href="{{ route('follow-ups.create', 'national') }}">
                    <i class="fa fa-plus" aria-hidden="true"></i> Create New Follow Up
                </a>
                <h3 class="text-start text-dark">National Registration</h3>
            @else
                <a class="btn btn-outline-theme rounded-pill  mt-2 mb-3 px-4"
                    href="{{ route('follow-ups.create', 'international') }}">
                    <i class="fa fa-plus" aria-hidden="true"></i> Create New Follow Up
                </a>
                <h3 class="text-start text-dark">International Registration</h3>
            @endif

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-pending-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-pending" type="button" role="tab" aria-controls="nav-pending"
                        aria-selected="true">Pending</button>
                    <button class="nav-link" id="nav-on-progress-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-on-progress" type="button" role="tab"
                        aria-controls="nav-on-progress" aria-selected="false">On
                        Progress</button>
                    <button class="nav-link" id="nav-done-tab" data-bs-toggle="tab" data-bs-target="#nav-done"
                        type="button" role="tab" aria-controls="nav-done" aria-selected="false">Done</button>
                    <button class="nav-link" id="nav-deleted-tab" data-bs-toggle="tab" data-bs-target="#nav-deleted"
                        type="button" role="tab" aria-controls="nav-deleted"
                        aria-selected="false">Deleted</button>
                </div>

            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-pending" role="tabpanel"
                    aria-labelledby="nav-pending-tab" tabindex="0">

                    <hr>
                    <div class="table-responsive py-2">
                        <table class="FollowUpTable table table-bordered">
                            <thead class="table-info">
                                <tr>
                                    <th class="align-middle text-center">ID</th>
                                    <th class="align-middle text-center">Priority</th>
                                    <th class="align-middle text-center">Institution Name</th>
                                    <th class="align-middle text-center">PIC Name</th>
                                    <th class="align-middle text-center">Type</th>
                                    <th class="align-middle text-center">Created At</th>
                                    <th scope="col" class="align-middle text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($followUps as $followUp)
                                    @if ($followUp->status == 1)
                                        <tr class="text-center">
                                            <td class="align-middle text-wrap">{{ $followUp->id }}</td>
                                            @if ($followUp->priority == 1)
                                                <td class="align-middle text-wrap">Low</td>
                                            @elseif($followUp->priority == 2)
                                                <td class="align-middle text-wrap">Medium</td>
                                            @elseif($followUp->priority == 3)
                                                <td class="align-middle text-wrap">High</td>
                                            @endif
                                            <td class="align-middle text-wrap" style="width: 13rem;">
                                                {{ $followUp->user->institution_name }}</td>
                                            <td class="align-middle text-wrap" style="width: 13rem;">
                                                {{ $followUp->user->pic_name }}</td>
                                            <td class="align-middle text-wrap" style="width: 6rem;">
                                                {{ ucwords(strtolower($followUp->type->name)) }}</td>
                                            <td class="align-middle">{{ $followUp->created_at }}</td>
                                            <td class="align-middle">
                                                <div class="btn-toolbar flex-nowrap justify-content-center"
                                                    role="toolbar" aria-label="Toolbar">
                                                    <div class="btn-group me-2">
                                                        <a class="btn btn-sm btn-primary text-white me-6"
                                                            href="{{ route('follow-ups.edit', $followUp) }}"
                                                            title="Assign  Follow Up"><span
                                                                class="fa fa-eye"></span></a>
                                                    </div>
                                                    <div class="btn-group" role="group" aria-label="link">
                                                        <form method="post"
                                                            action="{{ route('follow-ups.destroy', $followUp->id) }}"
                                                            accept-charset="UTF-8" style="display:inline">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger  mx-2"
                                                                title="Delete data"
                                                                onclick="return confirm(&quot;Are you sure you want to delete this data?&quot;)">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="tab-pane fade" id="nav-on-progress" role="tabpanel"
                    aria-labelledby="nav-on-progress-tab" tabindex="0">
                    <hr>
                    <div class="table-responsive">
                        <table class="FollowUpTable table table-bordered" id="OnProgressFollowUpTable">
                            <thead class="table-info">
                                <tr>
                                    <th class="align-middle text-center">ID</th>
                                    <th class="align-middle text-center">Priority</th>
                                    <th class="align-middle text-center">Institution Name</th>
                                    <th class="align-middle text-center">PIC Name</th>
                                    <th class="align-middle text-center">Type</th>
                                    <th class="align-middle text-center">Assigned To</th>
                                    <th class="align-middle text-center">Created At</th>
                                    <th scope="col" class="align-middle text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($followUps as $followUp)
                                    @if ($followUp->status == 2)
                                        <tr class="text-center">
                                            <td class="align-middle text-wrap">{{ $followUp->id }}</td>
                                            @if ($followUp->priority == 1)
                                                <td class="align-middle text-wrap">Low</td>
                                            @elseif($followUp->priority == 2)
                                                <td class="align-middle text-wrap">Medium</td>
                                            @elseif($followUp->priority == 3)
                                                <td class="align-middle text-wrap">High</td>
                                            @endif
                                            <td class="align-middle text-wrap" style="width: 13rem;">
                                                {{ $followUp->user->institution_name }}</td>
                                            <td class="align-middle text-wrap" style="width: 13rem;">
                                                {{ $followUp->user->pic_name }}</td>
                                            <td class="align-middle text-wrap" style="width: 13rem;">
                                                {{ $followUp->type->name }}</td>
                                            <td class="align-middle text-wrap" style="width: 13rem;">
                                                {{ $followUp->pic->name }}</td>
                                            <td class="align-middle text-wrap">{{ $followUp->created_at }}</td>
                                            <td class="align-middle">
                                                <div class="btn-toolbar flex-nowrap justify-content-center"
                                                    role="toolbar" aria-label="Toolbar">
                                                    <div class="btn-group me-2">
                                                        <a class="btn btn-sm btn-primary text-white me-6"
                                                            href="{{ route('follow-ups.edit', $followUp) }}"
                                                            title="View Follow Up"><i class="fa fa-pen-to-square" aria-hidden="true"></i></a>
                                                    </div>
                                                    <div class="btn-group" role="group" aria-label="link">
                                                        <form method="post"
                                                            action="{{ route('follow-ups.destroy', $followUp->id) }}"
                                                            accept-charset="UTF-8" style="display:inline">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger  mx-2"
                                                                title="Delete data"
                                                                onclick="return confirm(&quot;Are you sure you want to delete this data?&quot;)">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                            </button>
                                                        </form>

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="tab-pane fade" id="nav-done" role="tabpanel" aria-labelledby="nav-done-tab"
                    tabindex="0">
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="DoneFollowUpTable">
                            <thead class="table-info">
                                <tr>
                                    <th class="align-middle text-center">ID</th>
                                    <th class="align-middle text-center">Institution Name</th>
                                    <th class="align-middle text-center">PIC Name</th>
                                    <th class="align-middle text-center">Type</th>
                                    <th class="align-middle text-center">Creator</th>
                                    <th class="align-middle text-center">Completed At</th>
                                    <th scope="col" class="align-middle text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($followUps as $followUp)
                                    @if ($followUp->status == 3)
                                        <tr class="text-center">
                                            <td class="align-middle text-wrap">{{ $followUp->id }}</td>
                                            <td class="align-middle text-wrap" style="width: 13rem;">
                                                {{ $followUp->user->institution_name }}</td>
                                            <td class="align-middle text-wrap" style="width: 13rem;">
                                                {{ $followUp->user->pic_name }}</td>
                                            <td class="align-middle text-wrap" style="width: 6rem;">
                                                {{ ucwords(strtolower($followUp->type->name)) }}</td>
                                            <td class="align-middle text-wrap" style="width: 13rem;">
                                                {{ $followUp->creator->name }}</td>
                                            <td class="align-middle text-wrap">{{ $followUp->updated_at }}</td>
                                            <td class="align-middle">
                                                <div class="btn-toolbar flex-nowrap justify-content-center"
                                                    role="toolbar" aria-label="Toolbar">
                                                    <div class="btn-group me-2">
                                                        <a class="btn btn-sm btn-info text-white"
                                                            href="{{ route('follow-ups.show', $followUp) }}"
                                                            title="View Follow Up"><i
                                                                class="fas fa-search"></i></a>
                                                    </div>
                                                    <form method="post"
                                                        action="{{ route('follow-ups.destroy', $followUp->id) }}"
                                                        accept-charset="UTF-8" style="display:inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger  mx-2"
                                                            title="Delete data"
                                                            onclick="return confirm(&quot;Are you sure you want to delete this data?&quot;)">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="tab-pane fade" id="nav-deleted" role="tabpanel" aria-labelledby="nav-deleted-tab"
                    tabindex="0">
                    <hr>
                    <div class="table-responsive">
                        <table class="FollowUpTable table table-bordered">
                            <thead class="table-info">
                                <tr>
                                    <th class="align-middle text-center">ID</th>
                                    <th class="align-middle text-center">Priority</th>
                                    <th class="align-middle text-center">Institution Name</th>
                                    <th class="align-middle text-center">PIC Name</th>
                                    <th class="align-middle text-center">Type</th>
                                    <th class="align-middle text-center">Deleted At</th>
                                    <th scope="col" class="align-middle text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deletedfollowUps as $deletedfollowUp)
                                    <tr class="text-center">
                                        <td class="align-middle text-center">{{ $deletedfollowUp->id }}</td>
                                        @if ($deletedfollowUp->priority == 1)
                                            <td class="align-middle text-center">Low</td>
                                        @elseif($deletedfollowUp->priority == 2)
                                            <td class="align-middle text-center">Medium</td>
                                        @elseif($deletedfollowUp->priority == 3)
                                            <td class="align-middle text-center">High</td>
                                        @endif
                                        <td class="align-middle text-center">
                                            {{ $deletedfollowUp->user->institution_name }}</td>
                                        <td class="align-middle text-center">
                                            {{ $deletedfollowUp->user->pic_name }}</td>
                                        <td class="align-middle text-center">
                                            {{ ucwords(strtolower($deletedfollowUp->type->name)) }}</td>
                                        <td class="align-middle text-center">{{ $deletedfollowUp->deleted_at }}
                                        </td>
                                        <td class="align-middle">
                                            <div class="btn-toolbar flex-nowrap justify-content-center"
                                                role="toolbar" aria-label="Toolbar">
                                                <div class="btn-group me-2">
                                                    <a class="btn btn-sm btn-primary text-white me-6"
                                                        href="{{ route('follow-ups.restore', $deletedfollowUp) }}"
                                                        title="Restore Follow Up"><span
                                                            class="fa fa-trash-restore"></span></a>
                                                </div>
                                                <div class="btn-group" role="group" aria-label="link">
                                                    <a class="btn btn-sm btn-block btn-danger text-white"
                                                        href="{{ route('follow-ups.delete', $deletedfollowUp->id) }}"
                                                        onclick="return confirm('Are you sure you want to Permanently Delete this data?')"
                                                        style="margin-inline: 0.4vw"><i class="fa fa-trash"
                                                            aria-hidden="true"></i>
                                                    </a>


                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </x-card>
            </div>


        </div>


    </div>

</x-admin>
