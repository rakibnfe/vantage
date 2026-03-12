@extends('admin.layouts.app')

@section('title', 'Verify Email')
@section('page-title', 'Verify Your Email')

@section('content')
<div class="max-w-2xl mx-auto">
    
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
        <div class="text-center mb-6">
            <svg class="w-12 h-12 text-primary-600 dark:text-primary-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Verify Your Email</h2>
        </div>

        <p class="text-gray-600 dark:text-gray-400 mb-6 text-center">
            We've sent a verification link to your email address. Please check your inbox and click the link to verify your email.
        </p>

        @if (session('resent'))
            <div class="mb-4 bg-green-100 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded-lg">
                <p class="text-sm font-medium">A fresh verification link has been sent to your email address.</p>
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}" class="text-center">
            @csrf
            
            <button type="submit" class="px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800 transition">
                Resend Verification Email
            </button>
        </form>

        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700 text-center">
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 font-medium">
                    Log out
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
