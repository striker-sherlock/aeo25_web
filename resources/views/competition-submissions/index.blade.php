<x-admin >
    <div class="container my-4">
        <x-card>
            <h3 class="fw-bold my-3 c-text-1 text-gradient">{{ $competition->name }} - Submitted List</h3>
            @if ($submittedParticipants->count() > 0)
              <a href="{{ route('competition-submissions.export', $competition->id) }}" class="btn btn-outline-success mb-4"><i class="fas fa-download me-2"></i>Download Submissions</a>
            @endif
            <hr>
            @if ($submittedParticipants->count() > 0)
              <div class="table-responsive py-3 ">
                <table class="table table-bordered table-sm table-striped no-footer dataTables" id="submissions">
                  <thead class="thead-light">
                    <tr class="text-center">
                      @if (!$competition->need_team)
                        <th scope="col" class="align-middle text-nowrap">Participant ID</th>
                      @endif
                      <th scope="col" class="align-middle text-nowrap">{{ ($competition->need_team) ? 'Team Name' : 'Participant Name' }}</th>
                      <th scope="col" class="align-middle text-nowrap">Submission Title</th>
                      <th scope="col" class="align-middle text-nowrap">Institution Name</th>
                      <th scope="col" class="align-middle text-nowrap">Country</th>
                      <th scope="col" class="align-middle text-nowrap">Submitted At</th>
                      <th scope="col" class="align-middle text-nowrap">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($submittedParticipants as $submission)
                      <tr class="text-center">
                        @if (!$competition->need_team)
                          <td class="align-middle text-nowrap">{{ $submission->participant_id }}</td>
                        @endif
                        <td class="align-middle text-nowrap">{{ $submission->name }}</td>
                        <td class="align-middle text-nowrap">{{ $submission->submission_title }}</td>
                        <td class="align-middle text-nowrap">{{ $submission->institution_name }}</td>
                        <td class="align-middle text-nowrap">{{ $submission->country_name }}</td>
                        <td class="align-middle text-nowrap">{{ $submission->created_at }}</td>
                        <td class="align-middle text-nowrap">
                          <div class="btn-toolbar flex-nowrap justify-content-center" role="toolbar" aria-label="Toolbar">
                            <div class="btn-group">
                                <a class="btn btn-sm btn-primary text-white me-2" href="{{ route('competition-submissions.show', $submission->submission_id) }}" title="View Submission" target="_blank" style="padding:4px 10px;"> <span class="fas fa-file-alt"></span></a>
                            </div>
                            <div class="btn-group" role="group" aria-label="link">
                              <form method="POST" action="{{ route('competition-submissions.destroy', $submission->submission_id) }}">
                                @csrf
                                @method('delete')
                                <button class = "btn  btn-warning me-2" type="submit" title="Move to Recycle Bin">
                                    <i class="fas fa-trash"></i>
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

  @if ($unpaidSubmissions)
    @if ($unpaidSubmissions->count() > 0)
      <section id="unpaidSubmission">
        <div class="container my-2">
            <x-card>
                <div class="title-line"></div>
                
                <h3 class="fw-bold my-3 c-text-1 text-gradient">{{ $competition->name }} - Submission List - Haven't Paid</h3>
                <div class="callout callout-danger card-shadow-sm">
                  <b>Important Notes!</b><br>
                  This list contains {{ $competition->name }} participants who <b>have submitted</b> their works but still <b>haven't finished</b> their payment process yet.
                </div>
                <hr>
                <div class="table-responsive py-2">
                  <table class="table table-bordered table-sm table-striped no-footer dataTables" id="unpaidSubmissions">
                    <thead class="thead-light">
                      <tr class="text-center">
                        <th scope="col" class="align-middle text-nowrap">Institution ID</th>
                        <th scope="col" class="align-middle text-nowrap">Institution Name</th>
                        <th scope="col" class="align-middle text-nowrap">{{ ($competition->need_team) ? 'Team Name' : 'Participant Name' }}</th>
                        <th scope="col" class="align-middle text-nowrap">PIC Name</th>
                        <th scope="col" class="align-middle text-nowrap">PIC Email</th>
                        <th scope="col" class="align-middle text-nowrap">PIC Phone Number</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($unpaidSubmissions as $submission)
                        <tr class="text-center">
                          <td class="align-middle text-nowrap">{{ $submission->institution_id }}</td>
                          <td class="align-middle text-nowrap">{{ $submission->institution_name }}</td>
                          <td class="align-middle text-nowrap">{{ $submission->name }}</td>
                          <td class="align-middle text-nowrap">{{ $submission->pic_name }}</td>
                          <td class="align-middle text-nowrap">{{ $submission->pic_email }}</td>
                          <td class="align-middle text-nowrap">{{ $submission->pic_phone }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>

            </x-card>

        </div>
      </section>
    @endif
  @endif
  <section id="notSubmitList">
    <div class="container my-2">
        <x-card>
            <div class="title-line"></div>
          
          <h3 class="fw-bold my-3 c-text-1 text-gradient">{{ $competition->name }} - Not Submitted List</h3>
          <hr>
          @if ($notSubmittedParticipants->count() > 0)
            <div class="table-responsive py-2">
              <table class="table table-bordered table-sm table-striped no-footer dataTables" id="noSubmissions">
                <thead class="thead-light">
                  <tr class="text-center">
                    @if (!$competition->need_team)
                      <th class="align-middle text-nowrap">Participant ID</th>
                    @endif
                    <th scope="col" class="align-middle text-nowrap">{{ ($competition->need_team) ? 'Team Name' : 'Participant Name' }}</th>
                    <th scope="col" class="align-middle text-nowrap">PIC Name</th>
                    <th scope="col" class="align-middle text-nowrap">Institution Name</th>
                    <th scope="col" class="align-middle text-nowrap">Country</th>
                    <th scope="col" class="align-middle text-nowrap">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($notSubmittedParticipants as $participant)
                    <tr class="text-center">
                      @if (!$competition->need_team)
                        <td class="align-middle text-nowrap">{{ $participant->participant_id }}</td>
                      @endif
                      <td class="align-middle text-nowrap">{{ $participant->name }}</td>
                      <td class="align-middle text-nowrap">{{ $participant->pic_name }}</td>
                      <td class="align-middle text-nowrap">{{ $participant->institution_name }}</td>
                      <td class="align-middle text-nowrap">{{ $participant->country_name }}</td>
                      <td class="align-middle text-nowrap">
                        <div class="btn-toolbar flex-nowrap justify-content-center" role="toolbar" aria-label="Toolbar">
                          <div class="btn-group">
                            @if ($competition->need_team)
                              <a class="btn btn-sm btn-warning text-white" href="{{ route('competition-participants.edit', $participant->id) }}" title="Edit Team" target="_blank"> <span class="fas fa-user-edit"></span></a>
                            @else
                              <a class="btn btn-sm btn-warning text-white" href="{{ route('competition-participants.edit', $participant->id) }}" title="Edit Participant" target="_blank"> <span class="fas fa-user-edit"></span></a>
                            @endif
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
  </section>
  <section id="deletedSubmissionList">
    <div class="container my-2">
        <x-card>

            <div class="title-line"></div>
            
            <h3 class="fw-bold my-3 c-text-1 text-gradient">{{ $competition->name }} - Deleted Submission List</h3>
            <hr>
            @if ($deletedSubmissions->count() > 0)
              <div class="table-responsive py-2">
                <table class="table table-bordered table-sm table-striped no-footer dataTables" id="deletedSubmissions">
                  <thead class="thead-light">
                    <tr class="text-center">
                      <th scope="col" class="align-middle text-nowrap">{{ ($competition->need_team) ? 'Team Name' : 'Participant Name' }}</th>
                      <th scope="col" class="align-middle text-nowrap">PIC Name</th>
                      <th scope="col" class="align-middle text-nowrap">Institution Name</th>
                      <th scope="col" class="align-middle text-nowrap">Country</th>
                      <th scope="col" class="align-middle text-nowrap">Deleted At</th>
                      <th scope="col" class="align-middle text-nowrap">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($deletedSubmissions as $deleted)
                      <tr class="text-center">
                        <td class="align-middle text-nowrap">{{ $deleted->name }}</td>
                        <td class="align-middle text-nowrap">{{ $deleted->pic_name }}</td>
                        <td class="align-middle text-nowrap">{{ $deleted->institution_name }}</td>
                        <td class="align-middle text-nowrap">{{ $deleted->country_name }}</td>
                        <td class="align-middle text-nowrap">{{ $deleted->deleted_at }}</td>
                        <td class="align-middle text-nowrap">
                          <div class="btn-toolbar flex-nowrap justify-content-center" role="toolbar" aria-label="Toolbar">
                            <div class="btn-group">
                              <a class="btn btn-sm btn-success text-white me-2" href="{{ route('competition-submissions.restore', $deleted->submission_id) }}" title="Restore"> <span class="fas fa-trash-restore"></span></a>
                            </div>
                            <div class="btn-group" role="group" aria-label="link">
                       

                                <form method="POST" action="{{ route('competition-submissions.delete', $deleted->submission_id) }}" onsubmit="return confirm('Are you sure you want to permanently delete this data? this action cannot be undone');">
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
  </section>
  @foreach ($submittedParticipants as $submission)
      <div class="modal fade show pr-0" style="z-index: 9999;" tabindex="-1" id="destroySub-{{ $submission->submission_id }}" role="dialog" aria-labelledby="alertTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content rounded-20 border-0">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-12 mb-3 text-center">
                            <span class="fa-stack fa-4x">
                                <i class="fas fa-circle fa-stack-2x text-danger"></i>
                                <i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
                            </span>
                        </div>
                        <form action="{{ route('competition-submissions.destroy', $submission->submission_id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <div class="col-12 my-2 text-center">
                              <h4 class="fw-bold">Destroy Submission</h4>
                              <h5 class="font-weight-normal">Are you sure want to move this submission to recycle bin?</h5>
                              <button type="button" class="btn btn-outline-2 me-3 my-3 px-5 rounded-pill"
                                  data-bs-dismiss="modal">
                                  NO
                              </button>
                              <button type="submit" class="btn btn-danger text-white my-3 px-5 rounded-pill">
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
  @if ($deletedSubmissions->count() > 0)
    @foreach ($deletedSubmissions as $submission)
      <div class="modal fade show pr-0" style="z-index: 9999;" id="deleteSub-{{ $submission->submission_id }}" tabindex="-1" role="dialog"
        aria-labelledby="alertTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
              <div class="modal-content rounded-20 border-0">
                  <div class="modal-header border-bottom-0">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div class="row d-flex justify-content-center align-items-center">
                          <div class="col-12 mb-3 text-center">
                              <span class="fa-stack fa-4x">
                                  <i class="fas fa-circle fa-stack-2x text-danger"></i>
                                  <i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
                              </span>
                          </div>
                          <div class="col-12 my-2 text-center">
                              <h4 class="fw-bold">Delete Team</h4>
                              <h5 class="font-weight-normal">Are you sure to permanently delete this team?</h5>
                              <button type="button" class="btn btn-outline-2 me-3 my-3 px-5 rounded-pill"
                                  data-bs-dismiss="modal">
                                  NO
                              </button>
                              <a href="{{ route('competition-submissions.delete', $submission->submission_id) }}" class="btn btn-danger text-white my-3 px-5 rounded-pill">
                                  YES
                              </a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    @endforeach
  @endif

  @foreach ($submittedParticipants as $submission)
  <div class="modal fade p-5" id="move{{$submission->participant_id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered ">
          <div class="modal-content rounded-20 border-0 shadow p-5">
              <div class="modal-headers mb-4">
              <span class="fa-stack fa-4x d-block mx-auto" >
                  <i class="fas fa-circle fa-stack-2x text-danger"></i>
                  <i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
              </span>
              </div>
              <div class="body mb-3">
              <h1 class="fw-bold fs-3 text-center" > Are you sure want to move "<span class="fw-bolder text-danger">{{$submission->name}}</span>" to recycle bin ? </h1>
              </div>
              <div class="modal-footers">
                  <div class="row">
                  <div class="col">
                      <button type="button" class="btn btn-outline-secondary w-100  rounded-pill "  data-bs-dismiss="modal">Back</button>
                  </div>
                  <div class="col">
                      <form method="POST" action="{{route('competition-submissions.destroy',$submission->participant_id)}}">
                      <input type="hidden" name="_method" value = "DELETE">
                          <button class="btn btn-outline-danger  rounded-pill w-100 " title="delete">
                          Move
                          </button>
                      @csrf
                      </form>
                  </div>
                  </div>  
              </div>
          </div>
      </div>  
  </div>  
  @endforeach
</x-admin>


