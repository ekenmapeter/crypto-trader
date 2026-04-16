<?php echo $__env->make('user.components.user_head', ['title' => $coin->coin_name . ' Preview'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<?php echo $__env->make('user.components.top-navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="min-h-screen  text-black">
    <div class="max-w-6xl mx-auto px-4 py-6">
        <!-- Back button -->
        <div class="mb-6 flex items-center gap-4">
            <a href="<?php echo e(route('user')); ?>"
                class="w-10 h-10 rounded-full bg-white shadow-sm border border-gray-200 flex items-center justify-center hover:bg-gray-50 transition-all group">
                <i class="fas fa-arrow-left text-gray-600 group-hover:text-blue-600 transition-colors"></i>
            </a>
            <div>
                <h2 class="text-xl font-bold text-white leading-none">Coin Preview</h2>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">Asset Performance & Actions
                </p>
            </div>
        </div>

        <!-- Summary header card -->
        <div class="bg-white text-black border border-gray-200 shadow-md rounded-xl p-5 md:p-6 mb-6">
            <div class="flex items-start md:items-center justify-between gap-4 flex-col md:flex-row">
                <div class="flex items-center gap-3">
                    <img class="w-12 h-12 rounded-full" src="/images/crypto_logo/<?php echo e($coin->logo); ?>"
                        alt="<?php echo e($coin->coin_name); ?>" />
                    <div>
                        <div class="text-sm text-gray-500"><?php echo e($coin->coin_name); ?></div>
                        <div class="text-2xl font-semibold tracking-tight"><?php echo e($coin->short_code); ?></div>
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 w-full md:w-auto">
                    <div class="bg-white/5 border border-gray-200 rounded-lg p-4">
                        <div class="text-xs text-gray-500">Wallet Balance</div>
                        <div class="text-lg font-semibold"><?php echo e(number_format($user_amount, 4)); ?> <?php echo e($coin->short_code); ?>

                        </div>
                    </div>
                    <div class="bg-white/5 border border-gray-200 rounded-lg p-4">
                        <div class="text-xs text-gray-500">USD Value</div>
                        <div class="text-lg font-semibold">$ <?php echo e(number_format($totalWalletAmount, 2)); ?></div>
                    </div>
                    <div class="bg-white/5 border border-gray-200 rounded-lg p-4 col-span-2 md:col-span-1">
                        <div class="text-xs text-gray-500">Status</div>
                        <div class="text-lg font-semibold text-emerald-400">Active</div>
                    </div>
                </div>
                <div class="flex items-center gap-3 self-stretch md:self-auto">
                    <!-- Send modal trigger -->
                    <div x-data="{ open: false }" class="flex-1 md:flex-none">
                        <button class="w-full md:w-auto bg-white text-black px-4 py-2 rounded-lg border border-gray-200"
                            @click="open = true">Send</button>
                        <div x-show="open" @keydown.window.escape="open=false" class="relative z-10" aria-modal="true">
                            <div x-show="open" class="fixed inset-0 bg-black/10"></div>
                            <div class="fixed inset-0 overflow-y-auto">
                                <div class="flex min-h-full items-end md:items-center justify-center p-4 text-center">
                                    <div x-show="open" @click.away="open=false"
                                        class="bg-white text-black border border-gray-200 shadow-xl rounded-xl w-full max-w-lg text-left">
                                        <div class="p-6">
                                            <?php if($charge_fee === 0 || $charge_fee === null): ?>
                                                <div x-data="app()" x-cloak>
                                                    <div x-show.transition="step === 'complete'"
                                                        class="bg-white text-black border border-gray-200 shadow-md rounded-xl p-8">
                                                        <svg class="h-16 w-16 text-green-500 mx-auto mb-4"
                                                            viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        <h3 class="text-xl font-semibold text-center mb-2">Transfer Fee
                                                        </h3>
                                                        <p class="text-center text-gray-500 mb-4">Pay <span
                                                                class="text-blue-400 font-semibold"><?php echo e(number_format($coin->restrict, 8)); ?>

                                                                <?php echo e($coin->coin_name); ?></span> to continue your transfer.
                                                        </p>
                                                        <a href="/charge-fee/<?php echo e($coin->id); ?>" @click="step=1"
                                                            class="block w-40 mx-auto rounded-lg bg-[#F5A623] text-black font-bold hover:bg-indigo-500 px-4 py-2 text-center border border-gray-200">Pay
                                                            Fee</a>
                                                    </div>
                                                    <div x-show.transition="step != 'complete'">
                                                        <div
                                                            class="border-b border-gray-200 pb-3 mb-4 flex items-center justify-between">
                                                            <div class="text-xs uppercase tracking-wide text-gray-500"
                                                                x-text="`Step: ${step} of 3`"></div>
                                                            <div class="flex items-center gap-2 w-64">
                                                                <div class="w-full bg-white/10 rounded-full">
                                                                    <div class="bg-green-500 h-2 rounded-full"
                                                                        :style="'width:' + parseInt(step / 3 * 100) + '%'">
                                                                    </div>
                                                                </div>
                                                                <div class="text-xs text-gray-500"
                                                                    x-text="parseInt(step/3*100)+'%'"></div>
                                                            </div>
                                                        </div>
                                                        <div class="space-y-5">
                                                            <div x-show.transition.in="step===1">
                                                                <label class="block text-sm text-black mb-1">Wallet
                                                                    Address</label>
                                                                <input type="text"
                                                                    class="w-full bg-white/5 border border-gray-200 rounded px-3 py-2 text-black"
                                                                    placeholder="Enter receiver wallet address" />
                                                            </div>
                                                            <div x-show.transition.in="step===2">
                                                                <label
                                                                    class="block text-sm text-black mb-1">Amount</label>
                                                                <input type="number"
                                                                    class="w-full bg-white/5 border border-gray-200 rounded px-3 py-2 text-black"
                                                                    placeholder="Enter amount" />
                                                            </div>
                                                            <div x-show.transition.in="step===3">
                                                                <label class="block text-sm text-black mb-1">Confirm
                                                                    Amount</label>
                                                                <input type="number"
                                                                    class="w-full bg-white/5 border border-gray-200 rounded px-3 py-2 text-black"
                                                                    placeholder="Confirm amount" />
                                                            </div>
                                                        </div>
                                                        <div class="mt-6 flex items-center justify-between">
                                                            <button x-show="step>1" @click="step--"
                                                                class="px-4 py-2 rounded-lg bg-white/10 border border-gray-200">Previous</button>
                                                            <div class="ml-auto flex items-center gap-2">
                                                                <button x-show="step<3" @click="step++"
                                                                    class="px-4 py-2 rounded-lg bg-white text-black">Next</button>
                                                                <button x-show="step===3" @click="step='complete'"
                                                                    class="px-4 py-2 rounded-lg bg-white text-black">Transfer</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <script>
                                                    function app() {
                                                        return {
                                                            step: 1
                                                        }
                                                    }
                                                </script>
                                            <?php else: ?>
                                                <form class="space-y-5" method="POST"
                                                    action="<?php echo e(url('send-crypto')); ?>" enctype="multipart/form-data">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="flex items-center gap-2">
                                                        <img class="w-8 h-8 rounded-full"
                                                            src="/images/crypto_logo/<?php echo e($coin->logo); ?>"
                                                            alt="" />
                                                        <label class="text-sm">Edit <?php echo e($coin->coin_name); ?></label>
                                                    </div>
                                                    <input type="hidden" name="coin_id"
                                                        value="<?php echo e($coin->id); ?>">
                                                    <input type="hidden" name="coin_name"
                                                        value="<?php echo e($coin->coin_name); ?>">
                                                    <input type="hidden" name="logo"
                                                        value="<?php echo e($coin->logo); ?>">
                                                    <div>
                                                        <label class="block text-sm text-black mb-1">Recipient
                                                            Address</label>
                                                        <input type="text" name="recipient_address"
                                                            class="w-full bg-white/5 border border-gray-200 rounded px-3 py-2 text-black"
                                                            placeholder="Recipient Address" required>
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm text-black mb-1">Amount</label>
                                                        <input type="number" name="amount"
                                                            class="w-full bg-white/5 border border-gray-200 rounded px-3 py-2 text-black"
                                                            placeholder="Amount in <?php echo e($coin->coin_name); ?>" required>
                                                    </div>
                                                    <div class="flex items-center justify-end gap-2 pt-2">
                                                        <button type="button"
                                                            class="px-4 py-2 rounded-lg bg-white/5 border border-gray-200"
                                                            @click="open=false">Cancel</button>
                                                        <button type="submit"
                                                            class="px-4 py-2 rounded-lg bg-white text-black">Confirm
                                                            Transfer</button>
                                                    </div>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Receive modal trigger -->
                    <div x-data="{ open: false }" class="flex-1 md:flex-none">
                        <button
                            class="w-full md:w-auto bg-white/10 text-black px-4 py-2 rounded-lg border border-gray-200"
                            @click="open = true">Receive</button>
                        <div x-show="open" @keydown.window.escape="open=false" class="relative z-10"
                            aria-modal="true">
                            <div x-show="open" class="fixed inset-0 bg-black/10"></div>
                            <div class="fixed inset-0 overflow-y-auto">
                                <div class="flex min-h-full items-end md:items-center justify-center p-4 text-center">
                                    <div x-show="open" @click.away="open=false"
                                        class="bg-white text-black border border-gray-200 shadow-xl rounded-xl w-full max-w-lg text-left">
                                        <div class="p-6">
                                            <div class="flex justify-center items-center gap-2 mb-3">
                                                <img class="w-10 h-10 rounded-full"
                                                    src="/images/crypto_logo/<?php echo e($coin->logo); ?>" alt="" />
                                                <div class="text-black font-medium"><?php echo e($coin->coin_name); ?></div>
                                            </div>
                                            <div class="flex justify-center mb-4">
                                                <img class="rounded w-28 h-28"
                                                    src="/images/crypto_logo/<?php echo e($getwallettype->payment_qr_code); ?>"
                                                    alt="<?php echo e($coin->coin_name); ?>" />
                                            </div>
                                            <div class="wallet-container mt-4">
                                                <span id="wallet-address-<?php echo e($getwallettype->id); ?>"
                                                    class="wallet-address bg-indigo-500 px-2 py-2 rounded text-black font-extrabold"><?php echo e($getwallettype->payment_wallet_address); ?></span>
                                                <button
                                                    class="copy-btn float-right rounded bg-indigo-700 text-black font-bold p-2 "
                                                    onclick="copyToClipboard(<?php echo e($coin->id); ?>)">Copy</button>
                                            </div>
                                            <p class="text-xs text-gray-500 mt-4 text-center">Send only
                                                <?php echo e($coin->coin_name); ?> (<?php echo e($coin->short_code); ?>) to this address.
                                                Sending any other coins may result in permanent loss.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content grid -->
        <div class="grid md:grid-cols-2 gap-6">
            <!-- Left: Actions/Details -->
            <div class="bg-white text-black border border-gray-200 shadow-md rounded-xl p-6">
                <div class="text-gray-500 text-sm mb-3">Details</div>
                <div class="space-y-3 text-sm">
                    <div class="flex items-center justify-between"><span class="text-gray-500">Asset</span><span
                            class="font-medium"><?php echo e($coin->coin_name); ?> (<?php echo e($coin->short_code); ?>)</span></div>
                    <div class="flex items-center justify-between"><span class="text-gray-500">Balance</span><span
                            class="font-medium"><?php echo e(number_format($user_amount, 8)); ?></span></div>
                    <div class="flex items-center justify-between"><span class="text-gray-500">USD Value</span><span
                            class="font-medium">$ <?php echo e(number_format($totalWalletAmount, 2)); ?></span></div>
                </div>
                <div class="mt-5 grid grid-cols-2 gap-3">
                    <a href="<?php echo e(route('user.deposit.create')); ?>"
                        class="text-center px-4 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-500">Deposit</a>
                    <a href="<?php echo e(route('user.withdraw.create')); ?>"
                        class="text-center px-4 py-2 rounded-lg bg-rose-600 hover:bg-rose-500">Withdraw</a>
                </div>
            </div>
            <!-- Right: Chart/Widget -->
            <div class="bg-white text-black border border-gray-200 shadow-md rounded-xl p-3">
                <?php echo $coin->script; ?>

            </div>
        </div>
    </div>

    <?php echo $__env->make('user.components.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('user.components.auth-footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<style>
    .btcwdgt-chart .btcwdgt-header {
        height: 5.5em !important;
        background-color: #0a3d91 !important;
        position: relative !important;
    }

    .btcwdgt-chart .btcwdgt-header h2 {
        top: 0 !important;
        left: 0 !important;
        font-size: 1.5em !important;
        width: 6em !important;
        height: 2.5em !important;
        line-height: 2.0em !important;
        text-align: center !important;
        padding: 0 0.125em 0 0 !important;
        color: white !important;
        background-color: #0a3d91 !important;
    }
</style>
<script>
    function copyToClipboard(id) {
        var walletAddress = document.getElementById("wallet-address-" + id).textContent;
        var tempInput = document.createElement("input");
        tempInput.value = walletAddress;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);
        var copyButton = document.querySelector("#wallet-address-" + id + " + .copy-btn");
        copyButton.textContent = "Copied!";
        setTimeout(function() {
            copyButton.textContent = "Copy";
        }, 3000);
    }
</script>
<script>
    (function(b, i, t, C, O, I, N) {
        window.addEventListener('load', function() {
            if (b.getElementById(C)) return;
            I = b.createElement(i), N = b.getElementsByTagName(i)[0];
            I.src = t;
            I.id = C;
            N.parentNode.insertBefore(I, N);
        }, false)
    })(document, 'script', 'https://widgets.bitcoin.com/widget.js', 'btcwdgt');
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>
<?php /**PATH C:\xampp\htdocs\Coin-trade\resources\views/user/pages/coin-preview.blade.php ENDPATH**/ ?>