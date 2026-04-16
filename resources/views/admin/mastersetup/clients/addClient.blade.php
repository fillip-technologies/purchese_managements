@extends('admin.include.layout')

@section('heading', 'Clients')
@section('title', 'Add Clients')

@section('content')

<div class="max-w-3xl mx-auto mt-6">

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Add New Clients</h2>
            <p class="text-sm text-gray-400">Manage your clients details</p>
        </div>

        <form action="" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>
                    <label class="text-sm text-gray-600">Clients Name *</label>
                    <input type="text" name="vendor_name" value="{{ old('vendor_name') }}"
                        class="w-full mt-1 px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none">
                </div>

                <!-- Company Name -->
                <div>
                    <label class="text-sm text-gray-600">Company Name</label>
                    <input type="text" name="company_name" value="{{ old('company_name') }}"
                        class="w-full mt-1 px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none">
                </div>

                <!-- GST -->
                <div>
                    <label class="text-sm text-gray-600">GST Number</label>
                    <input type="text" name="gst_no" value="{{ old('gst_no') }}"
                        class="w-full mt-1 px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none">
                </div>

                <!-- Contact Person -->
                <div>
                    <label class="text-sm text-gray-600">Contact Person</label>
                    <input type="text" name="contact_person" value="{{ old('contact_person') }}"
                        class="w-full mt-1 px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none">
                </div>

                <!-- Phone -->
                <div>
                    <label class="text-sm text-gray-600">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                        class="w-full mt-1 px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none">
                </div>

                <!-- Email -->
                <div>
                    <label class="text-sm text-gray-600">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
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

                <!-- Address Full Width -->
                <div class="md:col-span-2">
                    <label class="text-sm text-gray-600">Address</label>
                    <textarea name="address" rows="3"
                        class="w-full mt-1 px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none">{{ old('address') }}</textarea>
                </div>

            </div>

            <!-- Button -->
            <div class="flex justify-end pt-4">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl text-sm font-medium shadow-sm transition">
                    + Add Clients
                </button>
            </div>

        </form>

    </div>
</div>

@endsection
