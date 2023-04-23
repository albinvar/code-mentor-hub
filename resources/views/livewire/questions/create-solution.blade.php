<div>
    <!-- Include stylesheet -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/default.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
    <link href="https://highlight.js/monokai-sublime.min.css" rel="stylesheet">

    <x-validation-errors class="mb-4" />
    @if ($errors->has('createSolution'))
        <p class="text-red-500">{{ $errors->first('createSolution') }}</p>
    @endif
    @if (session()->has('success'))
        <div class="bg-green-200 p-4 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" wire:submit.prevent="submit" enctype="multipart/form-data">
        @csrf

        <div class="mt-4" wire:ignore>
            <x-label for="solution" value="{{ __('Explain your question here ') }}" class="mb-4" />
            <div id="solution" wire:model="solution" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                @if(! empty($solution)) {!! $solution !!} @endif
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

            <x-secondary-button wire:click="toggleSolutionModal()" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>
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

        var quill = new Quill('#solution', {
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
        @this.set('solution', quill.root.innerHTML);
        });
    </script>

</div>
