<x-admin>
    <div class="container mt-4">
        <a class="btn btn-outline-theme rounded-pill  mt-2 mb-3 px-4"
            href="{{ route('institution-contacts.create', $type) }}">
            <i class="fa fa-plus" aria-hidden="true"></i> Add New Contact
        </a>
        <div class="card border-0 overflow-hidden shadow rounded-20 mb-5" style="border-radius:20px">
            <div class="card-header bg-secondary"></div>
            <div class="card-body my-3">
                <h1 class="text-primary text-center ">Institution Contacts</h1>
                <h5 class="text-white "> <span class="bg-success p-2 mb-3 rounded">Valid Contacts</span> </h5>
                <br>
                <div class="table-responsive py-2">
                    <table class="InstitutionContactTable table table-bordered">
                        <thead class="table-info">
                            <tr>
                                <th class="align-middle text-center">PIC Name</th>
                                <th class="align-middle text-center">Institution Type</th>
                                <th class="align-middle text-center">Institution Name</th>
                                <th class="align-middle text-center">Location</th>
                                <th class="align-middle text-center">PIC Institution</th>
                                <th class="align-middle text-center">Email</th>
                                <th class="align-middle text-center">Phone Number</th>
                                <th class="align-middle text-center">IL</th>
                                <th class="align-middle text-center">FL</th>
                                <th class="align-middle text-center">WA</th>
                                <th class="align-middle text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($validInstitutions as $validInstitution)
                                <tr>
                                    <th scope="row">{{ $validInstitution->admin->name }}</th>
                                    <td>{{ $validInstitution->inst_type }} </td>
                                    <td>{{ $validInstitution->institution_name }} </td>
                                    <td>{{ $validInstitution->location }} </td>
                                    <td>{{ $validInstitution->pic_name }} </td>
                                    <td>{{ $validInstitution->email }} </td>
                                    <td>{{ $validInstitution->phone_number }} </td>
                                    <td>{{ $validInstitution->informal_letter_sent }} </td>
                                    <td>{{ $validInstitution->formal_letter_sent }} </td>
                                    <td>{{ $validInstitution->whatsapp_sent }} </td>

                                    <td class="d-flex justify-content-center">
                                        <a class="btn btn-primary mx-2"
                                            href="{{ route('institution-contacts.edit', ['type' => $type, 'id' => $validInstitution->id]) }}"
                                            title="Update Data">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>




            </div>


        </div>


        <div class="card border-0 overflow-hidden shadow rounded-20 mb-5" style="border-radius:20px">
            <div class="card-header bg-secondary"></div>
            <div class="card-body my-3">
                <h1 class="text-primary text-center ">Institution Contacts</h1>
                <h5 class="text-white"> <span class="bg-danger p-2 mb-3 rounded">Invalid Contacts</span> </h5>
                <br>

                <div class="table-responsive">
                    <table class="InstitutionContactTable table table-bordered">
                        <thead class="table-info">
                            <tr>
                                <th class="align-middle text-center">PIC Name</th>
                                <th class="align-middle text-center">Institution Type</th>
                                <th class="align-middle text-center">Institution Name</th>
                                <th class="align-middle text-center">Location</th>
                                <th class="align-middle text-center">PIC Institution</th>
                                <th class="align-middle text-center">Email</th>
                                <th class="align-middle text-center">Phone Number</th>
                                <th class="align-middle text-center">IL</th>
                                <th class="align-middle text-center">FL</th>
                                <th class="align-middle text-center">WA</th>
                                <th class="align-middle text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invalidInstitutions as $invalidInstitution)
                                <tr>
                                    <th scope="row">{{ $invalidInstitution->admin->name }}</th>
                                    <td>{{ $invalidInstitution->inst_type }} </td>
                                    <td>{{ $invalidInstitution->institution_name }} </td>
                                    <td>{{ $invalidInstitution->location }} </td>
                                    <td>{{ $invalidInstitution->pic_name }} </td>
                                    <td>{{ $invalidInstitution->email }} </td>
                                    <td>{{ $invalidInstitution->phone_number }} </td>
                                    <td>{{ $invalidInstitution->informal_letter_sent }} </td>
                                    <td>{{ $invalidInstitution->formal_letter_sent }} </td>
                                    <td>{{ $invalidInstitution->whatsapp_sent }} </td>

                                    <td class="d-flex justify-content-center">
                                        <a class="btn btn-primary mx-2"
                                            href="{{ route('institution-contacts.edit', ['type' => $type, 'id' => $invalidInstitution->id])   }}"
                                            title="Update Data">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>




            </div>


        </div>

    </div>
    </div>

</x-admin>
