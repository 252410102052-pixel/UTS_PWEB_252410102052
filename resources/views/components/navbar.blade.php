@props(['username' => '', 'active' => ''])

<header class="navbar">
    <div class="navbar__inner">
        <a href="{{ route('dashboard', ['username' => $username]) }}" class="brand">
            <span class="brand__logo" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5V5a2 2 0 0 1 2-2h13v16H6a2 2 0 0 0-2 2"/><path d="M8 7h7"/></svg>
            </span>
            <span class="brand__name">BookNest</span>
        </a>

        <button class="navbar__toggle" id="navToggle" type="button" aria-label="Toggle navigation" aria-expanded="false">
            <span></span><span></span><span></span>
        </button>

        <nav class="navbar__menu" id="navMenu">
            <a href="{{ route('dashboard', ['username' => $username]) }}" class="{{ $active === 'dashboard' ? 'is-active' : '' }}">Dashboard</a>
            <a href="{{ route('pengelolaan', ['username' => $username]) }}" class="{{ $active === 'pengelolaan' ? 'is-active' : '' }}">My Collection</a>
            <a href="{{ route('profile', ['username' => $username]) }}" class="{{ $active === 'profile' ? 'is-active' : '' }}">Profile</a>
            <span class="navbar__user">
                <span class="avatar avatar--sm">{{ strtoupper(mb_substr($username, 0, 1)) }}</span>
                {{ $username }}
            </span>
        </nav>
    </div>
</header>
