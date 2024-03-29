<div>
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden my-4 mx-6 md:mx-2 lg:mx-2">
    <div class="p-6">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">{{ $question->title }}</h2>
        <div class="text-gray-700 dark:text-gray-100 mb-4 ">
            {!! $question->body !!}
        </div>
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <img class="h-10 w-10 rounded-full object-cover mr-2" src="{{ $question->user->profile_photo_url }}" alt="{{ $question->user->name }}" />
                @endif
                <p class="text-gray-500 dark:text-gray-400">{{ $question->user->name }}</p>
            </div>
            <p class="text-gray-500 dark:text-gray-400">{{ $question->created_at->diffForHumans() }}</p>
        </div>
        <div class="mt-6">
            @if (session()->has('success'))
                <div class="my-6 bg-green-200 p-4 rounded-md mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <x-button wire:click="$toggle('solutionModal')">Propose Solution</x-button>
        </div>

    </div>
    <x-dialog-modal wire:model="solutionModal">
        <x-slot name="title">
            {{ __('Enter details') }}
        </x-slot>

        <x-slot name="content">
            <livewire:questions.create-solution :question="$question" :status="$solutionModal"/>
        </x-slot>

        <x-slot name="footer">

        </x-slot>
    </x-dialog-modal>
    </div>

    <div class="my-8">
        <livewire:solutions.show :solutions="$question->solutions" />
    </div>

</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/styles/default.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/highlight.min.js"></script>

<style>
    .ql-syntax {
        /* Add your custom styles here */
        background-color: #edf2f7;
        color: #24292e;
        padding: 2rem;
        border-radius: 0.5rem;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        document.querySelectorAll('pre code').forEach((block) => {
            hljs.highlightBlock(block);
        });
    });
</script>
