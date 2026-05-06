<aside id="sidebar" class="fixed top-0 left-0 h-full w-64 bg-brand-blue p-6 shadow-admin lg:translate-x-0">
        
    <!-- Logo/Brand -->
    <div class="flex items-center gap-2 mb-8 pb-4 border-b border-white/10">
        <div class="w-10 h-10 bg-brand-teal rounded-lg flex items-center justify-center text-white shadow-lg shadow-brand-teal/40">
            <i class="fas fa-box-open text-xl"></i>
        </div>
        <span class="text-2xl font-extrabold text-white tracking-tight">FoodBox<span class="text-brand-teal">NG</span></span>
    </div>

    <!-- Admin Profile -->
    <div class="flex items-center gap-3 mb-10 pb-4 border-b border-white/10">
        <img src="https://placehold.co/40x40/E76F51/FFFFFF?text=SA" onerror="this.onerror=null; this.src='https://placehold.co/40x40/E76F51/FFFFFF?text=SA';" alt="Admin Avatar" class="w-10 h-10 rounded-full border-2 border-brand-gold/50 object-cover">
        <div class="text-white">
            <p class="font-semibold text-sm leading-tight">Admin J. Okoro</p>
            <p class="text-xs text-brand-gold font-medium">Super Admin</p>
        </div>
    </div>

    <!-- Navigation Links -->
    <nav class="space-y-1.5">
        <!-- Dashboard Overview (Active) -->
        <a href="#" class="nav-link active flex items-center gap-4 text-white/90 font-semibold p-3 rounded-xl transition-all hover:bg-brand-blue/70">
            <i class="fas fa-tachometer-alt text-lg w-6 text-center"></i>
            <span>Dashboard Overview</span>
        </a>
        <!-- Manage Packages -->
        <a href="#" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
            <i class="fas fa-cubes text-lg w-6 text-center"></i>
            <span>Manage Packages</span>
        </a>
        <!-- Orders Management -->
        <a href="#" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
            <i class="fas fa-shopping-cart text-lg w-6 text-center"></i>
            <span>Orders Management</span>
        </a>
        <!-- Subscriptions -->
        <a href="#" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
            <i class="fas fa-sync-alt text-lg w-6 text-center"></i>
            <span>Subscriptions</span>
        </a>
        <!-- Users Management -->
        <a href="#" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
            <i class="fas fa-users text-lg w-6 text-center"></i>
            <span>Users Management</span>
        </a>
        <!-- Delivery Logistics -->
        <a href="#" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
            <i class="fas fa-truck-fast text-lg w-6 text-center"></i>
            <span>Delivery Logistics</span>
        </a>
        <!-- Inventory / Stock -->
        <a href="#" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
            <i class="fas fa-warehouse text-lg w-6 text-center"></i>
            <span>Inventory / Stock</span>
        </a>
        <!-- Payments & Transactions -->
        <a href="#" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
            <i class="fas fa-credit-card text-lg w-6 text-center"></i>
            <span>Payments & Transactions</span>
        </a>
            <!-- System Settings -->
        <a href="#" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
            <i class="fas fa-cog text-lg w-6 text-center"></i>
            <span>System Settings</span>
        </a>
        <!-- Admin Management -->
        <a href="#" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
            <i class="fas fa-user-shield text-lg w-6 text-center"></i>
            <span>Admin Management</span>
        </a>
    </nav>

    <!-- Logout link at the bottom -->
    <div class="absolute bottom-6 left-6 right-6">
        <a href="{{ route('secure.logout') }}" class="flex items-center gap-4 text-brand-red font-semibold p-3 rounded-xl bg-white/10 transition-all hover:bg-brand-red/20">
            <i class="fas fa-sign-out-alt text-lg w-6 text-center"></i>
            <span>Log Out</span>
        </a>
    </div>
</aside>