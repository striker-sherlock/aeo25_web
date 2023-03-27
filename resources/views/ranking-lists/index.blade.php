<x-layout>
    <style>
        .page-content {
            min-height: 100vh;
        }
        .bg-theme{
            background-color:#7fbcd2;
        }
    </style>
        <x-navbar></x-navbar>
        <main id="page-toggled" class="page-wrapper">
            <div class="page-content">
                <div class="container mt-4">
                    <div class="d-flex justify-content-center align-items-center flex-wrap" style="margin-top: 80px">
                        @foreach ($competitions as $competition)
                            @if ($competition->id == 'OBS')@continue @endif
                            <div class="btn btn-outline-theme {{ $selectedField->id == $competition->id ? 'bg-theme text-white' : '' }} mx-2 mb-3 p-2 rounded-circle">
                                <a class="text-decoration-none text-reset" href="{{route('ranking-lists.index', [$competition->id, "preliminary"])}}">
                                    <img src="/storage/competition_logo/{{ $competition->logo }}" alt="" class="img-fluid" width="50">
                                </a>
                            </div>
                        @endforeach
                    </div>
                    
                    <x-card>
                        <h3 class="text-uppercase fw-bold   text-gradient mb-4" style="letter-spacing: 0.1em">{{ $selectedField->name }} - Ranking List - {{ $selectedType->type_name }}</h3>
                        @foreach ($scoreTypes as $scoreType)
                            @if ($selectedField->id !== "DB" && $scoreType->id == 2  ) @continue @endif
                            @if ($selectedField->id == "DB" && $scoreType->id == 3) @continue @endif
                            <a class="btn {{ ($selectedType->id == $scoreType->id) ? 'btn-primary' : 'btn-outline-theme' }} me-2 mb-3" href="{{ route('ranking-lists.index', [$selectedField->id, $scoreType->scoreTypeName]) }}">{{ $scoreType->typeName }}</a>
                        @endforeach
                        @if ($rankingLists->count() > 0)
                            <div class="table-responsive py-2">
                                <table class="table table-sm table-striped table-bordered no-footer" id="dataTables">
                                    <thead class="thead-light">
                                    <tr>
                                        @if ($selectedField->id == 'DB')
                                            <th class="align-middle text-center">Status</th>                                    
                                        @else
                                            <th class="align-middle text-center">Rank</th>
                                        @endif
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
                                                    @if ($selectedField->id == 'DB')
                                                        <td>{{$ranking[0]->rank_name}}</td>
                                                    @else
                                                        <td>{{ $loop->iteration }}</td>
                                                    @endif
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
                                                                    <p>{{ $ranking[0]->score }}</p>
                                                                    {{-- <input type="text" name="score" value="" class="form-control rounded-50 "required readonly > --}}
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
                    </x-card>
            </div>
        </main>
    <x-footer></x-footer>
</x-layout>