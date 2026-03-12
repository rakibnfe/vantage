@extends('admin.layouts.app')

@section('title', 'Change Password')
@section('page-title', 'Change Password')

@section('content')
<div class="max-w-2xl mx-auto">
    
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Update Password</h2>
        <p class="text-gray-600 dark:text-gray-400 mb-6">Change your account password.</p>

        @if (session('status') === 'password-updated')
            <div class="mb-4 bg-green-100 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded-lg">
                <p>Password updated successfully!</p>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Current Password -->
            <div>
                <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Current Password
                </label>
                <input id="current_password"
                       name="current_password"
                       type="password"
                       placeholder="Enter your current password"
                       autocomplete="current-password"
                       class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('current_password') border-red-500 @enderror"
                       required>
                @error('current_password')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- New Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    New Password
                </label>
                <input id="password"
                       name="password"
                       type="password"
                       placeholder="Enter a new password"
                       autocomplete="new-password"
                       class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('password') border-red-500 @enderror"
                       required>
                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                    Must be at least 8 characters long.
                </p>
                @error('password')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Confirm Password
                </label>
                <input id="password_confirmation"
                       name="password_confirmation"
                       type="password"
                       placeholder="Confirm your new password"
                       autocomplete="new-password"
                       class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('password_confirmation') border-red-500 @enderror"
                       required>
                @error('password_confirmation')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800 transition">
                Update Password
            </button>
        </form>
    </div>
</div>
@endsection
