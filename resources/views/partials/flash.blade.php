@if ($errors->any())
    <div class="flash flash--error" role="alert">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

@if (session('status'))
    <div class="flash flash--info" role="status">{{ session('status') }}</div>
@endif
