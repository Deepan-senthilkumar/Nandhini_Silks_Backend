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
        }
        .gradient-bg {
            background: linear-gradient(90deg, #a91b43 0%, #fbb624 100%);
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
    <aside class="sidebar-glass w-64 fixed h-full flex flex-col z-50">
        <div class="p-6 border-b border-slate-100 flex justify-center">
            <img src="{{ asset('images/image 1.png') }}" alt="Nandhini Silks" class="h-12 w-auto mix-blend-multiply">
        </div>

        <nav class="flex-1 px-4 space-y-2 py-4">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} flex items-center px-4 py-3 rounded-xl">
                <i class="fas fa-chart-line w-6"></i>
                <span class="font-medium">Dashboard</span>
            </a>
            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }} flex items-center px-4 py-3 rounded-xl">
                <i class="fas fa-layer-group w-6"></i>
                <span class="font-medium">Categories</span>
            </a>
            <a href="#" class="nav-link flex items-center px-4 py-3 rounded-xl">
                <i class="fas fa-box w-6"></i>
                <span class="font-medium">Products</span>
            </a>
            <a href="#" class="nav-link flex items-center px-4 py-3 rounded-xl">
                <i class="fas fa-users w-6"></i>
                <span class="font-medium">Customers</span>
            </a>
            <a href="#" class="nav-link flex items-center px-4 py-3 rounded-xl">
                <i class="fas fa-shopping-bag w-6"></i>
                <span class="font-medium">Orders</span>
            </a>
            <div class="pt-4 pb-2 px-4 uppercase text-[10px] font-bold text-slate-400 tracking-wider">Settings</div>
            <a href="#" class="nav-link flex items-center px-4 py-3 rounded-xl">
                <i class="fas fa-cog w-6"></i>
                <span class="font-medium">General Settings</span>
            </a>
        </nav>

        <div class="p-4 mt-auto">
            <div class="card-glass p-4 rounded-2xl flex items-center space-x-3">
                <div class="w-10 h-10 rounded-full gradient-bg flex items-center justify-center font-bold">
                    {{ substr(Auth::guard('admin')->user()->name, 0, 1) }}
                </div>
                <div class="flex-1 overflow-hidden">
                    <p class="text-sm font-semibold truncate">{{ Auth::guard('admin')->user()->name }}</p>
                    <p class="text-xs text-slate-500 truncate">{{ Auth::guard('admin')->user()->email }}</p>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-slate-500 hover:text-red-400 transition-colors">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-64 p-8">
        <header class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-3xl font-bold text-slate-800">@yield('title', 'Dashboard')</h1>
                <p class="text-slate-500">Welcome back, {{ Auth::guard('admin')->user()->name }}!</p>
            </div>
            <div class="flex items-center space-x-4">
                <button class="card-glass p-3 rounded-xl hover:bg-slate-50 transition-all text-slate-500">
                    <i class="fas fa-bell"></i>
                </button>
                <div class="h-10 w-[1px] bg-slate-200"></div>
                <div class="text-right">
                    <p class="text-xs text-slate-400">{{ date('l, d M Y') }}</p>
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
