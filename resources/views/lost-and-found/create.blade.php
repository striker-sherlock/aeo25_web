@extends('lost-and-found.layout')
@section("content")
<form method="POST" action="{{route('lost-and-found.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="item">Item</label>
        <input type="text" class="form-control" id="item" name="item" placeholder="Enter item">
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" class="form-control" id="image" name="image" placeholder="Enter image">
    </div>
    <div class="form-group">
        <label for="location">Location</label>
        <input type="text" class="form-control" id="location" name="location" placeholder="Enter location">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <select name="status">
            <option value="0">Lost</option>
            <option value="1">Found</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@stop