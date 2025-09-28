<form action="{{ route('login') }}" method="POST">
    @csrf
    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>

    @error('email')
        <p style="color:red;">{{ $message }}</p>
    @enderror
</form>