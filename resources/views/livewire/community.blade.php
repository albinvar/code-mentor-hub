<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse ($questions as $question)

        <a href="{{ route('question.show', ['question' => $question->slug]) }}" class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4 m-4">
            <h2 class="text-2xl dark:text-gray-100 text-gray-700 font-bold mb-4">{{ $question->title }}</h2>
            <p class="text-gray-600 dark:text-gray-400 mb-4">{!! \Illuminate\Support\Str::limit(strip_tags($question->body), 200) !!}.....</p>
            <div class="text-gray-600 dark:text-gray-400 mb-4">
                @foreach($question->tags->pluck('name') as $tag)
                    <span class="inline-flex items-center rounded-md bg-blue-500 dark:bg-blue-700 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10"> {{ $tag }}</span>
                @endforeach
            </div>
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <img class="h-10 w-10 rounded-full object-cover mr-2" src="{{ $question->user->profile_photo_url }}" alt="{{ $question->user->name }}" />
                    @endif
                    <p class="text-gray-500 dark:text-gray-400">{{ $question->user->name }}</p>
                </div>
                <div class="flex items-center">
                    <div class="flex -space-x-1 overflow-hidden">
                        <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.25&w=256&h=256&q=80" alt="">
                        <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                    </div>
                    <p class="text-gray-500 dark:text-gray-400 ml-2">{{ $question->created_at->diffForHumans() }}</p>
                </div>
            </div>
        </a>

    @empty
        <div class="text-2xl text-center dark:text-gray-100">
            <span>No Questions found...!!!</span>
        </div>
    @endforelse
</div>
