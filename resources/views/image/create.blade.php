<x-app-layout title="Image upload" subtitle="Select multiple images and send them in one go.">
    <x-slot:actions>
        <a class="btn secondary" href="{{ route('images.index') }}">All images</a>
    </x-slot:actions>

    <section class="card">
        <form class="upload" method="POST" action="{{ route('images.store') }}"
              enctype="multipart/form-data" id="upload-form">
            @csrf
            <label class="file">
                <input type="file" name="images[]" multiple accept="image/*" id="images">
            </label>

            <div id="message" style="display:none;" class="success">
                Uploading...
            </div>

            <button class="btn" type="submit" id="upload-button">Upload</button>
        </form>
    </section>

    @push('scripts')
        <script type="module">
            import * as FilePond from 'https://cdn.jsdelivr.net/npm/filepond/dist/filepond.esm.min.js';
            import FilePondPluginImagePreview from 'https://cdn.jsdelivr.net/npm/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.esm.min.js';
            import FilePondPluginFileValidateType from 'https://cdn.jsdelivr.net/npm/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.esm.min.js';

            FilePond.registerPlugin(FilePondPluginImagePreview);
            FilePond.registerPlugin(FilePondPluginFileValidateType);

            // Save FilePond instance in a variable
            const pond = FilePond.create(document.querySelector('input[type="file"]'), {
                allowMultiple: true,
                acceptedFileTypes: ['image/jpeg', 'image/png', 'image/webp'],
                labelIdle: 'Drag & drop images or <span class="filepond--label-action">Browse</span>',
            });

            const form = document.getElementById('upload-form');
            const message = document.getElementById('message');
            const uploadButton = document.getElementById('upload-button');

            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                // Get files FROM FILEPOND — not from the input
                const files = pond.getFiles();

                if (files.length === 0) {
                    alert('Please select at least one image.');
                    return;
                }

                const csrfToken = form.querySelector('input[name="_token"]').value;

                uploadButton.disabled = true;
                message.style.display = 'block';

                let allSuccess = true;

                for (let i = 0; i < files.length; i++) {
                    const formData = new FormData();
                    // files[i].file is the actual File object inside FilePond
                    formData.append('image', files[i].file);

                    try {
                        const response = await fetch(form.action, {
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': csrfToken },
                            body: formData
                        });

                        if (!response.ok) {
                            allSuccess = false;
                        }
                    } catch (error) {
                        allSuccess = false;
                    }
                }

                uploadButton.disabled = false;
                message.style.display = 'none';

                if (allSuccess) {
                    window.location.href = "{{ route('images.index') }}";
                } else {
                    alert('Some files failed to upload.');
                }
            });
        </script>
    @endpush
</x-app-layout>
