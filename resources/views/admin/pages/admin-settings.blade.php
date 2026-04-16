@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 pb-20">
    
    {{-- Header --}}
    <div class="flex items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-gray-900 leading-none mb-1">System Control Center</h1>
            <p class="text-sm text-gray-500 font-medium">Configure global application behavior and financial routes.</p>
        </div>
        <div class="w-14 h-14 bg-blue-600 rounded-[20px] shadow-xl shadow-blue-200 flex items-center justify-center text-white">
            <i class="fa-solid fa-gears text-2xl"></i>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl text-sm font-bold flex items-center gap-3 animate-bounce">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 gap-8">
        
        {{-- General & Email Config --}}
        <div class="bg-white rounded-[40px] shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gray-50/50 px-8 py-5 border-b border-gray-100 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-1.5 h-6 bg-blue-600 rounded-full"></div>
                    <h3 class="text-xs font-black text-gray-900 uppercase tracking-widest">Platform & Communication</h3>
                </div>
                <i class="fa-solid fa-envelope-open-text text-gray-300"></i>
            </div>
            
            <form action="{{ route('update-admin-settings') }}" method="POST" class="p-8 space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Admin Alert Email</label>
                        <div class="relative group">
                            <i class="fa-solid fa-shield-halved absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                            <input type="email" name="admin_email" value="{{ $setting->admin_email ?? '' }}"
                                class="w-full pl-11 pr-4 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold text-gray-900 focus:ring-2 focus:ring-blue-500/20 transition-all" />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Support Email</label>
                        <div class="relative group">
                            <i class="fa-solid fa-headset absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                            <input type="email" name="support_email" value="{{ $setting->support_email ?? '' }}"
                                class="w-full pl-11 pr-4 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold text-gray-900 focus:ring-2 focus:ring-blue-500/20 transition-all" />
                        </div>
                    </div>
                    <div class="md:col-span-2 space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Website Brand Name</label>
                        <div class="relative group">
                            <i class="fa-solid fa-font-awesome absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                            <input type="text" name="site_name" value="{{ $setting->site_name ?? '' }}"
                                class="w-full pl-11 pr-4 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold text-gray-900 focus:ring-2 focus:ring-blue-500/20 transition-all" />
                        </div>
                    </div>
                </div>
                <div class="pt-2 text-right">
                    <button type="submit" class="bg-gray-900 hover:bg-black text-white px-8 py-3.5 rounded-2xl text-xs font-black uppercase tracking-widest transition-all shadow-xl shadow-gray-200 active:scale-95">Update Identity</button>
                </div>
            </form>
        </div>

        {{-- Financial Routes (Bank/PayPal) --}}
        <div class="bg-white rounded-[40px] shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gray-50/50 px-8 py-5 border-b border-gray-100 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-1.5 h-6 bg-emerald-500 rounded-full"></div>
                    <h3 class="text-xs font-black text-gray-900 uppercase tracking-widest">Financial Settlement Methods</h3>
                </div>
                <i class="fa-solid fa-building-columns text-gray-300"></i>
            </div>
            
            <form action="{{ route('update-admin-settings') }}" method="POST" class="p-8 space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Institution Name</label>
                        <input type="text" name="bank_name" value="{{ $setting->bank_name ?? '' }}" placeholder="e.g. JPMorgan Chase"
                            class="w-full px-5 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold text-gray-900 focus:ring-2 focus:ring-emerald-500/20 transition-all" />
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Account Holder</label>
                        <input type="text" name="account_name" value="{{ $setting->account_name ?? '' }}" placeholder="Coinledger Global Ltd"
                            class="w-full px-5 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold text-gray-900 focus:ring-2 focus:ring-emerald-500/20 transition-all" />
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Account Number / IBAN</label>
                        <input type="text" name="account_number" value="{{ $setting->account_number ?? '' }}"
                            class="w-full px-5 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold text-gray-900 focus:ring-2 focus:ring-emerald-500/20 transition-all" />
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Routing / Swift Code</label>
                        <input type="text" name="routing_number" value="{{ $setting->routing_number ?? '' }}"
                            class="w-full px-5 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold text-gray-900 focus:ring-2 focus:ring-emerald-500/20 transition-all" />
                    </div>
                    <div class="md:col-span-2 space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">PayPal Business Email</label>
                        <div class="relative">
                            <i class="fa-brands fa-paypal absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="email" name="paypal_email" value="{{ $setting->paypal_email ?? '' }}"
                                class="w-full pl-11 pr-4 py-4 bg-emerald-50/30 border-none rounded-2xl text-sm font-bold text-gray-900 focus:ring-2 focus:ring-emerald-500/20 transition-all" />
                        </div>
                    </div>
                </div>
                <div class="pt-2 text-right">
                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-3.5 rounded-2xl text-xs font-black uppercase tracking-widest transition-all shadow-xl shadow-emerald-200 active:scale-95">Update Payment Routes</button>
                </div>
            </form>
        {{-- Admin Security --}}
        <div class="bg-white rounded-[40px] shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gray-50/50 px-8 py-5 border-b border-gray-100 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-1.5 h-6 bg-red-500 rounded-full"></div>
                    <h3 class="text-xs font-black text-gray-900 uppercase tracking-widest">Admin Account Security</h3>
                </div>
                <i class="fa-solid fa-lock text-gray-300"></i>
            </div>
            
            <form action="{{ route('admin.change-password') }}" method="POST" class="p-8 space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Current Password</label>
                        <input type="password" name="current_password" required placeholder="••••••••"
                            class="w-full px-5 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold text-gray-900 focus:ring-2 focus:ring-red-500/20 transition-all" />
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">New Password</label>
                        <input type="password" name="password" required placeholder="Min 8 characters"
                            class="w-full px-5 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold text-gray-900 focus:ring-2 focus:ring-red-500/20 transition-all" />
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Confirm Password</label>
                        <input type="password" name="password_confirmation" required placeholder="••••••••"
                            class="w-full px-5 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold text-gray-900 focus:ring-2 focus:ring-red-500/20 transition-all" />
                    </div>
                </div>
                <div class="pt-2 text-right">
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-8 py-3.5 rounded-2xl text-xs font-black uppercase tracking-widest transition-all shadow-xl shadow-red-200 active:scale-95">Update Security</button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
