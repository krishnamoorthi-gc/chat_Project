<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="ChatBot Dashboard - Manage your AI Chatbots, conversations, and leads in one place.">
    <meta name="keywords" content="dashboard, chatbot management, analytics, leads, conversations, AI control panel">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/dashboard') }}">
    <meta property="og:title" content="{{ config('app.name', 'Laravel') }} - Dashboard">
    <meta property="og:description" content="Manage your AI Chatbots and conversations efficiently.">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
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
                        <i class="bi bi-robot"></i>
                        <span class="ms-2 fw-bold">ChatApp</span>
                    </div>
                    <button class="sidebar-toggle-btn d-none d-lg-flex" onclick="toggleSidebar()">
                        <i class="bi bi-list" id="toggleIcon"></i>
                    </button>
                </div>
                
                <div class="sidebar-nav">
                    <a href="{{ route('dashboard') }}" class="nav-item-custom {{ Route::is('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('chatbots.index') }}" class="nav-item-custom {{ Route::is('chatbots.*') ? 'active' : '' }}">
                        <i class="bi bi-robot"></i>
                        <span>My Chatbots</span>
                    </a>
                    <a href="{{ route('conversations.index') }}" class="nav-item-custom {{ Route::is('conversations.*') ? 'active' : '' }}">
                        <i class="bi bi-chat-text"></i>
                        <span>Conversations</span>
                    </a>
                    <a href="{{ route('leads.index') }}" class="nav-item-custom {{ Route::is('leads.*') ? 'active' : '' }}">
                        <i class="bi bi-people"></i>
                        <span>Leads</span>
                    </a>
                    <a href="#" class="nav-item-custom">
                        <i class="bi bi-graph-up"></i>
                        <span>Analytics</span>
                    </a>
                    <a href="#" class="nav-item-custom">
                        <i class="bi bi-gear"></i>
                        <span>Settings</span>
                    </a>
                    <a href="{{ route('help') }}" class="nav-item-custom {{ Route::is('help') ? 'active' : '' }}">
                        <i class="bi bi-book"></i>
                        <span>Knowledge Base</span>
                    </a>
                    
                    <div style="margin-top: auto;"></div>
                    
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-global').submit();" class="nav-item-custom">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </a>
                    <form id="logout-form-global" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>

                <div class="upgrade-promo mt-4">
                    <h6>Upgrade to Pro</h6>
                    <p>Unlock more features</p>
                    <button class="btn-upgrade">Upgrade</button>
                </div>
            </div>

            <!-- Main Content Wrapper -->
            <div class="main-content">
                <!-- Top Bar -->
                <div class="top-bar">
                    <div class="d-flex align-items-center">
                        <h2 class="page-title mb-0">@yield('title', 'Dashboard')</h2>
                    </div>
                    
                    <div class="d-flex align-items-center gap-3">
                        <div class="search-bar d-none d-md-flex">
                            <i class="bi bi-search"></i>
                            <input type="text" placeholder="Search...">
                        </div>
                        
                        <div class="user-nav d-flex align-items-center gap-2 ps-3 border-start">
                            <div class="text-end d-none d-sm-block">
                                <div class="fw-bold small">{{ Auth::user()->name }}</div>
                                <div class="text-muted" style="font-size: 0.7rem;">Admin</div>
                            </div>
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=6c5dd3&color=fff" alt="User" class="rounded-circle" width="35">
                        </div>
                    </div>
                </div>

                <!-- Page Content -->
                @yield('content')
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const wrapper = document.getElementById('dashboardWrapper');
            // const icon = document.getElementById('toggleIcon'); // No longer toggling icon class
            
            sidebar.classList.toggle('mini');
            wrapper.classList.toggle('sidebar-collapsed');
            
            if (sidebar.classList.contains('mini')) {
                // icon.classList.replace('bi-text-indent-left', 'bi-text-indent-right');
                localStorage.setItem('sidebar-mode', 'mini');
            } else {
                // icon.classList.replace('bi-text-indent-right', 'bi-text-indent-left');
                localStorage.setItem('sidebar-mode', 'full');
            }
        }

        // Restore sidebar state
        document.addEventListener('DOMContentLoaded', () => {
            const mode = localStorage.getItem('sidebar-mode');
            if (mode === 'mini') {
                toggleSidebar();
            }
        });
    </script>
</body>
</html>
