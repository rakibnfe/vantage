@extends('admin.layouts.master')

@section('title','Admin Login')

@section('content')
<h1>Admin Loginaaaaa</h1>
<form method="POST" action="{{ route('admin.login') }}">
    @csrf
    <div>
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required autofocus>
    </div>
    <div>
        <label>Password</label>
        <input type="password" name="password" required>
    </div>
    <div>
        <label><input type="checkbox" name="remember"> Remember me</label>
    </div>
    <button type="submit">Login</button>
</form>
<p><a href="{{ route('admin.password.request') }}">Forgot password?</a></p>
@endsection