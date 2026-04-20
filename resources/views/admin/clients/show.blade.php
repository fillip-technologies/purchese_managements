@extends('admin.include.layout')
@section('title', 'Client Details')
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
                    Back to Clients
                </a>
                <div class="flex items-center gap-5">
                    <div class="w-[70px] h-[70px] bg-gradient-to-br from-indigo-600 to-indigo-700 text-white rounded-xl flex items-center justify-center text-2xl font-bold shadow-md">
                        {{ strtoupper(substr($client->client_name, 0, 2)) }}
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-slate-800 dark:text-white mb-2">{{ $client->client_name }}</h3>
                        <div class="flex items-center gap-3 flex-wrap">
                            <span class="text-xs text-slate-500 dark:text-slate-400 bg-slate-100 dark:bg-slate-700 px-3 py-1 rounded-full">ID: #{{ $client->id }}</span>
                            @if($client->status == 'Active')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400">
                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                                    Inactive
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('clients.edit', $client->id) }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 rounded-xl font-medium text-sm hover:bg-amber-600 hover:text-white transition-all">
                    <svg class="w-4.5 h-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 3l4 4L7 21H3v-4L17 3z"></path>
                    </svg>
                    Edit Client
                </a>
                <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Delete this client?')" class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400 rounded-xl font-medium text-sm hover:bg-red-600 hover:text-white transition-all">
                        <svg class="w-4.5 h-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        </svg>
                        Delete Client
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Info Cards Grid -->
    <div class="grid md:grid-cols-2 gap-6 mb-7">
        <!-- Basic Information Card -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-all">
            <div class="flex items-center gap-3 px-6 py-4 bg-slate-50 dark:bg-slate-700/50 border-b border-slate-100 dark:border-slate-700">
                <div class="w-9 h-9 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
                <h4 class="font-semibold text-slate-800 dark:text-white">Basic Information</h4>
            </div>
            <div class="p-6 divide-y divide-slate-100 dark:divide-slate-700">
                <div class="flex justify-between items-center py-3">
                    <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Client Name</span>
                    <span class="text-sm font-medium text-slate-800 dark:text-white">{{ $client->client_name }}</span>
                </div>
                <div class="flex justify-between items-center py-3">
                    <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Company Name</span>
                    <span class="text-sm text-slate-600 dark:text-slate-300">{{ $client->company_name ?? '—' }}</span>
                </div>
                <div class="flex justify-between items-center py-3">
                    <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">GST Number</span>
                    <span class="text-sm text-slate-600 dark:text-slate-300">{{ $client->gst_no ?? '—' }}</span>
                </div>
            </div>
        </div>

        <!-- Contact Information Card -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-all">
            <div class="flex items-center gap-3 px-6 py-4 bg-slate-50 dark:bg-slate-700/50 border-b border-slate-100 dark:border-slate-700">
                <div class="w-9 h-9 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.362 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.338 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                </div>
                <h4 class="font-semibold text-slate-800 dark:text-white">Contact Information</h4>
            </div>
            <div class="p-6 divide-y divide-slate-100 dark:divide-slate-700">
                <div class="flex justify-between items-center py-3">
                    <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Contact Person</span>
                    <span class="text-sm text-slate-600 dark:text-slate-300">{{ $client->contact_person ?? '—' }}</span>
                </div>
                <div class="flex justify-between items-center py-3">
                    <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Phone Number</span>
                    @if($client->phone)
                        <a href="tel:{{ $client->phone }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 hover:underline">{{ $client->phone }}</a>
                    @else
                        <span class="text-sm text-slate-600 dark:text-slate-300">—</span>
                    @endif
                </div>
                <div class="flex justify-between items-center py-3">
                    <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Email Address</span>
                    @if($client->email)
                        <a href="mailto:{{ $client->email }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 hover:underline">{{ $client->email }}</a>
                    @else
                        <span class="text-sm text-slate-600 dark:text-slate-300">—</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Address Card - Full Width -->
        <div class="md:col-span-2 bg-white dark:bg-slate-800 rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-all">
            <div class="flex items-center gap-3 px-6 py-4 bg-slate-50 dark:bg-slate-700/50 border-b border-slate-100 dark:border-slate-700">
                <div class="w-9 h-9 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                </div>
                <h4 class="font-semibold text-slate-800 dark:text-white">Address</h4>
            </div>
            <div class="p-6">
                <div class="flex gap-3 p-4 bg-slate-50 dark:bg-slate-700/30 rounded-xl text-slate-600 dark:text-slate-300">
                    <svg class="w-5 h-5 text-indigo-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    <span class="text-sm leading-relaxed">{{ $client->address ?? 'No address provided' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm p-5">
        <h4 class="font-semibold text-slate-800 dark:text-white mb-4">Quick Actions</h4>
        <div class="flex gap-4 flex-wrap">
            <button onclick="window.print()" class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 rounded-lg text-sm font-medium hover:bg-slate-200 dark:hover:bg-slate-600 transition-all">
                <svg class="w-4.5 h-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 9V3h12v6"></path>
                    <path d="M6 21h12a2 2 0 0 0 2-2v-6H4v6a2 2 0 0 0 2 2z"></path>
                    <line x1="8" y1="15" x2="16" y2="15"></line>
                </svg>
                Print Details
            </button>
            @if($client->email)
            <a href="mailto:{{ $client->email }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 rounded-lg text-sm font-medium hover:bg-slate-200 dark:hover:bg-slate-600 transition-all">
                <svg class="w-4.5 h-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
                Send Email
            </a>
            @endif
            @if($client->phone)
            <a href="tel:{{ $client->phone }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 rounded-lg text-sm font-medium hover:bg-slate-200 dark:hover:bg-slate-600 transition-all">
                <svg class="w-4.5 h-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.362 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.338 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg>
                Call Client
            </a>
            @endif
        </div>
    </div>
</div>

<style>
@media print {
    .bg-slate-50, .dark\:bg-slate-900 { background: white; }
    .shadow-sm { box-shadow: none; }
    a[href]:after, button { display: none; }
    .no-print { display: none; }
}
</style>

@endsection
