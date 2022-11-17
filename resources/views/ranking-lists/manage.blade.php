<x-admin>
    <div class="container mt-4">
        <div class="d-flex justify-content-center align-items-center flex-wrap">
            @foreach ($competitions as $competition)
                <div class="btn btn-outline-primary {{ $selectedField->id == $competition->id ? 'bg-primary text-white' : '' }} mx-2 mb-3 p-2">
                    <a class="text-decoration-none text-reset" href="{{route('ranking-lists.manage', [$competition->id, "preliminary"])}}">
                        {{ $competition->id }}
                    </a>
                </div>
            @endforeach
        </div>
      <div class="card border-0 overflow-hidden shadow rounded-20 mb-5" style="border-radius:20px">
          <div class="card-header bg-secondary"></div>
          <div class="card-body my-3">
            <h1>{{ $selectedField->name }} - Ranking List - {{ $selectedType->type_name }}</h1>
            @foreach ($scoreTypes as $scoreType)
                @if ($selectedField->id !== "DB" && $scoreType->id == 2)
                    @continue
                @endif
                <a class="btn {{ ($selectedType->id == $scoreType->id) ? 'btn-primary' : 'btn-outline-primary' }} me-2" href="{{ route('ranking-lists.manage', [$selectedField->id, $scoreType->scoreTypeName]) }}">{{ $scoreType->typeName }}</a>
            @endforeach
            @if ($rankingLists->count() > 0)
                <div class="table-responsive py-2">
                    <table class="table table-sm table-striped table-bordered no-footer" id="dataTables">
                        <thead class="thead-light">
                        <tr>
                            <th class="align-middle text-center">Rank</th>
                            @if ($selectedField->need_team)
                                <th class="align-middle text-center">Team</th>
                            @endif
                            <th class="align-middle text-center">{{ ($selectedField->need_team) ? 'Member' : 'Participant' }} Name</th>
                            <th class="align-middle text-center">Institution Name</th>
                            @if ($selectedField->id === "DB")
                                <th class="align-middle text-center">Debate Type</th>
                            @else
                                <th class="align-middle text-center">Score</th>
                            @endif
                            <th class="align-middle text-center">Status</th>
                            <th class="align-middle text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($rankingLists as $ranking)
                            @php
                                if ($selectedField->need_team)
                                    $competitionScoreId = $ranking[0]->id;
                                else
                                    $competitionScoreId = $ranking->id;
                            @endphp
                                <tr class="align-middle text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    @if ($selectedField->need_team)
                                        <td>{{ $ranking[0]->team_name }}</td>
                                        <td class="text-nowrap">
                                            @foreach ($ranking as $participantRanking)
                                                {{ $loop->iteration }}. {!! $participantRanking->participant_name !!}
                                            @endforeach
                                        </td>
                                        <td>{{ $ranking[0]->institution_name }}</td>
                                        @if ($selectedField->id === "DB")
                                            <td>
                                                @if ($ranking[0]->is_novice_debater == 1)
                                                    <span>NOVICE</span>
                                                @else
                                                    <span>MAIN</span>
                                                @endif
                                                <a href="{{ route('ranking-lists.update-debate-type', $ranking[0]->team_id) }}" class="btn btn-sm btn-warning text-white ms-2" title="Change Debate Type">
                                                    <span class="fas fa-exchange-alt"></span>
                                                </a>
                                            </td>
                                        @endif
                                        @if ($selectedField->id === "RD")
                                            <td>
                                                <form method="POST" action="{{route('ranking-lists.update-score', $competitionScoreId)}}" class="mb-0">
                                                    @csrf
                                                    @method("PUT")
                                                    <div class="d-inline-flex">
                                                        <input type="text" name="score" value="{{ $ranking[0]->score }}" class="form-control rounded-50"required>
                                                        <button class="btn btn-sm btn-warning ms-3 text-white"><i class="fas fa-edit"></i></button>
                                                    </div>
                                                </form>
                                            </td>
                                        @endif
                                        <td>{{ $ranking->status }}</td>
                                        <td class="align-middle">
                                            <div class="btn-toolbar flex-nowrap justify-content-center">
                                                @if (!str_contains($ranking->status, 'Passed to') && $ranking[0]->participant_rank_id < 8)
                                                    <div class="btn-group me-2">
                                                        <a class="btn btn-sm btn-danger text-white" href="{{ route('ranking-lists.update-team-score-type', [$competitionScoreId, $ranking[0]->team_id, "down"]) }}" title="Status Down">
                                                            <span class="fas fa-arrow-down"></span>
                                                        </a>
                                                    </div>
                                                    <div class="btn-group">
                                                        <a class="btn btn-sm btn-success text-white" href="{{ route('ranking-lists.update-team-score-type', [$competitionScoreId, $ranking[0]->team_id, "up"]) }}" title="Status Up">
                                                            <span class="fas fa-arrow-up"></span>
                                                        </a>
                                                    </div>
                                                @elseif ($ranking[0]->participant_rank_id == 8)
                                                    <div class="btn-group me-2">
                                                        <a class="btn btn-sm btn-danger text-white" href="{{ route('ranking-lists.update-team-score-type', [$competitionScoreId, $ranking[0]->team_id, "down"]) }}" title="Status Down">
                                                            <span class="fas fa-arrow-down"></span>
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                    @else
                                        <td>{{ $ranking->participant_name}}</td>
                                        <td>{{ $ranking->institution_name }}</td>
                                        <td>
                                            <form method="POST" action="{{route('ranking-lists.update-score', $competitionScoreId)}}" class="mb-0">
                                                @csrf
                                                @method("PUT")
                                                <div class="d-inline-flex">
                                                    <input type="number" name="score" value="{{ $ranking->score }}" class="form-control rounded-50"required>
                                                    <button class="btn btn-sm btn-warning ms-3 text-white"><i class="fas fa-edit"></i></button>
                                                </div>
                                            </form>
                                        </td>
                                        <td>{{ $ranking->status }}</td>
                                        <td class="align-middle">
                                            <div class="btn-toolbar flex-nowrap justify-content-center">
                                                @if (!str_contains($ranking->status, 'Passed to') && $ranking->participant_rank_id < 8)
                                                    <div class="btn-group me-2">
                                                        <a class="btn btn-sm btn-danger text-white" href="{{ route('ranking-lists.update-score-type', [$competitionScoreId, "down"]) }}" title="Status Down">
                                                            <span class="fas fa-arrow-down"></span>
                                                        </a>
                                                    </div>
                                                    <div class="btn-group">
                                                        <a class="btn btn-sm btn-success text-white" href="{{ route('ranking-lists.update-score-type', [$competitionScoreId, "up"]) }}" title="Status Up">
                                                            <span class="fas fa-arrow-up"></span>
                                                        </a>
                                                    </div>
                                                @elseif ($ranking->participant_rank_id == 8)
                                                    <div class="btn-group me-2">
                                                        <a class="btn btn-sm btn-danger text-white" href="{{ route('ranking-lists.update-score-type', [$competitionScoreId, "down"]) }}" title="Status Down">
                                                            <span class="fas fa-arrow-down"></span>
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center">No Data.</p>
            @endif
          </div>
      </div>
    </div>
</x-admin>