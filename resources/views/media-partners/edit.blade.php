<x-layout>
    
    <div class="container mx-5 px-5">
        <a class="btn btn-primary rounded-pill my-4" href="{{ route('media-partners.manage') }}" title="Back to Main Menu">
            <i class="fa-solid fa-square-caret-left"></i>
        </a>
        <h3 class="fw-bold my-3 text-primary">Media Partners</h3>
        <h6> Edit Media Partner</h6>
        <form method="POST" action="{{route('media-partners.update', $media_partner->id) }}" enctype="multipart/form-data">
            @csrf
            @method('UPDATE')
            <div class="mb-3">
                <label for="name" class="form-label">Media Partner Name</label>
                <input type="text" class="form-control" name="name" value="{{ $media_partner->name }}">
            </div>
            <div class="mb-3">
                <label for="logo" class="form-label">Media Partner Logo</label>
                <input type="text" class="form-control" name="logo" value="{{ $media_partner->logo }}" hidden>
                <input type="file" accept="image/jpg, image/png, image/jpeg" class="form-control" name="logo_new" >
            </div>
            @method('PUT')
            <button type="submit" class="btn btn-primary rounded-pill w-100">Update</button>
        </form>


    </div>



</x-layout>
