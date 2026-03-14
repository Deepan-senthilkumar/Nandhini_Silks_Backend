@extends('admin.layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <!-- Stat Cards -->
    <div class="card-glass p-6 rounded-3xl">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-2xl bg-pink-100 flex items-center justify-center text-[#a91b43]">
                <i class="fas fa-users text-xl"></i>
            </div>
            <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg">+12.5%</span>
        </div>
        <p class="text-slate-500 text-sm font-medium">Total Customers</p>
        <h3 class="text-2xl font-bold text-slate-800 mt-1">2,458</h3>
    </div>

    <div class="card-glass p-6 rounded-3xl">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-2xl bg-amber-100 flex items-center justify-center text-amber-600">
                <i class="fas fa-shopping-bag text-xl"></i>
            </div>
            <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg">+8.2%</span>
        </div>
        <p class="text-slate-500 text-sm font-medium">Monthly Orders</p>
        <h3 class="text-2xl font-bold text-slate-800 mt-1">1,210</h3>
    </div>

    <div class="card-glass p-6 rounded-3xl">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-2xl bg-rose-100 flex items-center justify-center text-rose-600">
                <i class="fas fa-chart-line text-xl"></i>
            </div>
            <span class="text-xs font-semibold text-rose-600 bg-rose-50 px-2 py-1 rounded-lg">-2.4%</span>
        </div>
        <p class="text-slate-500 text-sm font-medium">Total Revenue</p>
        <h3 class="text-2xl font-bold text-slate-800 mt-1">₹4,55,210</h3>
    </div>

    <div class="card-glass p-6 rounded-3xl">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-2xl bg-orange-100 flex items-center justify-center text-orange-600">
                <i class="fas fa-box text-xl"></i>
            </div>
            <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg">+1.5%</span>
        </div>
        <p class="text-slate-500 text-sm font-medium">Active Products</p>
        <h3 class="text-2xl font-bold text-slate-800 mt-1">856</h3>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Recent Activities -->
    <div class="lg:col-span-2 card-glass p-8 rounded-3xl">
        <div class="flex items-center justify-between mb-6">
            <h4 class="text-xl font-bold text-slate-800">Recent Transactions</h4>
            <button class="text-[#a91b43] text-sm hover:underline">View All</button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-slate-500 text-sm border-b border-white/5">
                        <th class="pb-4 font-medium">Customer</th>
                        <th class="pb-4 font-medium">Product</th>
                        <th class="pb-4 font-medium">Amount</th>
                        <th class="pb-4 font-medium">Status</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    <tr class="border-b border-slate-50">
                        <td class="py-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-xs font-bold text-slate-600">JD</div>
                                <span class="text-slate-700">John Doe</span>
                            </div>
                        </td>
                        <td class="py-4 text-slate-500">Kanchipuram Silk Saree</td>
                        <td class="py-4 text-slate-800 font-semibold">₹8,499</td>
                        <td class="py-4">
                            <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-xs">Completed</span>
                        </td>
                    </tr>
                    <tr class="border-b border-white/5">
                        <td class="py-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center text-xs font-bold">AS</div>
                                <span class="text-white">Alice Smith</span>
                            </div>
                        </td>
                        <td class="py-4 text-slate-400">Custom Design Kit</td>
                        <td class="py-4 text-white font-semibold">$149.00</td>
                        <td class="py-4">
                            <span class="px-3 py-1 bg-amber-500/10 text-amber-500 rounded-full text-xs">Pending</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center text-xs font-bold">BK</div>
                                <span class="text-white">Bob Knight</span>
                            </div>
                        </td>
                        <td class="py-4 text-slate-400">Pro License</td>
                        <td class="py-4 text-white font-semibold">$299.00</td>
                        <td class="py-4">
                            <span class="px-3 py-1 bg-emerald-500/10 text-emerald-500 rounded-full text-xs">Completed</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card-glass p-8 rounded-3xl">
        <h4 class="text-xl font-bold text-slate-800 mb-6">Quick Actions</h4>
        <div class="space-y-4">
            <button class="w-full flex items-center justify-between p-4 rounded-2xl bg-[#a91b43] hover:bg-[#940437] transition-all group">
                <span class="font-semibold text-white">Add New Product</span>
                <i class="fas fa-plus text-white group-hover:rotate-90 transition-transform"></i>
            </button>
            <button class="w-full flex items-center justify-between p-4 rounded-2xl bg-slate-50 hover:bg-slate-100 transition-all text-slate-600">
                <span class="font-semibold">Manage Customers</span>
                <i class="fas fa-user-friends"></i>
            </button>
            <button class="w-full flex items-center justify-between p-4 rounded-2xl bg-slate-50 hover:bg-slate-100 transition-all text-slate-600">
                <span class="font-semibold">Store Settings</span>
                <i class="fas fa-cog"></i>
            </button>
        </div>
    </div>
</div>
@endsection
