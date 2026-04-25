@extends('layouts.app')

@section('title', 'Profile & Reset Password')

@section('content')
    <div class="min-h-screen bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10 grid gap-8 xl:grid-cols-[1.1fr_0.9fr]">
                <section class="rounded-3xl border border-gray-200 bg-white shadow-xl p-8">
                    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h1 class="text-3xl font-semibold text-gray-900">Profile</h1>
                            <p class="mt-2 text-sm text-gray-600">Update your user details and keep your account info current.</p>
                        </div>
                        <div class="inline-flex items-center gap-2 rounded-full border border-gray-200 bg-gray-50 px-4 py-2 text-sm text-gray-700">
                            <i class="fas fa-user-circle text-primary"></i>
                            Admin profile UI
                        </div>
                    </div>

                    <div class="grid gap-6 lg:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input type="text" value="John Doe" placeholder="Full name"
                                class="mt-3 w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" value="john.doe@example.com" placeholder="Email address"
                                class="mt-3 w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" />
                        </div>
                    </div>

                    <div class="mt-6 grid gap-6 lg:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Phone</label>
                            <input type="text" value="+91 98765 43210" placeholder="Phone number"
                                class="mt-3 w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Role</label>
                            <input type="text" value="Administrator" disabled
                                class="mt-3 w-full rounded-2xl border border-gray-200 bg-gray-100 px-4 py-3 text-sm text-gray-600 outline-none" />
                        </div>
                    </div>

                    <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <button type="button"
                            class="inline-flex items-center justify-center rounded-2xl bg-primary px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-primary/90 transition">
                            Save Profile
                        </button>
                        <p class="text-sm text-gray-500">Profile fields are UI-only for now.</p>
                    </div>
                </section>

                <section class="rounded-3xl border border-gray-200 bg-white shadow-xl p-8">
                    <div class="mb-8">
                        <h2 class="text-3xl font-semibold text-gray-900">Reset Password</h2>
                        <p class="mt-2 text-sm text-gray-600">Send a reset link to your email address.</p>
                    </div>

                    <form class="space-y-6">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                            <input id="email" name="email" type="email" placeholder="you@example.com"
                                class="mt-3 w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" />
                        </div>

                        <button type="submit"
                            class="w-full rounded-2xl bg-primary px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-primary/90 transition">
                            Send Reset Link
                        </button>
                    </form>

                    <p class="mt-6 text-center text-sm text-gray-500">
                        Remembered your password?
                        <a href="{{ url('/app/user/log') }}" class="font-semibold text-primary hover:underline">Back to login</a>
                    </p>
                </section>
            </div>
        </div>
    </div>
@endsection
