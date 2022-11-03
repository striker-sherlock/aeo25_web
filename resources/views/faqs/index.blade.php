@extends('lost-and-found.layout')
@section("content")
<a href="{{ route('faqs.create') }}"><button><i class="fa fa-plus"></i><span>Add</span></button></a>
<table border="1">
    <thead>
        <th>ID</th>
        <th>Question</th>
        <th>Answer</th>
        <th>Action</th>
    </thead>
    <tbody>
        @foreach ($faqs as $faq)
            <tr>
                <td>{{ $faq->id }}</td>
                <td>{{ $faq->question }}</td>
                <td>{{ $faq->answer }}</td>
                <td>
                    <a href="/faqs/{{ $faq->id }}/edit" class="btn btn-warning">Edit</a>
                    <form action="/faqs/{{ $faq->id }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@stop