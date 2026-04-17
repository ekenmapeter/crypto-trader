<?php ($title = 'Buy Crypto'); ?>
<?php echo $__env->make('user.components.user_head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Alpine.js -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<div class="min-h-screen flex flex-col font-sans">
    <!-- Sticky Navigation Header -->
    <header class="sticky top-0 z-40 bg-blue-900/60 backdrop-blur-xl border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a href="<?php echo e(route('user')); ?>" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition-all border border-white/10">
                    <i class="fas fa-arrow-left text-white"></i>
                </a>
                <div>
                    <h1 class="text-xl font-black text-white leading-none">Buy Crypto</h1>
                    <p class="text-[10px] font-bold text-blue-300 uppercase tracking-widest mt-1">Manual Bank & PayPal Transfer</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-blue-500/20 rounded-xl flex items-center justify-center text-blue-300 border border-blue-400/30">
                    <i class="fas fa-university text-sm"></i>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 w-full">
        <!-- Hero -->
        <div class="text-center mb-12 px-4">
            <h2 class="text-3xl md:text-4xl font-black text-white tracking-tighter mb-3 leading-tight">Purchase Digital Assets</h2>
            <p class="text-base text-blue-200 max-w-xl mx-auto font-medium">Send payment via bank transfer or PayPal, upload your receipt, and our team will credit your wallet within 30 minutes.</p>
        </div>

        <!-- Payment Instructions Card -->
        <?php if($setting): ?>
        <div class="bg-white/5 backdrop-blur-md rounded-[32px] border border-white/10 shadow-2xl overflow-hidden mb-10">
            <div class="px-8 py-5 border-b border-white/5 bg-blue-600/80 flex items-center gap-3">
                <i class="fa-solid fa-circle-info text-white/80 text-lg"></i>
                <h3 class="font-black text-white uppercase tracking-wider text-sm">Payment Instructions</h3>
            </div>
            <div class="p-8 grid md:grid-cols-2 gap-6">
                <!-- Bank Transfer -->
                <div class="bg-white/5 rounded-[20px] p-6 border border-white/10 space-y-4">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-9 h-9 bg-blue-500/30 rounded-xl flex items-center justify-center border border-blue-400/30">
                            <i class="fa-solid fa-building-columns text-blue-300 text-sm"></i>
                        </div>
                        <span class="font-black text-white text-sm uppercase tracking-wider">Bank Transfer</span>
                    </div>
                    <?php if($setting->bank_name || $setting->account_name || $setting->account_number): ?>
                    <div class="space-y-3">
                        <?php if($setting->bank_name): ?>
                        <div class="flex justify-between items-center bg-black/20 p-2 rounded-lg">
                            <span class="text-[10px] font-black text-blue-400 uppercase tracking-widest">Bank Name</span>
                            <span class="text-xs font-black text-white"><?php echo e($setting->bank_name); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if($setting->account_name): ?>
                        <div class="flex justify-between items-center bg-black/20 p-2 rounded-lg">
                            <span class="text-[10px] font-black text-blue-400 uppercase tracking-widest">Account Name</span>
                            <span class="text-xs font-black text-white"><?php echo e($setting->account_name); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if($setting->account_number): ?>
                        <div class="flex justify-between items-center bg-black/20 p-2 rounded-lg">
                            <span class="text-[10px] font-black text-blue-400 uppercase tracking-widest">Account No.</span>
                            <span class="text-xs font-black text-white select-all"><?php echo e($setting->account_number); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if($setting->routing_number): ?>
                        <div class="flex justify-between items-center bg-black/20 p-2 rounded-lg">
                            <span class="text-[10px] font-black text-blue-400 uppercase tracking-widest">Routing / Swift</span>
                            <span class="text-xs font-black text-white select-all"><?php echo e($setting->routing_number); ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php else: ?>
                    <p class="text-sm text-blue-400 italic">Bank details not configured yet. Please contact support.</p>
                    <?php endif; ?>
                </div>

                <!-- PayPal -->
                <div class="bg-white/5 rounded-[20px] p-6 border border-white/10 space-y-4">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-9 h-9 bg-blue-500/30 rounded-xl flex items-center justify-center border border-blue-400/30">
                            <i class="fa-brands fa-paypal text-blue-300 text-sm"></i>
                        </div>
                        <span class="font-black text-white text-sm uppercase tracking-wider">PayPal</span>
                    </div>
                    <?php if($setting->paypal_email): ?>
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-bold text-blue-400 uppercase tracking-widest">Send To</span>
                        <span class="text-sm font-black text-white select-all"><?php echo e($setting->paypal_email); ?></span>
                    </div>
                    <p class="text-xs text-blue-300/60 mt-2">Use "Friends & Family" when sending via PayPal to avoid fees.</p>
                    <?php else: ?>
                    <p class="text-sm text-blue-400 italic">PayPal not configured yet. Please contact support.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Asset List -->
        <div class="bg-white/5 backdrop-blur-md rounded-[32px] border border-white/10 shadow-2xl overflow-hidden">
            <div class="p-6 border-b border-white/5 bg-white/5 flex justify-between items-center">
                <span class="text-xs font-black text-blue-300 uppercase tracking-widest ml-2">Select Asset to Buy</span>
                <span class="text-xs font-black text-blue-300 uppercase tracking-widest mr-2">Action</span>
            </div>

            <div class="divide-y divide-white/5">
                <?php $__empty_1 = true; $__currentLoopData = $activeWalletTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $walletType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div x-data="{ open: false }" class="group">
                    <div class="flex items-center justify-between p-6 hover:bg-white/5 transition-all duration-300">
                        <div class="flex items-center space-x-5">
                            <div class="relative">
                                <div class="w-14 h-14 bg-white/90 rounded-2xl shadow-lg p-2.5 group-hover:scale-110 transition-transform duration-300 overflow-hidden border border-white/20">
                                    <img src="/images/crypto_logo/<?php echo e($walletType->logo); ?>" alt="<?php echo e($walletType->coin_name); ?>" class="w-full h-full object-contain"/>
                                </div>
                                <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 border-2 border-blue-900 rounded-full"></div>
                            </div>
                            <div>
                                <div class="flex items-center space-x-2">
                                    <h3 class="text-base font-black text-white"><?php echo e($walletType->coin_name); ?></h3>
                                    <span class="text-[10px] font-bold text-blue-200 bg-blue-500/20 px-2 py-0.5 rounded-full border border-blue-400/20"><?php echo e($walletType->short_code); ?></span>
                                </div>
                                <p class="text-[10px] text-blue-400 font-bold tracking-widest uppercase mt-0.5">Manual Transfer</p>
                            </div>
                        </div>

                        <button @click="open = true; document.body.style.overflow = 'hidden'"
                            class="bg-blue-600 hover:bg-blue-500 text-white px-7 py-2.5 rounded-2xl font-black text-xs transition-all duration-300 shadow-xl hover:shadow-blue-500/30 hover:-translate-y-0.5">
                            Buy Now
                        </button>
                    </div>

                    <!-- Purchase Modal -->
                    <div x-show="open"
                        class="fixed inset-0 z-50 flex items-center justify-center p-4"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0">

                        <div class="absolute inset-0 bg-blue-950/80 backdrop-blur-md" @click="open = false; document.body.style.overflow = 'auto'"></div>

                        <div class="bg-blue-900 border border-white/10 rounded-[32px] shadow-2xl w-full max-w-lg relative z-10 overflow-hidden"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100">

                            <!-- Modal Header -->
                            <div class="bg-blue-600 px-8 py-6 flex justify-between items-center">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-white/20 rounded-xl p-2.5">
                                        <img src="/images/crypto_logo/<?php echo e($walletType->logo); ?>" class="w-full h-full object-contain" alt="<?php echo e($walletType->coin_name); ?>">
                                    </div>
                                    <div>
                                        <p class="text-[10px] text-blue-200 font-black uppercase tracking-widest mb-0.5">Purchase Order</p>
                                        <h2 class="text-2xl font-black text-white">Buy <?php echo e($walletType->coin_name); ?></h2>
                                    </div>
                                </div>
                                <button @click="open = false; document.body.style.overflow = 'auto'" class="w-10 h-10 bg-white/20 hover:bg-white/30 rounded-xl flex items-center justify-center text-white transition-all">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>

                            <!-- Modal Body -->
                            <div class="px-8 py-7 overflow-y-auto max-h-[70vh]">
                                <form action="<?php echo e(url('buy-crypto')); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="wallet_type_id" value="<?php echo e($walletType->id); ?>">
                                    <input type="hidden" name="coin_name" value="<?php echo e($walletType->coin_name); ?>">
                                    <input type="hidden" name="short_code" value="<?php echo e($walletType->short_code); ?>">
                                    <input type="hidden" name="logo" value="<?php echo e($walletType->logo); ?>">

                                    <!-- Amount -->
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-blue-300 uppercase tracking-widest ml-1">Amount in USD ($)</label>
                                        <div class="relative">
                                            <div class="absolute left-5 top-1/2 -translate-y-1/2 text-xl font-black text-blue-500">$</div>
                                            <input type="number" name="amount" placeholder="0.00" required step="0.01" min="1"
                                                class="w-full bg-black/30 border-2 border-white/5 focus:border-blue-500 rounded-[16px] pl-10 pr-5 py-4 text-xl font-black text-white transition-all outline-none">
                                        </div>
                                    </div>

                                    <!-- Payment Method -->
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-blue-300 uppercase tracking-widest ml-1">Payment Method</label>
                                        <select name="payment_method" required class="w-full bg-black/30 border-2 border-white/5 focus:border-blue-500 rounded-[16px] px-5 py-4 text-white font-bold outline-none cursor-pointer appearance-none transition-all">
                                            <option value="">Select method...</option>
                                            <option value="bank_transfer">Bank Transfer</option>
                                            <option value="paypal">PayPal</option>
                                        </select>
                                    </div>

                                    <!-- Payment Reference / Receipt Upload -->
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-blue-300 uppercase tracking-widest ml-1">Payment Receipt / Proof</label>
                                        <input type="file" name="receipt_upload" accept="image/*,.pdf"
                                            class="w-full bg-black/30 border-2 border-dashed border-white/10 focus:border-blue-500 rounded-[16px] px-5 py-4 text-blue-100 text-sm font-bold outline-none transition-all cursor-pointer file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-blue-600 file:text-white">
                                        <p class="text-[10px] text-blue-400 ml-1">Upload a screenshot or PDF of your payment confirmation.</p>
                                    </div>

                                    <!-- Note -->
                                    <div class="bg-blue-500/10 rounded-2xl p-4 border border-blue-500/20 flex gap-3">
                                        <i class="fa-solid fa-clock text-blue-400 mt-0.5"></i>
                                        <p class="text-xs text-blue-200 font-medium leading-relaxed">After submitting, our team will verify your payment and credit your wallet within <strong>30 minutes</strong> during business hours.</p>
                                    </div>

                                    <!-- Submit -->
                                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 py-5 rounded-2xl text-white font-black text-base transition-all shadow-lg shadow-blue-900/40 active:scale-95 flex items-center justify-center gap-2">
                                        <i class="fas fa-paper-plane"></i>
                                        Submit Purchase Request
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="p-12 text-center">
                    <i class="fas fa-coins text-white/20 text-5xl mb-4"></i>
                    <p class="text-blue-300 font-bold">No assets available at the moment.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <p class="text-center text-[11px] text-blue-400 font-bold mt-8 uppercase tracking-widest">All transactions are manually reviewed &amp; secured.</p>
    </main>
</div>

<?php echo $__env->make('user.components.auth-footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\Coin-trade\resources\views/user/pages/buynow.blade.php ENDPATH**/ ?>