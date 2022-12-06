<x-admin title="Reply Question">
    <div class="container mt-4 py-4">
        <x-card class="my-2">
            <div class="title-line"></div> 
            <h5 class="subheading-text mt-3">Sender: {{ $question->name }}</h5>
            <h5 class="my-3">Question: <span>{{ $question->question }}</span></h5>
            <h5 class="my-3">Created At: <span>{{ (date('M j, Y G:i', strtotime($question->created_at))) }}</span></h5>
            <hr>
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12 my-3">
                    <div class="section-line"></div>
                    <form method="POST" action="{{ route('questions.reply', $question) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-12">
                                <div class="card-body">
                                    <div class="form-group">
                                        <textarea name="reply" id="editor" cols="30" rows="10" class="form-control rounded-20 @error('reply') is-invalid @enderror" class="ckeditor">{{ old('reply') }}</textarea>
                                        @error('reply')
                                            <span class="invalid-feedback d-block">
                                                {!! $message !!}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-grid mt-4">
                                    <button type="submit" class="btn btn-outline-primary text-uppercase rounded-20 btnSubmit">Submit</button>    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </x-card>
    </div>
    <script>
        ClassicEditor
           .create( document.querySelector( '#editor' ))
           .then( editor => {
               console.log( editor );
       })
           .catch( error => {
               console.error( error );
       });
    </script>
    <style>
       .ck-editor__editable {
           min-height: 100px;
       }
   </style>
</x-admin>