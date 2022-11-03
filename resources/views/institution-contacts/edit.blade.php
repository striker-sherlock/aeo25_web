<x-admin>
    <div class="container mt-4">
        <div class="card border-0 overflow-hidden shadow rounded-20 mb-5" style="border-radius:20px">
            <div class="card-header bg-secondary"></div>
            <div class="card-body my-3">
                <div class="my-2">
                    <a class="" href="{{ route('institution-contacts.index') }}" title="Back to Main Menu">
                        <i class="fas fa-arrow-circle-left fa-2x"></i>
                    </a>

                </div>
                <h3 class="fw-bold  text-primary ">Institution Contact</h3>
                <h6> Edit Contact</h6>
                <form method="POST" action="{{ route('institution-contacts.update', $institution_contact->id) }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="admin_id" class="">Admin ID</label>
                        <input type="number" class="form-control" name="admin_id" value="10" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="division" class="">Division <span class="text-danger">*</span> </label>
                        <select name="division" class="form-select " required>
                            <option value="NR">National Registration</option>
                            <option value="IR">International Registration</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="inst_type">Institution Type <span class="text-danger">*</span></label>
                        <select name="inst_type" class="form-select " required>
                            <option value="UNI">University</option>
                            <option value="SHS">Senior High School</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="institution_name" class="">Institution Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="institution_name" required
                            value="{{ $institution_contact->institution_name }}">
                    </div>

                    <div class="mb-3">
                        <label for="location" class="">Location <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="location" required
                            value="{{ $institution_contact->location }}">
                    </div>
                    <div class="mb-3">
                        <label for="pic_name" class="">PIC <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="pic_name" required
                            value="{{ $institution_contact->pic_name }}">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="">Email <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="email" required
                            value="{{ $institution_contact->email }}">
                    </div>

                    <div class="mb-3">
                        <label for="phone_number" class="">Phone Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="phone_number" required
                            value="{{ $institution_contact->phone_number }}">
                    </div>

                    <div class="mb-3">
                        <label for="informal_letter_sent" class="">Informal Letter Sent <span
                                class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="informal_letter_sent" min="0" required
                            value="{{ $institution_contact->informal_letter_sent }}">
                    </div>

                    <div class="mb-3">
                        <label for="formal_letter_sent" class="">Formal Letter Sent <span
                                class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="formal_letter_sent" min="0" required
                            value="{{ $institution_contact->formal_letter_sent }}">
                    </div>

                    <div class="mb-3">
                        <label for="whatsapp_sent" class="">Whatsapp Sent <span class="text-danger">*</span>
                        </label>
                        <input type="number" class="form-control" name="whatsapp_sent" min="0" required
                            value="{{ $institution_contact->whatsapp_sent }}">
                    </div>

                    <div class="mb-3">
                        <p>Contact Status <span class="text-danger">*</span> </p>
                        <div class="row">
                            <div class="col-6 d-grid" >
                                <input type="radio" class="btn-check  " name="is_valid" id="1"
                                    autocomplete="off" value="1"
                                    {{ $institution_contact->is_valid ? 'checked' : '' }}>
                                <label class="btn btn-outline-success" for="1">Valid</label>

                            </div>

                            <div class="col-6 d-grid">
                                <input type="radio" class="btn-check  " name="is_valid" id="0"
                                    autocomplete="off" value="0"
                                    {{ !$institution_contact->is_valid ? 'checked' : '' }}>
                                <label class="btn btn-outline-danger " for="0">Invalid</label>


                            </div>

                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="reason" class="">Reason <span class="text-danger">*</span> </label>
                        <textarea class="form-control" name="reason" rows="3"> {{ $institution_contact->reason }} </textarea>

                    </div>
                    <div class="mb-3">
                        <label for="additional_notes" class="">Additional Notes </label>
                        <textarea class="form-control" name="additional_notes" rows="3"> {{ $institution_contact->additional_notes }} </textarea>

                    </div>
                    @method('PUT')
                    <button type="submit" class="btn btn-outline-primary rounded-pill w-100">Submit</button>
                </form>

            </div>

        </div>
    </div>

</x-admin>
