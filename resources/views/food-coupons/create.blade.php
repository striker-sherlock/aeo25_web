<x-admin>
    <div class="container mt-4">
        <a href="{{route('food-coupons.index')}}" style="min-width:200px" class="btn btn-outline-theme rounded-pill mb-4">Back</a>
        <x-card>
            <h3 class="text-uppercase fw-bold text-center  text-gradient mb-4" style="letter-spacing: 0.1em">Food Coupon Claim Confirmation </h3>
            
            <form action="{{route('food-coupons.store')}}" method="POST" enctype="multipart/form-data" >
                @csrf
                <input type="text" value="{{$participant->id}}" name="participant_id" hidden>
                <div class="form-group row align-items-center mb-3">
                    <label class="control-label col-3" for="name">Participant</label>
                    <div class="col-9">
                        <input type="text" class="form-control rounded-pill" id="name" name="name" value="{{$participant->name}}" disabled>
                    </div>
                </div>

                <div class="form-group row align-items-center mb-3">
                    <label class="control-label col-3" for="insitution">Insitution</label>
                    <div class="col-9">
                        <input type="text" class="form-control rounded-pill" id="insitution" name="insitution" value="{{$participant->user->institution_name}}" disabled>
                    </div>
                </div>

                <div class="form-group row align-items-center mb-3">
                    <label class="control-label col-3" for="day">day</label>
                    <div class="col-9">
                        <input type="text" class="form-control rounded-pill" id="day" name="day" value="{{$day}}" >
                    </div>
                </div>

                <div class="form-group row align-items-center mb-3">
                    <label class="control-label col-3" for="field">Competition Field</label>
                    <div class="col-9">
                        <input type="text" class="form-control rounded-pill" id="field" name="field" value="{{$participant->competition->name}}" disabled>
                    </div>
                </div>

                <div class="form-group row align-items-center mb-3">
                    <label class="control-label col-3" for="vegetarian">Vegetarian</label>
                    <div class="col-9">
                        <input type="text" class="form-control rounded-pill" id="vegetarian" name="vegetarian" value="{{$participant->is_vegetarian == 1 ? 'Yes' : 'No'}}" disabled>
                    </div>
                </div>

                <div class="form-group row align-items-center mb-3">
                    <label class="control-label col-3" for="type">Type</label>
                    <div class="col-9">
                        <select name="type" id="type" class="form-control rounded-pill w-100" required>
                            <option  selected disabled class="d-none">Select Type ...</option>
                            <option value="BREAKFAST">Breakfast</option>
                            <option value="LUNCH">Lunch</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-outline-theme w-100 rounded-pill">Confirm </button>
            </form>
        </x-card>
    </div>
</x-admin>