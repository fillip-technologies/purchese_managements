@extends('admin.include.layout')
@section('title', 'Create Vendor')
@section('content')

<div class="max-w-5xl mx-auto px-4 py-6 bg-slate-50 min-h-screen">
    <!-- Header Section -->
    <div class="bg-white rounded-2xl p-6 mb-7 shadow-sm">
        <div class="flex justify-between items-center flex-wrap gap-5">
            <div class="flex flex-col gap-4">
                <a href="{{ route('vendors.index') }}" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 text-sm font-medium transition-all hover:gap-3 w-fit">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    Back to Vendor List
                </a>
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-indigo-50 to-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                            <line x1="12" y1="11" x2="12" y2="15"></line>
                            <line x1="10" y1="13" x2="14" y2="13"></line>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-slate-800 mb-1">Add New Vendor</h3>
                        <p class="text-sm text-slate-500">Fill in the details to create a new vendor record</p>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-2 bg-slate-50 px-4 py-2 rounded-full">
                <div class="w-8 h-8 bg-indigo-600 text-white rounded-full flex items-center justify-center text-xs font-bold">1</div>
                <div class="w-8 h-0.5 bg-slate-200"></div>
                <div class="w-8 h-8 bg-white border-2 border-slate-200 rounded-full flex items-center justify-center text-xs font-bold text-slate-400">2</div>
                <div class="w-8 h-0.5 bg-slate-200"></div>
                <div class="w-8 h-8 bg-white border-2 border-slate-200 rounded-full flex items-center justify-center text-xs font-bold text-slate-400">3</div>
            </div>
        </div>
    </div>

    <!-- Form Section -->
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-6">
        <form action="{{ route('vendors.store') }}" method="POST" id="vendorForm">
            @csrf
            
                @include('admin.vendors.form')
            <!-- Form Actions -->
            <div class="border-t border-slate-100 bg-slate-50/50 px-8 py-6 flex justify-between items-center flex-wrap gap-4">
                <div class="flex gap-4">
                    <button type="reset" onclick="return confirm('Reset form? All data will be lost.')" 
                        class="inline-flex items-center gap-2.5 px-7 py-3 bg-white text-slate-600 rounded-xl font-semibold text-sm border border-slate-200 hover:bg-slate-50 transition-all">
                        <svg class="w-4.5 h-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"></path>
                            <path d="M3 3v5h5"></path>
                        </svg>
                        Reset Form
                    </button>
                    
                    <button type="submit" 
                        class="inline-flex items-center gap-2.5 px-7 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-xl font-semibold text-sm shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all">
                        <svg class="w-4.5 h-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        Save Vendor
                    </button>
                </div>
                
                <div class="flex items-center gap-2 text-xs text-slate-400">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <span>Fields marked with <span class="text-red-500 font-semibold">*</span> are required</span>
                </div>
            </div>
        </form>
    </div>

    <!-- Tips Section -->
    <div class="grid md:grid-cols-2 gap-4">
        <div class="bg-white rounded-xl p-3.5 flex items-center gap-3 border-l-4 border-indigo-500 shadow-sm">
            <div class="w-8 h-8 bg-indigo-50 rounded-lg flex items-center justify-center text-indigo-600">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M12 16v-4M12 8h.01"></path>
                </svg>
            </div>
            <div class="text-sm text-slate-600">
                <strong class="text-slate-800">Tip:</strong> Ensure all mandatory fields are filled correctly
            </div>
        </div>
        <div class="bg-white rounded-xl p-3.5 flex items-center gap-3 border-l-4 border-indigo-500 shadow-sm">
            <div class="w-8 h-8 bg-indigo-50 rounded-lg flex items-center justify-center text-indigo-600">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                </svg>
            </div>
            <div class="text-sm text-slate-600">
                <strong class="text-slate-800">Tip:</strong> GST number should be in format: XX-XXXXX-XXXX
            </div>
        </div>
    </div>
</div>

<script>
function confirmReset() {
    return confirm('Are you sure you want to reset the form? All entered data will be lost.');
}

// Form validation feedback
document.getElementById('vendorForm')?.addEventListener('submit', function(e) {
    const requiredFields = this.querySelectorAll('[required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            field.classList.add('border-red-500', 'bg-red-50');
            isValid = false;
        } else {
            field.classList.remove('border-red-500', 'bg-red-50');
        }
    });
    
    if (!isValid) {
        e.preventDefault();
        alert('Please fill in all required fields.');
    }
});

// Remove error class on input
document.querySelectorAll('input, select, textarea').forEach(field => {
    field.addEventListener('input', function() {
        this.classList.remove('border-red-500', 'bg-red-50');
    });
});
</script>

@endsection
