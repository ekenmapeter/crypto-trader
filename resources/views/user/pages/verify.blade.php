@include('user.components.user_head', ['title' => $title ?? 'Identity Verification'])

@include('user.components.top-navbar')

<div class="min-h-screen bg-gray-50 pb-24">
    <div class="max-w-4xl mx-auto px-6 pt-12">
        
        {{-- Header Section --}}
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-600 rounded-[28px] shadow-xl shadow-blue-200 text-white mb-6 transform rotate-3 hover:rotate-0 transition-transform duration-500">
                <i class="fa-solid fa-shield-halved text-3xl"></i>
            </div>
            <h1 class="text-3xl font-black text-gray-900 tracking-tight uppercase">Identity Verification</h1>
            <p class="text-xs font-black text-blue-600 uppercase tracking-widest mt-2 px-4 py-1 bg-blue-50 rounded-full inline-block">Tier 1 Compliance Required</p>
        </div>

        @if(session('success'))
            <div class="mb-8 bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl text-sm font-bold flex items-center gap-3 animate-bounce">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('success') }}
            </div>
        @endif

        @if($verification)
            <div class="mb-10 bg-white rounded-[32px] p-8 shadow-xl border border-gray-100 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gray-50 rounded-full blur-3xl -mr-16 -mt-16"></div>
                <div class="flex flex-col md:flex-row items-center justify-between gap-6 relative">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-xl {{ $verification->status == 'approved' ? 'bg-emerald-50 text-emerald-600' : ($verification->status == 'rejected' ? 'bg-red-50 text-red-600' : 'bg-orange-50 text-orange-600 animate-pulse') }}">
                            @if($verification->status == 'approved') <i class="fa-solid fa-circle-check"></i>
                            @elseif($verification->status == 'rejected') <i class="fa-solid fa-circle-xmark"></i>
                            @else <i class="fa-solid fa-hourglass-half"></i> @endif
                        </div>
                        <div>
                            <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">Current Status</div>
                            <div class="text-xl font-black text-gray-900 uppercase tracking-tighter">{{ $verification->status }}</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Submitted On</div>
                        <div class="text-sm font-bold text-gray-900">{{ optional($verification->submitted_at)->format('M d, Y') ?? 'Recently' }}</div>
                    </div>
                </div>
                @if($verification->status == 'rejected')
                    <div class="mt-6 p-4 bg-red-50 rounded-2xl border border-red-100">
                        <p class="text-[10px] font-black text-red-700 uppercase mb-1"><i class="fa-solid fa-circle-info mr-1"></i> Admin Notes</p>
                        <p class="text-xs font-bold text-red-600">{{ $verification->admin_notes ?? 'Incomplete or unclear documentation. Please try again with clear images.' }}</p>
                    </div>
                @endif
            </div>
        @endif

        {{-- Verification Form --}}
        <div class="bg-white rounded-[40px] shadow-2xl shadow-blue-500/5 border border-gray-100 p-8 md:p-12">
            <form action="{{ route('user.verify.store') }}" method="post" enctype="multipart/form-data" class="space-y-8">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Issued Country</label>
                        <div class="relative group">
                            <i class="fa-solid fa-globe absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-blue-600 transition-colors"></i>
                            <select name="country" class="w-full bg-gray-50 border-2 border-transparent focus:border-blue-600 focus:bg-white rounded-[20px] pl-12 pr-4 py-4 text-sm font-black text-gray-900 appearance-none transition-all outline-none">
                                <option value="US">United States</option>
                                <option value="CA">Canada</option>
                                <option value="GB">United Kingdom</option>
                                <option value="AU">Australia</option>
                                <option value="EU">European Union</option>
                            </select>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Document Type</label>
                        <div class="relative group">
                            <i class="fa-solid fa-id-card absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-blue-600 transition-colors"></i>
                            <select name="document_type" class="w-full bg-gray-50 border-2 border-transparent focus:border-blue-600 focus:bg-white rounded-[20px] pl-12 pr-4 py-4 text-sm font-black text-gray-900 appearance-none transition-all outline-none">
                                <option value="driver_license">Driver's License</option>
                                <option value="passport">International Passport</option>
                                <option value="us_id_card">National ID Card</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Front of ID</label>
                        <div class="relative group flex items-center justify-center border-2 border-dashed border-gray-200 hover:border-blue-600 hover:bg-blue-50/50 rounded-[32px] p-8 transition-all cursor-pointer overflow-hidden h-48">
                            <input type="file" name="doc_front" class="absolute inset-0 opacity-0 cursor-pointer z-10" required onchange="previewFile(this)">
                            <div class="text-center group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-cloud-arrow-up text-3xl text-gray-300 group-hover:text-blue-600 mb-3"></i>
                                <p class="text-[10px] font-black text-gray-400 group-hover:text-blue-600 uppercase tracking-widest">Drop Front Side</p>
                            </div>
                            <img src="" class="absolute inset-0 w-full h-full object-cover hidden preview-img">
                        </div>
                    </div>
                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Back of ID</label>
                        <div class="relative group flex items-center justify-center border-2 border-dashed border-gray-200 hover:border-blue-600 hover:bg-blue-50/50 rounded-[32px] p-8 transition-all cursor-pointer overflow-hidden h-48">
                            <input type="file" name="doc_back" class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewFile(this)">
                            <div class="text-center group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-cloud-arrow-up text-3xl text-gray-300 group-hover:text-blue-600 mb-3"></i>
                                <p class="text-[10px] font-black text-gray-400 group-hover:text-blue-600 uppercase tracking-widest">Drop Back Side</p>
                            </div>
                            <img src="" class="absolute inset-0 w-full h-full object-cover hidden preview-img">
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Personal Identifier (SSN/BVN/NIN)</label>
                    <div class="relative group">
                        <i class="fa-solid fa-fingerprint absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-blue-600 transition-colors"></i>
                        <input type="text" name="ssn_last4" placeholder="Last 4 characters (Optional)" 
                            class="w-full bg-gray-50 border-2 border-transparent focus:border-blue-600 focus:bg-white rounded-[20px] pl-12 pr-4 py-4 text-sm font-black text-gray-900 transition-all outline-none placeholder:text-gray-300">
                    </div>
                    <p class="text-[9px] text-gray-400 font-bold px-2 italic">Data is encrypted and stored according to {{ $setting->site_name ?? 'our' }} global privacy standards.</p>
                </div>

                <div class="pt-4">
                    <button type="submit" 
                        class="w-full bg-gray-900 hover:bg-black py-5 rounded-[24px] text-white font-black text-sm uppercase tracking-[0.2em] transition-all shadow-xl shadow-gray-200 active:scale-95 flex items-center justify-center gap-3 group">
                        <span>Initiate Verification</span>
                        <i class="fa-solid fa-bolt text-yellow-400 group-hover:scale-125 transition-transform"></i>
                    </button>
                </div>
            </form>
        </div>

        {{-- Privacy Trust Section --}}
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="flex items-center gap-4 bg-white/50 p-4 rounded-2xl border border-gray-100">
                <i class="fa-solid fa-lock text-blue-600"></i>
                <p class="text-[9px] font-black text-gray-600 uppercase">AES-256 Encryption</p>
            </div>
            <div class="flex items-center gap-4 bg-white/50 p-4 rounded-2xl border border-gray-100">
                <i class="fa-solid fa-user-shield text-blue-600"></i>
                <p class="text-[9px] font-black text-gray-600 uppercase">Biometric Match</p>
            </div>
            <div class="flex items-center gap-4 bg-white/50 p-4 rounded-2xl border border-gray-100">
                <i class="fa-solid fa-building-columns text-blue-600"></i>
                <p class="text-[9px] font-black text-gray-600 uppercase">Compliance Standard</p>
            </div>
        </div>
    </div>
</div>

<script>
    function previewFile(input) {
        const preview = input.parentElement.querySelector('.preview-img');
        const iconContainer = input.parentElement.querySelector('.text-center');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                iconContainer.classList.add('hidden');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@include('user.components.user')
