<x-admin>
    <div class="container mt-4">
        <x-card>
            <h3 class="fw-bold my-3 c-text-1 text-gradient"> {{$competition->name}} Schedule List</h3>
            <hr>
            <a class="btn btn-md my-2   btn-outline-1" href="{{ route('schedules.create') }}"><i
                    class="fas fa-plus me-2"></i>Insert New Schedule</a>
            @if ($schedules->count() > 0)
                <div class="table-responsive py-2">
                    <table class="table table-bordered table-striped table-sm dataTables" id="schedules">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th class="align-middle text-center">ID</th>
                                <th class="align-middle text-center">Event Name</th>
                                <th class="align-middle text-center">Start Time</th>
                                <th class="align-middle text-center">End Time</th>
                                <th class="align-middle text-center">Duration</th>
                                <th scope="col" class="align-middle text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $schedule)
                                @php
                                    
                                    $startTime = \Carbon\Carbon::parse($schedule->start_time);
                                    $endTime =  \Carbon\Carbon::parse($schedule->end_time);
                                    $duration = $startTime->longAbsoluteDiffForHumans($endTime);
                                    
                                @endphp
                                <tr>
                                    <td class="align-middle text-center">{{ $schedule->id }}</td>
                                    <td class="align-middle text-center">{{ $schedule->event_name }}</td>
                                    <td class="align-middle text-center">{{ $schedule->start_time }}</td>
                                    <td class="align-middle text-center">{{ $schedule->end_time }}</td>
                                    <td class="align-middle text-center">{{ $duration }}</td>
                                    <td class="align-middle">
                                        <div class="btn-toolbar flex-nowrap justify-content-center" role="toolbar"
                                            aria-label="Toolbar">
                                            <div class="btn-group me-2" role="group" aria-label="link">
                                                <a class="btn btn-sm btn-warning btn-block text-white"
                                                    href="{{ route('schedules.edit', $schedule) }}" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group" role="group" aria-label="link">
                                                <form action="{{ route('schedules.destroy', $schedule->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger text-white" title="Delete">
                                                        <span class="fa fa-trash">
                                                        </span>
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
            @else
                <p class="text-center">No Data</p>
            @endif

        </x-card>
        <x-card>
            <h3 class="fw-bold my-3 c-text-1 text-gradient">Deleted {{$competition->name}} Schedule List</h3>
            <hr>
            @if ($deletedSchedules->count() > 0)
                <div class="table-responsive py-2">
                    <table class="table table-bordered table-striped table-sm dataTables" id="deletedSchedules">
                        <thead class="thead-light">
                            <th class="align-middle text-center">ID</th>
                            <th class="align-middle text-center">Event Name</th>
                            <th class="align-middle text-center">Event Start</th>
                            <th class="align-middle text-center">Event End</th>
                            <th class="align-middle text-center">Deleted At</th>
                            <th scope="col" class="align-middle text-center">Action</th>
                        </thead>
                        <tbody>
                            @foreach ($deletedSchedules as $deletedSchedule)
                                <tr>
                                    <td class="align-middle text-center">{{ $deletedSchedule->id }}</td>
                                    <td class="align-middle text-center">{{ $deletedSchedule->event_name }}</td>
                                    <td class="align-middle text-center">{{ $deletedSchedule->start_time }}</td>
                                    <td class="align-middle text-center">{{ $deletedSchedule->end_time }}</td>
                                    <td class="align-middle text-center">{{ $deletedSchedule->deleted_at }}</td>
                                    <td class="align-middle">
                                        <div class="btn-toolbar flex-nowrap justify-content-center" role="toolbar"
                                            aria-label="Toolbar">
                                            <div class="btn-group me-2">
                                                <a class="btn btn-sm btn-success text-white me-6"
                                                    href="{{ route('schedules.restore', $deletedSchedule->id) }}"
                                                    title="Restore"><span class="fa fa-trash-restore"></span></a>
                                            </div>
                                            <div class="btn-group ps-2">
                                                <form method="POST"
                                                    action="{{ route('schedules.delete', $deletedSchedule->id) }}"
                                                    onsubmit="return confirm('Are you sure you want to permanently delete this data? this action cannot be undone');">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-sm btn-danger text-white" title="Delete">
                                                        <span class="fas fa-trash"></span>
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
            @else
                <p class="text-center">No Data</p>
            @endif

        </x-card>

    </div>
</x-admin>
{{-- Modal For Delete Confirmation --}}
@foreach ($schedules as $schedule)
    <div class="modal fade show pr-0" style="z-index: 9999;" id="deleteSchedule{{ $schedule->id }}" tabindex="-1"
        role="dialog" aria-labelledby="alertTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content rounded-20 border-0">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-12 mb-3 text-center">
                            <span class="fas fa-exclamation-triangle fa-6x text-danger">
                            </span>
                        </div>
                        <form action="{{ route('schedules.destroy', $schedule) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="col-12 my-2 text-center">
                                <h5 class="font-weight-normal">Are you sure to Delete Schedule ID -
                                    <strong>{{ $schedule->id }}</strong>?</h5>
                                <button type="button" class="btn btn-outline-2 me-3 my-3 px-5 mx-2 rounded-20"
                                    data-bs-dismiss="modal">
                                    NO
                                </button>
                                <button type="submit" class="btn btn-danger text-white my-3 px-5 mx-2 rounded-20">
                                    YES
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

@foreach ($deletedSchedules as $deletedSchedule)
    <div class="modal fade show pr-0" style="z-index: 9999;" id="deletePermanentSchedule{{ $deletedSchedule->id }}"
        tabindex="-1" role="dialog" aria-labelledby="alertTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content rounded-20 border-0">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-12 mb-3 text-center">
                            <span class="fas fa-exclamation-triangle fa-6x text-danger">
                            </span>
                        </div>
                        <form action="{{ route('schedules.delete', $deletedSchedule) }}" method="GET">
                            @csrf
                            <div class="col-12 my-2 text-center">
                                <h5 class="font-weight-normal">Are you sure to Delete Permanent Schedule ID -
                                    <strong>{{ $deletedSchedule->id }}</strong>?</h5>
                                <button type="button" class="btn btn-outline-2 me-3 my-3 px-5 mx-2 rounded-20"
                                    data-bs-dismiss="modal">
                                    NO
                                </button>
                                <button type="submit" class="btn btn-danger text-white my-3 px-5 mx-2 rounded-20">
                                    YES
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
