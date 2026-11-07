@extends('layouts.app')

@section('title', 'Profile')
@section('active', 'profile')

@section('content')
<div class="container container--narrow">
    <section class="profile">
        <div class="avatar avatar--lg">{{ strtoupper(mb_substr($username, 0, 1)) }}</div>
        <h1 class="title">{{ $username }}</h1>
        <p class="muted">BookNest Member</p>
        <p class="small muted">Role: BookNest Member &middot; Member since {{ $memberSince }}</p>
    </section>

    <section class="stats">
        <div class="stat"><span class="stat__num">{{ $stats['total'] }}</span><span class="stat__label">Total Books</span></div>
        <div class="stat"><span class="stat__num">{{ $stats['reading'] }}</span><span class="stat__label">Reading</span></div>
        <div class="stat"><span class="stat__num">{{ $stats['finished'] }}</span><span class="stat__label">Finished</span></div>
        <div class="stat"><span class="stat__num">{{ $stats['wantToRead'] }}</span><span class="stat__label">Want to Read</span></div>
    </section>

    <section class="card">
        <h2 class="section__title">Reading Preferences</h2>
        <ul class="pref-list">
            @foreach ($preferences as $category => $count)
                <li><span>{{ $category }}</span><span class="tag">{{ $count }} {{ $count > 1 ? 'books' : 'book' }}</span></li>
            @endforeach
        </ul>
        <p class="small muted">Average rating: <strong>{{ $avgRating }}</strong> &middot; Most common status: <strong>{{ $favoriteStatus }}</strong></p>
    </section>

    <div class="actions">
        <a href="{{ route('dashboard', ['username' => $username]) }}" class="btn btn--primary">&larr; Back to Dashboard</a>
        <a href="{{ route('login') }}" class="btn btn--ghost">Logout</a>
    </div>
</div>
@endsection
