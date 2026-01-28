<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Admin</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; background: #f4f7fe; }
        .dashboard-wrapper { display: flex; min-height: 100vh; }
        
        /* Sidebar Styles */
        .sidebar { 
            width: 280px; 
            background: #11142d; 
            color: #808191; 
            display: flex; 
            flex-direction: column; 
            padding: 24px;
            transition: all 0.3s ease;
        }
        .sidebar-header { margin-bottom: 40px; }
        .nav-item-custom { 
            display: flex; 
            align-items: center; 
            padding: 12px 20px; 
            border-radius: 12px; 
            color: #808191; 
            text-decoration: none; 
            margin-bottom: 8px; 
            transition: all 0.3s;
            gap: 12px;
        }
        .nav-item-custom i { font-size: 1.25rem; }
        .nav-item-custom:hover { background: rgba(108, 93, 211, 0.1); color: #6c5dd3; }
        .nav-item-custom.active { background: #6c5dd3; color: #ffffff !important; box-shadow: 0 10px 20px rgba(108, 93, 211, 0.2); }
        .nav-item-custom.active i { color: #ffffff !important; }
        
        /* Main Content */
        .main-content { flex: 1; display: flex; flex-direction: column; background: #f4f7fe; }
        .top-bar { 
            background: #ffffff; 
            padding: 16px 40px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center;
            border-bottom: 1px solid #f0f0f0;
        }
        .page-title { color: #11142d; font-weight: 700; font-size: 1.5rem; }
        
        /* Mobile Toggle */
        .mobile-nav-toggle { display: none; }
        
        @media (max-width: 991px) {
            .sidebar { position: fixed; left: -280px; z-index: 1001; height: 100vh; }
            .sidebar.active { left: 0; }
            .mobile-nav-toggle { 
                display: block; 
                position: fixed; 
                top: 20px; 
                left: 20px; 
                z-index: 1000; 
                background: white; 
                border: none; 
                padding: 10px; 
                border-radius: 8px; 
                box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            }
            .mobile-overlay { 
                display: none; 
                position: fixed; 
                inset: 0; 
                background: rgba(0,0,0,0.5); 
                z-index: 1000; 
            }
            .mobile-overlay.active { display: block; }
        }
    </style>
</head>
<body>
    <div id="app">
        <div class="dashboard-wrapper" id="dashboardWrapper">
            <!-- Mobile Toggle -->
            <button class="mobile-nav-toggle" onclick="document.querySelector('.sidebar').classList.toggle('active'); document.querySelector('.mobile-overlay').classList.toggle('active');">
                <i class="bi bi-list"></i>
            </button>
            <div class="mobile-overlay" onclick="document.querySelector('.sidebar').classList.remove('active'); document.querySelector('.mobile-overlay').classList.remove('active');"></div>

            <!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-header d-flex align-items-center justify-content-between">
                    <div class="logo-wrapper d-flex align-items-center">
                        <i class="bi bi-robot" style="color: #6c5dd3;"></i>
                        <span class="ms-2 fw-bold text-white">Admin Panel</span>
                    </div>
                </div>
                
                <div class="sidebar-nav">
                    <a href="{{ route('admin.dashboard') }}" class="nav-item-custom {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="nav-item-custom {{ Route::is('admin.users.*') ? 'active' : '' }}">
                        <i class="bi bi-people-fill"></i>
                        <span>User Management</span>
                    </a>
                    <a href="{{ route('admin.pricing.index') }}" class="nav-item-custom {{ Route::is('admin.pricing.*') ? 'active' : '' }}">
                        <i class="bi bi-tags-fill"></i>
                        <span>Pricing Management</span>
                    </a>
                    
                    <div style="margin-top: auto;"></div>
                    
                    <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-admin').submit();" class="nav-item-custom">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </a>
                    <form id="logout-form-admin" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>

            <!-- Main Content Wrapper -->
            <div class="main-content">
                <!-- Top Bar -->
                <div class="top-bar">
                    <div class="d-flex align-items-center">
                        <h2 class="page-title mb-0">@yield('title', 'Admin Dashboard')</h2>
                    </div>
                    
                    <div class="d-flex align-items-center gap-3">
                        <div class="user-nav d-flex align-items-center gap-2 ps-3 border-start">
                            <div class="text-end d-none d-sm-block">
                                <div class="fw-bold small">{{ Auth::user()->name }}</div>
                                <div class="text-muted" style="font-size: 0.7rem;">Super Admin</div>
                            </div>
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=6c5dd3&color=fff" alt="User" class="rounded-circle" width="35">
                        </div>
                    </div>
                </div>

                <!-- Page Content -->
                <div class="p-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>
</html>
