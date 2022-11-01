<form method="POST" action="{{route('faqs.update', $faq -> id)}}">
@csrf
@method('PUT')
    <div class="form-group">
        <label for="question">Question</label>
        <input type="text" class="form-control" id="question" name="question" placeholder="Enter question" value="{{ $faq->question }}">
    </div>
    <div class="form-group">
        <label for="answer">Answer</label>
        <textarea class="form-control" id="answer" name="answer" rows="3">{{ $faq->answer }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>