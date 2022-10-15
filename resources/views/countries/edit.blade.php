<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Edit Country</title>
  @vite('resources/js/app.js')
</head>
<body>
  <x-guest>
  <x-card>
    <x-slot name="subtitle">Countries</x-slot>
    <x-slot name="title">Edit Country</x-slot>
      <a href="{{ route("countries.index") }}" class="btn btn-outline-secondary mb-3">Back</a>
          <form action="{{ route('countries.update', $country->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('UPDATE')
            <div class="form-group mb-3">
              <label class="col-form-label" for="name">Country Name <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="name" id="name" value="{{ $country->name }}">
            </div>

            @method('PUT')
            <button type="submit" class="btn btn-outline-primary w-100 my-2">Submit</button>
          </form>
  </x-card>
</x-guest>
</body>
</html>
