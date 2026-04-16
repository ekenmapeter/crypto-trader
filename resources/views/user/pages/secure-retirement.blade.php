@include('user.components.user_head', ['title' => $title ?? 'Secure 401(k)/IRA'])

<div class="min-h-screen bg-[#F5A623] text-black font-bold text-black">
    <div class="max-w-5xl mx-auto px-4 py-10">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full mb-5">
                <svg class="w-10 h-10 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0-1.657-1.343-3-3-3s-3 1.343-3 3v2H5a2 2 0 00-2 2v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 00-2-2h-1v-2a5 5 0 00-10 0v2"/>
                </svg>
            </div>
            <h1 class="text-3xl md:text-4xl font-extrabold mb-2 bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent">Secure 401(k) / IRA Inquiry</h1>
            <p class="text-sm md:text-base text-gray-400 max-w-2xl mx-auto">Tell us about your retirement account to explore a compliant, crypto-enabled self-directed structure with institutional-grade security.</p>
        </div>

        <!-- CTA & Inquiry Form -->
        <div class="mt-12 max-w-2xl mx-auto">
            <div class="bg-white text-black rounded-2xl p-6 md:p-8 shadow-2xl">
                <h3 class="text-2xl font-bold mb-2">Get Started Securely</h3>
                <p class="text-gray-700 mb-6">Tell us a bit about your current retirement account so we can guide you to a compliant, secure crypto structure.</p>
                <form method="POST" action="{{ route('user.secure-retirement.submit') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold mb-2">Full Name</label>
                        <input name="full_name" type="text" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3" required />
                    </div>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold mb-2">Email</label>
                            <input name="email" type="email" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3" required />
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2">Phone (optional)</label>
                            <input name="phone" type="text" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3" />
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2">Account Type</label>
                        <select name="account_type" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3" required>
                            <option value="Traditional IRA">Traditional IRA</option>
                            <option value="Roth IRA">Roth IRA</option>
                            <option value="Solo 401k">Solo 401k</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold mb-2">Current Provider (optional)</label>
                            <input name="current_provider" type="text" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3" />
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2">Rollover Amount (optional)</label>
                            <input name="rollover_amount" type="number" step="0.01" min="0" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3" />
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2">Preferred Custodian (optional)</label>
                        <input name="preferred_custodian" type="text" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3" />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2">Notes (optional)</label>
                        <textarea name="notes" rows="3" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-[#F5A623] text-black font-bold text-black px-6 py-3 rounded-xl font-bold hover:bg-gray-800">Submit Inquiry</button>
                </form>
            </div>

        </div>
    </div>

    @include('user.components.user')
    @include('user.components.auth-footer')
</div>
