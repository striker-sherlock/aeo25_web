<x-admin>
    <div class="container mt-4">
        <div class="card border-0 overflow-hidden shadow rounded-20 mb-5" style="border-radius:20px">
            <div class="card-header bg-secondary"></div>
            <div class="card-body my-3">
                <div class="title-line"></div> 
                <h5 class="subheading-text mt-3">Follow Ups</h5>
                <h3 class="fw-bold my-3 c-text-1">Follow Up Detail - {{$followUp->id}} </h3>
                <hr>
                <div class="form-group mb-3">
                    <label for="creator_id" class="col-sm-3 col-form-label text-sm-left">
                        Creator</label>
                    <input type="text" id="creator_name" name="creator_name" class="form-control " value="{{ $followUp->creator->name }}" disabled readonly>
                </div>
                <div class="form-group mb-3">
                    <label for="pic_id" class="col-sm-3 col-form-label text-sm-left">
                        Follow Up PIC</label>
                    <input type="text" id="pic_name" name="pic_name" class="form-control " value="{{ $followUp->pic->name }}" disabled readonly>
                </div>
                <div class="form-group mb-3">
                    <label for="is_national" class="col-sm-3 col-form-label text-sm-left">
                        Nationality Type</label>
                    @if($followUp->is_national == true)
                        <input type="text" id="is_national" name="is_national" class="form-control " value="National" disabled readonly>
                    @else
                        <input type="text" id="is_national" name="is_national" class="form-control " value="International" disabled readonly>
                    @endif   
                </div>
                <div class="form-group mb-3">
                    <label for="type" class="col-sm-3 col-form-label text-sm-left">
                        Follow Up Type</label>
                    @if($followUp->type == "overslot")
                        <input type="text" id="type" name="type" class="form-control " value="Overslot" disabled readonly>
                    @elseif($followUp->type == "payment")
                        <input type="text" id="type" name="type" class="form-control " value="Payment" disabled readonly>
                    @else
                        <input type="text" id="type" name="type" class="form-control " value="General" disabled readonly>
                    @endif 
                </div>
                <div class="form-group mb-3">
                    <label for="type" class="col-sm-3 col-form-label text-sm-left">
                        Priority</label>
                    @if($followUp->priority == 1)
                        <input type="text" id="priority" name="priority" class="form-control " value="Low" disabled readonly>
                    @elseif($followUp->priority == 2)
                        <input type="text" id="priority" name="priority" class="form-control " value="Medium" disabled readonly>
                    @else
                        <input type="text" id="priority" name="priority" class="form-control " value="High" disabled readonly>
                    @endif 
                </div>
                <div class="form-group mb-3">
                    <label for="detail" class="col-sm-3 col-form-label text-sm-left">
                        Detail</label>
                    <textarea class="form-control rounded-20" cols="30" rows="7" id="notes" name="notes" value="{{ $followUp->detail }}" class="form-control" disabled readonly>{{ $followUp->detail }}</textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="detail" class="col-sm-3 col-form-label text-sm-left">
                        Notes</label>
                    <textarea class="form-control rounded-20" cols="30" rows="7" id="notes" name="notes" value="{{ $followUp->notes }}" class="form-control" disabled readonly>{{ $followUp->notes }}</textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="user_id" class="col-sm-3 col-form-label text-sm-left">
                        Institution PIC</label>
                    <input type="text" id="user_name" name="user_name" class="form-control " value="{{ $followUp->user->pic_name }}" disabled readonly>
                </div>
                <div class="form-group mb-3">
                    <label for="user_id" class="col-sm-3 col-form-label text-sm-left">
                        PIC Email</label>
                    <input type="text" id="user_name" name="user_name" class="form-control " value="{{ $followUp->user->email }}" disabled readonly>
                </div>
                <div class="form-group mb-3">
                    <label for="status" class="col-sm-3 col-form-label text-sm-left">
                        Status </label>
                    @if($followUp->status == 1)
                        <input type="text" id="status" name="status" class="form-control " value="Pending" disabled readonly>
                    @elseif($followUp->status == 2)
                        <input type="text" id="status" name="status" class="form-control " value="On Progress" disabled readonly>
                    @else
                        <input type="text" id="status" name="status" class="form-control " value="Done" disabled readonly>
                    @endif    
                </div>
            </div>
        </div>

    </div>
    </div>

</x-admin>
