@extends('admin.layouts.app')

@section('title', 'Edit Profile')
@section('page-title', 'Edit Profile')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    
    <!-- Update Profile Information -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Profile Information</h2>
        <p class="text-gray-600 dark:text-gray-400 mb-6">Update your profile information.</p>

        <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
            @csrf
            @method('PATCH')

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Name
                </label>
                <input id="name"
                       name="name"
                       type="text"
                       value="{{ old('name', $user->name) }}"
                       required
                       autofocus
                       class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Email Address
                </label>
                <input id="email"
                       name="email"
                       type="email"
                       value="{{ old('email', $user->email) }}"
                       required
                       class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                    <p class="text-sm text-yellow-700 dark:text-yellow-300">
                        Your email address is unverified.
                        <button form="send-verification" class="underline text-yellow-700 dark:text-yellow-300 hover:text-yellow-900 dark:hover:text-yellow-100">
                            Click here to re-send the verification email.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm text-green-700 dark:text-green-300">
                            A new verification link has been sent to your email address.
                        </p>
                    @endif
                </div>
            @endif

            <div class="flex gap-4">
                <button type="submit" class="px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800 transition">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <!-- Delete Account -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border-2 border-red-200 dark:border-red-900/30">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Delete Account</h2>
        <p class="text-gray-600 dark:text-gray-400 mb-6">
            Once your account is deleted, there is no going back. Please be certain.
        </p>

        <form method="POST" action="{{ route('profile.destroy') }}" class="space-y-4">
            @csrf
            @method('DELETE')

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Password (to confirm deletion)
                </label>
                <input id="password"
                       name="password"
                       type="password"
                       placeholder="Enter your password"
                       class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent @error('password') border-red-500 @enderror"
                       required>
                @error('password')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:focus:ring-offset-gray-800 transition">
                Delete Account
            </button>
        </form>
    </div>
</div>

<form id="send-verification" method="POST" action="{{ route('verification.send') }}" class="hidden">
    @csrf
</form>
@endsection
