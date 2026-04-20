@extends('admin.include.layout')
@section('title', 'Vendors')
@section('content')

<div class="vendor-list-container">
    <div class="page-header">
        <div>
            <h3 class="page-title">Vendors</h3>
            <p class="page-subtitle">Manage your vendor records</p>
        </div>
        <a href="{{ route('vendors.create') }}" class="btn-primary-custom">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Add New Vendor
        </a>
    </div>

    @if(session('success'))
        <div class="alert-success-custom">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Search and Filter Section -->
    <div class="filter-section">
        <div class="search-box">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input type="text" id="searchInput" placeholder="Search by vendor name, phone or company..." class="search-input">
        </div>

        <div class="filter-group">
            <select id="statusFilter" class="filter-select">
                <option value="">All Status</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>

            <button id="resetFilters" class="btn-reset">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"></path>
                    <path d="M3 3v5h5"></path>
                </svg>
                Reset
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon total-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
            </div>
            <div class="stat-info">
                <span class="stat-label">Total Vendors</span>
                <span class="stat-value" id="totalCount">{{ $vendors->total() }}</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon active-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </div>
            <div class="stat-info">
                <span class="stat-label">Active</span>
                <span class="stat-value" id="activeCount">0</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon inactive-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
            </div>
            <div class="stat-info">
                <span class="stat-label">Inactive</span>
                <span class="stat-value" id="inactiveCount">0</span>
            </div>
        </div>
    </div>

    <!-- Vendor Table -->
    <div class="table-container">
        <table class="vendor-table" id="vendorTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Vendor Name</th>
                    <th>Company</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th class="action-col">Actions</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @foreach($vendors as $key => $vendor)
                <tr data-status="{{ $vendor->status }}" data-name="{{ strtolower($vendor->vendor_name) }}" data-phone="{{ $vendor->phone }}" data-company="{{ strtolower($vendor->company_name ?? '') }}">
                    <td data-label="#">{{ $vendors->firstItem() + $key }}</td>
                    <td data-label="Vendor Name">
                        <div class="vendor-name">
                            <div class="vendor-avatar">
                                {{ strtoupper(substr($vendor->vendor_name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="name-main">{{ $vendor->vendor_name }}</div>
                                <div class="name-sub">ID: #{{ $vendor->id }}</div>
                            </div>
                        </div>
                    </td>
                    <td data-label="Company">{{ $vendor->company_name ?? '—' }}</td>
                    <td data-label="Phone">{{ $vendor->phone ?? '—' }}</td>
                    <td data-label="Email">{{ $vendor->email ?? '—' }}</td>
                    <td data-label="Status">{!! status_badge($vendor->status) !!}</td>
                    <td data-label="Actions" class="action-buttons">
                        <a href="{{ route('vendors.show', $vendor->id) }}" class="action-btn view-btn" title="View">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </a>
                        <a href="{{ route('vendors.edit', $vendor->id) }}" class="action-btn edit-btn" title="Edit">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M17 3l4 4L7 21H3v-4L17 3z"></path>
                            </svg>
                        </a>
                        <form action="{{ route('vendors.destroy', $vendor->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Delete this vendor?')" class="action-btn delete-btn" title="Delete">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div id="noResults" class="no-results" style="display: none;">
            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <h4>No vendors found</h4>
            <p>Try adjusting your search or filter criteria</p>
        </div>
    </div>

    <!-- Pagination -->
    <div class="pagination-wrapper">
        {{ $vendors->links() }}
    </div>
</div>

<script>
// Search and Filter functionality
function updateStats() {
    const rows = document.querySelectorAll('#tableBody tr');
    let activeCount = 0;
    let inactiveCount = 0;

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

        const matchesSearch = name.includes(searchTerm) ||
                             phone.includes(searchTerm) ||
                             company.includes(searchTerm);
        const matchesStatus = statusFilter === '' || status === statusFilter;

        if (matchesSearch && matchesStatus) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });

    // Show/hide no results message
    const noResults = document.getElementById('noResults');
    if (visibleCount === 0) {
        noResults.style.display = 'flex';
    } else {
        noResults.style.display = 'none';
    }

    updateStats();
}

// Debounce search for better performance
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

// Initialize stats on page load
document.addEventListener('DOMContentLoaded', function() {
    updateStats();
});
</script>

<style>
/* Main Container */
.vendor-list-container {
    padding: 24px;
    background: #f8fafc;
    min-height: 100vh;
}

/* Page Header */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 28px;
    flex-wrap: wrap;
    gap: 16px;
}

.page-title {
    font-size: 28px;
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 4px 0;
}

.page-subtitle {
    color: #64748b;
    font-size: 14px;
    margin: 0;
}

.btn-primary-custom {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
    color: white;
    padding: 10px 20px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 500;
    font-size: 14px;
    transition: all 0.2s ease;
    box-shadow: 0 2px 4px rgba(79, 70, 229, 0.2);
}

.btn-primary-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    color: white;
}

/* Alert Success */
.alert-success-custom {
    display: flex;
    align-items: center;
    gap: 12px;
    background: #ecfdf5;
    border-left: 4px solid #10b981;
    padding: 14px 20px;
    border-radius: 10px;
    margin-bottom: 24px;
    color: #065f46;
    font-weight: 500;
}

/* Filter Section */
.filter-section {
    display: flex;
    gap: 16px;
    margin-bottom: 24px;
    flex-wrap: wrap;
}

.search-box {
    flex: 1;
    min-width: 250px;
    position: relative;
}

.search-box svg {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
}

.search-input {
    width: 100%;
    padding: 12px 12px 12px 44px;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    font-size: 14px;
    transition: all 0.2s ease;
    background: white;
}

.search-input:focus {
    outline: none;
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

.filter-group {
    display: flex;
    gap: 12px;
}

.filter-select {
    padding: 12px 36px 12px 16px;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    font-size: 14px;
    background: white;
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
}

.btn-reset {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 20px;
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.2s ease;
}

.btn-reset:hover {
    background: #f1f5f9;
    border-color: #cbd5e1;
}

/* Stats Cards */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 28px;
}

.stat-card {
    background: white;
    border-radius: 16px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 16px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    transition: all 0.2s ease;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.stat-icon {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.total-icon {
    background: #eef2ff;
    color: #4f46e5;
}

.active-icon {
    background: #ecfdf5;
    color: #10b981;
}

.inactive-icon {
    background: #fef2f2;
    color: #ef4444;
}

.stat-info {
    display: flex;
    flex-direction: column;
}

.stat-label {
    font-size: 13px;
    color: #64748b;
    font-weight: 500;
}

.stat-value {
    font-size: 28px;
    font-weight: 700;
    color: #1e293b;
}

/* Table Container */
.table-container {
    background: white;
    border-radius: 16px;
    overflow-x: auto;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
}

.vendor-table {
    width: 100%;
    border-collapse: collapse;
}

.vendor-table thead {
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
}

.vendor-table th {
    text-align: left;
    padding: 16px 20px;
    font-weight: 600;
    font-size: 13px;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.vendor-table td {
    padding: 16px 20px;
    border-bottom: 1px solid #f1f5f9;
    font-size: 14px;
    color: #334155;
}

.vendor-table tbody tr:hover {
    background: #fefce8;
}

/* Vendor Name Cell */
.vendor-name {
    display: flex;
    align-items: center;
    gap: 12px;
}

.vendor-avatar {
    width: 36px;
    height: 36px;
    background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
    color: white;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 14px;
}

.name-main {
    font-weight: 600;
    color: #1e293b;
}

.name-sub {
    font-size: 11px;
    color: #94a3b8;
    margin-top: 2px;
}

/* Action Buttons */
.action-col {
    width: 120px;
}

.action-buttons {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.action-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 8px;
    border-radius: 8px;
    transition: all 0.2s ease;
    text-decoration: none;
}

.view-btn {
    background: #eef2ff;
    color: #4f46e5;
}

.view-btn:hover {
    background: #4f46e5;
    color: white;
    transform: translateY(-2px);
}

.edit-btn {
    background: #fef3c7;
    color: #d97706;
}

.edit-btn:hover {
    background: #d97706;
    color: white;
    transform: translateY(-2px);
}

.delete-btn {
    background: #fee2e2;
    color: #ef4444;
    border: none;
    cursor: pointer;
}

.delete-btn:hover {
    background: #ef4444;
    color: white;
    transform: translateY(-2px);
}

/* No Results */
.no-results {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 60px 20px;
    text-align: center;
    color: #94a3b8;
}

.no-results svg {
    margin-bottom: 16px;
    color: #cbd5e1;
}

.no-results h4 {
    margin: 0 0 8px 0;
    color: #64748b;
}

/* Pagination */
.pagination-wrapper {
    margin-top: 24px;
    display: flex;
    justify-content: flex-end;
}

.pagination-wrapper .pagination {
    margin: 0;
}

/* Status Badge (if not already defined) */
.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.status-active {
    background: #ecfdf5;
    color: #10b981;
}

.status-inactive {
    background: #fef2f2;
    color: #ef4444;
}

/* Responsive */
@media (max-width: 768px) {
    .vendor-list-container {
        padding: 16px;
    }

    .page-title {
        font-size: 24px;
    }

    .vendor-table th {
        display: none;
    }

    .vendor-table td {
        display: block;
        padding: 12px 16px;
        text-align: right;
    }

    .vendor-table td::before {
        content: attr(data-label);
        float: left;
        font-weight: 600;
        color: #475569;
    }

    .action-buttons {
        justify-content: flex-end;
    }

    .filter-section {
        flex-direction: column;
    }

    .filter-group {
        justify-content: stretch;
    }

    .btn-reset, .filter-select {
        flex: 1;
    }
}
</style>

@endsection
