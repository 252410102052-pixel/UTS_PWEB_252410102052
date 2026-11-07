@extends('layouts.app')

@section('title', 'My Collection')
@section('active', 'pengelolaan')

@section('content')
<div class="container">
    <section class="hero hero--col">
        <p class="eyebrow">Library</p>
        <h1 class="title">My Collection</h1>
        <p class="muted">Semua buku yang kamu miliki, dalam satu rak digital. Cari, saring, dan lihat statusnya.</p>
        <div class="chips">
            <span class="chip">Total: <strong>{{ $stats['total'] }}</strong></span>
            <span class="chip">Reading: <strong>{{ $stats['reading'] }}</strong></span>
            <span class="chip">Finished: <strong>{{ $stats['finished'] }}</strong></span>
            <span class="chip">Want to Read: <strong>{{ $stats['wantToRead'] }}</strong></span>
        </div>
    </section>

    <section class="toolbar">
        <input type="search" id="searchInput" class="input" placeholder="Search by title or author..." aria-label="Search books">
        <select id="categoryFilter" class="input" aria-label="Filter by category">
            <option value="">All Categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category }}">{{ $category }}</option>
            @endforeach
        </select>
        <select id="statusFilter" class="input" aria-label="Filter by status">
            <option value="">All Status</option>
            @foreach ($statuses as $status)
                <option value="{{ $status }}">{{ $status }}</option>
            @endforeach
        </select>
    </section>

    <p class="muted small" id="resultCount">Showing {{ count($books) }} of {{ count($books) }} books</p>

    <section class="grid grid--4" id="bookGrid">
        @foreach ($books as $book)
            <div class="book-wrap"
                 data-title="{{ strtolower($book['title']) }}"
                 data-author="{{ strtolower($book['author']) }}"
                 data-category="{{ $book['category'] }}"
                 data-status="{{ $book['status'] }}">
                @include('partials.book-card', ['book' => $book])
            </div>
        @endforeach
    </section>

    <div class="empty" id="emptyState" hidden>
        <h3>No books found</h3>
        <p class="muted">Coba kata kunci lain atau ubah filter kategori dan status.</p>
    </div>
</div>
@endsection

@section('extra_js')
<script>initCollectionFilter();</script>
@endsection
