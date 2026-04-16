@include('user.components.user_head', ['title' => $title ?? 'Deposit'])

@include('user.components.top-navbar')

<div class="px-4 py-8 space-y-6">
    <div class="bg-white text-black border border-gray-100 shadow-xl rounded-[24px] overflow-hidden" x-data="depositApp()">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h3 class="font-bold text-lg text-gray-800 tracking-tight" x-text="step === 1 ? '1. Select Asset' : '2. Deposit Funds'">Deposit Funds</h3>
            <button x-show="step === 2" @click="step = 1" type="button" class="text-xs font-bold text-blue-600 bg-blue-50 px-3 py-1.5 rounded-full hover:bg-blue-100 transition-colors uppercase tracking-widest flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-left"></i> Change Asset
            </button>
        </div>

        <div class="p-6">
            @if(session('success'))
                <div class="mb-6 p-4 rounded-[16px] bg-emerald-50 border border-emerald-100 text-emerald-700 text-sm font-semibold flex items-center gap-2">
                    <i class="fa-solid fa-circle-check"></i>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Step 1: Select Coin -->
            <div x-show="step === 1" x-transition.opacity.duration.300ms>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($walletTypes as $coin)
                        <button type="button" @click="selectCoin('{{ $coin->id }}', '{{ $coin->payment_wallet_address }}', '{{ $coin->payment_qr_code ? '/images/crypto_logo/' . $coin->payment_qr_code : '' }}')"
                            class="group flex flex-col items-center justify-center p-6 bg-gray-50 border-2 border-transparent hover:border-blue-500 rounded-[20px] transition-all hover:-translate-y-1 hover:shadow-lg focus:outline-none">
                            <div class="w-12 h-12 mb-2 p-2 bg-white rounded-[12px] shadow-sm group-hover:scale-110 transition-transform">
                                <img src="/images/crypto_logo/{{ $coin->logo }}" alt="{{ $coin->coin_name }}" class="w-full h-full object-contain filter drop-shadow-sm">
                            </div>
                            <h3 class="font-black text-gray-900 mt-1 text-sm group-hover:text-blue-600 transition-colors">{{ $coin->coin_name }}</h3>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $coin->short_code }}</p>
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Step 2: Deposit Details -->
            <div x-show="step === 2" x-transition.opacity.duration.300ms style="display: none;">
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <div class="p-5 rounded-[20px] bg-gray-50 border border-gray-100 space-y-4">
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Deposit Address</label>
                                <div class="flex items-center gap-2">
                                    <div class="flex-1 font-mono text-sm break-all bg-white p-3 rounded-[12px] border border-gray-100 text-blue-900 font-bold" x-text="selectedAddress"></div>
                                    <button @click="copyAddress()" class="p-3 rounded-[12px] bg-[#F5A623] text-black font-bold hover:bg-black hover:text-white transition-all transform active:scale-95 shadow-sm">
                                        <i class="fa-solid fa-copy"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="space-y-2 flex flex-col items-center pt-2">
                                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Scan QR Code</label>
                                <div class="p-4 bg-white rounded-[20px] border border-gray-100 shadow-inner">
                                    <img :src="selectedQr" alt="QR Code" class="w-40 h-40 object-contain mx-auto">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50/50 p-6 rounded-[20px] border border-gray-100 h-fit">
                        <form action="{{ route('user.deposit.store') }}" method="post" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            <input type="hidden" name="wallet_type_id" :value="selectedId">
                            
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Deposit Amount</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 font-bold text-gray-400">$</span>
                                    <input type="number" step="0.00000001" name="amount" class="w-full bg-white border border-gray-100 rounded-[12px] pl-8 pr-4 py-4 font-bold text-xl focus:ring-2 focus:ring-blue-500 transition-all" placeholder="0.00" required>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Tx Reference / Hash</label>
                                <input type="text" name="tx_reference" class="w-full bg-white border border-gray-100 rounded-[12px] px-4 py-3 focus:ring-2 focus:ring-blue-500 transition-all" placeholder="Optional text">
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-1">Upload Payment Proof</label>
                                <input type="file" name="payment_proof" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                            </div>

                            <button type="submit" class="w-full py-4 rounded-[16px] bg-[#F5A623] text-black font-bold shadow-lg hover:shadow-xl hover:bg-black hover:text-white transition-all transform active:scale-95 duration-200">
                                CONFIRM DEPOSIT
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('user.components.user')

<!-- Alpine.js for Step Handling -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('depositApp', () => ({
            step: 1,
            selectedId: '',
            selectedAddress: '',
            selectedQr: '',

            selectCoin(id, address, qr) {
                this.selectedId = id;
                this.selectedAddress = address;
                this.selectedQr = qr;
                this.step = 2;
            },

            copyAddress() {
                if (!this.selectedAddress) return;
                navigator.clipboard.writeText(this.selectedAddress);
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 2000,
                  timerProgressBar: true,
                });
                Toast.fire({
                  icon: 'success',
                  title: 'Address Copied Successfully!'
                });
            }
        }))
    })
</script>

