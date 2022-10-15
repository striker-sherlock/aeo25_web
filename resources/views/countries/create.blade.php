<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
@vite('resources/js/app.js')

<body>
  <x-card>
    <x-slot name="subtitle">Countries</x-slot>
    <x-slot name="title">Create Country</x-slot>
    <form action="{{route('countries.store')}}" method="POST" enctype="multipart/form-data">
      @csrf
        <div class="form-group mb-3">
          <label class="col-form-label" for="name">Country Name <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="{{old('name')}}">
        </div>
        <div class="row my-4">
          <div class="col">
            <a href="{{ route("countries.index") }}" class="btn btn-outline-secondary mb-3 w-100">Back</a>

          </div>
          <div class="col">
            <button type="submit" class="btn btn-outline-primary w-100 ">Create</button>
          </div>
      </div>
    </form>
  </x-card>
</body>
</html>