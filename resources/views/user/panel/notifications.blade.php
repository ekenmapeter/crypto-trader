<section x-show="currentSidebarTab == 'notificationsTab'" class="px-4 py-6">
        <h2 class="text-xl mb-2">Notifications</h2>
         @forelse($notification as $data)
        <div class="flex items-center transition-colors shadow-lg mb-2 rounded-lg group hover:bg-indigo-600 hover:text-white">
                <div class="ml-3 text-sm font-normal">
                    <div class="text-sm font-bold text-black dark:text-white hover:text-white"><a class="hover:text-blue-500" href="/user-preview-notification/{{ $data->id }}">{{ Str::limit($data->subject , 25) }}</a></div>
                    <span class="text-xs font-medium text-blue-600 dark:text-blue-500 hover:text-white">{{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</span>   
                </div>
        </div>
        @empty
             <div>
                <h3 class="text-red-400 font-extrabold mb-8">No Notification Available</h3>
            </div>
           @endforelse    
        
        
</section>


