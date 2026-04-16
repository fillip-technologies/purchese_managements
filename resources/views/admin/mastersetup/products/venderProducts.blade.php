@extends('admin.include.layout')

@section('heading', 'Vendor Products')
@section('title', 'Map Vendor Product')

@section('content')

<div class="max-w-5xl mx-auto mt-6">

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Vendor Product Mapping</h2>
            <p class="text-sm text-gray-400">Assign products to vendors</p>
        </div>

        <form action="#" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <!-- Vendor -->
                <div>
                    <label class="text-sm text-gray-600">Select Vendor</label>
                    <select class="w-full mt-1 px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500">
                        <option>-- Select Vendor --</option>
                        <option>ABC Traders</option>
                        <option>Sharma Suppliers</option>
                        <option>Global Distributors</option>
                    </select>
                </div>

                <!-- Product -->
                <div>
                    <label class="text-sm text-gray-600">Select Product</label>
                    <select class="w-full mt-1 px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500">
                        <option>-- Select Product --</option>
                        <option>Rice Bag 25kg</option>
                        <option>Wheat Flour 10kg</option>
                        <option>Cooking Oil 5L</option>
                    </select>
                </div>

                <!-- Price -->
                <div>
                    <label class="text-sm text-gray-600">Vendor Price</label>
                    <input type="number" placeholder="Enter price"
                        class="w-full mt-1 px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500">
                </div>

                <!-- GST -->
                <div>
                    <label class="text-sm text-gray-600">GST (%)</label>
                    <input type="number" placeholder="e.g. 18"
                        class="w-full mt-1 px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500">
                </div>

                <!-- Lead Time -->
                <div>
                    <label class="text-sm text-gray-600">Lead Time (Days)</label>
                    <input type="number" placeholder="e.g. 5"
                        class="w-full mt-1 px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500">
                </div>

            </div>

            <!-- Button -->
            <div class="flex justify-end pt-4">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl text-sm font-medium shadow-sm transition">
                    + Map Vendor Product
                </button>
            </div>

        </form>

    </div>
</div>

@endsection
