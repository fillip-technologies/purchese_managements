@extends('admin.include.layout')

@section('heading', 'Products')
@section('title', 'Add Product')

@section('content')

<div class="max-w-4xl mx-auto mt-6">

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Add New Product</h2>
            <p class="text-sm text-gray-400">Manage your inventory products</p>
        </div>

        <form action="" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <!-- Product Name -->
                <div>
                    <label class="text-sm text-gray-600">Product Name *</label>
                    <input type="text" name="product_name" value="{{ old('product_name') }}"
                        class="w-full mt-1 px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none">
                </div>

                <!-- SKU -->
                <div>
                    <label class="text-sm text-gray-600">SKU Code</label>
                    <input type="text" name="sku_code" value="{{ old('sku_code') }}"
                        class="w-full mt-1 px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none">
                </div>

                <!-- Category -->
                <div>
                    <label class="text-sm text-gray-600">Category</label>
                    <input type="text" name="category" value="{{ old('category') }}"
                        class="w-full mt-1 px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none">
                </div>

                <!-- Unit -->
                <div>
                    <label class="text-sm text-gray-600">Unit (kg, pcs, box)</label>
                    <input type="text" name="unit" value="{{ old('unit') }}"
                        placeholder="e.g. pcs, kg"
                        class="w-full mt-1 px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none">
                </div>

                <!-- Base Price -->
                <div>
                    <label class="text-sm text-gray-600">Base Price</label>
                    <input type="number" step="0.01" name="base_price" value="{{ old('base_price') }}"
                        class="w-full mt-1 px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none">
                </div>

                <!-- GST -->
                <div>
                    <label class="text-sm text-gray-600">GST (%)</label>
                    <input type="number" step="0.01" name="gst_percent" value="{{ old('gst_percent') }}"
                        placeholder="e.g. 18"
                        class="w-full mt-1 px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none">
                </div>

                <!-- Status -->
                <div>
                    <label class="text-sm text-gray-600">Status</label>
                    <select name="status"
                        class="w-full mt-1 px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <!-- Description Full -->
                <div class="md:col-span-2">
                    <label class="text-sm text-gray-600">Description</label>
                    <textarea name="description" rows="3"
                        class="w-full mt-1 px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none">{{ old('description') }}</textarea>
                </div>

            </div>

            <!-- Button -->
            <div class="flex justify-end pt-4">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl text-sm font-medium shadow-sm transition">
                    + Add Product
                </button>
            </div>

        </form>

    </div>
</div>

@endsection
