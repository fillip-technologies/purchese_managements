<div class="space-y-6">
    <!-- Client Name -->
    <div>
        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
            Client Name <span class="text-red-500">*</span>
        </label>
        <input type="text" name="client_name"
            class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none @error('client_name') border-red-500 bg-red-50 dark:bg-red-900/20 @enderror"
            placeholder="Enter client name"
            value="{{ old('client_name', $client->client_name ?? '') }}"
            required>
        @error('client_name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Company Name -->
    <div>
        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Company Name</label>
        <input type="text" name="company_name"
            class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none"
            placeholder="Enter company name"
            value="{{ old('company_name', $client->company_name ?? '') }}">
    </div>

    <!-- GST Number -->
    <div>
        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">GST Number</label>
        <input type="text" name="gst_no"
            class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none"
            placeholder="XX-XXXXX-XXXX"
            value="{{ old('gst_no', $client->gst_no ?? '') }}">
        <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">Format: XX-XXXXX-XXXX</p>
    </div>

    <!-- Address -->
    <div>
        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Address</label>
        <textarea name="address" rows="3"
            class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none resize-y"
            placeholder="Enter complete address">{{ old('address', $client->address ?? '') }}</textarea>
    </div>

    <!-- Contact Person -->
    <div>
        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Contact Person</label>
        <input type="text" name="contact_person"
            class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none"
            placeholder="Full name"
            value="{{ old('contact_person', $client->contact_person ?? '') }}">
    </div>

    <!-- Phone -->
    <div>
        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
            Phone Number <span class="text-red-500">*</span>
        </label>
        <input type="tel" name="phone"
            class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none @error('phone') border-red-500 bg-red-50 dark:bg-red-900/20 @enderror"
            placeholder="+91 XXXXXXXXXX"
            value="{{ old('phone', $client->phone ?? '') }}"
            required>
        @error('phone')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Email -->
    <div>
        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Email Address</label>
        <input type="email" name="email"
            class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none"
            placeholder="client@company.com"
            value="{{ old('email', $client->email ?? '') }}">
    </div>

    <!-- Status -->
    <div>
        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Status</label>
        <select name="status"
            class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none bg-white dark:bg-slate-700 cursor-pointer appearance-none bg-no-repeat bg-right-4"
            style="background-image: url('data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"%2364748b\" stroke-width=\"2\"><polyline points=\"6 9 12 15 18 9\"></polyline></svg>'); background-position: right 1rem center;">
            <option value="Active" {{ old('status', $client->status ?? '') == 'Active' ? 'selected' : '' }}>✅ Active</option>
            <option value="Inactive" {{ old('status', $client->status ?? '') == 'Inactive' ? 'selected' : '' }}>⭕ Inactive</option>
        </select>
    </div>
</div>
