@extends('layouts.app')

@section('title', 'Sign In')
@section('body_class', 'page-login')

@section('guest', '1')

@section('content')
<section class="login">
    <div class="login__art" aria-hidden="true">
        <svg viewBox="0 0 400 400" class="login__svg">
            <circle cx="200" cy="200" r="170" fill="#A7B89A" opacity=".25"/>
            <rect x="120" y="150" width="46" height="170" rx="6" fill="#78947C"/>
            <rect x="172" y="120" width="46" height="200" rx="6" fill="#26382D"/>
            <rect x="224" y="165" width="46" height="155" rx="6" fill="#A7B89A"/>
            <rect x="276" y="140" width="40" height="180" rx="6" fill="#78947C" opacity=".75"/>
            <rect x="100" y="320" width="236" height="10" rx="5" fill="#26382D"/>
            <path d="M80 330 C60 270 70 220 110 190 C115 240 105 285 80 330Z" fill="#78947C"/>
            <path d="M340 330 C365 280 360 230 325 200 C318 250 325 290 340 330Z" fill="#A7B89A"/>
        </svg>
        <p class="login__quote">"A room without books is like a body without a soul."</p>
    </div>

    <div class="login__panel">
        <div class="login__card">
            <div class="brand brand--lg">
                <span class="brand__logo" aria-hidden="true">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5V5a2 2 0 0 1 2-2h13v16H6a2 2 0 0 0-2 2"/><path d="M8 7h7"/></svg>
                </span>
                <span class="brand__name">BookNest</span>
            </div>

            <h1 class="title">Welcome to BookNest</h1>
            <p class="muted">Your Little Space for Every Story. Masukkan username untuk mulai mengelola koleksi bukumu.</p>

            <form method="POST" action="{{ route('login.process') }}" novalidate>
                @csrf
                <label for="username" class="label">Username</label>
                <input type="text" id="username" name="username" class="input @error('username') input--error @enderror"
                       value="{{ old('username') }}" placeholder="e.g. alya" autocomplete="off" autofocus>
                @error('username')
                    <span class="field-error">{{ $message }}</span>
                @enderror

                <button type="submit" class="btn btn--primary btn--block">Sign In</button>
            </form>
        </div>
    </div>
</section>
@endsection
