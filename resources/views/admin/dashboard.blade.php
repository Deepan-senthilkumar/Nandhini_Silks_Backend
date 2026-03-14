@extends('admin.layouts.admin')

@section('title', 'Advanced Analytics')

@section('content')
<div class="space-y-8 pb-10">
    <!-- Hero Welcome Section -->
    <div class="card-glass p-8 rounded-[2.5rem] relative overflow-hidden bg-gradient-to-br from-[#a91b43] to-[#800d2e] text-white">
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="space-y-4 text-center md:text-left">
                <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight">Welcome, {{ Auth::guard('admin')->user()->name }} 👋</h2>
                <p class="text-pink-100/80 text-lg max-w-xl">Your store is performing exceptional today. Total revenue is up by <span class="text-white font-bold underline">12.5%</span> compared to last week.</p>
                <div class="flex flex-wrap justify-center md:justify-start gap-3">
                    <a href="{{ route('admin.categories.create') }}" class="bg-white text-[#a91b43] px-6 py-2.5 rounded-xl font-bold hover:scale-105 transition-all shadow-xl shadow-black/10">
                        <i class="fas fa-plus mr-2"></i> Quick Category
                    </a>
                    <button class="bg-white/20 backdrop-blur-md text-white border border-white/30 px-6 py-2.5 rounded-xl font-bold hover:bg-white/30 transition-all">
                        <i class="fas fa-download mr-2"></i> Export Report
                    </button>
                </div>
            </div>
            <div class="hidden lg:block">
                <div class="w-48 h-48 bg-white/10 rounded-full flex items-center justify-center animate-pulse">
                    <i class="fas fa-rocket text-6xl text-pink-200/50"></i>
                </div>
            </div>
        </div>
        <!-- Decorative blobs -->
        <div class="absolute -top-12 -right-12 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-12 -left-12 w-64 h-64 bg-pink-500/20 rounded-full blur-3xl"></div>
    </div>

    <!-- Analytics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @php
            $stats = [
                ['label' => 'Total Sales', 'value' => '₹4,55,210', 'trend' => '+15.2%', 'icon' => 'fa-indian-rupee-sign', 'color' => 'pink'],
                ['label' => 'Total Orders', 'value' => '1,210', 'trend' => '+8.4%', 'icon' => 'fa-shopping-cart', 'color' => 'amber'],
                ['label' => 'Active Users', 'value' => '2,458', 'trend' => '+12.5%', 'icon' => 'fa-users', 'color' => 'indigo'],
                ['label' => 'Total Products', 'value' => '856', 'trend' => '+2.1%', 'icon' => 'fa-box-open', 'color' => 'rose'],
            ];
        @endphp

        @foreach($stats as $stat)
        <div class="card-glass p-6 rounded-[2rem] hover:translate-y-[-5px] transition-all duration-300">
            <div class="flex items-start justify-between">
                <div class="p-3 rounded-2xl bg-{{ $stat['color'] }}-50 text-{{ $stat['color'] }}-600">
                    <i class="fas {{ $stat['icon'] }} text-xl"></i>
                </div>
                <div class="text-right">
                    <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg">{{ $stat['trend'] }}</span>
                </div>
            </div>
            <div class="mt-6">
                <p class="text-slate-400 text-sm font-semibold uppercase tracking-wider">{{ $stat['label'] }}</p>
                <h3 class="text-2xl font-black text-slate-800 tracking-tight mt-1">{{ $stat['value'] }}</h3>
                <div class="w-full bg-slate-100 h-1.5 rounded-full mt-4 overflow-hidden">
                    <div class="bg-{{ $stat['color'] }}-500 h-full rounded-full" style="width: 75%"></div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Main Analytics Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Sales Chart Card -->
        <div class="lg:col-span-2 card-glass p-8 rounded-[2.5rem]">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                <div>
                    <h3 class="text-2xl font-bold text-slate-800">Sales Analytics</h3>
                    <p class="text-slate-400 text-sm">Showing performance for the last 30 days</p>
                </div>
                <select class="bg-slate-50 border-none rounded-xl px-4 py-2 text-sm font-semibold text-slate-600 focus:ring-2 focus:ring-[#a91b43]">
                    <option>Last 30 Days</option>
                    <option>Last 3 Months</option>
                    <option>This Year</option>
                </select>
            </div>
            <div class="h-[350px] w-full">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <!-- Recent Activities Card -->
        <div class="card-glass p-8 rounded-[2.5rem] flex flex-col">
            <h3 class="text-xl font-bold text-slate-800 mb-6">Inventory Share</h3>
            <div class="flex-1 flex flex-col justify-center items-center">
                <div class="h-[250px] w-full mb-6">
                    <canvas id="categoryChart"></canvas>
                </div>
                <div class="grid grid-cols-2 gap-4 w-full">
                    <div class="flex items-center text-xs font-bold text-slate-500">
                        <span class="w-3 h-3 rounded-full bg-[#a91b43] mr-2"></span> Silk (45%)
                    </div>
                    <div class="flex items-center text-xs font-bold text-slate-500">
                        <span class="w-3 h-3 rounded-full bg-[#fbb624] mr-2"></span> Cotton (30%)
                    </div>
                    <div class="flex items-center text-xs font-bold text-slate-500">
                        <span class="w-3 h-3 rounded-full bg-indigo-500 mr-2"></span> Bridal (15%)
                    </div>
                    <div class="flex items-center text-xs font-bold text-slate-500">
                        <span class="w-3 h-3 rounded-full bg-rose-500 mr-2"></span> Other (10%)
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Categories / Products Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Top Categories -->
        <div class="card-glass p-8 rounded-[2.5rem]">
            <h3 class="text-xl font-bold text-slate-800 mb-6">Top Performing Categories</h3>
            <div class="space-y-4">
                @php
                    $cats = [
                        ['name' => 'Kanchipuram Silk', 'sales' => '₹2.4L', 'percent' => 85, 'color' => '#a91b43'],
                        ['name' => 'Cotton Collection', 'sales' => '₹1.1L', 'percent' => 65, 'color' => '#fbb624'],
                        ['name' => 'Bridal Wear', 'sales' => '₹85K', 'percent' => 45, 'color' => '#indigo-500'],
                        ['name' => 'Designer Blouses', 'sales' => '₹45K', 'percent' => 30, 'color' => '#rose-500'],
                    ];
                @endphp
                @foreach($cats as $cat)
                <div class="space-y-2">
                    <div class="flex justify-between text-sm font-bold">
                        <span class="text-slate-700">{{ $cat['name'] }}</span>
                        <span class="text-slate-400">{{ $cat['sales'] }}</span>
                    </div>
                    <div class="w-full bg-slate-100 h-2 rounded-full">
                        <div class="h-full rounded-full" style="width: {{ $cat['percent'] }}%; background-color: {{ $cat['color'] }}"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Quick Links Grid -->
        <div class="grid grid-cols-2 gap-4">
            <div class="card-glass p-6 rounded-3xl group bg-white hover:bg-[#a91b43] transition-all cursor-pointer">
                <div class="w-12 h-12 rounded-2xl bg-pink-50 flex items-center justify-center text-[#a91b43] group-hover:bg-white/20 group-hover:text-white transition-all">
                    <i class="fas fa-plus text-xl"></i>
                </div>
                <h4 class="mt-4 font-bold text-slate-800 group-hover:text-white">New Product</h4>
                <p class="text-xs text-slate-400 group-hover:text-white/60">Manage inventory</p>
            </div>
            <div class="card-glass p-6 rounded-3xl group bg-white hover:bg-indigo-600 transition-all cursor-pointer">
                <div class="w-12 h-12 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600 group-hover:bg-white/20 group-hover:text-white transition-all">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <h4 class="mt-4 font-bold text-slate-800 group-hover:text-white">Customers</h4>
                <p class="text-xs text-slate-400 group-hover:text-white/60">User behavior</p>
            </div>
            <div class="card-glass p-6 rounded-3xl group bg-white hover:bg-amber-500 transition-all cursor-pointer">
                <div class="w-12 h-12 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-600 group-hover:bg-white/20 group-hover:text-white transition-all">
                    <i class="fas fa-tags text-xl"></i>
                </div>
                <h4 class="mt-4 font-bold text-slate-800 group-hover:text-white">Promotions</h4>
                <p class="text-xs text-slate-400 group-hover:text-white/60">Campaign management</p>
            </div>
            <div class="card-glass p-6 rounded-3xl group bg-white hover:bg-emerald-600 transition-all cursor-pointer">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600 group-hover:bg-white/20 group-hover:text-white transition-all">
                    <i class="fas fa-gear text-xl"></i>
                </div>
                <h4 class="mt-4 font-bold text-slate-800 group-hover:text-white">Settings</h4>
                <p class="text-xs text-slate-400 group-hover:text-white/60">Configuration</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    
    // Gradient filling
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(169, 27, 67, 0.2)');
    gradient.addColorStop(1, 'rgba(169, 27, 67, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['01 Mar', '05 Mar', '10 Mar', '15 Mar', '20 Mar', '25 Mar', '30 Mar'],
            datasets: [{
                label: 'Sales Revenue',
                data: [45000, 52000, 48000, 72000, 68000, 95000, 88000],
                borderColor: '#a91b43',
                borderWidth: 4,
                tension: 0.4,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#a91b43',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8,
                fill: true,
                backgroundColor: gradient
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { display: true, color: 'rgba(0,0,0,0.03)' },
                    ticks: {
                        callback: function(value) { return '₹' + (value/1000) + 'k'; },
                        font: { weight: '600' }
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { weight: '600' } }
                }
            }
        }
    });

    // Category Doughnut Chart
    const ctx2 = document.getElementById('categoryChart').getContext('2d');
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Silk', 'Cotton', 'Bridal', 'Other'],
            datasets: [{
                data: [45, 30, 15, 10],
                backgroundColor: ['#a91b43', '#fbb624', '#6366f1', '#f43f5e'],
                borderWidth: 0,
                hoverOffset: 20
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '75%',
            plugins: {
                legend: { display: false }
            }
        }
    });
</script>
@endpush
