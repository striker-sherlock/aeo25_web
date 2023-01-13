<x-admin >
    <div class="container my-4">
        <div class="row justify-content-center align-items-center">
          <div class="col-12 col-lg-10">
            <x-card>
                <h3 class="fw-bold my-3 c-text-1 text-gradient">{{ $submission->competition->name }} - Submission Detail - ID: {{ $submission->id }}</h3>
                <hr>
                @if ($submission->competition->is_team)
                  <label for="title" class="form-label">Team Name</label>
                  <div class="input-group mb-3">
                    <input class="form-control" type="text" name="title" value="{{ $submission->teamSubmitter->name }}" style="border-radius: 20px 0 0 20px" disabled readonly>
                    <a href="{{ route('competition-participants.edit-team', $submission->teamSubmitter->id) }}"class="btn btn-outline-1" style="border-radius: 0 20px 20px 0 !important" target="_blank"><i class="fas fa-search mx-1"></i> View Team</a>
                  </div>
                @else
                  <div class="mb-3">
                    <label for="title" class="form-label">Participant Name</label>
                    <input class="form-control " type="text" name="title" value="{{ $submission->participantSubmitter->name }}"disabled readonly>
                  </div>
                @endif
                <div class="mb-3">
                  <label for="title" class="form-label">Title</label>
                  <input class="form-control " type="text" name="title" value="{{ $submission->title }}" disabled readonly>
                </div>
                <div class="mb-3">
                  <label for="submission_link" class="form-label">Submission Link</label>
                  <input class="form-control " type="url" id="submission_link"name="submission_link" value="{{ $submission->submission_link }}" disabled readonly>
                </div>
                <div class="d-grid mt-4">
                  <a href="{{ $submission->submission_link }}" class="btn btn-outline-1 rounded-50 text-uppercase" target="_blank">View Submission</a>
                </div>
            </x-card>
          </div>
        </div>

    </div>

  </x-admin>