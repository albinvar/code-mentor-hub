<div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden my-4 mx-6 md:mx-2 lg:mx-2">
    <div class="p-4">
        <!-- Solution content -->
        <div class="text-gray-700 dark:text-gray-100 mb-4">
            {!! $solution->body !!}
        </div>

        <!-- User information -->
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <img class="h-8 w-8 rounded-full object-cover mr-2" src="{{ $solution->user->profile_photo_url }}" alt="{{ $solution->user->name }}" />
                @endif
                <p class="text-gray-500 dark:text-gray-400">{{ $solution->user->name }}</p>
            </div>
            <p class="text-gray-500 dark:text-gray-400">{{ $solution->created_at->diffForHumans() }}</p>
        </div>

        <!-- Vote buttons -->
        <div class="mt-4 flex justify-end items-center">
            <button class="px-4 py-2 rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none" wire:click="upvote">
                <i class="fas fa-thumbs-up"></i>
                <span class="ml-2">{{ "43" }}</span>
            </button>
            <button class="ml-4 px-4 py-2 rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none">
                <i class="fas fa-thumbs-down"></i>
                <span class="ml-2">{{ "32" }}</span>
            </button>
        </div>
    </div>
</div>
