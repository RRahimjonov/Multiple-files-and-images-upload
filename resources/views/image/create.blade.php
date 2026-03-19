<h1>Image Upload</h1>

<form method="POST" action="{{ route('images.store') }}" enctype="multipart/form-data">
   @csrf
    <input type="file" name="images[]" multiple accept="image/*">
    <button type="submit">Upload</button>
</form>
