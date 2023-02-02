<x-user title="Competition Submission">
    <div class="container mt-5">
        <h1 class="aeo-title">Step 4</h1>
        <h3 class="text-uppercase fw-bold display-6 text-gradient mb-4" style="letter-spacing: 0.1em">
            {{ $competition->name }} Submission</h3>

        @if ($competition->need_team)
            <x-card>
                <h3 class="my-3 fw-bold c-text-1 text-uppercase text-gradient">{{ $competition->name }} Team Members</h3>
                <hr>
                <div class="table-responsive py-3">
                    <table class="table table-bordered">
                        <thead class="text-center">
                            <tr class="text-center fw-bold text-uppercase">
                                <th class="align-middle">team name</th>
                                <th class="align-middle">details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($submitters as $team)
                        
                                <tr class="text-center">
                                    <td class="align-middle text-center">{{ $team->name }}</td>
                                    <td class="align-middle text-center">
                                        <div class="btn-toolbar flex-nowrap justify-content-center" role="toolbar"
                                            aria-label="Toolbar">
                                            <div class="btn-group me-2" role="group" aria-label="link">
                                                <a class="btn btn-sm btn-info text-white"
                                                    href="{{route('competition-participants.show',[Auth::user()->id,'RD'])}}" title="View Details"> <span
                                                        class="fa fa-eye"></span></a>
                                            </div>
                                            
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </x-card>

        @endif


        <x-card>
            <form action="{{ route('competition-submissions.store') }}" method="POST"
                enctype="multipart/form-data" id="form"
                onsubmit="return confirm('You can only submit your work once! Are you sure you want to send your submission?');">
                <input type="hidden" value="{{ $competition->id }}" name="competition_id">
                @csrf
                @method('POST')
                <h3 class="text-uppercase fw-bold text-gradient" style="letter-spacing: 0.1em">
                    {{ $competition->name }} Participant
                </h3>
                <hr>
                <div class="form-group">
                    @if ($competition->need_team)
                        <div class="mb-3">
                            <label for="submitter_id" class="form-label">Team Name<span
                                    class="text-danger">*</span></label>
                            <select class="form-select " name="submitter_id" required>
                                <option selected="0">Select Team</option>
                                @foreach ($submitters as $submitter)
                                        <option value="{{ $submitter->id }}"  class="" name="submitter_id"
                                            required {{$submitter->teamSubmission ? 'disabled' :''}}>{{ $submitter->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @else
                        <div class="mb-3">
                            <label for="submitter_id" class="form-label">Participant Name<span
                                    class="text-danger">*</span></label>
                            <select class="form-select " name="submitter_id" required>
                                <option selected="0">Select participant</option>
                                @foreach ($submitters as $submitter)
                                        <option value="{{ $submitter->id }}" class="" name="submitter_id"
                                            required {{$submitter->participantSubmission ? 'disabled' : ''}}>{{ $submitter->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="title" class="form-label">Title<span class="text-danger">*</span></label>
                        <input class="form-control " type="text" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="submission_link" class="form-label">Submission Link<span
                                class="text-danger">*</span></label>
                        <input class="form-control " type="url"
                            placeholder="e.g. https://docs.google.com/document/d/1_gq4pRAMxL63"
                            id="submission_link"name="submission_link" required>
                    </div>
                    <div class="d-grid my-4">
                        <button type="submit" id="btnConfirmSubmit" class="btn   btn-outline-theme rounded-pill">Send
                            Submission</button>
                    </div>
                </div>
            </form>
        </x-card>


        @if ($submissionCounter > 0)
            <x-card>
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="title-line"></div>
                        <h3 class="my-3 fw-bold c-text-1 text-uppercase text-gradient">Submitted Work(s)</h3>
                        <hr>
                        <div class="title-line mx-auto"></div>
                        <div class="table-responsive py-2 mt-3">
                            <table class="table table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col" class="align-middle">
                                            {{ $competition->need_team ? 'Team Name' : 'Submitter Name' }} </th>
                                        <th scope="col" class="align-middle">Title</th>
                                        <th scope="col" class="align-middle">Submitted At</th>
                                        <th scope="col" class="align-middle">Submission</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($submitters as $submitter)
                                        @if ($competition->need_team)
                                            @if ($submitter->teamSubmission)
                                                <tr class="text-center">
                                                    <td class="align-middle text-center">{{ $submitter->name }}</td>
                                                    <td class="align-middle text-center">
                                                        {{ $submitter->teamSubmission->title }}</td>
                                                    <td class="align-middle text-center">
                                                        {{ date('M j, Y g:i a', strtotime($submitter->teamSubmission->created_at)) }}
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <a href="{{ $submitter->teamSubmission->submission_link }}"
                                                            class="btn btn-outline-1 rounded-pill " target="_blank"
                                                            rel="noreferrer">View Submission</a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @else
                                            @if ($submitter->participantSubmission)
                                                <tr class="text-center">
                                                    <td class="align-middle text-center">{{ $submitter->name }}</td>
                                                    <td class="align-middle text-center">
                                                        {{ $submitter->participantSubmission->title }}</td>
                                                    <td class="align-middle text-center">
                                                        {{ date('M j, Y g:i a', strtotime($submitter->participantSubmission->created_at)) }}
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <a href="{{ $submitter->participantSubmission->submission_link }}"
                                                            class="btn btn-outline-1 rounded-pill" target="_blank">View
                                                            Submission</a>
                                                        {{-- <button type="button" data-bs-toggle="modal" data-bs-target="#view-{{ $submitter->id }}" class="btn btn-outline-1  my-3">View Submission</button> --}}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </x-card>

        @endif


       
            
     
        <div class="modal fade show pr-0" style="z-index: 9999;" id="confirmSubmission" tabindex="-1"
            role="dialog" aria-labelledby="alertTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-20 border-0">
                    <div class="modal-header border-bottom-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row d-flex justify-content-center align-items-center">
                            <div class="col-12 mb-3 text-center">
                                <span class="fa-stack fa-4x align-items-center">
                                    <i class="fas fa-circle fa-stack-2x text-warning"></i>
                                    <i class="fas fa-exclamation fa-stack text-white"></i>
                                </span>
                            </div>
                            <div class="col-12 my-2 text-center">
                                <h4 class="fw-bold">Submission Confirmation</h4>
                                <h5 class="font-weight-normal">You can only submit your work once! Are you sure you
                                    want to send
                                    your submission?</h5>
                                <p class="mb-0">Please confirm your submission first by clicking the link below</p>
                                <div class="con my-2">
                                    <a href="" class="fs-5"id="confirmLink" target="_blank">Submission
                                        Link</a>
                                </div>
                                <button type="button" class="btn btn-outline-2 mx-3 px-5 rounded-20"
                                    data-bs-dismiss="modal">
                                    NO
                                </button>
                                <button type="button" id="sendSubmission" onClick="submit()"
                                    class="btn btn-success text-white my-3 px-5 rounded-20 btnSubmit">
                                    YES
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @foreach ($submitters as $team)
            <div class="modal fade p-5" id="team-{{$team->id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                {{-- <div class="modal-content rounded-20 border-0 shadow p-5">
                    <div class="modal-headers mb-4">
                    <span class="fa-stack fa-4x d-block mx-auto" >
                        <i class="fas fa-circle fa-stack-2x text-danger"></i>
                        <i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
                    </span>
                    </div>
                    <div class="body mb-3">
                    <h1 class="fw-bold fs-3 text-center" > Are you sure want to delete "<span class="fw-bolder text-danger">{{$team->name}}</span>"? </h1>
                    <p class="text-warning"> note: this action can't be undone  </p>
                    </div>
                    <div class="footers">
                        <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-secondary w-100"  data-bs-dismiss="modal">Back</button>
                        </div>
                        <div class="col">
                            <form method="POST" action="{{route('teams.destroy',$team->id)}}">
                            <input type="hidden" name="_method" value = "DELETE">
                                <button class="btn btn-danger rounded w-100" title="delete">
                                Delete
                                </button>
                            @csrf
                            </form>
                        </div>
                        </div>  
                    </div>
                </div> --}}
            </div>  
        </div>  
            
        @endforeach

        <script>
            $("#btnConfirmSubmit").on("click", function() {
                let submissionLink = $("#submission_link").val();
                $("#confirmLink").attr("href", submissionLink);
            })
            $(document).ready(function() {
                $("#sendSubmission").prop("disabled", true);
                $("#confirmLink").on("click", function() {
                    $("#sendSubmission").prop("disabled", false);
                })
            })

            function submit() {
                $("#form").submit();
            }
            $('.modal').insertAfter($('section'));
        </script>

</x-user>
