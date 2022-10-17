<x-layout>

    <div class="mx-5 my-3">
        <h1 class="text-primary ml-2">Media Partner</h1>
    </div>

    <div class="d-flex justify-content-end  ">
        <a class="btn btn-primary rounded-pill mx-5 my-4" href="{{ route('media-partners.create') }}">
            <i class="fa fa-plus" aria-hidden="true"></i> Create Media Partners
        </a>
    </div>
<div class="px-5">
    <table class="table table-bordered">
        <thead class="table-info">
          <tr>
            <th class="align-middle text-center">ID</th>
            <th class="align-middle text-center">Media Partner Name</th>
            <th class="align-middle text-center">Logo</th>
            <th class="align-middle text-center">Visibility</th>
            <th class="align-middle text-center">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($media_partners as $media_partner)
            <tr>
                <th scope="row">{{ $media_partner->id }}</th>
                <td>{{ $media_partner->name }}</td>
                <td> <img width="75" src="/storage/logo/media-partner/{{ $media_partner->logo }}">
                </td>
                <td class="align-middle text-center"> 
                    @if ($media_partner->is_showed == true)
                        VISIBLE
                    @else
                        HIDDEN
                    @endif       
                </td>
                <td class="d-flex justify-content-center">
                    <a class="btn btn-primary mx-2" href="{{ route('media-partners.edit', $media_partner->id) }}" title="Update Data">
                        <i class="fa fa-edit"></i>
                    </a>
               
                    @if($media_partner->is_showed == true)
                        <a class="btn btn-info mx-2" href="{{ route('media-partners.update-visibility', $media_partner->id) }}" title="Hide">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    @else
                        <a class="btn btn-danger mx-2" href="{{ route('media-partners.update-visibility', $media_partner->id) }}" title="Show">
                            <i class="fa fa-eye-slash"></i>
                        </a>
                    @endif


                    <form method="post" action="{{ route('media-partners.destroy', $media_partner->id) }}" accept-charset="UTF-8" style="display:inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger  mx-2" title="Delete data" onclick="return confirm(&quot;Confirm delete?&quot;)">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
      </table>
    

</div>




</x-layout>
