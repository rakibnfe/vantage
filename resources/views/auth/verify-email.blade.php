@extends('layouts.auth')

@section('title', 'Verify Email')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-2xl shadow-lg">
        
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-900">Verify Email</h2>
            <p class="mt-2 text-sm text-gray-600">
                We've sent a verification link to your email address. Please check your inbox and click the link to verify your email.
            </p>
        </div>

        @if (session('resent'))
            <div class="rounded-lg bg-green-50 p-4">
                <p class="text-sm text-green-700">
                    A fresh verification link has been sent to your email address.
                </p>
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}" class="space-y-4">
            @csrf
            
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg text-white font-semibold bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                Resend Verification Link
            </button>
        </form>

        <div class="text-center text-sm">
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="text-blue-600 hover:text-blue-500 font-medium">
                    Log out
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
