<a href="{{ route("campuses.index") }}" class="btn btn-outline-secondary mb-3">Back</a>
    <x-card>
      <x-slot name="subtitle">countries</x-slot>
      <x-slot name="title">Edit Country</x-slot>
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