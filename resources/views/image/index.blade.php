<h1>Images</h1>
<a href="{{ route('images.create') }}">Upload image</a>
<ul>
    @foreach($media as $item)
        <li>
            <img src="{{ $item->originalUrl }}" alt="{{ $item->filename }}" width="300">
            <p>{{ number_format($item->size/1024, 1) }} kB</p>
        </li>

    @endforeach
</ul>
