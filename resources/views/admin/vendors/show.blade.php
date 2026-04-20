@extends('admin.include.layout')
@section('title', 'Vendor Details')
@section('content')

<div class="vendor-details-container">
    <!-- Header Section -->
    <div class="details-header">
        <div class="header-left">
            <a href="{{ route('vendors.index') }}" class="back-link">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Back to Vendors
            </a>
            <div class="vendor-title">
                <div class="vendor-avatar-large">
                    {{ strtoupper(substr($vendor->vendor_name, 0, 2)) }}
                </div>
                <div>
                    <h3 class="vendor-name-large">{{ $vendor->vendor_name }}</h3>
                    <div class="vendor-meta">
                        <span class="vendor-id">ID: #{{ $vendor->id }}</span>
                        <span class="status-badge-large">{!! status_badge($vendor->status) !!}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-right">
            <a href="{{ route('vendors.edit', $vendor->id) }}" class="btn-edit">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 3l4 4L7 21H3v-4L17 3z"></path>
                </svg>
                Edit Vendor
            </a>
            <form action="{{ route('vendors.destroy', $vendor->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Delete this vendor?')" class="btn-delete">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    </svg>
                    Delete Vendor
                </button>
            </form>
        </div>
    </div>

    <!-- Info Cards Grid -->
    <div class="info-grid">
        <!-- Basic Information Card -->
        <div class="info-card">
            <div class="card-header">
                <div class="card-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
                <h4 class="card-title">Basic Information</h4>
            </div>
            <div class="card-body">
                <div class="info-row">
                    <span class="info-label">Vendor Name</span>
                    <span class="info-value">{{ $vendor->vendor_name }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Company Name</span>
                    <span class="info-value">{{ $vendor->company_name ?? '—' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">GST Number</span>
                    <span class="info-value">{{ $vendor->gst_no ?? '—' }}</span>
                </div>
            </div>
        </div>

        <!-- Contact Information Card -->
        <div class="info-card">
            <div class="card-header">
                <div class="card-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.362 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.338 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                </div>
                <h4 class="card-title">Contact Information</h4>
            </div>
            <div class="card-body">
                <div class="info-row">
                    <span class="info-label">Contact Person</span>
                    <span class="info-value">{{ $vendor->contact_person ?? '—' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Phone Number</span>
                    <span class="info-value">
                        @if($vendor->phone)
                            <a href="tel:{{ $vendor->phone }}" class="contact-link">
                                {{ $vendor->phone }}
                            </a>
                        @else
                            —
                        @endif
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Email Address</span>
                    <span class="info-value">
                        @if($vendor->email)
                            <a href="mailto:{{ $vendor->email }}" class="contact-link">
                                {{ $vendor->email }}
                            </a>
                        @else
                            —
                        @endif
                    </span>
                </div>
            </div>
        </div>

        <!-- Address Card -->
        <div class="info-card full-width">
            <div class="card-header">
                <div class="card-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                </div>
                <h4 class="card-title">Address</h4>
            </div>
            <div class="card-body">
                <div class="address-box">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    <span>{{ $vendor->address ?? 'No address provided' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Card -->
    <div class="quick-actions">
        <h4 class="quick-actions-title">Quick Actions</h4>
        <div class="actions-grid">
            <a href="#" class="quick-action-btn" onclick="window.print(); return false;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 9V3h12v6"></path>
                    <path d="M6 21h12a2 2 0 0 0 2-2v-6H4v6a2 2 0 0 0 2 2z"></path>
                    <line x1="8" y1="15" x2="16" y2="15"></line>
                </svg>
                Print Details
            </a>
            <a href="mailto:{{ $vendor->email }}" class="quick-action-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
                Send Email
            </a>
            <a href="tel:{{ $vendor->phone }}" class="quick-action-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.362 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.338 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg>
                Call Vendor
            </a>
        </div>
    </div>
</div>

<style>
/* Main Container */
.vendor-details-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 24px;
    background: #f8fafc;
    min-height: 100vh;
}

/* Header Section */
.details-header {
    background: white;
    border-radius: 20px;
    padding: 24px;
    margin-bottom: 28px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
}

.header-left {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #6366f1;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.2s ease;
    width: fit-content;
}

.back-link:hover {
    gap: 12px;
    color: #4f46e5;
}

.vendor-title {
    display: flex;
    align-items: center;
    gap: 20px;
}

.vendor-avatar-large {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
    color: white;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    font-weight: 700;
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
}

.vendor-name-large {
    font-size: 24px;
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 8px 0;
}

.vendor-meta {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}

.vendor-id {
    font-size: 13px;
    color: #64748b;
    background: #f1f5f9;
    padding: 4px 10px;
    border-radius: 20px;
}

.status-badge-large {
    display: inline-flex;
    align-items: center;
}

.header-right {
    display: flex;
    gap: 12px;
}

.btn-edit, .btn-delete {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: 10px;
    font-weight: 500;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
    border: none;
}

.btn-edit {
    background: #fef3c7;
    color: #d97706;
}

.btn-edit:hover {
    background: #d97706;
    color: white;
    transform: translateY(-2px);
}

.btn-delete {
    background: #fee2e2;
    color: #ef4444;
}

.btn-delete:hover {
    background: #ef4444;
    color: white;
    transform: translateY(-2px);
}

/* Info Grid */
.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 24px;
    margin-bottom: 28px;
}

.info-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    transition: all 0.2s ease;
}

.info-card:hover {
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    transform: translateY(-2px);
}

.info-card.full-width {
    grid-column: 1 / -1;
}

.card-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 20px 24px;
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
}

.card-icon {
    width: 36px;
    height: 36px;
    background: #eef2ff;
    color: #4f46e5;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.card-title {
    font-size: 16px;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
}

.card-body {
    padding: 20px 24px;
}

.info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #f1f5f9;
}

.info-row:last-child {
    border-bottom: none;
}

.info-label {
    font-size: 13px;
    font-weight: 500;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.info-value {
    font-size: 15px;
    font-weight: 500;
    color: #1e293b;
    text-align: right;
    word-break: break-word;
    max-width: 60%;
}

.contact-link {
    color: #4f46e5;
    text-decoration: none;
    transition: color 0.2s ease;
}

.contact-link:hover {
    color: #6366f1;
    text-decoration: underline;
}

/* Address Box */
.address-box {
    display: flex;
    gap: 12px;
    align-items: flex-start;
    padding: 12px;
    background: #f8fafc;
    border-radius: 12px;
    color: #475569;
    line-height: 1.6;
}

.address-box svg {
    flex-shrink: 0;
    margin-top: 2px;
    color: #6366f1;
}

/* Quick Actions */
.quick-actions {
    background: white;
    border-radius: 20px;
    padding: 20px 24px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
}

.quick-actions-title {
    font-size: 16px;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 16px 0;
}

.actions-grid {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
}

.quick-action-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background: #f1f5f9;
    color: #475569;
    border-radius: 10px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.2s ease;
}

.quick-action-btn:hover {
    background: #6366f1;
    color: white;
    transform: translateY(-2px);
}

/* Responsive Design */
@media (max-width: 768px) {
    .vendor-details-container {
        padding: 16px;
    }
    
    .details-header {
        padding: 20px;
        flex-direction: column;
        align-items: stretch;
    }
    
    .header-right {
        justify-content: stretch;
    }
    
    .btn-edit, .btn-delete {
        flex: 1;
        justify-content: center;
    }
    
    .vendor-title {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .vendor-name-large {
        font-size: 20px;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
    }
    
    .info-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 6px;
    }
    
    .info-value {
        text-align: left;
        max-width: 100%;
    }
    
    .actions-grid {
        flex-direction: column;
    }
    
    .quick-action-btn {
        justify-content: center;
    }
}

/* Print Styles */
@media print {
    .vendor-details-container {
        padding: 0;
        background: white;
    }
    
    .header-right,
    .quick-actions,
    .back-link,
    .btn-edit,
    .btn-delete {
        display: none;
    }
    
    .info-card {
        box-shadow: none;
        border: 1px solid #e2e8f0;
    }
}
</style>

@endsection
