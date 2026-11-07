@extends('layouts.app')

@section('title', 'Dashboard')
@section('active', 'dashboard')

@section('content')
<div class="container">
    <section class="hero">
        <div>
            <p class="eyebrow">{{ $today }}</p>
            <h1 class="title">Hello, {{ $username }}!</h1>
            <p class="muted">Selamat datang kembali di sarang bukumu. Lanjutkan bacaanmu hari ini.</p>
        </div>
        <a href="{{ route('pengelolaan', ['username' => $username]) }}" class="btn btn--primary">Open My Collection &rarr;</a>
    </section>

    <section class="stats">
        <div class="stat"><span class="stat__num">{{ $stats['total'] }}</span><span class="stat__label">Total Books</span></div>
        <div class="stat"><span class="stat__num">{{ $stats['reading'] }}</span><span class="stat__label">Reading</span></div>
        <div class="stat"><span class="stat__num">{{ $stats['finished'] }}</span><span class="stat__label">Finished</span></div>
        <div class="stat"><span class="stat__num">{{ $stats['wantToRead'] }}</span><span class="stat__label">Want to Read</span></div>
    </section>

    <section class="section">
        <h2 class="section__title">Recently Added</h2>
        <div class="grid grid--4">
            @foreach ($recent as $book)
                @include('partials.book-card', ['book' => $book])
            @endforeach
        </div>
    </section>

    <section class="section">
        <h2 class="section__title">Reading Progress</h2>
        <div class="progress-list">
            @forelse ($reading as $book)
                <div class="progress-item">
                    <div class="progress-item__head">
                        <div>
                            <strong>{{ $book['title'] }}</strong>
                            <span class="muted small">{{ $book['author'] }}</span>
                        </div>
                        <span class="progress-item__pct">{{ $book['progress'] }}%</span>
                    </div>
                    <div class="bar"><div class="bar__fill" style="width: {{ $book['progress'] }}%"></div></div>
                </div>
            @empty
                <p class="muted">Belum ada buku yang sedang dibaca.</p>
            @endforelse
        </div>
    </section>

    <section class="section">
        <h2 class="section__title">Recommended for You</h2>
        <div class="grid grid--3">
            @foreach ($recommended as $book)
                @include('partials.book-card', ['book' => $book])
            @endforeach
        </div>
    </section>
</div>
@endsection
