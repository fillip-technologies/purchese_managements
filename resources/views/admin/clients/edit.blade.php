@extends('admin.include.layout')
@section('title', 'Edit Client')
@section('content')

<div class="max-w-5xl mx-auto px-4 py-6 bg-slate-50 dark:bg-slate-900 min-h-screen">
    <!-- Header Section -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 mb-7 shadow-sm">
        <div class="flex justify-between items-center flex-wrap gap-5">
            <div class="flex flex-col gap-4">
                <a href="{{ route('clients.index') }}" class="inline-flex items-center gap-2 text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 text-sm font-medium transition-all hover:gap-3 w-fit">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    Back to Client List
                </a>
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-amber-50 to-amber-100 dark:from-amber-900/50 dark:to-amber-800/50 text-amber-600 dark:text-amber-400 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M17 3l4 4L7 21H3v-4L17 3z"></path>
                            <path d="M15 5l4 4"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-slate-800 dark:text-white mb-1">Edit Client</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Update client information</p>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2 bg-slate-50 dark:bg-slate-700/50 px-4 py-2 rounded-full">
                    <div class="w-8 h-8 bg-emerald-600 text-white rounded-full flex items-center justify-center text-xs font-bold">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                    <span class="text-sm text-slate-600 dark:text-slate-300 font-medium">Editing Mode</span>
                </div>
                <a href="{{ route('clients.show', $client->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-lg text-sm font-medium hover:bg-indigo-100 dark:hover:bg-indigo-900/50 transition-all">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    View Details
                </a>
            </div>
        </div>
    </div>

    <!-- Form Section -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm overflow-hidden mb-6">
        <form action="{{ route('clients.update', $client->id) }}" method="POST" id="clientForm">
            @csrf
            @method('PUT')

            <div class="p-8">
                @include('admin.clients.forms')
            </div>

            <!-- Form Actions -->
            <div class="border-t border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-700/30 px-8 py-6 flex justify-between items-center flex-wrap gap-4">
                <div class="flex gap-4">
                    <a href="{{ route('clients.index') }}"
                        class="inline-flex items-center gap-2.5 px-7 py-3 bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 rounded-xl font-semibold text-sm border border-slate-200 dark:border-slate-600 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all">
                        <svg class="w-4.5 h-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                        Cancel
                    </a>

                    <button type="submit"
                        class="inline-flex items-center gap-2.5 px-7 py-3 bg-gradient-to-r from-amber-500 to-amber-600 text-white rounded-xl font-semibold text-sm shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all">
                        <svg class="w-4.5 h-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        Update Client
                    </button>
                </div>

                <div class="flex items-center gap-2 text-xs text-slate-400 dark:text-slate-500">
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

    <!-- Tips & Information Section -->
    <div class="grid md:grid-cols-2 gap-4">
        <div class="bg-white dark:bg-slate-800 rounded-xl p-3.5 flex items-center gap-3 border-l-4 border-amber-500 shadow-sm">
            <div class="w-8 h-8 bg-amber-50 dark:bg-amber-900/30 rounded-lg flex items-center justify-center text-amber-600 dark:text-amber-400">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M12 16v-4M12 8h.01"></path>
                </svg>
            </div>
            <div class="text-sm text-slate-600 dark:text-slate-400">
                <strong class="text-slate-800 dark:text-slate-200">Tip:</strong> Update only the fields that need to be changed
            </div>
        </div>
        <div class="bg-white dark:bg-slate-800 rounded-xl p-3.5 flex items-center gap-3 border-l-4 border-amber-500 shadow-sm">
            <div class="w-8 h-8 bg-amber-50 dark:bg-amber-900/30 rounded-lg flex items-center justify-center text-amber-600 dark:text-amber-400">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                </svg>
            </div>
            <div class="text-sm text-slate-600 dark:text-slate-400">
                <strong class="text-slate-800 dark:text-slate-200">Info:</strong> Client ID: #{{ $client->id }} - Created: {{ $client->created_at ? $client->created_at->format('d M Y') : 'N/A' }}
            </div>
        </div>
    </div>
</div>

<script>
// Form validation feedback
document.getElementById('clientForm')?.addEventListener('submit', function(e) {
    const requiredFields = this.querySelectorAll('[required]');
    let isValid = true;

    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            field.classList.add('border-red-500', 'bg-red-50', 'dark:bg-red-900/20');
            isValid = false;
        } else {
            field.classList.remove('border-red-500', 'bg-red-50', 'dark:bg-red-900/20');
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
        this.classList.remove('border-red-500', 'bg-red-50', 'dark:bg-red-900/20');
    });
});

// Warn before leaving if changes were made
let formChanged = false;
document.querySelectorAll('input, select, textarea').forEach(field => {
    field.addEventListener('change', function() {
        formChanged = true;
    });
});

window.addEventListener('beforeunload', function(e) {
    if (formChanged) {
        e.preventDefault();
        e.returnValue = 'You have unsaved changes. Are you sure you want to leave?';
    }
});

document.getElementById('clientForm')?.addEventListener('submit', function() {
    formChanged = false;
});
</script>

@endsection
