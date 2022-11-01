@extends('lost-and-found.layout')
@section("content")
<a href="{{ route('lost-and-found.create') }}"><button><i class="fa fa-plus"></i><span>Add</span></button></a>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Item</th>
            <th>Image</th>
            <th>Location</th>
            <th>Description</th>
            <th>Status</th>
            <th>Action</th>
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
                <td>
                    <a href="{{ route('lost-and-found.edit', $object->id) }}"><button><i class="fa fa-edit"></i><span>Edit</span></button></a>
                    <form action="{{ route('lost-and-found.destroy', $object->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"><i class="fa fa-trash"></i><span>Delete</span></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@stop