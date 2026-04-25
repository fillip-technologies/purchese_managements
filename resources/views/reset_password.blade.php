@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
    <div class="min-h-screen bg-gray-50 py-16">
        <div class="max-w-md mx-auto px-4">
            <div class="bg-white shadow-xl rounded-3xl border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-primary to-secondary text-white text-center py-8 px-6">
                    <h1 class="text-3xl font-semibold">Forgot Password</h1>
                    <p class="mt-2 text-sm text-white/80">Enter your registered email address and we’ll send a reset link.</p>
                </div>

                <div class="p-8">
                    @if (session('success'))
                        <div class="mb-6 rounded-xl bg-green-50 border border-green-200 p-4 text-sm text-green-700">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->has('email'))
                        <div class="mb-4 rounded-xl bg-red-50 border border-red-200 p-4 text-sm text-red-700">
                            {{ $errors->first('email') }}
                        </div>
                    @endif

                    <form action="{{ route('reset.password') }}" method="POST" class="space-y-5">
                        @csrf
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                            <div class="relative">
                                <input type="email" name="email" id="email" placeholder="you@example.com"
                                    value="{{ old('email') }}"
                                    class="w-full rounded-2xl border border-gray-300 px-4 py-3 pr-12 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" />
                                <span class="absolute inset-y-0 right-4 inline-flex items-center text-gray-400">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full rounded-2xl bg-primary text-white py-3 text-sm font-semibold shadow-md hover:bg-primary/90 transition">
                            Send Reset Link
                        </button>
                    </form>

                    <p class="text-center text-sm text-gray-500 mt-6">
                        Remembered your password?
                        <a href="{{ url('/app/user/log') }}" class="text-primary font-semibold hover:underline">Go back to login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
