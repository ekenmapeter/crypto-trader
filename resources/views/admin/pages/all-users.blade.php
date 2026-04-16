@extends('layouts.admin')

@section('content')
<div class="space-y-6 pb-10">
    
    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-gray-900">User Directory</h1>
            <p class="text-sm text-gray-500 font-medium">Manage and monitor all platform participants.</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="bg-white border border-gray-200 px-6 py-2.5 rounded-2xl shadow-sm flex items-center gap-2">
                <i class="fa-solid fa-users text-xs text-blue-500"></i>
                <span class="text-sm font-black text-gray-900">{{ number_format($totalUsers) }} Accounts</span>
            </div>
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-2xl shadow-lg shadow-blue-200 text-sm font-black transition-all active:scale-95 flex items-center gap-2">
                <i class="fa-solid fa-plus text-xs"></i>
                <span>Add User</span>
            </button>
        </div>
    </div>

    {{-- Filter Bar --}}
    <div class="bg-white p-4 rounded-[24px] shadow-sm border border-gray-100 flex flex-wrap items-center gap-4">
        <div class="relative flex-1 min-w-[300px]">
            <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
            <input type="text" placeholder="Search by name, email, or country..." 
                class="w-full pl-11 pr-4 py-3 bg-gray-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-blue-500/20 transition-all font-medium">
        </div>
        <div class="flex items-center gap-2">
            <button class="px-4 py-3 bg-gray-50 hover:bg-gray-100 rounded-xl text-gray-600 text-sm font-bold transition-all flex items-center gap-2">
                <i class="fa-solid fa-cloud-arrow-down text-xs"></i>
                <span>Export</span>
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl text-sm font-bold flex items-center gap-3">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- Users List --}}
    <div class="bg-white rounded-[32px] shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Client Identity</th>
                        <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Account Status</th>
                        <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Joined Date</th>
                        <th class="px-8 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($usersTable as $data)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center text-white font-black text-lg shadow-lg group-hover:scale-110 transition-transform">
                                    {{ strtoupper(substr($data->firstname ?? $data->email, 0, 1)) }}
                                </div>
                                <div>
                                    <h4 class="text-sm font-black text-gray-900 leading-none mb-1">
                                        {{ $data->firstname }} {{ $data->lastname }}
                                        @if($data->admin)
                                            <span class="ml-2 px-2 py-0.5 bg-purple-100 text-purple-600 rounded text-[9px] uppercase tracking-tighter">Admin</span>
                                        @endif
                                    </h4>
                                    <p class="text-xs text-gray-400 font-bold tracking-tight">{{ $data->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.4)] animate-pulse"></span>
                                <span class="text-xs font-black text-emerald-600 uppercase tracking-widest">Verified Account</span>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <p class="text-sm font-bold text-gray-700">{{ \Carbon\Carbon::parse($data->created_at)->format('j M, Y') }}</p>
                            <p class="text-[10px] text-gray-400 font-medium">{{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</p>
                        </td>
                        <td class="px-8 py-5 text-right relative">
                            <div x-data="{ open: false }" class="inline-block relative">
                                <button @click="open = !open" @click.away="open = false" class="w-10 h-10 rounded-xl border border-gray-100 flex items-center justify-center text-gray-400 hover:text-blue-600 hover:bg-blue-50 transition-all">
                                    <i class="fa-solid fa-ellipsis text-xs"></i>
                                </button>
                                
                                {{-- Dropdown --}}
                                <div x-show="open" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-2xl border border-gray-100 z-50 overflow-hidden py-2">
                                    <a href="{{ route('user-preview', $data->id) }}" class="flex items-center gap-3 px-4 py-2.5 text-xs font-bold text-gray-600 hover:bg-gray-50 hover:text-blue-600 transition-colors">
                                        <i class="fa-solid fa-eye text-[10px]"></i>
                                        View Profile
                                    </a>
                                    <a href="{{ route('user-preview', $data->id) }}#edit-section" class="flex items-center gap-3 px-4 py-2.5 text-xs font-bold text-gray-600 hover:bg-gray-50 hover:text-blue-600 transition-colors">
                                        <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                                        Edit Details
                                    </a>
                                    <div class="h-px bg-gray-50 my-1 mx-2"></div>
                                    <a href="{{ route('delete-user', $data->id) }}" onclick="return confirm('Destructive Action: Are you sure you want to delete this user forever?')" 
                                       class="flex items-center gap-3 px-4 py-2.5 text-xs font-bold text-red-500 hover:bg-red-50 transition-colors">
                                        <i class="fa-solid fa-trash-can text-[10px]"></i>
                                        Delete User
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-20 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                    <i class="fa-solid fa-user-slash text-gray-200 text-3xl"></i>
                                </div>
                                <h3 class="text-gray-900 font-black text-lg">No Users Yet</h3>
                                <p class="text-gray-400 text-sm">When users register on your platform, they will appear here.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($usersTable->hasPages())
        <div class="px-8 py-6 bg-gray-50/50 border-t border-gray-100">
            {{ $usersTable->links() }}
        </div>
        @endif
    </div>

</div>
@endsection
