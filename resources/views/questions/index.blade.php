<x-admin title="Question List">
    <div class="container mt-4 ">
        <x-card class="my-2">
            <div class="title-line"></div> 
            <h5 class="subheading-text mt-3 text-primary">Question List</h5>
            <h3 class="fw-bold my-3 c-text-1 text-gradient-blue">Unanswered Questions</h3>
            <hr>
            @if (count($questions->where('is_responded', 0)) == 0)
                <div class="text-center">No Data</div>
            @else
                <div class="table-responsive py-3">
                    <table class="table table-bordered table-sm table-striped no-footer" id="unansweredQuestions">
                        <thead class="thead-light">
                            <th class="align-middle text-center">ID</th>
                            <th class="align-middle text-center">Name</th>
                            <th class="align-middle text-center">Country</th>
                            <th class="align-middle text-center">Phone number</th>
                            <th class="align-middle text-center">Question</th>
                            <th class="align-middle text-center">Email</th>
                            <th class="align-middle text-center">Action</th>
                        </thead>
                        <tbody>
                            @foreach ($questions as $question)
                                @if ($question->is_responded == 0)
                                    <tr>
                                        <td class="align-middle text-center">{{ $question->id }}</td>
                                        <td class="align-middle text-center">{{ $question->name }}</td>
                                        <td class="align-middle text-center">{{ $question->countries->name }}</td>
                                        <td class="align-middle text-center">{{ $question->phone_number }}</td>
                                        <td class="align-middle text-center d-flex justify-content-center">
                                            <button type="button" class="btn btn-sm btn-block btn-info" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $question->id }}">
                                                <i class="fas fa-question-circle text-white"></i>
                                            </button>
                                            <div class="modal fade" id="exampleModal{{ $question->id }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content rounded-20">
                                                        <div class="modal-header bg-white rounded-20">
                                                            <h5 id="exampleModalLabel">Question</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-start">
                                                            <div class="form-group row mb-0 mb-sm-3">
                                                                <label class="col-form-label text-sm-left">
                                                                    {{ $question->question }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">{{ $question->email }}</td>
                                        <td class="align-middle text-center d-flex justify-content-center">
                                            <a class="btn btn-sm btn-block btn-info mx-1"
                                                href="{{ route('questions.viewreply', $question) }}">
                                                <i class="fas fa-envelope-square"></i></button></a>  
                                            <form method="POST" action="{{ route('questions.destroy', $question->id) }}">
                                                @csrf
                                                <input type="hidden" name="_method" value='DELETE'>
                                                <button type="submit" class="btn btn-sm btn-block btn-danger text-white mx-1"
                                                onclick="return confirm('Are you sure you want to permanently delete the data?')">
                                                <i class="fa fa-trash" aria-hidden="true"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </x-card>
        
        <x-card class="my-2">
            <div class="title-line"></div> 
            <h5 class="subheading-text mt-3 text-primary">Question List</h5>
            <h3 class="fw-bold my-3 c-text-1 text-gradient-blue">Answered Questions</h3>
            <hr>
            <div class="table-responsive py-3">
                <table class="table table-bordered table-sm table-striped no-footer" id="answeredQuestions">
                    <thead class="thead-light">
                    <th class="align-middle text-center">ID</th>
                    <th class="align-middle text-center">Name</th>
                    <th class="align-middle text-center">Country</th>
                    <th class="align-middle text-center">Phone number</th>
                    <th class="align-middle text-center">Question</th>
                    <th class="align-middle text-center">Answer</th>
                    <th class="align-middle text-center">Email</th>
                    <th class="align-middle text-center">Responded by</th>
                    <th scope="col" class="align-middle text-center">Action</th>
                </thead>
                <tbody>
                    @foreach ($questions as $question)
                    @if ($question->is_responded == 1)
                        <tr>
                            <td class="align-middle text-center">{{ $question->id }}</td>
                            <td class="align-middle text-center">{{ $question->name }}</td>
                            <td class="align-middle text-center">{{ $question->countries->name }}</td>
                            <td class="align-middle text-center">{{ $question->phone_number }}</td>
                            <td class="align-middle text-center d-flex justify-content-center">
                                <button type="button" class="btn btn-sm btn-block btn-info btn-info" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{ $question->id }}">
                                    <i class="fas fa-question-circle text-white"></i>
                                </button>
    
                                <div class="modal fade" id="exampleModal{{ $question->id }}"
                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content rounded-20">
                                            <div class="modal-header bg-white rounded-20">
                                                <h5 id="exampleModalLabel">Question</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-start">
                                                <div class="form-group row mb-0 mb-sm-3">
                                                    <label class="col-form-label text-sm-left">
                                                        {{ $question->question }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle text-center ">
                                <button type="button" class="btn btn-sm btn-block btn-warning btn-warning" data-bs-toggle="modal"
                                data-bs-target="#answerModal{{ $question->id }}">
                               <i class="fa-solid fa-lightbulb"></i>
                            </button>

                            <div class="modal fade" id="answerModal{{ $question->id }}"
                                tabindex="-1" aria-labelledby="answerModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content rounded-20">
                                        <div class="modal-header bg-white rounded-20">
                                            <h5 id="answerModalLabel">Answer</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            <div class="form-group row mb-0 mb-sm-3">
                                                <label class="col-form-label text-sm-left">
                                                    {!! $question->answer !!}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            </td>
                           
                        <td class="align-middle text-center">{{ $question->email }}</td>
                            <td class="align-middle text-center">{{ $question->admin->name }}</td>
                            <td class="align-middle text-center d-flex justify-content-center">
                                <form method="POST" action="{{ route('questions.destroy', $question->id) }}">
                                    @csrf
                                    <input type="hidden" name="_method" value='DELETE'>
                                    <button type="submit" class="btn btn-sm btn-block btn-danger text-white"
                                    onclick="return confirm('Are you sure you want to permanently delete the data?')">
                                    <i class="fa fa-trash" aria-hidden="true"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
    
        </x-card>
    </div> 
  
</x-admin>