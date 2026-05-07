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
        @php
            $initials = collect(explode(' ', $adminName))
                ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                ->join('');
        @endphp

        <div class="flex items-center gap-3">
            <img src="https://placehold.co/40x40/E76F51/FFFFFF?text={{ $initials }}"
                onerror="this.onerror=null; this.src='https://placehold.co/40x40/E76F51/FFFFFF?text=SA';"
                alt="Admin Avatar" class="w-10 h-10 rounded-full border-2 border-brand-gold/50 object-cover flex-shrink-0"
            >

            <div class="text-white min-w-0">
                <p class="font-semibold text-sm leading-tight truncate">
                    {{ strtoupper($adminName) }}
                </p>

                <p class="text-xs text-brand-gold font-medium">
                    Super Admin
                </p>
            </div>
        </div>
    </div>

    <!-- Scrollable Navigation -->
    @php
        $navLinks = [
            ['route' => 'admin.dashboard',             'icon' => 'fa-tachometer-alt', 'label' => 'Dashboard Overview'],
            ['route' => 'admin.managePackages',         'icon' => 'fa-cubes',          'label' => 'Manage Packages'],
            ['route' => 'admin.orderManagement',        'icon' => 'fa-shopping-cart',  'label' => 'Orders Management'],
            ['route' => 'admin.subscriptionManagement', 'icon' => 'fa-sync-alt',       'label' => 'Subscriptions'],
            ['route' => 'admin.userManagement',         'icon' => 'fa-users',          'label' => 'Users Management'],
            ['route' => 'admin.deliveryLogistics',      'icon' => 'fa-truck-fast',     'label' => 'Delivery Logistics'],
            ['route' => 'admin.inventoryManagement',    'icon' => 'fa-warehouse',      'label' => 'Inventory / Stock'],
            ['route' => 'admin.paymentManagement',      'icon' => 'fa-credit-card',    'label' => 'Payments & Transactions'],
            ['route' => 'admin.systemSettings',         'icon' => 'fa-cog',            'label' => 'System Settings'],
            ['route' => 'admin.adminManagement',        'icon' => 'fa-user-shield',    'label' => 'Admin Management'],
        ];
    @endphp

    <nav class="flex-1 overflow-y-auto px-6 py-4 space-y-1.5 sidebar-scroll">
        @foreach($navLinks as $link)
            @php $isActive = request()->routeIs($link['route']); @endphp
            <a href="{{ route($link['route']) }}"
               class="nav-link {{ $isActive ? 'active' : '' }} flex items-center gap-4 {{ $isActive ? 'text-white/90 font-semibold' : 'text-white/70 font-medium hover:bg-brand-blue/70 hover:text-white' }} p-3 rounded-xl transition-all">
                <i class="fas {{ $link['icon'] }} text-lg w-6 text-center"></i>
                <span>{{ $link['label'] }}</span>
            </a>
        @endforeach
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