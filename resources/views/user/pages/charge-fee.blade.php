@include('user.components.user_head')

<!-- Header -->
@include('user.components.top-navbar')

<!-- Main Content -->
<div class="mt-14 rounded-xl p-6 mx-2 mb-6 bg-white text-black shadow-md border border-gray-200">
    <div class="flex flex-col items-center justify-center">
        
                    <!-- Coin Information Card -->
            <div class="bg-gray-50 rounded-xl p-2 max-w-md w-full border border-gray-200">
                <!-- Coin Logo and Name -->
                <div class="flex flex-col items-center mb-6">
                    <img class="w-16 h-16 rounded-full mb-3" 
                         src="/images/crypto_logo/{{ $coin->logo }}" 
                         alt="{{ $coin->coin_name }}" />
                    <h2 class="text-xl font-bold text-gray-900">{{ $coin->coin_name }}</h2>
                    <p class="text-gray-600 text-sm">{{ $coin->short_code }}</p>
                </div>

                <!-- QR Code -->
                <div class="flex justify-center mb-6">
                    <img class="w-1/2 rounded-lg border border-gray-300" 
                         src="/images/crypto_logo/{{ $coin->payment_qr_code }}" 
                         alt="QR Code for {{ $coin->coin_name }}" />
                </div>

                <!-- Wallet Address -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Wallet Address</label>
                    <div class="flex gap-2">
                        <span id="wallet-address-{{ $coin->id }}" 
                              class="flex-1 bg-gray-100 px-3 py-2 rounded-lg text-gray-900 font-mono text-sm break-all border border-gray-300">
                            {{ $coin->payment_wallet_address }}
                        </span>
                        <button class="copy-btn px-4 py-2 bg-[#F5A623] text-black font-bold hover:bg-blue-700 hover:text-black text-black font-medium rounded-lg transition-colors" 
                                onclick="copyToClipboard({{ $coin->id }})">
                            Copy
                        </button>
                    </div>
                </div>

                <!-- Warning Message -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                    <p class="text-yellow-800 text-sm text-center">
                        Send only <span class="font-bold">{{ number_format($getcrypto->restrict, 8) }} {{ $coin->short_code }}</span> to this address. 
                        Sending any other coins may result in permanent loss.
                    </p>
                </div>

            <!-- Confirmation Form -->
            <form method="POST" action="{{ route('charge-sent') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="crypto" value="{{ $getcrypto->id }}" />
                <input type="hidden" name="amount" value="{{ number_format($getcrypto->restrict, 8) }}" />
                
                <button type="submit" 
                        class="w-full bg-[#F5A623] text-black font-bold hover:bg-green-700 hover:text-black text-black font-bold py-3 px-4 rounded-lg transition-colors">
                    I have sent the funds
                </button>
            </form>
        </div>

        <!-- Additional Information -->
        <div class="mt-8 text-center">
            <p class="text-gray-600 text-sm">
                After sending the funds, please wait for confirmation. 
                The transaction will be processed automatically.
            </p>
        </div>
    </div>
</div>

<script>
function copyToClipboard(id) {
    var walletAddress = document.getElementById("wallet-address-" + id).textContent.trim();
    
    // Create temporary input element
    var tempInput = document.createElement("input");
    tempInput.value = walletAddress;
    document.body.appendChild(tempInput);
    
    // Select and copy
    tempInput.select();
    document.execCommand("copy");
    document.body.removeChild(tempInput);
    
    // Update button text
    var copyButton = document.querySelector("#wallet-address-" + id + " + .copy-btn");
    copyButton.textContent = "Copied!";
    copyButton.classList.add("bg-green-600");
    
    // Reset button after 3 seconds
    setTimeout(function() {
        copyButton.textContent = "Copy";
        copyButton.classList.remove("bg-green-600");
    }, 3000);
}
</script>
@include('user.components.user')
</body>
</html>
