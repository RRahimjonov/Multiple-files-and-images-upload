<h1>Images</h1>

<ul>
    @foreach($media as $item)
        <li>
            <img src="{{ $item->originalUrl }}" alt="{{ $item->filename }}" width="300">
        </li>
    @endforeach
</ul>
