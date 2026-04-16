@include('user.components.user_head', ['title' => 'Account Settings']) 
@include('user.components.top-navbar')

<div class="px-4 py-8 space-y-6">
    <div class="bg-white text-black border border-gray-100 shadow-xl rounded-[24px] overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h3 class="font-bold text-lg text-gray-800">Account Settings</h3>
            <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded-full uppercase">Profile</span>
        </div>
        
        <div class="p-6">
            <div class="grid md:grid-cols-2 gap-4">
                @php
                    $fields = [
                        ['label' => 'Full Name', 'value' => $getUserProfile->firstname . ' ' . $getUserProfile->lastname],
                        ['label' => 'Username', 'value' => $getUserProfile->username],
                        ['label' => 'Sex', 'value' => $getUserProfile->sex],
                        ['label' => 'Age', 'value' => $getUserProfile->age],
                        ['label' => 'Email', 'value' => $getUserProfile->email],
                        ['label' => 'Mobile Number', 'value' => $getUserProfile->mobile_number],
                        ['label' => 'Account Name', 'value' => $getUserProfile->account_name],
                    ];
                @endphp

                @foreach($fields as $field)
                    <div class="p-4 rounded-[16px] bg-gray-50 border border-gray-100 hover:border-blue-100 transition-colors">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">{{ $field['label'] }}</p>
                        <p class="font-semibold text-gray-900">{{ $field['value'] }}</p>
                    </div>
                @endforeach

                <div class="p-4 rounded-[16px] bg-gray-50 border border-gray-100 hover:border-blue-100 transition-colors flex justify-between items-center">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Account Number</p>
                        <p class="font-semibold text-gray-900" id="myInput">{{ $getUserProfile->account_number }}</p>
                    </div>
                    <button class="px-4 py-2 rounded-lg bg-[#F5A623] text-black font-bold text-xs shadow hover:bg-black hover:text-white transition-all active:scale-95 btn-copy" data-text="{{ $getUserProfile->account_number }}">Copy</button>
                </div>

                <div class="p-4 rounded-[16px] bg-gray-50 border border-gray-100 hover:border-blue-100 transition-colors">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Bank Name</p>
                    <p class="font-semibold text-gray-900">{{ $getUserProfile->bank_name }}</p>
                </div>

                <div class="p-4 rounded-[16px] bg-gray-50 border border-gray-100 hover:border-blue-100 transition-colors flex justify-between items-center md:col-span-2">
                    <div class="flex-1 pr-4">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Wallet Phrase</p>
                        <p class="font-semibold text-gray-900 break-all">{{ $getUserProfile->wallet_phrase ?? 'No phrase generated.' }}</p>
                    </div>
                    @if($getUserProfile->wallet_phrase)
                        <button class="px-4 py-2 rounded-lg bg-[#F5A623] text-black font-bold text-xs shadow hover:bg-black hover:text-white transition-all active:scale-95 btn-copy" data-text="{{ $getUserProfile->wallet_phrase }}">Copy</button>
                    @endif
                </div>
            </div>

            <div class="mt-8 flex justify-center">
                <a class="px-8 py-3 bg-[#F5A623] text-black rounded-[12px] font-bold shadow-lg hover:shadow-xl hover:bg-black hover:text-white transition-all transform active:scale-95" href="/edit-account/{{ $getUserProfile->id }}">
                    <i class="fa-solid fa-user-pen mr-2"></i>Edit Account
                </a>
            </div>
        </div>
    </div>
</div>

@include('user.components.user') 

<script>
    document.querySelectorAll('.btn-copy').forEach(btn => {
        btn.addEventListener('click', function() {
            const text = this.getAttribute('data-text');
            navigator.clipboard.writeText(text).then(() => {
                const originalText = this.textContent;
                this.textContent = 'Copied!';
                this.classList.replace('bg-[#F5A623]', 'bg-green-500');
                this.classList.add('text-white');
                setTimeout(() => {
                    this.textContent = originalText;
                    this.classList.replace('bg-green-500', 'bg-[#F5A623]');
                    this.classList.remove('text-white');
                }, 2000);
            });
        });
    });
</script>
