<x-app-layout title="All images" subtitle="Your uploaded files in one calm grid.">
    <x-slot:actions>
        <a class="btn" href="{{ route('images.create') }}">Upload images</a>
    </x-slot:actions>

    <section class="card">
        @forelse ($media as $item)
            @if ($loop->first)
                <div class="grid">
            @endif
                    <article class="media">
                        <img src="{{ $item->originalUrl }}" alt="{{ $item->filename }}">
                        <div class="meta">
                            <span>{{ $item->filename }}</span>
                            <span>{{ number_format($item->size / 1024, 1) }} kB</span>
                        </div>
                    </article>
            @if ($loop->last)
                </div>
            @endif
        @empty
            <p class="empty">No uploads yet. Add your first images.</p>
        @endforelse
    </section>
</x-app-layout>
