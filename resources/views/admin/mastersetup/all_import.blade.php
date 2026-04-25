@extends('admin.include.layout')

@section('heading', 'All Imports')
@section('title', 'Imports')

@section('content')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: `{!! implode('<br>', $errors->all()) !!}`
            });
        </script>
    @endif
    <div class="max-w-3xl mx-auto mt-6">

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

            <!-- Header -->
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Import Datas</h2>
                <p class="text-sm text-gray-400">Upload excel file and create data</p>
            </div>

            <form action="{{ route('data.imports') }}" method="POST" class="space-y-5" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="text-sm text-gray-600">Select Users</label>
                        <select name="section"
                            class="w-full mt-1 px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none">
                            <option value="">-- Select Section --</option>
                            @foreach (MasterSection() as $key => $mst)
                                <option value="{{ $key }}">{{ $mst }}</option>
                            @endforeach
                        </select>
                        @error('section')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Select Excel File</label>
                        <input type="file" name="file" value="{{ old('file') }}"
                            class="w-full mt-1 px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none">
                        @error('file')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>


                </div>
                 <div class="p-3 m-3">
                        <a href="" class="text-blue-500 hover:underline">Download Sample</a>
                    </div>
                <div class="flex justify-end pt-4 gap-3">
                       <a href="" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2.5 rounded-xl text-sm font-medium shadow-sm transition">Download Sample</a>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl text-sm font-medium shadow-sm transition">
                        + Upload
                    </button>

                </div>

            </form>

        </div>
    </div>

@endsection
