<header class="fixed top-0 right-0 w-full h-20 bg-white border-b border-gray-100 shadow-soft z-30 flex items-center justify-between px-4 md:px-8">
    <div class="flex-grow flex items-center space-x-6">
        <h1 class="text-xl font-bold text-brand-blue hidden md:block">Dashboard Overview</h1>
        <!-- Search Bar -->
        <div class="relative w-full max-w-sm">
            <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            <input 
                type="search" 
                placeholder="Search orders, users, or packages..."
                class="w-full pl-12 pr-4 py-2 border border-gray-200 rounded-full focus:border-brand-teal focus:ring-1 focus:ring-brand-teal/20 outline-none transition-all text-sm bg-brand-grey/50"
            >
        </div>
    </div>

    <!-- Right Side Actions -->
    <div class="flex items-center space-x-3 sm:space-x-4">
        
        <!-- Notifications Bell & Dropdown -->
        <div class="relative">
            <button 
                id="adminNotifBellBtn" 
                onclick="toggleAdminNotifications(event)" 
                type="button" 
                class="p-2.5 rounded-xl text-gray-500 hover:bg-brand-grey hover:text-brand-teal transition-all relative focus:outline-none"
                title="Notifications"
            >
                <i class="fas fa-bell text-lg"></i>
                @if(isset($adminUnreadCount) && $adminUnreadCount > 0)
                    <span id="adminNotifBadge" class="absolute top-1 right-1 flex h-4 min-w-4 px-1 items-center justify-center rounded-full ring-2 ring-white bg-brand-orange text-white text-[9px] font-extrabold animate-pulse">
                        {{ $adminUnreadCount > 99 ? '99+' : $adminUnreadCount }}
                    </span>
                @endif
            </button>

            <!-- Notification Box Dropdown -->
            <div 
                id="adminNotifDropdown" 
                class="absolute right-0 mt-3 w-80 sm:w-96 bg-white border border-gray-100 rounded-2xl shadow-modal opacity-0 invisible transition-all duration-200 transform scale-95 origin-top-right z-50 overflow-hidden"
                onclick="event.stopPropagation()"
            >
                <!-- Notification Header -->
                <div class="p-4 bg-gradient-to-r from-brand-blue to-teal-900 text-white flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center text-brand-gold text-xs shadow-inner">
                            <i class="fas fa-bell"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-sm leading-none">Notifications</h3>
                            <p class="text-[10px] text-gray-300 mt-0.5">Live customer & system alerts</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <span id="adminNotifCount" class="px-2 py-0.5 rounded-full text-[10px] font-extrabold {{ isset($adminUnreadCount) && $adminUnreadCount > 0 ? 'bg-brand-teal text-white' : 'bg-white/20 text-gray-200' }}">
                            {{ $adminUnreadCount ?? 0 }} New
                        </span>
                        @if(isset($adminUnreadCount) && $adminUnreadCount > 0)
                            <button 
                                id="adminMarkReadBtn"
                                type="button" 
                                onclick="markAllAdminNotificationsRead(event)" 
                                class="text-[11px] text-brand-gold hover:underline font-semibold transition-all"
                            >
                                Mark all read
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Notification Items List -->
                <div class="divide-y divide-gray-100 max-h-80 sm:max-h-96 overflow-y-auto" id="adminNotifList">
                    @forelse($adminNotifications ?? [] as $notification)
                        @php
                            $typeInfo = match($notification->type) {
                                'order' => ['bg' => 'bg-teal-50 text-brand-teal border-teal-100', 'icon' => 'fas fa-box-open', 'label' => 'Order'],
                                'delivery' => ['bg' => 'bg-blue-50 text-blue-600 border-blue-100', 'icon' => 'fas fa-truck-fast', 'label' => 'Delivery'],
                                'support' => ['bg' => 'bg-amber-50 text-amber-600 border-amber-100', 'icon' => 'fas fa-headset', 'label' => 'Support'],
                                'payment' => ['bg' => 'bg-emerald-50 text-emerald-600 border-emerald-100', 'icon' => 'fas fa-credit-card', 'label' => 'Payment'],
                                'subscription' => ['bg' => 'bg-indigo-50 text-indigo-600 border-indigo-100', 'icon' => 'fas fa-repeat', 'label' => 'Subscription'],
                                'promotion' => ['bg' => 'bg-purple-50 text-purple-600 border-purple-100', 'icon' => 'fas fa-tag', 'label' => 'Promotion'],
                                default => ['bg' => 'bg-gray-100 text-gray-600 border-gray-200', 'icon' => 'fas fa-bell', 'label' => 'Alert'],
                            };
                        @endphp
                        <a href="{{ $notification->url ?: '#' }}" class="p-3.5 flex items-start gap-3 hover:bg-brand-grey/70 transition-colors {{ !$notification->is_read ? 'bg-teal-50/30' : '' }} admin-notif-item">
                            <div class="w-9 h-9 rounded-xl {{ $typeInfo['bg'] }} border flex items-center justify-center shrink-0 mt-0.5 shadow-sm">
                                <i class="{{ $notification->icon ?: $typeInfo['icon'] }} text-xs"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-2">
                                    <p class="text-xs font-bold text-brand-blue truncate">{{ $notification->title }}</p>
                                    <span class="text-[10px] text-gray-400 shrink-0 font-medium">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-xs text-gray-500 line-clamp-2 mt-0.5 leading-relaxed">{{ $notification->message }}</p>
                            </div>
                            @if(!$notification->is_read)
                                <span class="w-2 h-2 rounded-full bg-brand-teal shrink-0 mt-2 notif-unread-dot"></span>
                            @endif
                        </a>
                    @empty
                        <div class="p-8 text-center text-gray-400">
                            <div class="w-12 h-12 rounded-2xl bg-brand-grey text-gray-400 flex items-center justify-center mx-auto mb-3 shadow-inner">
                                <i class="fas fa-bell-slash text-lg"></i>
                            </div>
                            <p class="text-xs font-bold text-brand-blue">No notifications yet</p>
                            <p class="text-[11px] text-gray-400 mt-0.5 max-w-xs mx-auto">All customer orders and support alerts will appear here in real time.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Quick Footer Links -->
                <div class="p-3 bg-gray-50 border-t border-gray-100 flex items-center justify-between text-xs">
                    <a href="{{ route('admin.support') }}" class="font-semibold text-brand-blue hover:text-brand-teal transition-colors flex items-center gap-1.5">
                        <i class="fas fa-headset text-[11px] text-brand-teal"></i> Support Tickets
                    </a>
                    <a href="{{ route('admin.orderManagement') }}" class="font-semibold text-brand-blue hover:text-brand-teal transition-colors flex items-center gap-1.5">
                        <i class="fas fa-box-open text-[11px] text-brand-teal"></i> Orders Desk
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Action Button -->
        <div class="relative group">
            <button class="px-3.5 sm:px-4 py-2 bg-brand-teal text-white font-semibold rounded-xl hover:bg-brand-teal/90 transition-colors shadow-sm-brand flex items-center gap-2 text-xs sm:text-sm">
                <i class="fas fa-plus"></i>
                <span class="hidden md:inline">Add New</span>
            </button>
            <!-- Quick Action Dropdown -->
            <div class="absolute right-0 mt-3 w-40 bg-white border border-gray-100 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform scale-95 origin-top-right z-40">
                <a href="{{ route('admin.managePackages') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-grey rounded-t-xl">
                    <i class="fas fa-cube mr-2 text-brand-teal"></i> 
                    Add Package
                </a>
                <a href="{{ route('admin.inventoryManagement') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-grey">
                    <i class="fas fa-box-open mr-2 text-brand-teal"></i>
                    Sub Package
                </a>
                <div class="border-t border-gray-100"></div>
                <a href="{{ route('admin.adminManagement') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-grey rounded-b-xl">
                    <i class="fas fa-user-plus mr-2 text-brand-teal"></i> Add Admin
                </a>
            </div>
        </div>
        
        <!-- Profile Avatar Dropdown -->
        @php
            $initials = collect(explode(' ', $adminName ?? 'Super Admin'))
                ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                ->join('');
        @endphp
        <div class="relative group cursor-pointer hidden sm:block">
            <img src="https://placehold.co/36x36/E76F51/FFFFFF?text={{ $initials }}" onerror="this.onerror=null; this.src='https://placehold.co/36x36/E76F51/FFFFFF?text=SA';" alt="Admin Avatar" class="w-9 h-9 rounded-full object-cover ring-2 ring-brand-blue/50">
        </div>
    </div>
</header>

<script>
    function toggleAdminNotifications(event) {
        event.stopPropagation();
        const dropdown = document.getElementById('adminNotifDropdown');
        if (dropdown) {
            const isHidden = dropdown.classList.contains('invisible');
            if (isHidden) {
                dropdown.classList.remove('opacity-0', 'invisible', 'scale-95');
                dropdown.classList.add('opacity-100', 'visible', 'scale-100');
            } else {
                dropdown.classList.add('opacity-0', 'invisible', 'scale-95');
                dropdown.classList.remove('opacity-100', 'visible', 'scale-100');
            }
        }
    }

    function markAllAdminNotificationsRead(event) {
        if (event) event.stopPropagation();
        
        const badge = document.getElementById('adminNotifBadge');
        const count = document.getElementById('adminNotifCount');
        const markReadBtn = document.getElementById('adminMarkReadBtn');
        const unreadDots = document.querySelectorAll('.notif-unread-dot');
        const unreadItems = document.querySelectorAll('.admin-notif-item');

        // Optimistic UI updates
        if (badge) badge.classList.add('hidden');
        if (count) {
            count.innerText = '0 New';
            count.classList.remove('bg-brand-teal');
            count.classList.add('bg-white/20', 'text-gray-200');
        }
        if (markReadBtn) markReadBtn.classList.add('hidden');
        unreadDots.forEach(dot => dot.remove());
        unreadItems.forEach(item => item.classList.remove('bg-teal-50/30'));

        // AJAX POST request to mark all read in database
        fetch("{{ route('notifications.mark-all-read') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        }).then(response => response.json())
        .catch(err => {
            console.error('Failed to sync notification read state:', err);
        });
    }

    // Close notification dropdown when clicking anywhere outside
    window.addEventListener('click', function(e) {
        const dropdown = document.getElementById('adminNotifDropdown');
        const bellBtn = document.getElementById('adminNotifBellBtn');
        if (dropdown && !dropdown.classList.contains('invisible')) {
            if (!dropdown.contains(e.target) && (!bellBtn || !bellBtn.contains(e.target))) {
                dropdown.classList.add('opacity-0', 'invisible', 'scale-95');
                dropdown.classList.remove('opacity-100', 'visible', 'scale-100');
            }
        }
    });

    // Close on Escape key press
    window.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const dropdown = document.getElementById('adminNotifDropdown');
            if (dropdown && !dropdown.classList.contains('invisible')) {
                dropdown.classList.add('opacity-0', 'invisible', 'scale-95');
                dropdown.classList.remove('opacity-100', 'visible', 'scale-100');
            }
        }
    });
</script>