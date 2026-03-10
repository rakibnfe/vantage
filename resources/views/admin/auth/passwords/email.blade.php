@extends('admin.layouts.master')

@section('title','Reset Password')

@section('content')
<h1>Reset Password</h1>
@if (session('status'))
    <div>{{ session('status') }}</div>
@endif
<form method="POST" action="{{ route('admin.password.email') }}">
    @csrf
    <div>
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
    </div>
    <button type="submit">Send Reset Link</button>
</form>
@endsection