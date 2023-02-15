<x-layout>
    <style>
        .page-content {
            min-height: 100vh;
        }
    </style>
    <x-navbar-user></x-navbar-user> 
        <main id="page-toggled" class="page-wrapper">
            <x-sidebar-user></x-sidebar-user>
            <div class="page-content">
                <div class="container mt-4">
                    <div class="d-flex justify-content-center align-items-center flex-wrap" style="margin-top: 80px">
                        @foreach ($competitions as $competition)
                            <div class="btn btn-outline-theme {{ $selectedField->id == $competition->id ? 'bg-primary text-white' : '' }} mx-2 mb-3 p-2">
                                <a class="text-decoration-none text-reset" href="{{route('ranking-lists.index', [$competition->id, "preliminary"])}}">
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
                                <a class="btn {{ ($selectedType->id == $scoreType->id) ? 'btn-primary' : 'btn-outline-theme' }} me-2" href="{{ route('ranking-lists.manage', [$selectedField->id, $scoreType->scoreTypeName]) }}">{{ $scoreType->typeName }}</a>
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
                                                                </td>
                                                            @endif
                                                            @if ($selectedField->id === "RD")
                                                                <td>
                                                                    <div class="d-inline-flex">
                                                                        <input type="text" name="score" value="{{ $ranking[0]->score }}" class="form-control rounded-50"required>
                                                                    </div>
                                                                </td>
                                                            @endif
                                                        @else
                                                            <td>{{ $ranking->participant_name}}</td>
                                                            <td>{{ $ranking->institution_name }}</td>
                                                            <td>{{ $ranking->score }}</td>
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
        </main>
    <x-footer></x-footer>
</x-layout>