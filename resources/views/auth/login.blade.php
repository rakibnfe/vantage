<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')<div>{{ $message }}</div>@enderror
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password" required>
            @error('password')<div>{{ $message }}</div>@enderror
        </div>
        <div>
            <input type="checkbox" name="remember"> Remember me
        </div>
        <button type="submit">Login</button>
    </form>
    <p><a href="{{ route('register') }}">Register</a></p>
</body>
</html>