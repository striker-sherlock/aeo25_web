@extends('lost-and-found.layout')
@section("content")
<table class="table table-dark table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Item</th>
            <th>Image</th>
            <th>Location</th>
            <th>Description</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($lost_and_found as $object)
            <tr>
                <td>{{ $object->id }}</td>
                <td>{{ $object->item }}</td>
                <td>
                    <img width="100" src="{{ asset('images/lost-and-found/'. $object->image) }}" alt="Image"/>
                </td>
                <td>{{ $object->location }}</td>
                <td>{{ $object->description }}</td>
                <td>
                    @if ($object->status == 0)
                        Lost
                    @else
                        Found
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@stop