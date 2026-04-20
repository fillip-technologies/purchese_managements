@extends('admin.include.layout')
@section('title', 'Clients')
@section('content')

<div class="p-6 bg-slate-50 dark:bg-slate-900 min-h-screen">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-7 flex-wrap gap-4">
        <div>
            <h3 class="text-2xl font-bold text-slate-800 dark:text-white mb-1">Clients</h3>
            <p class="text-sm text-slate-500 dark:text-slate-400">Manage your client records</p>
        </div>
        <a href="{{ route('clients.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white px-5 py-2.5 rounded-xl font-medium text-sm shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Add New Client
        </a>
    </div>

    @if(session('success'))
        <div class="flex items-center gap-3 bg-emerald-50 dark:bg-emerald-900/30 border-l-4 border-emerald-500 text-emerald-700 dark:text-emerald-400 p-4 rounded-xl mb-6">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Search and Filter Section -->
    <div class="flex gap-4 mb-6 flex-wrap">
        <div class="flex-1 min-w-[250px] relative">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 dark:text-slate-500 w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input type="text" id="searchInput" placeholder="Search by client name, phone or company..."
                class="w-full pl-11 pr-4 py-3 border border-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none">
        </div>

        <div class="flex gap-3">
            <select id="statusFilter" class="px-4 py-3 border border-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 rounded-xl bg-white dark:bg-slate-800 cursor-pointer appearance-none pr-10 focus:ring-2 focus:ring-indigo-500 outline-none"
                style="background-image: url('data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"%2364748b\" stroke-width=\"2\"><polyline points=\"6 9 12 15 18 9\"></polyline></svg>'); background-repeat: no-repeat; background-position: right 1rem center;">
                <option value="">All Status</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>

            <button id="resetFilters" class="inline-flex items-center gap-2 px-5 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 transition-all font-medium text-sm text-slate-700 dark:text-slate-300">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"></path>
                    <path d="M3 3v5h5"></path>
                </svg>
                Reset
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid md:grid-cols-3 gap-5 mb-7">
        <div class="bg-white dark:bg-slate-800 rounded-xl p-5 flex items-center gap-4 shadow-sm hover:shadow-md transition-all">
            <div class="w-14 h-14 bg-indigo-50 dark:bg-indigo-900/30 rounded-xl flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
            </div>
            <div>
                <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">Total Clients</p>
                <p class="text-3xl font-bold text-slate-800 dark:text-white" id="totalCount">{{ $clients->total() }}</p>
            </div>
        </div>
        <div class="bg-white dark:bg-slate-800 rounded-xl p-5 flex items-center gap-4 shadow-sm hover:shadow-md transition-all">
            <div class="w-14 h-14 bg-emerald-50 dark:bg-emerald-900/30 rounded-xl flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </div>
            <div>
                <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">Active</p>
                <p class="text-3xl font-bold text-slate-800 dark:text-white" id="activeCount">0</p>
            </div>
        </div>
        <div class="bg-white dark:bg-slate-800 rounded-xl p-5 flex items-center gap-4 shadow-sm hover:shadow-md transition-all">
            <div class="w-14 h-14 bg-red-50 dark:bg-red-900/30 rounded-xl flex items-center justify-center text-red-600 dark:text-red-400">
                <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
            </div>
            <div>
                <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">Inactive</p>
                <p class="text-3xl font-bold text-slate-800 dark:text-white" id="inactiveCount">0</p>
            </div>
        </div>
    </div>

    <!-- Client Table -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full" id="clientTable">
                <thead class="bg-slate-50 dark:bg-slate-700/50 border-b border-slate-100 dark:border-slate-700">
                    <tr>
                        <th class="text-left px-6 py-4 font-semibold text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider">#</th>
                        <th class="text-left px-6 py-4 font-semibold text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider">Client Name</th>
                        <th class="text-left px-6 py-4 font-semibold text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider">Company</th>
                        <th class="text-left px-6 py-4 font-semibold text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider">Phone</th>
                        <th class="text-left px-6 py-4 font-semibold text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider">Email</th>
                        <th class="text-left px-6 py-4 font-semibold text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                        <th class="text-left px-6 py-4 font-semibold text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider w-[140px]">Actions</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @foreach($clients as $key => $client)
                    <tr class="border-b border-slate-100 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors"
                        data-status="{{ $client->status }}"
                        data-name="{{ strtolower($client->client_name) }}"
                        data-phone="{{ $client->phone }}"
                        data-company="{{ strtolower($client->company_name ?? '') }}">
                        <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400" data-label="#"> {{ $clients->firstItem() + $key }} </td>
                        <td class="px-6 py-4" data-label="Client Name">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 bg-gradient-to-br from-indigo-600 to-indigo-700 text-white rounded-lg flex items-center justify-center text-sm font-bold">
                                    {{ strtoupper(substr($client->client_name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="font-semibold text-slate-800 dark:text-white">{{ $client->client_name }}</div>
                                    <div class="text-xs text-slate-400 dark:text-slate-500">ID: #{{ $client->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400" data-label="Company">{{ $client->company_name ?? '—' }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400" data-label="Phone">{{ $client->phone ?? '—' }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400" data-label="Email">{{ $client->email ?? '—' }}</td>
                        <td class="px-6 py-4" data-label="Status">
                            @if($client->status == 'Active')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400">
                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-1.5"></span>
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></span>
                                    Inactive
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4" data-label="Actions">
                            <div class="flex gap-2">
                                <a href="{{ route('clients.show', $client->id) }}" class="p-2 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-lg hover:bg-indigo-600 hover:text-white transition-all" title="View">
                                    <svg class="w-4.5 h-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </a>
                                <a href="{{ route('clients.edit', $client->id) }}" class="p-2 bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 rounded-lg hover:bg-amber-600 hover:text-white transition-all" title="Edit">
                                    <svg class="w-4.5 h-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M17 3l4 4L7 21H3v-4L17 3z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Delete this client?')" class="p-2 bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 rounded-lg hover:bg-red-600 hover:text-white transition-all" title="Delete">
                                        <svg class="w-4.5 h-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- No Results -->
        <div id="noResults" class="hidden flex-col items-center justify-center py-16 text-center">
            <svg class="w-16 h-16 text-slate-300 dark:text-slate-600 mb-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <h4 class="text-lg font-semibold text-slate-600 dark:text-slate-400 mb-1">No clients found</h4>
            <p class="text-sm text-slate-400 dark:text-slate-500">Try adjusting your search or filter criteria</p>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-end">
        {{ $clients->links() }}
    </div>
</div>

<script>
function updateStats() {
    const rows = document.querySelectorAll('#tableBody tr:not([style*="display: none"])');
    let activeCount = 0, inactiveCount = 0;

    rows.forEach(row => {
        if (row.style.display !== 'none') {
            const status = row.getAttribute('data-status');
            if (status === 'Active') activeCount++;
            else if (status === 'Inactive') inactiveCount++;
        }
    });

    document.getElementById('activeCount').textContent = activeCount;
    document.getElementById('inactiveCount').textContent = inactiveCount;
}

function filterTable() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const statusFilter = document.getElementById('statusFilter').value;
    const rows = document.querySelectorAll('#tableBody tr');
    let visibleCount = 0;

    rows.forEach(row => {
        const name = row.getAttribute('data-name');
        const phone = row.getAttribute('data-phone');
        const company = row.getAttribute('data-company');
        const status = row.getAttribute('data-status');

        const matchesSearch = name?.includes(searchTerm) || phone?.includes(searchTerm) || company?.includes(searchTerm);
        const matchesStatus = statusFilter === '' || status === statusFilter;

        if (matchesSearch && matchesStatus) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });

    const noResults = document.getElementById('noResults');
    noResults.classList.toggle('hidden', visibleCount > 0);
    noResults.classList.toggle('flex', visibleCount === 0);

    updateStats();
}

let debounceTimer;
document.getElementById('searchInput').addEventListener('input', function() {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(filterTable, 300);
});

document.getElementById('statusFilter').addEventListener('change', filterTable);
document.getElementById('resetFilters').addEventListener('click', function() {
    document.getElementById('searchInput').value = '';
    document.getElementById('statusFilter').value = '';
    filterTable();
});

document.addEventListener('DOMContentLoaded', updateStats);
</script>

@endsection
