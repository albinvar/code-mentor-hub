<x-authentication-card>
    <x-slot name="logo">

    </x-slot>

        <!-- Include stylesheet -->
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/default.min.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
        <link href="https://highlight.js/monokai-sublime.min.css" rel="stylesheet">

    <x-validation-errors class="mb-4" />
    @if ($errors->has('createQuestion'))
        <p class="text-red-500">{{ $errors->first('createQuestion') }}</p>
    @endif
    @if (session()->has('success'))
        <div class="bg-green-200 p-4 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" wire:submit.prevent="submit" enctype="multipart/form-data">
        @csrf

        <div>
            <x-label for="title" value="{{ __('Ttile') }}" />
            <x-input id="title" class="block mt-1 w-full" type="text" wire:model.lazy="title" required autofocus autocomplete="title" />
        </div>

        <div class="mt-4" wire:ignore>
            <x-label for="location" value="{{ __('Explain your question here ') }}" class="mb-4" />
            <div id="question" wire:model="question" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                @if(! empty($question)) {!! $question !!} @endif
            </div>
        </div>

        <div class="mt-4" x-data="{ tags: [], newTag: '' }" x-init="() => {
            @if ($errors->any())
                tags = []
                tags.push(...JSON.parse('{{ json_encode($tags) }}'))
            @endif
        }">
            <x-label for="tags" value="{{ __('Related Tags') }}" />
            <div class="my-3 flex flex-wrap items-center gap-2" x-cloak>
                <template x-for="(tag, index) in tags" :key="index">
                    <div class="px-2 py-1 bg-gray-200 rounded-lg dark:bg-gray-700 transition-opacity duration-900 opacity-100 hover:opacity-75">
                        <span x-text="tag"></span>
                        <button type="button" class="ml-2 text-red-500 hover:text-red-700 focus:outline-none" @click.prevent="
        tags.splice(index, 1);
        $wire.removeTag(tag)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M11.414 10l4.293-4.293a1 1 0 10-1.414-1.414L10 8.586 5.707 4.293a1 1 0 10-1.414 1.414L8.586 10l-4.293 4.293a1 1 0 001.414 1.414L10 11.414l4.293 4.293a1 1 0 001.414-1.414L11.414 10z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </template>

                <input type="text" id="tags" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" x-model="newTag" x-on:keydown.enter.prevent="
        if (newTag.trim()) {
            let tagsToAdd = newTag.split(/[ ,]+/);
            tagsToAdd.forEach(tag => {
                if (tag.trim() && !tags.includes(tag.trim())) {
                    tags.push(tag.trim());
                }
            });
            newTag = '';
            @this.set('tags', tags);
        }" placeholder="Add tags (comma, space, or enter separated)">
            </div>
        </div>

        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mt-4">
                <x-label for="terms">
                    <div class="flex items-center">
                        <x-checkbox name="terms" id="terms" required />

                        <div class="ml-2">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Terms of Service').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Privacy Policy').'</a>',
                            ]) !!}
                        </div>
                    </div>
                </x-label>
            </div>
        @endif

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-button class="ml-4">
                {{ __('Post Question') }}
            </x-button>
        </div>
    </form>


        <!-- Include the Quill library -->
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

        <!-- Initialize Quill editor -->
        <script>
            hljs.configure({   // optionally configure hljs
                languages: ['javascript', 'ruby', 'python', 'php']
            });

            var quill = new Quill('#question', {
                modules: {
                    syntax: true,
                    toolbar: [
                        [{ header: [1, 2, false] }],
                        ['bold', 'italic', 'underline'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        ['code-block', 'link']
                    ]
                },
                placeholder: '.',
                theme: 'snow'
            });
            quill.on('text-change', function(delta, oldDelta, source) {
                // Sync the Quill editor content with Livewire's data
            @this.set('question', quill.root.innerHTML);
            });
        </script>

    @section('scripts')
        <script>
            Livewire.on('tagsUpdated', tags => {
                window.tags = tags;
            });
        </script>
    @endsection
</x-authentication-card>
