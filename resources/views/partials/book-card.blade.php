<article class="book">
    <div class="book__cover" style="background: linear-gradient(145deg, {{ $book['cover'] }}, #26382D);">
        <span class="book__cover-title">{{ $book['title'] }}</span>
        <span class="book__cover-author">{{ $book['author'] }}</span>
    </div>
    <div class="book__body">
        <h3 class="book__title">{{ $book['title'] }}</h3>
        <p class="muted small">{{ $book['author'] }}</p>
        <div class="book__meta">
            <span class="tag">{{ $book['category'] }}</span>
            <span class="status status--{{ \Illuminate\Support\Str::slug($book['status']) }}">{{ $book['status'] }}</span>
        </div>
        <div class="book__foot">
            <span class="small muted">{{ $book['year'] }}</span>
            <span class="rating">&#9733; {{ number_format($book['rating'], 1) }}</span>
        </div>
    </div>
</article>
