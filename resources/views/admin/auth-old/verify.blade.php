@extends('admin.layouts.master')

@section('title','Verify Email')

@section('content')
<h1>Verify Your Email Address</h1>
@if (session('resent'))
    <div>A fresh verification link has been sent to your email address.</div>
@endif
<p>Before proceeding, please check your email for a verification link.</p>
<p>If you did not receive the email, <form style="display:inline" method="POST" action="{{ route('admin.verification.resend') }}">@csrf<button type="submit">click here to request another</button></form>.</p>
@endsection