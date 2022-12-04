

<x-admin>
    <div class="container mt-4">
        <div class="card border-0 overflow-hidden shadow  mb-5" style="border-radius:20px">
            <div class="card-header bg-secondary"></div>
            <div class="card-body my-3">
                <h3 class="text-uppercase fw-bold display-6 text-gradient mb-4" style="letter-spacing: 0.1em">Frequently Asked Question</h3>
                <a class="btn btn-outline-primary rounded-pill  mt-2 mb-3 px-4"
                    href= "{{ route('faqs.create') }}" >
                    <i class="fa fa-plus" aria-hidden="true"></i> Add New F.A.Q
                </a>

                <table class="table table-bordered" id="FAQTable">
                    <thead class="table-info">
                        <tr>
                            <th class="align-middle text-center">ID</th>
                            <th class="align-middle text-center">Question</th>
                            <th class="align-middle text-center">Answer</th>
                            <th scope="col" class="align-middle text-center">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($faqs as $faq)
                            <tr>
                                <td class="align-middle text-center">
                                    {{ $faq->id }}  </td>
                                <td class="align-middle text-center">
                                    {{ $faq->question }}  </td>
                                <td class="align-middle text-center">
                                    {{ $faq->answer }}  </td>
                                <td class="align-middle">
                                    <div class="btn-toolbar flex-nowrap justify-content-center" role="toolbar"
                                        aria-label="Toolbar">
                                        <div class="btn-group me-2" role="group" aria-label="link">
                                            <a class="btn btn-warning text-white rounded me-2"
                                                href= "/faqs/{{ $faq->id }}/edit"
                                                title="Edit">
                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                            </a>

                                            <form method="post" action="/faqs/{{ $faq->id }}" accept-charset="UTF-8" style="display:inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger  mx-2" title="Delete data" onclick="return confirm(&quot;Are you sure you want to delete this data?&quot;)">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
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


        </div>

    </div>
    </div>
</x-admin>