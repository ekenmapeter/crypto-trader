@include('user.components.user_head', ['title' => 'Edit Account'])

@include('user.components.top-navbar')

<div class="min-h-screen  text-black">
  <div class="max-w-3xl mx-auto px-4 py-8">
    <div class="mb-16 bg-white dark:bg-slate-800 text-black dark:text-white border border-gray-200 dark:border-slate-700 shadow-xl rounded-2xl transition-colors">
                    <div class="w-full">
        <h3 class="font-medium text-black text-left px-6 py-4">Edit Account</h3>
        <form method="POST" action="{{ route('edit-user-account') }}" class="px-6 pb-6">
                                 @csrf
          <input type="hidden" name="id" value="{{ $getUserProfile->id }}" />
                    
                        <div class="mt-5 w-full text-sm">
                            <div class="grid md:grid-cols-2 md:gap-6">
              <div class="w-full border-t border-gray-200 text-gray-500 py-4">
                <label class="block text-black mb-1">First Name</label>
                <input type="text" name="firstname" class="w-full bg-white/5 border border-gray-200 rounded px-3 py-2 text-black" value="{{ $getUserProfile->firstname }}" />
              </div>
              <div class="w-full border-t border-gray-200 text-gray-500 py-4">
                <label class="block text-black mb-1">Last Name</label>
                <input type="text" name="lastname" class="w-full bg-white/5 border border-gray-200 rounded px-3 py-2 text-black" value="{{ $getUserProfile->lastname }}" />
              </div>
              <div class="w-full border-t border-gray-200 text-gray-500 py-4">
                <label class="block text-black mb-1">Email</label>
                <input type="text" name="email" class="w-full bg-white/5 border border-gray-200 rounded px-3 py-2 text-black" value="{{ $getUserProfile->email }}" />
              </div>
              <div class="w-full border-t border-gray-200 text-gray-500 py-4">
                <label class="block text-black mb-1">Username</label>
                <input type="text" name="username" class="w-full bg-white/5 border border-gray-200 rounded px-3 py-2 text-black" value="{{ $getUserProfile->username }}" />
              </div>
              <div class="w-full border-t border-gray-200 text-gray-500 py-4">
                <label class="block text-black mb-1">Sex</label>
                <select id="sex" name="sex" class="w-full bg-white/5 border border-gray-200 rounded px-3 py-2 text-black">
                  <option class="text-black" selected>{{ $getUserProfile->sex }}</option>
                  <option class="text-black" value="Male">Male</option>
                  <option class="text-black" value="Female">Female</option>
                                </select>
              </div>
              <div class="w-full border-t border-gray-200 text-gray-500 py-4">
                <label class="block text-black mb-1">Age</label>
                <input type="text" name="age" class="w-full bg-white/5 border border-gray-200 rounded px-3 py-2 text-black" value="{{ $getUserProfile->age }}" />
              </div>
              <div class="w-full border-t border-gray-200 text-gray-500 py-4">
                <label class="block text-black mb-1">Mobile Number</label>
                <input type="text" name="mobile_number" class="w-full bg-white/5 border border-gray-200 rounded px-3 py-2 text-black" value="{{ $getUserProfile->mobile_number }}" readonly />
              </div>
              <div class="w-full border-t border-gray-200 text-gray-500 py-4">
                <label class="block text-black mb-1">Account Name</label>
                <input type="text" name="account_name" class="w-full bg-white/5 border border-gray-200 rounded px-3 py-2 text-black" value="{{ $getUserProfile->account_name }}" />
              </div>
              <div class="w-full border-t border-gray-200 text-gray-500 py-4">
                <label class="block text-black mb-1">Account Number</label>
                <input type="text" name="account_number" class="w-full bg-white/5 border border-gray-200 rounded px-3 py-2 text-black" value="{{ $getUserProfile->account_number }}" />
              </div>
              <div class="w-full border-t border-gray-200 text-gray-500 py-4">
                <label class="block text-black mb-1">Bank Name</label>
                <input type="text" name="bank_name" class="w-full bg-white/5 border border-gray-200 rounded px-3 py-2 text-black" value="{{ $getUserProfile->bank_name }}" />
              </div>
                        </div>
                        </div>

          <div class="flex items-center gap-2 justify-center pt-4">
            <a class="p-2 items-center text-center justify-center bg-red-500 rounded-lg text-black font-bold" href="{{ route('account-settings') }}">Go Back</a>
            <button type="submit" class="p-2 items-center text-center justify-center bg-white text-black rounded-lg font-bold">Save Profile Settings</button>
                    </div>
                </form>
                </div>
            </div>
        <div class="mb-16 bg-white text-black border border-gray-200 shadow-md rounded-xl p-6">
            <h3 class="font-medium text-black text-left mb-4">Security: Change Password</h3>
            <form method="POST" action="{{ route('change-password') }}">
                @csrf
                <div class="grid md:grid-cols-1 gap-4">
                    <div class="w-full">
                        <label class="block text-black mb-1 text-sm font-semibold">Current Password</label>
                        <input type="password" name="current_password" required class="w-full bg-white border border-gray-200 rounded px-3 py-2 text-black" placeholder="Enter current password" />
                    </div>
                    <div class="w-full">
                        <label class="block text-black mb-1 text-sm font-semibold">New Password</label>
                        <input type="password" name="password" required class="w-full bg-white border border-gray-200 rounded px-3 py-2 text-black" placeholder="Min 8 characters" />
                    </div>
                    <div class="w-full">
                        <label class="block text-black mb-1 text-sm font-semibold">Confirm New Password</label>
                        <input type="password" name="password_confirmation" required class="w-full bg-white border border-gray-200 rounded px-3 py-2 text-black" placeholder="Repeat new password" />
                    </div>
                </div>
                <div class="mt-6 text-center">
                    <button type="submit" class="bg-[#F5A623] text-black px-6 py-2 rounded-lg font-bold hover:shadow-lg transition-all active:scale-95">Update Security</button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('user.components.user')
@include('user.components.auth-footer')
