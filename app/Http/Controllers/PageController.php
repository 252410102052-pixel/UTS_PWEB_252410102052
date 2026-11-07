<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Sumber data tunggal koleksi buku (tanpa database).
     * 'cover' berisi warna hex yang dipakai untuk membuat sampul buku dengan CSS.
     */
    private function books(): array
    {
        return [
            ['id' => 1,  'title' => 'Atomic Habits',               'author' => 'James Clear',         'category' => 'Self Development', 'status' => 'Reading',      'year' => 2018, 'cover' => '#78947C', 'rating' => 4.8, 'progress' => 64],
            ['id' => 2,  'title' => 'The Hobbit',                  'author' => 'J.R.R. Tolkien',      'category' => 'Fantasy',          'status' => 'Finished',     'year' => 1937, 'cover' => '#8A7B5C', 'rating' => 4.7, 'progress' => 100],
            ['id' => 3,  'title' => 'Clean Code',                  'author' => 'Robert C. Martin',    'category' => 'Technology',       'status' => 'Reading',      'year' => 2008, 'cover' => '#4F6D7A', 'rating' => 4.5, 'progress' => 38],
            ['id' => 4,  'title' => 'Laskar Pelangi',              'author' => 'Andrea Hirata',       'category' => 'Fiction',          'status' => 'Finished',     'year' => 2005, 'cover' => '#B08968', 'rating' => 4.6, 'progress' => 100],
            ['id' => 5,  'title' => 'Educated',                    'author' => 'Tara Westover',       'category' => 'Education',        'status' => 'Want to Read', 'year' => 2018, 'cover' => '#7A8F6A', 'rating' => 4.4, 'progress' => 0],
            ['id' => 6,  'title' => 'The Pragmatic Programmer',    'author' => 'Andrew Hunt & David Thomas', 'category' => 'Technology', 'status' => 'Want to Read', 'year' => 1999, 'cover' => '#5E7C6B', 'rating' => 4.6, 'progress' => 0],
            ['id' => 7,  'title' => 'Mistborn: The Final Empire',  'author' => 'Brandon Sanderson',   'category' => 'Fantasy',          'status' => 'Reading',      'year' => 2006, 'cover' => '#6B5B7B', 'rating' => 4.7, 'progress' => 22],
            ['id' => 8,  'title' => 'Deep Work',                   'author' => 'Cal Newport',         'category' => 'Self Development', 'status' => 'Finished',     'year' => 2016, 'cover' => '#9C7A4D', 'rating' => 4.3, 'progress' => 100],
            ['id' => 9,  'title' => 'Pedagogy of the Oppressed',   'author' => 'Paulo Freire',        'category' => 'Education',        'status' => 'Finished',     'year' => 1968, 'cover' => '#8C6A5D', 'rating' => 4.2, 'progress' => 100],
            ['id' => 10, 'title' => 'Bumi Manusia',                'author' => 'Pramoedya Ananta Toer', 'category' => 'Fiction',        'status' => 'Want to Read', 'year' => 1980, 'cover' => '#A0522D', 'rating' => 4.8, 'progress' => 0],
        ];
    }

    /** Statistik dihitung dari array buku, bukan angka statis. */
    private function stats(array $books): array
    {
        $collection = collect($books);

        return [
            'total'      => $collection->count(),
            'reading'    => $collection->where('status', 'Reading')->count(),
            'finished'   => $collection->where('status', 'Finished')->count(),
            'wantToRead' => $collection->where('status', 'Want to Read')->count(),
        ];
    }

    /** Ambil username dari Request Parameter (?username=...). */
    private function getUsername(Request $request): string
    {
        return trim((string) $request->query('username', ''));
    }

    private function backToLogin()
    {
        return redirect()->route('login')->with('status', 'Please sign in first to continue.');
    }

    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $validated = $request->validate(
            ['username' => ['required', 'string', 'max:30']],
            [
                'username.required' => 'Username cannot be empty.',
                'username.max'      => 'Username may not be longer than 30 characters.',
            ]
        );

        $username = trim($validated['username']);

        if ($username === '') {
            return back()->withErrors(['username' => 'Username cannot be empty.'])->withInput();
        }

        return redirect()->route('dashboard', ['username' => $username]);
    }

    public function dashboard(Request $request)
    {
        $username = $this->getUsername($request);
        if ($username === '') {
            return $this->backToLogin();
        }

        $books = $this->books();
        $stats = $this->stats($books);
        $today = now()->format('l, d F Y');

        $collection  = collect($books);
        $recent      = $collection->sortByDesc('id')->take(4)->values()->all();
        $reading     = $collection->where('status', 'Reading')->values()->all();
        $recommended = $collection->where('status', 'Want to Read')->sortByDesc('rating')->take(3)->values()->all();

        return view('dashboard', compact('username', 'books', 'stats', 'today', 'recent', 'reading', 'recommended'));
    }

    public function pengelolaan(Request $request)
    {
        $username = $this->getUsername($request);
        if ($username === '') {
            return $this->backToLogin();
        }

        $books      = $this->books();
        $stats      = $this->stats($books);
        $categories = ['Fiction', 'Self Development', 'Technology', 'Education', 'Fantasy'];
        $statuses   = ['Reading', 'Finished', 'Want to Read'];

        return view('pengelolaan', compact('username', 'books', 'stats', 'categories', 'statuses'));
    }

    public function profile(Request $request)
    {
        $username = $this->getUsername($request);
        if ($username === '') {
            return $this->backToLogin();
        }

        $books = $this->books();
        $stats = $this->stats($books);

        $memberSince = 'January 2025';
        $preferences = collect($books)
            ->groupBy('category')
            ->map(fn ($items) => $items->count())
            ->sortDesc()
            ->all();
        $favoriteStatus = collect($books)->groupBy('status')->map->count()->sortDesc()->keys()->first();
        $avgRating = round(collect($books)->avg('rating'), 1);

        return view('profile', compact('username', 'stats', 'memberSince', 'preferences', 'favoriteStatus', 'avgRating'));
    }
}
