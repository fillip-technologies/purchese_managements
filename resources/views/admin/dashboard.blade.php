@extends('admin.include.layout')
@section('title', 'Dashboard')
@section('content')

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    <!-- Card -->
    <div class="bg-white/80 backdrop-blur rounded-2xl shadow-sm hover:shadow-lg p-6 border border-gray-100 transition-all duration-300 group">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-gray-500 text-sm">Total Users</p>
                <h3 class="text-3xl font-semibold text-gray-800 mt-2">0</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center group-hover:scale-110 transition">
                <i class="fas fa-users text-blue-600"></i>
            </div>
        </div>
        <div class="mt-4 text-sm">
            <span class="text-green-600 font-medium"><i class="fas fa-arrow-up"></i> 12.5%</span>
            <span class="text-gray-400 ml-2">Since last month</span>
        </div>
    </div>

    <!-- Repeat -->
    <div class="bg-white/80 backdrop-blur rounded-2xl shadow-sm hover:shadow-lg p-6 border border-gray-100 transition group">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-gray-500 text-sm">Active Bookings</p>
                <h3 class="text-3xl font-semibold text-gray-800 mt-2">0</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center group-hover:scale-110 transition">
                <i class="fas fa-calendar-check text-green-600"></i>
            </div>
        </div>
        <div class="mt-4 text-sm">
            <span class="text-green-600"><i class="fas fa-arrow-up"></i> 8.3%</span>
            <span class="text-gray-400 ml-2">Since last month</span>
        </div>
    </div>

    <div class="bg-white/80 backdrop-blur rounded-2xl shadow-sm hover:shadow-lg p-6 border border-gray-100 transition group">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-gray-500 text-sm">Total Products</p>
                <h3 class="text-3xl font-semibold text-gray-800 mt-2">0</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center group-hover:scale-110 transition">
                <i class="fas fa-box text-purple-600"></i>
            </div>
        </div>
        <div class="mt-4 text-sm">
            <span class="text-green-600"><i class="fas fa-arrow-up"></i> 5.2%</span>
            <span class="text-gray-400 ml-2">Since last month</span>
        </div>
    </div>

    <div class="bg-white/80 backdrop-blur rounded-2xl shadow-sm hover:shadow-lg p-6 border border-gray-100 transition group">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-gray-500 text-sm">Order Requests</p>
                <h3 class="text-3xl font-semibold text-gray-800 mt-2">0</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-yellow-50 flex items-center justify-center group-hover:scale-110 transition">
                <i class="fas fa-star text-yellow-500"></i>
            </div>
        </div>
        <div class="mt-4 text-sm">
            <span class="text-green-600"><i class="fas fa-arrow-up"></i> 0.3%</span>
            <span class="text-gray-400 ml-2">Since last month</span>
        </div>
    </div>

</div>

<!-- Charts + Table -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

    <!-- Chart -->
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold text-gray-700">Revenue Overview</h2>
            <div class="flex gap-2">
                <button class="text-xs bg-blue-50 text-blue-600 px-3 py-1 rounded-lg">Monthly</button>
                <button class="text-xs hover:bg-gray-100 px-3 py-1 rounded-lg">Yearly</button>
            </div>
        </div>
        <div class="h-64 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl flex items-center justify-center">
            <p class="text-gray-400">Chart will display here</p>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
        <h2 class="text-lg font-semibold text-gray-700 mb-6">Users List</h2>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-gray-400 border-b">
                        <th class="pb-3 text-left">Name</th>
                        <th class="pb-3 text-left">Email</th>
                        <th class="pb-3 text-left">Address</th>
                        <th class="pb-3 text-left">Phone</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600">
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="py-3">John Doe</td>
                        <td>john@mail.com</td>
                        <td>Delhi</td>
                        <td>9876543210</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Reviews -->
<div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
    <h2 class="text-lg font-semibold text-gray-700 mb-6">Recent Reviews</h2>

    <div class="space-y-5 text-sm">

        <div class="border-b pb-4">
            <div class="flex justify-between">
                <h3 class="font-medium text-gray-800">The Grand Ballroom</h3>
                <div class="text-yellow-400">
                    ★★★★★
                </div>
            </div>
            <p class="text-gray-500 mt-2">Excellent venue with professional staff.</p>
            <p class="text-gray-400 text-xs mt-1">- Amit Sharma</p>
        </div>

        <div class="border-b pb-4">
            <div class="flex justify-between">
                <h3 class="font-medium text-gray-800">Sunset Resort</h3>
                <div class="text-yellow-400">
                    ★★★★☆
                </div>
            </div>
            <p class="text-gray-500 mt-2">Good experience overall.</p>
            <p class="text-gray-400 text-xs mt-1">- Priya Singh</p>
        </div>

    </div>
</div>

@endsection
