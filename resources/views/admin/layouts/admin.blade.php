<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Nandhini Silks Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f8fafc;
            color: #1e293b;
        }
        .sidebar-glass {
            background: #ffffff;
            border-right: 1px solid #e2e8f0;
            box-shadow: 4px 0 24px rgba(0,0,0,0.02);
        }
        .card-glass {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        }
        .nav-link {
            transition: all 0.3s ease;
            color: #64748b;
        }
        .nav-link:hover {
            background: rgba(169, 27, 67, 0.05);
            color: #a91b43;
        }
        .nav-link.active {
            background: #a91b43;
            color: #ffffff;
            box-shadow: 0 10px 20px rgba(169, 27, 67, 0.2);
        }
        .gradient-bg {
            background: linear-gradient(90deg, #a91b43 0%, #fbb624 100%);
        }
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #cbd5e1;
        }
        .error {
            color: #ef4444;
            font-size: 0.75rem;
            margin-top: 0.25rem;
            font-weight: 500;
        }
        input.error, select.error, textarea.error {
            border-color: #ef4444 !important;
        }
    </style>
</head>
<body class="min-h-screen flex">
    <!-- Sidebar -->
    <aside class="sidebar-glass w-72 fixed h-full flex flex-col z-50">
        <div class="px-8 py-8 border-b border-slate-50 flex flex-col items-center">
            <img src="{{ asset('images/image 1.png') }}" alt="Nandhini Silks" class="h-16 w-auto mix-blend-multiply mb-2">
            <span class="text-[10px] font-black text-slate-300 uppercase tracking-[0.2em]">Management Suite</span>
        </div>
        <nav class="flex-1 px-4 space-y-1.5 overflow-y-auto custom-scrollbar">
            <div class="px-4 py-2 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Main Menu</div>
            
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} flex items-center px-4 py-3.5 rounded-2xl">
                <div class="w-8 flex justify-center"><i class="fas fa-home text-lg"></i></div>
                <span class="font-bold ml-2">Analytics</span>
            </a>

            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }} flex items-center px-4 py-3.5 rounded-2xl">
                <div class="w-8 flex justify-center"><i class="fas fa-shapes text-lg"></i></div>
                <span class="font-bold ml-2">Categories</span>
            </a>

            <a href="#" class="nav-link flex items-center px-4 py-3.5 rounded-2xl">
                <div class="w-8 flex justify-center"><i class="fas fa-gem text-lg"></i></div>
                <span class="font-bold ml-2">Inventory</span>
            </a>

            <div class="px-4 py-6 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Customer Insight</div>

            <a href="#" class="nav-link flex items-center px-4 py-3.5 rounded-2xl">
                <div class="w-8 flex justify-center"><i class="fas fa-user-tie text-lg"></i></div>
                <span class="font-bold ml-2">Clients</span>
            </a>

            <a href="#" class="nav-link flex items-center px-4 py-3.5 rounded-2xl">
                <div class="w-8 flex justify-center"><i class="fas fa-truck-fast text-lg"></i></div>
                <span class="font-bold ml-2">Logistics</span>
                <span class="ml-auto bg-amber-100 text-amber-600 text-[10px] font-black px-2 py-0.5 rounded-lg">12</span>
            </a>

            <div class="px-4 py-6 text-[11px] font-bold text-slate-400 uppercase tracking-widest">System</div>

            <a href="#" class="nav-link flex items-center px-4 py-3.5 rounded-2xl">
                <div class="w-8 flex justify-center"><i class="fas fa-sliders text-lg"></i></div>
                <span class="font-bold ml-2">Preferences</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-72 p-10 bg-[#f9fafc]">
        <header class="flex justify-between items-center mb-12">
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">@yield('title', 'Dashboard')</h1>
                <div class="flex items-center space-x-2 mt-1">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <p class="text-slate-400 text-sm font-medium uppercase tracking-widest">Nandhini Silks Console • Live</p>
                </div>
            </div>
            
            <div class="flex items-center space-x-6">
                <!-- Date Info -->
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-black text-slate-800">{{ date('d M Y') }}</p>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-tighter">{{ date('l') }}</p>
                </div>

                <div class="h-8 w-[1px] bg-slate-200 hidden sm:block"></div>

                <!-- Notifications -->
                <button class="w-11 h-11 flex items-center justify-center card-glass rounded-xl hover:bg-[#a91b43] hover:text-white transition-all group relative">
                    <i class="fas fa-bell"></i>
                    <span class="absolute top-2.5 right-2.5 w-2 h-2 bg-rose-500 rounded-full border-2 border-white"></span>
                </button>

                <!-- Profile and Logout -->
                <div class="flex items-center space-x-4 bg-white p-1.5 pr-4 rounded-2xl border border-slate-100 shadow-sm">
                    <div class="w-10 h-10 rounded-xl gradient-bg flex items-center justify-center font-black text-white shadow-md">
                        {{ substr(Auth::guard('admin')->user()->name, 0, 1) }}
                    </div>
                    <div class="flex flex-col">
                        <span class="text-sm font-black text-slate-800 leading-none mb-1">{{ Auth::guard('admin')->user()->name }}</span>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tight">Administrator</span>
                    </div>
                    <div class="w-[1px] h-6 bg-slate-100 mx-2"></div>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-9 h-9 flex items-center justify-center bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white transition-all rounded-xl shadow-sm group">
                            <i class="fas fa-power-off text-sm"></i>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        @yield('content')
    </main>

    <script>
        // Toastr Configuration
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000"
        };

        @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif

        @if(Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif

        @if($errors->any())
            @foreach($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>
    @stack('scripts')
</body>
</html>
