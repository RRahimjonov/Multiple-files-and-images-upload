<x-app-layout title="Image upload" subtitle="Select multiple images and send them in one go.">
    <x-slot:actions>
        <a class="btn secondary" href="{{ route('images.index') }}">All images</a>
    </x-slot:actions>

    <section class="card">
        <form class="upload" method="POST" action="{{ route('images.store') }}" enctype="multipart/form-data">
            @csrf
            <label class="file">
                <input type="file" name="images[]" multiple accept="image/*">
            </label>

            @error('images')
                <p class="error">{{ $message }}</p>
            @enderror

            <button class="btn" type="submit">Upload</button>
        </form>
    </section>
    @push('scripts')
        <script type="module">
            import * as FilePond from 'https://cdn.jsdelivr.net/npm/filepond/dist/filepond.esm.min.js';
            import FilePondPluginImagePreview from 'https://cdn.jsdelivr.net/npm/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.esm.min.js';

            FilePond.registerPlugin(FilePondPluginImagePreview);

            FilePond.create(document.querySelector('input[type="file"]'), {
                allowMultiple: true,
                labelIdle: 'Drag & drop images or <span class="filepond--label-action">Choose</span>',
                acceptedFileTypes: ['image/jpeg', 'image/png', 'image/webp'],
                fileValidateTypeLabelExpectedTypes: 'Only jpg, png, webp allowed',
                storeAsFile: true,
                name: 'images[]',
            });
        </script>
    @endpush
</x-app-layout>

