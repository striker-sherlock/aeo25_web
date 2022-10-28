
@foreach ($faqs as $faq)
    Q = {{ $faq->question }}<br>
    A = {{ $faq->answer }}<br><br>
@endforeach
