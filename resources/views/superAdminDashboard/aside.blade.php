<aside id="sidebar" class="fixed top-0 left-0 h-full w-64 bg-brand-blue shadow-admin flex flex-col">

    <!-- Fixed Top: Logo/Brand -->
    <div class="flex-shrink-0 px-6 pt-6 pb-4 border-b border-white/10">
        <div class="flex items-center gap-2 mb-4">
            <div class="w-10 h-10 bg-brand-teal rounded-lg flex items-center justify-center text-white shadow-lg shadow-brand-teal/40">
                <i class="fas fa-box-open text-xl"></i>
            </div>
            <span class="text-2xl font-extrabold text-white tracking-tight">FoodBox<span class="text-brand-teal">NG</span></span>
        </div>

        <!-- Admin Profile -->
        <div class="flex items-center gap-3">
            <img src="https://placehold.co/40x40/E76F51/FFFFFF?text=SA" onerror="this.onerror=null; this.src='https://placehold.co/40x40/E76F51/FFFFFF?text=SA';" alt="Admin Avatar" class="w-10 h-10 rounded-full border-2 border-brand-gold/50 object-cover flex-shrink-0">
            <div class="text-white min-w-0">
                <p class="font-semibold text-sm leading-tight truncate">Admin J. Okoro</p>
                <p class="text-xs text-brand-gold font-medium">Super Admin</p>
            </div>
        </div>
    </div>

    <!-- Scrollable Navigation -->
    <nav class="flex-1 overflow-y-auto px-6 py-4 space-y-1.5 sidebar-scroll">
        <!-- Dashboard Overview (Active) -->
        <a href="{{ route('admin.dashboard') }}" class="nav-link active flex items-center gap-4 text-white/90 font-semibold p-3 rounded-xl transition-all hover:bg-brand-blue/70">
            <i class="fas fa-tachometer-alt text-lg w-6 text-center"></i>
            <span>Dashboard Overview</span>
        </a>
        <!-- Manage Packages -->
        <a href="{{ route('admin.managePackages') }}" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
            <i class="fas fa-cubes text-lg w-6 text-center"></i>
            <span>Manage Packages</span>
        </a>
        <!-- Orders Management -->
        <a href="{{ route('admin.orderManagement') }}" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
            <i class="fas fa-shopping-cart text-lg w-6 text-center"></i>
            <span>Orders Management</span>
        </a>
        <!-- Subscriptions -->
        <a href="{{ route('admin.subscriptionManagement') }}" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
            <i class="fas fa-sync-alt text-lg w-6 text-center"></i>
            <span>Subscriptions</span>
        </a>
        <!-- Users Management -->
        <a href="{{ route('admin.userManagement') }}" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
            <i class="fas fa-users text-lg w-6 text-center"></i>
            <span>Users Management</span>
        </a>
        <!-- Delivery Logistics -->
        <a href="{{ route('admin.deliveryLogistics') }}" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
            <i class="fas fa-truck-fast text-lg w-6 text-center"></i>
            <span>Delivery Logistics</span>
        </a>
        <!-- Inventory / Stock -->
        <a href="{{ route('admin.inventoryManagement') }}" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
            <i class="fas fa-warehouse text-lg w-6 text-center"></i>
            <span>Inventory / Stock</span>
        </a>
        <!-- Payments & Transactions -->
        <a href="{{ route('admin.paymentManagement') }}" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
            <i class="fas fa-credit-card text-lg w-6 text-center"></i>
            <span>Payments & Transactions</span>
        </a>
        <!-- System Settings -->
        <a href="{{ route('admin.systemSettings') }}" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
            <i class="fas fa-cog text-lg w-6 text-center"></i>
            <span>System Settings</span>
        </a>
        <!-- Admin Management -->
        <a href="{{ route('admin.adminManagement') }}" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
            <i class="fas fa-user-shield text-lg w-6 text-center"></i>
            <span>Admin Management</span>
        </a>
    </nav>

    <!-- Fixed Bottom: Logout -->
    <div class="flex-shrink-0 px-6 pb-6 pt-4 border-t border-white/10">
        <a href="{{ route('secure.logout') }}" class="flex items-center gap-4 text-brand-red font-semibold p-3 rounded-xl bg-white/10 transition-all hover:bg-brand-red/20">
            <i class="fas fa-sign-out-alt text-lg w-6 text-center"></i>
            <span>Log Out</span>
        </a>
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