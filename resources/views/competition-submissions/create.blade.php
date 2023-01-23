<x-user title="Competition Submission">
  <div class="container mt-5">
      <h1 class="aeo-title">Step 4</h1>
      <h3 class="text-uppercase fw-bold display-6 text-gradient mb-4" style="letter-spacing: 0.1em">
          {{ $competition->name }} Submission</h3>

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
                                      <th scope="col" class="align-middle">{{ $competition->is_team ? 'Team Name' : 'Submitter Name' }} </th>
                                      <th scope="col" class="align-middle">Title</th>
                                      <th scope="col" class="align-middle">Submitted At</th>
                                      <th scope="col" class="align-middle">Submission</th>
                                  </tr>
                              </thead>
                              <tbody class="text-center">
                                  @foreach ($submitters as $submitter)
                                      @if ($competition->is_team)
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
                                                          class="btn btn-outline-1 " target="_blank"
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
                                                          class="btn btn-outline-1 " target="_blank">View
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
          </div>
          @else
          @if ($submissionCounter != $submitters->count())
          <x-card>
                    <form action="{{ route('competition-submissions.store') }}" 
                    method="POST" 
                    enctype="multipart/form-data" 
                    id="form"
                    onsubmit="return confirm('You can only submit your work once! Are you sure you want to send your submission?');"
                    >
                    <input type="hidden" value="{{ $competition->id }}" name="competition_id">
                    @csrf
                    @method('POST')
                      <h3 class="text-uppercase fw-bold text-gradient" style="letter-spacing: 0.1em">{{ $competition->name }} Participant
                      </h3>
                      <hr>
                      <div class="form-group">
                          @if ($competition->is_team)
                              <div class="mb-3">
                                  <label for="submitter_id" class="form-label">Team Name<span
                                          class="text-danger">*</span></label>
                                  <select class="form-select " name="submitter_id" required>
                                      <option selected="0">Select Team</option>
                                      @foreach ($submitters as $submitter)
                                          @if ($submitter->teamSubmission)
                                              @continue
                                          @else
                                              <option value="{{ $submitter->id }}" class="" name="submitter_id"
                                                  required>{{ $submitter->name }}</option>
                                          @endif
                                      @endforeach
                                  </select>
                              </div>
                          @else
                              <div class="mb-3">
                                  <label for="submitter_id" class="form-label">Participant Name<span
                                          class="text-danger">*</span></label>
                                  <select class="form-select " name="submitter_id" required>
                                      <option selected="0" disabled>Select participant</option>
                                      @foreach ($submitters as $submitter)
                                          @if ($submitter->participantSubmission)
                                              @continue
                                          @else
                                              <option value="{{ $submitter->id }}" class="" name="submitter_id"
                                                  required>{{ $submitter->name }}</option>
                                          @endif
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
                              <button type="submit" id="btnConfirmSubmit" class="btn c-button-1">Send Submission</button>
                          </div>
                      </div>
                  </x-card>
              </form>
          @endif
      
          @endif


      <div class="modal fade show pr-0" style="z-index: 9999;" id="confirmSubmission" tabindex="-1" role="dialog"
          aria-labelledby="alertTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content rounded-20 border-0">
                  <div class="modal-header border-bottom-0">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                              <h5 class="font-weight-normal">You can only submit your work once! Are you sure you want to send
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