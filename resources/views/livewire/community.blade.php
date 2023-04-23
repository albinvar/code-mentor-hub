<div>
   @foreach($questions as $question)
        {{ $question->title }} - {{ $question->tags->pluck('name') }}
       <br>
       <br>
   @endforeach
</div>
