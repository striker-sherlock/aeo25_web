<x-admin>
    <div class="container mt-4">
        <div class="card border-0 overflow-hidden shadow rounded-20 mb-5" style="border-radius:20px">
            <div class="card-header bg-secondary"></div>
            <div class="card-body my-3">
                
                <h3 class="fw-bold  text-primary " >Institution Contact</h3>
                <h6> Add New Contact</h6>
                <form method="POST" action="{{ route('institution-contacts.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="admin_id" class="col-form-label">PIC Name</label>
                        <select name="admin_id" class="form-select ">
                            <option value="admin_id" selected disabled>Choose PIC</option>
                            @foreach ($admins as $admin)
                                <option value={{ $admin->id }}>
                                    {{ $admin->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="division" class="col-form-label">Division <span class="text-danger">*</span>
                        </label>
                        <select name="division" class="form-select"required>
                            <option value="NR" @if ($type == 'national') selected  @endif>National Registration</option>
                            <option value="IR" @if ($type == 'international') selected  @endif>International Registration</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="inst_type">Institution Type <span class="text-danger">*</span> </label>
                        <select name="inst_type" class="form-select " required>
                            <option value="UNI">University</option>
                            <option value="SHS">Senior High School</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="institution_name" class="col-form-label">Institution Name <span
                                class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="institution_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="location" class="col-form-label">Location <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="location" required>
                    </div>
                    <div class="mb-3">
                        <label for="pic_name" class="col-form-label">PIC Institution<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="pic_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="col-form-label">Email <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone_number" class="col-form-label">Phone Number <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="phone_number" required>
                    </div>

                    <div class="mb-3">
                        <label for="informal_letter_sent" class="col-form-label">Informal Letter Sent <span
                                class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="informal_letter_sent" min="0" required>
                    </div>

                    <div class="mb-3">
                        <label for="formal_letter_sent" class="col-form-label">Formal Letter Sent <span
                                class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="formal_letter_sent" min="0" required>
                    </div>

                    <div class="mb-3">
                        <label for="whatsapp_sent" class="col-form-label">Whatsapp Sent <span
                                class="text-danger">*</span>
                        </label>
                        <input type="number" class="form-control" name="whatsapp_sent" min="0" required>
                    </div>

                    <div class="mb-3">
                        <p>Contact Status <span class="text-danger">*</span> </p>
                        <div class="row">

                            <div class="col-6 d-grid">
                                <input type="radio" class="btn-check  " name="is_valid" id="1"
                                    autocomplete="off" value="1"
                                    >
                                <label class="btn btn-outline-success" for="1">Valid</label>

                            </div>

                            <div class="col-6 d-grid">
                                <input type="radio" class="btn-check  " name="is_valid" id="0"
                                autocomplete="off" value="0" >
                                <label class="btn btn-outline-danger " for="0">Invalid</label>


                            </div>

                        </div>
                     
                    </div>

                    <div class="mb-3">
                        <label for="reason" class="col-form-label">Reason <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control" name="reason" rows="3"></textarea>

                    </div>
                    <div class="mb-3">
                        <label for="additional_notes" class="col-form-label">Additional Notes </label>
                        <textarea class="form-control" name="additional_notes" rows="3"></textarea>

                    </div>

                    <button type="submit" class="btn btn-outline-primary rounded-pill w-100">Submit</button>
                </form>

            </div>

        </div>
    </div>

</x-admin>
