@foreach($solutions as $solution)

    <livewire:solutions.voting :solution="$solution" />

@endforeach
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
