<!-- Mobile Menu Button (Outside Sidebar) -->
<div class="fixed top-4 left-4 z-50 lg:hidden">
    <button id="menu-toggle" class="p-3 rounded-xl bg-white shadow-md text-brand-blue hover:bg-brand-grey transition-colors">
        <i class="fas fa-bars text-xl"></i>
    </button>
</div>

<!-- Backdrop for Mobile Sidebar -->
<div id="backdrop" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden opacity-0" onclick="toggleSidebar()"></div>

<!-- 1. Sticky Sidebar Navigation -->
<aside id="sidebar" class="fixed top-0 left-0 h-full w-64 bg-brand-blue shadow-xl-heavy lg:translate-x-0 flex flex-col transition-transform duration-300">
    
    <!-- Fixed Top: Logo & Profile -->
    <div class="flex-shrink-0 p-6 border-b border-white/10">
        <!-- Logo/Brand -->
        <div class="flex items-center gap-2 mb-8">
            <div class="w-10 h-10 bg-brand-teal rounded-lg flex items-center justify-center text-white shadow-lg shadow-brand-teal/40">
                <i class="fas fa-leaf text-xl"></i>
            </div>
            <span class="text-2xl font-extrabold text-white tracking-tight">FoodBox<span class="text-brand-teal">NG</span></span>
        </div>

        <!-- Profile Info -->
        <div class="flex items-center gap-3">
            <img src="https://placehold.co/40x40/E9C46A/264653?text={{ strtoupper(substr($user->name, 0, 2)) }}" onerror="this.onerror=null; this.src='https://placehold.co/40x40/E9C46A/264653?text={{ strtoupper(substr($user->name, 0, 2)) }}';" alt="Profile Avatar" class="w-10 h-10 rounded-full border-2 border-brand-gold/50 object-cover flex-shrink-0">
            <div class="text-white min-w-0">
                <p class="font-semibold text-sm leading-tight truncate">{{ $user->name }}</p>
                <p class="text-[10px] uppercase font-bold tracking-wider text-brand-teal">Premium User</p>
            </div>
        </div>
    </div>

    <!-- Scrollable Navigation -->
    <nav class="flex-1 overflow-y-auto p-6 space-y-2 sidebar-scroll">
        <a href="{{ route('dashboard') }}" class="nav-link flex items-center gap-4 font-medium p-3 rounded-xl transition-all {{ request()->routeIs('dashboard') ? 'bg-brand-teal text-white shadow-lg shadow-brand-teal/20' : 'text-white/80 hover:bg-brand-teal hover:text-white' }}">
            <i class="fas fa-chart-line text-lg w-6 text-center {{ request()->routeIs('dashboard') ? 'text-brand-gold' : '' }}"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('myorders') }}" class="nav-link flex items-center gap-4 font-medium p-3 rounded-xl transition-all {{ request()->routeIs('myorders') ? 'bg-brand-teal text-white shadow-lg shadow-brand-teal/20' : 'text-white/80 hover:bg-brand-teal hover:text-white' }}">
            <i class="fas fa-box text-lg w-6 text-center {{ request()->routeIs('myorders') ? 'text-brand-gold' : '' }}"></i>
            <span>My Orders</span>
        </a>
        <a href="{{ route('mypackages') }}" class="nav-link flex items-center gap-4 font-medium p-3 rounded-xl transition-all {{ request()->routeIs('mypackages') ? 'bg-brand-teal text-white shadow-lg shadow-brand-teal/20' : 'text-white/80 hover:bg-brand-teal hover:text-white' }}">
            <i class="fas fa-cubes text-lg w-6 text-center {{ request()->routeIs('mypackages') ? 'text-brand-gold' : '' }}"></i>
            <span>My Packages</span>
        </a>
        <a href="{{ route('subscriptions') }}" class="nav-link flex items-center gap-4 font-medium p-3 rounded-xl transition-all {{ request()->routeIs('subscriptions') ? 'bg-brand-teal text-white shadow-lg shadow-brand-teal/20' : 'text-white/80 hover:bg-brand-teal hover:text-white' }}">
            <i class="fas fa-sync-alt text-lg w-6 text-center {{ request()->routeIs('subscriptions') ? 'text-brand-gold' : '' }}"></i>
            <span>Subscriptions</span>
        </a>
        <a href="{{ route('delivery_address') }}" class="nav-link flex items-center gap-4 font-medium p-3 rounded-xl transition-all {{ request()->routeIs('delivery_address') ? 'bg-brand-teal text-white shadow-lg shadow-brand-teal/20' : 'text-white/80 hover:bg-brand-teal hover:text-white' }}">
            <i class="fas fa-map-marker-alt text-lg w-6 text-center {{ request()->routeIs('delivery_address') ? 'text-brand-gold' : '' }}"></i>
            <span>Delivery Address</span>
        </a>
        <a href="{{ route('payment_history') }}" class="nav-link flex items-center gap-4 font-medium p-3 rounded-xl transition-all {{ request()->routeIs('payment_history') ? 'bg-brand-teal text-white shadow-lg shadow-brand-teal/20' : 'text-white/80 hover:bg-brand-teal hover:text-white' }}">
            <i class="fas fa-credit-card text-lg w-6 text-center {{ request()->routeIs('payment_history') ? 'text-brand-gold' : '' }}"></i>
            <span>Payment History</span>
        </a>
        <a href="{{ route('userprofile') }}" class="nav-link flex items-center gap-4 font-medium p-3 rounded-xl transition-all {{ request()->routeIs('userprofile') ? 'bg-brand-teal text-white shadow-lg shadow-brand-teal/20' : 'text-white/80 hover:bg-brand-teal hover:text-white' }}">
            <i class="fas fa-cog text-lg w-6 text-center {{ request()->routeIs('userprofile') ? 'text-brand-gold' : '' }}"></i>
            <span>Profile Settings</span>
        </a>
    </nav>

    <!-- Fixed Bottom: Logout -->
    <div class="flex-shrink-0 p-6 border-t border-white/10">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center gap-4 text-brand-red font-semibold p-3 rounded-xl bg-white/5 hover:bg-brand-red/10 transition-all">
                <i class="fas fa-sign-out-alt text-lg w-6 text-center"></i>
                <span>Log Out</span>
            </button>
        </form>
    </div>
</aside>

<style>
    /* Custom thin scrollbar for sidebar nav */
    .sidebar-scroll::-webkit-scrollbar {
        width: 4px;
    }
    .sidebar-scroll::-webkit-scrollbar-track {
        background: transparent;
    }
    .sidebar-scroll::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.15);
        border-radius: 4px;
    }
    .sidebar-scroll::-webkit-scrollbar-thumb:hover {
        background: rgba(42, 157, 143, 0.5);
    }
</style>

<!-- 2. Top Header -->
<header class="fixed top-0 right-0 w-full lg:left-64 lg:w-[calc(100%-16rem)] h-20 bg-white border-b border-gray-100 shadow-sm z-30 flex items-center px-4 md:px-8">
    <div class="flex-grow">
        <!-- Search Bar -->
        <div class="relative w-full max-w-sm hidden md:block">
            <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            <input type="search" placeholder="Search orders, packages, or settings..." class="w-full pl-12 pr-4 py-2 border border-gray-200 rounded-full focus:border-brand-teal focus:ring-1 focus:ring-brand-teal/20 outline-none transition-all text-sm bg-brand-grey/50">
        </div>
        <h1 class="text-xl font-bold lg:hidden">Dashboard</h1>
    </div>

    <!-- Right Side Icons -->
    <div class="flex items-center space-x-4">
        <!-- Notifications Bell -->
        <button class="p-2 rounded-full text-gray-500 hover:bg-brand-grey transition-colors relative">
            <i class="fas fa-bell text-lg"></i>
            <span class="absolute top-0.5 right-0.5 block h-2 w-2 rounded-full ring-2 ring-white bg-brand-orange"></span>
        </button>
        
        <!-- Profile Avatar Dropdown -->
        <div class="relative group cursor-pointer">
            <img src="https://placehold.co/36x36/E9C46A/264653?text=JO" onerror="this.onerror=null; this.src='https://placehold.co/36x36/E9C46A/264653?text=JO';" alt="Profile Avatar" class="w-9 h-9 rounded-full object-cover ring-2 ring-brand-teal/50">
            <!-- Dropdown Menu (Hidden by default) -->
            <div class="absolute right-0 mt-3 w-48 bg-white border border-gray-100 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform scale-95 group-hover:scale-100 origin-top-right">
                <a href="{{ route('userprofile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-grey rounded-t-xl"><i class="fas fa-user-circle mr-2"></i> View Profile</a>
                <a href="{{ route('settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-grey"><i class="fas fa-cog mr-2"></i> Settings</a>
                <div class="border-t border-gray-100"></div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-brand-red hover:bg-brand-red/10 rounded-b-xl">
                        <i class="fas fa-sign-out-alt mr-2"></i> Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>