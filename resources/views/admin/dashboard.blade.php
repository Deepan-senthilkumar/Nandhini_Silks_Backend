@extends('admin.layouts.admin')

@section('title', 'Advanced Analytics')

@section('content')
<div class="space-y-6 pb-6">
    <!-- Hero Welcome Section -->
    <div class="card-glass p-6 rounded-[1.5rem] relative overflow-hidden bg-gradient-to-br from-[#a91b43] to-[#800d2e] text-white">
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="space-y-3 text-center md:text-left">
                <h2 class="text-xl md:text-2xl font-extrabold tracking-tight">Welcome, {{ Auth::guard('admin')->user()->name }} 👋</h2>
                <p class="text-pink-100/80 text-sm max-w-xl">Revenue is up by <span class="text-white font-bold underline">12.5%</span> today.</p>
                <div class="flex flex-wrap justify-center md:justify-start gap-2">
                    <a href="{{ route('admin.categories.create') }}" class="bg-white text-[#a91b43] px-5 py-2 rounded-lg text-xs font-bold hover:scale-105 transition-all shadow-xl shadow-black/10">
                        <i class="fas fa-plus mr-1.5"></i> Category
                    </a>
                    <button class="bg-white/20 backdrop-blur-md text-white border border-white/30 px-5 py-2 rounded-lg text-xs font-bold hover:bg-white/30 transition-all">
                        <i class="fas fa-download mr-1.5"></i> Export
                    </button>
                </div>
            </div>
            <div class="hidden lg:block">
                <div class="w-32 h-32 bg-white/10 rounded-full flex items-center justify-center animate-pulse">
                    <i class="fas fa-rocket text-4xl text-pink-200/50"></i>
                </div>
            </div>
        </div>
        <!-- Decorative blobs -->
        <div class="absolute -top-12 -right-12 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-12 -left-12 w-64 h-64 bg-pink-500/20 rounded-full blur-3xl"></div>
    </div>

    <!-- Analytics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @php
            $stats = [
                ['label' => 'Total Sales', 'value' => '₹4,55,210', 'trend' => '+15.2%', 'icon' => 'fa-indian-rupee-sign', 'color' => 'pink'],
                ['label' => 'Total Orders', 'value' => '1,210', 'trend' => '+8.4%', 'icon' => 'fa-shopping-cart', 'color' => 'amber'],
                ['label' => 'Active Users', 'value' => '2,458', 'trend' => '+12.5%', 'icon' => 'fa-users', 'color' => 'indigo'],
                ['label' => 'Total Products', 'value' => '856', 'trend' => '+2.1%', 'icon' => 'fa-box-open', 'color' => 'rose'],
            ];
        @endphp

        @foreach($stats as $stat)
        <div class="card-glass p-5 rounded-[1.25rem] hover:translate-y-[-3px] transition-all duration-300">
            <div class="flex items-start justify-between">
                <div class="p-2 rounded-xl bg-{{ $stat['color'] }}-50 text-{{ $stat['color'] }}-600">
                    <i class="fas {{ $stat['icon'] }} text-lg"></i>
                </div>
                <div class="text-right">
                    <span class="text-[9px] font-bold text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded-md">{{ $stat['trend'] }}</span>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider">{{ $stat['label'] }}</p>
                <h3 class="text-xl font-black text-slate-800 tracking-tight mt-0.5">{{ $stat['value'] }}</h3>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Main Analytics Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Sales Chart Card -->
        <div class="lg:col-span-2 card-glass p-6 rounded-[1.5rem]">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2 mb-6">
                <div>
                    <h3 class="text-lg font-bold text-slate-800">Sales Analytics</h3>
                    <p class="text-slate-400 text-[11px]">Performance for the last 30 days</p>
                </div>
                <select class="bg-slate-50 border-none rounded-lg px-3 py-1.5 text-xs font-semibold text-slate-600 focus:ring-2 focus:ring-[#a91b43]">
                    <option>Last 30 Days</option>
                    <option>Last 3 Months</option>
                </select>
            </div>
            <div class="h-[280px] w-full">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <!-- Recent Activities Card -->
        <div class="card-glass p-6 rounded-[1.5rem] flex flex-col">
            <h3 class="text-lg font-bold text-slate-800 mb-4">Inventory Share</h3>
            <div class="flex-1 flex flex-col justify-center items-center">
                <div class="h-[180px] w-full mb-4">
                    <canvas id="categoryChart"></canvas>
                </div>
                <div class="grid grid-cols-2 gap-3 w-full">
                    <div class="flex items-center text-[10px] font-bold text-slate-500">
                        <span class="w-2 h-2 rounded-full bg-[#a91b43] mr-1.5"></span> Silk (45%)
                    </div>
                    <div class="flex items-center text-[10px] font-bold text-slate-500">
                        <span class="w-2 h-2 rounded-full bg-[#fbb624] mr-1.5"></span> Cotton (30%)
                    </div>
                    <div class="flex items-center text-[10px] font-bold text-slate-500">
                        <span class="w-2 h-2 rounded-full bg-indigo-500 mr-1.5"></span> Bridal (15%)
                    </div>
                    <div class="flex items-center text-[10px] font-bold text-slate-500">
                        <span class="w-2 h-2 rounded-full bg-rose-500 mr-1.5"></span> Other (10%)
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Categories / Products Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Top Categories -->
        <div class="card-glass p-6 rounded-[1.5rem]">
            <h3 class="text-lg font-bold text-slate-800 mb-4">Top Categories</h3>
            <div class="space-y-3">
                @php
                    $cats = [
                        ['name' => 'Kanchipuram Silk', 'sales' => '₹2.4L', 'percent' => 85, 'color' => '#a91b43'],
                        ['name' => 'Cotton Collection', 'sales' => '₹1.1L', 'percent' => 65, 'color' => '#fbb624'],
                        ['name' => 'Bridal Wear', 'sales' => '₹85K', 'percent' => 45, 'color' => '#6366f1'],
                    ];
                @endphp
                @foreach($cats as $cat)
                <div class="space-y-1.5">
                    <div class="flex justify-between text-[11px] font-bold">
                        <span class="text-slate-700">{{ $cat['name'] }}</span>
                        <span class="text-slate-400">{{ $cat['sales'] }}</span>
                    </div>
                    <div class="w-full bg-slate-100 h-1.5 rounded-full">
                        <div class="h-full rounded-full" style="width: {{ $cat['percent'] }}%; background-color: {{ $cat['color'] }}"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Quick Links Grid -->
        <div class="grid grid-cols-2 gap-3">
            <div class="card-glass p-4 rounded-xl group bg-white hover:bg-[#a91b43] transition-all cursor-pointer">
                <div class="w-8 h-8 rounded-lg bg-pink-50 flex items-center justify-center text-[#a91b43] group-hover:bg-white/20 group-hover:text-white transition-all">
                    <i class="fas fa-plus text-sm"></i>
                </div>
                <h4 class="mt-2 font-bold text-slate-800 text-xs group-hover:text-white">Product</h4>
            </div>
            <div class="card-glass p-4 rounded-xl group bg-white hover:bg-slate-800 transition-all cursor-pointer text-slate-500">
                <div class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-600 group-hover:bg-white/20 group-hover:text-white transition-all">
                    <i class="fas fa-gear text-sm"></i>
                </div>
                <h4 class="mt-2 font-bold text-slate-800 text-xs group-hover:text-white">Settings</h4>
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
