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
                <h6> Add New Contact</h6>
                <form method="POST" action="{{ route('institution-contacts.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="admin_id" class="">PIC Name</label>
                        <input type="number" class="form-control" name="admin_id"  value="1" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="division" class="">Division <span
                            class="text-danger">*</span> </label>
                        <select name="division" class="form-select " required>
                            <option value="NR">National Registration</option>
                            <option value="IR">International Registration</option>
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
                        <label for="institution_name" class="">Institution Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="institution_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="location" class="">Location <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="location" required>
                    </div>
                    <div class="mb-3">
                        <label for="pic_name" class="">PIC Institution<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="pic_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="">Email <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone_number" class="">Phone Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="phone_number" required>
                    </div>

                    <div class="mb-3">
                        <label for="informal_letter_sent" class="">Informal Letter Sent <span
                                class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="informal_letter_sent" min="0" required>
                    </div>

                    <div class="mb-3">
                        <label for="formal_letter_sent" class="">Formal Letter Sent <span
                                class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="formal_letter_sent" min="0" required>
                    </div>

                    <div class="mb-3">
                        <label for="whatsapp_sent" class="">Whatsapp Sent <span class="text-danger">*</span>
                        </label>
                        <input type="number" class="form-control" name="whatsapp_sent" min="0" required>
                    </div>

                    <div class="mb-3">
                        <p>Contact Status <span class="text-danger">*</span> </p>
                        <input type="radio" class="btn-check" name="is_valid" id="1" autocomplete="off" value="1">
                        <label class="btn btn-outline-success px-5 me-2" for="1">Valid</label>

                        <input type="radio" class="btn-check" name="is_valid" id="0" autocomplete="off" value="0">
                        <label class="btn btn-outline-danger px-5 ms-2" for="0">Invalid</label>
                        
                    </div>


                    <div class="mb-3">
                        <label for="reason" class="">Reason <span class="text-danger">*</span> </label>
                        <textarea class="form-control" name="reason" rows="3"></textarea>

                    </div>
                    <div class="mb-3">
                        <label for="additional_notes" class="">Additional Notes </label>
                        <textarea class="form-control" name="additional_notes" rows="3"></textarea>

                    </div>

                    <button type="submit" class="btn btn-outline-primary rounded-pill w-100">Submit</button>
                </form>

            </div>

        </div>
    </div>

</x-admin>
