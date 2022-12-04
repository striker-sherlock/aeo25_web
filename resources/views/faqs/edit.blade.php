

<x-admin>
    <div class="container mt-5">
        <x-card>
            <h3 class="text-uppercase fw-bold display-6 text-gradient mb-4" style="letter-spacing: 0.1em">Edit Sponsor</h3>
            <form method="POST" action="{{route('faqs.update', $faq -> id)}}">
                @csrf
                @method('PUT')
                    <div class="form-group mb-3">
                        <label for="question">Question</label>
                        <input type="text" class="form-control" id="question" name="question" placeholder="Enter question" value="{{ $faq->question }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="answer">Answer</label>
                        <textarea class="form-control" id="answer" name="answer" rows="3">{{ $faq->answer }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                
    </x-card>
</div>
</x-admin>