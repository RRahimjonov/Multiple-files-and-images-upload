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
</x-app-layout>
