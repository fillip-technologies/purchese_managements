@extends('admin.include.layout')

@section('heading', 'Users')
@section('title', 'Add User')

@section('content')

<div class="max-w-3xl mx-auto mt-6">

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Add New User</h2>
            <p class="text-sm text-gray-400">Fill details to create a new user</p>
        </div>

        <form action="" method="POST" class="space-y-5">
            @csrf

            <!-- Grid Start -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <!-- Name -->
                <div>
                    <label class="text-sm text-gray-600">Full Name</label>
                    <input type="text" name="name"
                        class="w-full mt-1 px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none">
                </div>

                <!-- Email -->
                <div>
                    <label class="text-sm text-gray-600">Email</label>
                    <input type="email" name="email"
                        class="w-full mt-1 px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none">
                </div>

                <!-- Phone -->
                <div>
                    <label class="text-sm text-gray-600">Phone</label>
                    <input type="text" name="phone"
                        class="w-full mt-1 px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none">
                </div>

                <!-- Role -->
                <div>
                    <label class="text-sm text-gray-600">Role</label>
                    <select name="role"
                        class="w-full mt-1 px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none">
                        <option value="">-- Select Role --</option>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <!-- Password -->
                <div>
                    <label class="text-sm text-gray-600">Password</label>
                    <input type="password" name="password"
                        class="w-full mt-1 px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none">
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="text-sm text-gray-600">Confirm Password</label>
                    <input type="password" name="password_confirmation"
                        class="w-full mt-1 px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none">
                </div>

                <!-- Address Full Width -->
                <div class="md:col-span-2">
                    <label class="text-sm text-gray-600">Address</label>
                    <textarea name="address" rows="3"
                        class="w-full mt-1 px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none"></textarea>
                </div>

            </div>
            <!-- Grid End -->

            <!-- Button -->
            <div class="flex justify-end pt-4">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl text-sm font-medium shadow-sm transition">
                    + Create User
                </button>
            </div>

        </form>

    </div>
</div>

@endsection
