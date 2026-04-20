<div class="vendor-form-container">
    <div class="form-grid">
        <!-- Vendor Name -->
        <div class="form-group">
            <label for="vendor_name">Vendor Name <span class="required">*</span></label>
            <input type="text" id="vendor_name" name="vendor_name" class="form-control"
                placeholder="Enter vendor name"
                value="{{ old('vendor_name', $vendor->vendor_name ?? '') }}">
        </div>

        <!-- Company Name -->
        <div class="form-group">
            <label for="company_name">Company Name</label>
            <input type="text" id="company_name" name="company_name" class="form-control"
                placeholder="Enter company name"
                value="{{ old('company_name', $vendor->company_name ?? '') }}">
        </div>

        <!-- GST Number -->
        <div class="form-group">
            <label for="gst_no">GST Number</label>
            <input type="text" id="gst_no" name="gst_no" class="form-control"
                placeholder="XX-XXXXX-XXXX"
                value="{{ old('gst_no', $vendor->gst_no ?? '') }}">
        </div>

        <!-- Address (Full Width) -->
        <div class="form-group full-width">
            <label for="address">Address</label>
            <textarea id="address" name="address" class="form-control" 
                rows="3" placeholder="Enter complete address">{{ old('address', $vendor->address ?? '') }}</textarea>
        </div>

        <!-- Contact Person -->
        <div class="form-group">
            <label for="contact_person">Contact Person</label>
            <input type="text" id="contact_person" name="contact_person" class="form-control"
                placeholder="Full name"
                value="{{ old('contact_person', $vendor->contact_person ?? '') }}">
        </div>

        <!-- Phone -->
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" class="form-control"
                placeholder="+91 XXXXXXXXXX"
                value="{{ old('phone', $vendor->phone ?? '') }}">
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" class="form-control"
                placeholder="vendor@company.com"
                value="{{ old('email', $vendor->email ?? '') }}">
        </div>

        <!-- Status -->
        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" class="form-control">
                <option value="Active" {{ old('status', $vendor->status ?? '') == 'Active' ? 'selected' : '' }}>
                    ✅ Active
                </option>
                <option value="Inactive" {{ old('status', $vendor->status ?? '') == 'Inactive' ? 'selected' : '' }}>
                    ⭕ Inactive
                </option>
            </select>
        </div>
    </div>
</div>

<style>
    .vendor-form-container {
        background: #ffffff;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 20px;
        align-items: start;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-group label {
        font-weight: 600;
        font-size: 14px;
        color: #1f2937;
        margin-bottom: 8px;
        letter-spacing: 0.3px;
    }

    .required {
        color: #ef4444;
        margin-left: 4px;
    }

    .form-control {
        padding: 10px 14px;
        font-size: 14px;
        font-family: inherit;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        background-color: #ffffff;
        transition: all 0.2s ease;
        outline: none;
        width: 100%;
        box-sizing: border-box;
    }

    .form-control:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    .form-control:hover:not(:focus) {
        border-color: #9ca3af;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 80px;
    }

    select.form-control {
        cursor: pointer;
        appearance: none;
        background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="%236b7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>');
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 16px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .vendor-form-container {
            padding: 16px;
        }
        
        .form-grid {
            gap: 16px;
        }
        
        .form-control {
            font-size: 16px; /* Prevents zoom on mobile */
        }
    }
</style>