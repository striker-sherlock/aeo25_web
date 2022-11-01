<form enctype="multipart/form-data" method="POST" action="{{route('lost-and-found.update', $lost_and_found -> id)}}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="item">Item</label>
        <input type="text" id="item" name="item" placeholder="Enter item" value="{{ $lost_and_found->item }}">
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" id="image" name="image" placeholder="Enter image" value="{{ $lost_and_found->image }}"> <br>
        <img width="70" src="{{ asset('images/lost-and-found/'. $lost_and_found->image) }}" alt="Image"/>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <input type="text" id="description" name="description" placeholder="Enter description" value="{{ $lost_and_found->description }}">
    </div>
    <div class="form-group">
        <label for="location">Location</label>
        <input type="text" id="location" name="location" placeholder="Enter location" value="{{ $lost_and_found->location }}">
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <select name="status">
            @if($lost_and_found->status == '0')
                <option value="0" selected>Lost</option>
                <option value="1">Found</option>
            @else
                <option value="0">Lost</option>
                <option value="1" selected>Found</option>
            @endif
        </select>
    </div>
        <button type="submit">Submit</button>
    </div>
</form>
