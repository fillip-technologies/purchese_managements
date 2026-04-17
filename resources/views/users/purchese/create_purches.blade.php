@extends('admin.include.layout')

@section('heading', 'Requests')
@section('title', 'Add Request')

@section('content')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                confirmButtonColor: '#3085d6'
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Validation Error',
                html: `
        <ul style="text-align:center;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    `,
                confirmButtonColor: '#f59e0b'
            });
        </script>
    @endif
    <div class="max-w-3xl mx-auto mt-6">

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

            <!-- Header -->
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Add New Request</h2>
                <p class="text-sm text-gray-400">Fill details to create a new request</p>
            </div>

            <form action="{{ route('store.purches') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Grid Start -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <!-- Project Name -->
                    <div>
                        <label class="text-sm text-gray-600">Project Name</label>
                        <input type="text" name="project_name" value="{{ old('project_name') }}"
                            class="w-full mt-1 px-4 py-2.5 border border-gray-200 rounded-xl
                        focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none @error('project_name') border-red-400 @enderror">

                        @error('project_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Client -->
                    <div>
                        <label class="text-sm text-gray-600">Client</label>
                        <select name="client_id"
                            class="w-full mt-1 px-4 py-2.5 border border-gray-200 rounded-xl
                        focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none @error('client_id') border-red-400 @enderror">

                            <option value="">Select Client</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                    {{ $client->client_name }}
                                </option>
                            @endforeach
                        </select>

                        @error('client_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="text-sm text-gray-600">Status</label>
                        <select name="status"
                            class="w-full mt-1 px-4 py-2.5 border border-gray-200 rounded-xl
                        focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none @error('status') border-red-400 @enderror">

                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="submitted" {{ old('status') == 'submitted' ? 'selected' : '' }}>Submitted
                            </option>
                            <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>

                        @error('status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remarks Full Width -->
                    <div class="md:col-span-2">
                        <label class="text-sm text-gray-600">Remarks</label>
                        <textarea name="remarks" rows="3"
                            class="w-full mt-1 px-4 py-2.5 border border-gray-200 rounded-xl
                        focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none @error('remarks') border-red-400 @enderror">{{ old('remarks') }}</textarea>

                        @error('remarks')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
                <!-- Grid End -->

                <!-- Button -->
                <div class="flex justify-end pt-4">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl text-sm font-medium shadow-sm transition">
                        + Create Request
                    </button>
                </div>

            </form>

        </div>
    </div>

@endsection
