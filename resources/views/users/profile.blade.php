@extends('layouts.app')

@section('title', 'User Profile')

@section('content')
    <div class="min-h-screen bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-3xl font-semibold text-gray-900">My Profile</h1>
                    <p class="mt-2 text-sm text-gray-600">Manage your personal details and account security settings.</p>
                </div>
                <a href="{{ url('/app/users/dashboard') }}"
                    class="inline-flex items-center justify-center rounded-full border border-gray-200 bg-white px-5 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 transition">
                    Back to Dashboard
                </a>
            </div>

            @if (session('success'))
                <div class="mb-6 rounded-2xl bg-green-50 border border-green-200 p-4 text-sm text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid gap-8 xl:grid-cols-[320px_1fr]">
                <aside class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center gap-4">
                        <div class="flex h-16 w-16 items-center justify-center rounded-3xl bg-primary text-3xl font-semibold text-white">
                            {{ ucfirst(strtok($user->full_name, ' ')) ?: 'U' }}
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Logged in as</p>
                            <h2 class="text-xl font-semibold text-gray-900">{{ $user->full_name }}</h2>
                        </div>
                    </div>

                    <div class="mt-8 space-y-4 text-sm text-gray-600">
                        <div>
                            <p class="font-medium text-gray-800">Email</p>
                            <p>{{ $user->email }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Phone</p>
                            <p>{{ $user->phone ?: 'Not added yet' }}</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">Role</p>
                            <p>{{ optional($user->role)->role ?: 'User' }}</p>
                        </div>
                    </div>
                </aside>

                <div class="space-y-8">
                    <section class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                        <div class="mb-6 flex items-center justify-between gap-4">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Personal Information</h2>
                                <p class="text-sm text-gray-600">Update your name, email and phone number.</p>
                            </div>
                        </div>

                        <form action="{{ route('user.profile.update') }}" method="POST" class="space-y-6">
                            @csrf

                            <div class="grid gap-6 sm:grid-cols-2">
                                <div>
                                    <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                    <input id="full_name" name="full_name" type="text"
                                        value="{{ old('full_name', $user->full_name) }}"
                                        class="mt-2 block w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" />
                                    @error('full_name')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                                    <input id="email" name="email" type="email"
                                        value="{{ old('email', $user->email) }}"
                                        class="mt-2 block w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" />
                                    @error('email')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                <input id="phone" name="phone" type="text"
                                    value="{{ old('phone', $user->phone) }}"
                                    class="mt-2 block w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" />
                                @error('phone')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="pt-4 border-t border-gray-200">
                                <button type="submit"
                                    class="inline-flex items-center justify-center rounded-2xl bg-primary px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-primary/90 transition">
                                    Save profile
                                </button>
                            </div>
                        </form>
                    </section>

                    <section class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                        <div class="mb-6">
                            <h2 class="text-xl font-semibold text-gray-900">Security</h2>
                            <p class="text-sm text-gray-600">Change your password regularly to keep your account secure.</p>
                        </div>

                        <form action="{{ route('user.profile.password.update') }}" method="POST" class="space-y-6">
                            @csrf

                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
                                <input id="current_password" name="current_password" type="password"
                                    class="mt-2 block w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" />
                                @error('current_password')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid gap-6 sm:grid-cols-2">
                                <div>
                                    <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
                                    <input id="new_password" name="new_password" type="password"
                                        class="mt-2 block w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" />
                                    @error('new_password')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                                    <input id="new_password_confirmation" name="new_password_confirmation" type="password"
                                        class="mt-2 block w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" />
                                </div>
                            </div>

                            <div class="pt-4 border-t border-gray-200">
                                <button type="submit"
                                    class="inline-flex items-center justify-center rounded-2xl bg-secondary px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-secondary/90 transition">
                                    Update password
                                </button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
