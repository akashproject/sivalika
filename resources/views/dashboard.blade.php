<!-- resources/views/dashboard.blade.php -->

@if (Auth::check())
    <p>Welcome, {{ Auth::user()->name }}!</p>
    <p>Your email: {{ Auth::user()->email }}</p>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
@else
    <p>Please log in to access your dashboard.</p>
@endif
