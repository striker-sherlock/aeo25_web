<x-admin>
    <div class="container mt-4">
        <div class="card border-0 overflow-hidden shadow rounded-20 mb-5" style="border-radius:20px">
            <div class="card-header bg-secondary"></div>
            <div class="card-body my-3">
                <div class="my-2">
                    <a class="col-form-label" href="{{ route('institution-contacts.index', $type) }}" title="Back to Main Menu">
                        <i class="fas fa-arrow-circle-left fa-2x"></i>
                    </a>

                </div>
                <h3 class="fw-bold  text-primary ">Institution Contact</h3>
                <h6> Edit Contact</h6>
                <form method="POST" action="{{ route('institution-contacts.update', $institutionContact->id) }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="admin_id" class="col-form-label">PIC Name</label>
                        <select name="admin_id" class="form-select " >
                                <option value={{ $institutionContact->admin->id }}>
                                    {{  $institutionContact->admin->name}}
                                </option>
                        </select>
                    </div>


                    <div class="mb-3">
                        <label for="division" class="col-form-label">Division <span class="text-danger">*</span>
                        </label>
                        <select name="division" class="form-select " required>
                            <option value="NR" @if ($institutionContact->division == 'NR') selected @endif>National Registration</option>
                            <option value="IR" @if ($institutionContact->division == 'IR') selected @endif>International Registration</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="inst_type">Institution Type <span class="text-danger">*</span></label>
                        <select name="inst_type" class="form-select " required>
                            <option value="UNI" @if ($institutionContact->inst_type == 'UNI') selected @endif>University</option>
                            <option value="SHS" @if ($institutionContact->inst_type == 'SHS') selected @endif>Senior High School</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="institution_name" class="col-form-label">Institution Name <span
                                class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="institution_name" required
                            value="{{ $institutionContact->institution_name }}">
                    </div>

                    <div class="mb-3">
                        <label for="location" class="col-form-label">Location <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="location" required
                            value="{{ $institutionContact->location }}">
                    </div>
                    <div class="mb-3">
                        <label for="pic_name" class="col-form-label">PIC <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="pic_name" required
                            value="{{ $institutionContact->pic_name }}">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="col-form-label">Email <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="email" required
                            value="{{ $institutionContact->email }}">
                    </div>

                    <div class="mb-3">
                        <label for="phone_number" class="col-form-label">Phone Number <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="phone_number" required
                            value="{{ $institutionContact->phone_number }}">
                    </div>

                    <div class="mb-3">
                        <label for="informal_letter_sent" class="col-form-label">Informal Letter Sent <span
                                class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="informal_letter_sent" min="0" required
                            value="{{ $institutionContact->informal_letter_sent }}">
                    </div>

                    <div class="mb-3">
                        <label for="formal_letter_sent" class="col-form-label">Formal Letter Sent <span
                                class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="formal_letter_sent" min="0" required
                            value="{{ $institutionContact->formal_letter_sent }}">
                    </div>

                    <div class="mb-3">
                        <label for="whatsapp_sent" class="col-form-label">Whatsapp Sent <span
                                class="text-danger">*</span>
                        </label>
                        <input type="number" class="form-control" name="whatsapp_sent" min="0" required
                            value="{{ $institutionContact->whatsapp_sent }}">
                    </div>

                    <div class="mb-3">
                        <p>Contact Status <span class="text-danger">*</span> </p>
                        <div class="row">
                            <div class="col-6 d-grid">
                                <input type="radio" class="btn-check  " name="is_valid" id="1"
                                    autocomplete="off" value="1"
                                    {{ $institutionContact->is_valid ? 'checked' : '' }}>
                                <label class="btn btn-outline-success" for="1">Valid</label>

                            </div>

                            <div class="col-6 d-grid">
                                <input type="radio" class="btn-check  " name="is_valid" id="0"
                                    autocomplete="off" value="0"
                                    {{ !$institutionContact->is_valid ? 'checked' : '' }}>
                                <label class="btn btn-outline-danger " for="0">Invalid</label>


                            </div>

                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="reason" class="col-form-label">Reason <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control" name="reason" rows="3"> {{ $institutionContact->reason }} </textarea>

                    </div>
                    <div class="mb-3">
                        <label for="additional_notes" class="col-form-label">Additional Notes </label>
                        <textarea class="form-control" name="additional_notes" rows="3"> {{ $institutionContact->additional_notes }} </textarea>

                    </div>
                    @method('PUT')
                    <button type="submit" class="btn btn-outline-primary rounded-pill w-100">Submit</button>
                </form>

            </div>

        </div>
    </div>

</x-admin>
