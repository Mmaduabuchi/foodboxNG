<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard | FoodBox NG</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Tailwind Config (Branding) -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            teal: '#2A9D8F', // Primary Action/Highlight
                            blue: '#264653', // Deep Text/Background (Admin Primary)
                            gold: '#E9C46A', // Secondary Highlight/Warning
                            orange: '#F4A261', // Tertiary/Alert
                            red: '#E76F51',   // Error/Danger
                            grey: '#F4F6F8',  // Light Background
                        }
                    },
                    boxShadow: {
                        'soft': '0 8px 30px -10px rgba(0,0,0,0.06)',
                        'sm-brand': '0 4px 6px -1px rgba(42, 157, 143, 0.1), 0 2px 4px -2px rgba(42, 157, 143, 0.1)',
                        'admin': '0 15px 45px -15px rgba(38, 70, 83, 0.3)',
                    }
                }
            }
        }
    </script>

    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #E0E7E8; 
        }
        ::-webkit-scrollbar-thumb {
            background: #2A9D8F;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #264653;
        }

        /* Sidebar transition for smoother mobile opening/closing */
        #sidebar {
            transition: transform 0.3s ease-in-out;
            transform: translateX(-100%);
            z-index: 50;
        }
        #sidebar.open {
            transform: translateX(0);
        }
        /* Always visible on desktop (lg: 1024px+) */
        @media (min-width: 1024px) {
            #sidebar {
                transform: translateX(0) !important;
            }
        }
        
        /* Backdrop for mobile sidebar */
        #backdrop {
            transition: opacity 0.3s ease-in-out;
        }
        
        /* Main content area adjustment for fixed header */
        .main-content {
            padding-top: 5rem; 
        }

        /* Chart Placeholder styling */
        .chart-placeholder {
            min-height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            border: 2px dashed #E0E7E8;
            color: #A0AEC0;
            font-style: italic;
        }
        
        /* Sidebar active link specific styling */
        .nav-link.active {
            background-color: #3B5F6C; /* Slightly lighter shade of brand-blue */
            color: #E9C46A; /* Gold text for highlight */
            box-shadow: 0 5px 15px -5px rgba(42, 157, 143, 0.2);
            border-left: 4px solid #2A9D8F; /* Teal border indicator */
            padding-left: 1.75rem; /* Adjust padding for border */
        }
        .nav-link:not(.active) {
            border-left: 4px solid transparent;
        }

        /* Table Responsive Styles */
        @media (max-width: 768px) {
            .responsive-table th, .responsive-table td {
                padding: 0.5rem 0.75rem;
                display: block;
                width: 100%;
                text-align: left !important;
            }
            .responsive-table th:before {
                content: attr(data-label);
                float: left;
                font-weight: 700;
                margin-right: 10px;
                color: #264653;
            }
            .responsive-table tr {
                margin-bottom: 1rem;
                display: block;
                border: 1px solid #E0E7E8;
                border-radius: 0.75rem;
                padding: 1rem;
            }
            .responsive-table thead {
                display: none;
            }
        }
    </style>
</head>
<body class="bg-brand-grey text-brand-blue font-sans min-h-screen">

    <!-- Mobile Menu Button -->
    <div class="fixed top-4 left-4 z-50 lg:hidden">
        <button id="menu-toggle" class="p-3 rounded-xl bg-white shadow-md text-brand-blue hover:bg-brand-grey transition-colors">
            <i class="fas fa-bars text-xl"></i>
        </button>
    </div>

    <!-- Backdrop for Mobile Sidebar -->
    <div id="backdrop" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden opacity-0" onclick="toggleSidebar()"></div>

    <!-- 1. Sidebar Navigation (Deep Blue Background) -->
    @include('superAdminDashboard.aside')

    <!-- 2. Top Header -->
    @include('superAdminDashboard.header')
    
    <!-- Main Content Area -->
    <main class="mt-20 lg:ml-64 p-4 md:p-8 main-content">
        
        <!-- 3. Dashboard Overview Cards -->
        <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-5 lg:gap-5 mb-8">
            
            <!-- Card 1: Total Users -->
            <div class="p-4 bg-white rounded-2xl shadow-soft">
                <div class="flex items-center justify-between">
                    <i class="fas fa-users text-2xl text-brand-teal p-3 bg-brand-teal/10 rounded-xl"></i>
                </div>
                <p class="text-sm text-gray-500 mt-2">Total Users</p>
                <p class="text-2xl font-extrabold text-brand-blue">{{ $totalUsers }}</p>
            </div>

            <!-- Card 2: Total Orders -->
            <div class="p-4 bg-white rounded-2xl shadow-soft">
                <div class="flex items-center justify-between">
                    <i class="fas fa-shopping-basket text-2xl text-brand-blue p-3 bg-brand-blue/10 rounded-xl"></i>
                </div>
                <p class="text-sm text-gray-500 mt-2">Total Orders</p>
                <p class="text-2xl font-extrabold text-brand-blue">{{ $totalOrders }}</p>
            </div>

            <!-- Card 3: Active Subscriptions -->
            <div class="p-4 bg-white rounded-2xl shadow-soft">
                <div class="flex items-center justify-between">
                    <i class="fas fa-sync-alt text-2xl text-brand-gold p-3 bg-brand-gold/10 rounded-xl"></i>
                </div>
                <p class="text-sm text-gray-500 mt-2">Active Subs</p>
                <p class="text-2xl font-extrabold text-brand-blue">{{ $activeSubscriptions }}</p>
            </div>

            <!-- Card 4: Revenue This Month -->
            <div class="p-4 bg-white rounded-2xl shadow-soft">
                <div class="flex items-center justify-between">
                    <i class="fas fa-money-bill-wave text-2xl text-brand-teal p-3 bg-brand-teal/10 rounded-xl"></i>
                </div>
                <p class="text-sm text-gray-500 mt-2">Rev. (This Month)</p>
                <p class="text-2xl font-extrabold text-brand-blue">₦4.2M</p>
            </div>
            
            <!-- Card 5: Pending Deliveries -->
            <div class="p-4 bg-white rounded-2xl shadow-soft">
                <div class="flex items-center justify-between">
                    <i class="fas fa-box text-2xl text-brand-orange p-3 bg-brand-orange/10 rounded-xl"></i>
                    <span class="text-sm text-gray-500 hidden md:block">High Priority</span>
                </div>
                <p class="text-sm text-gray-500 mt-2">Pending Deliveries</p>
                <p class="text-2xl font-extrabold text-brand-blue">84</p>
            </div>
        </div>

        <!-- 5. Recent Orders Table & 6. Inventory/Activity Log (Grid Layout) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Recent Orders Table (2/3 width) -->
            <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-soft overflow-x-auto">
                <h3 class="text-xl font-semibold mb-4 text-brand-blue">Recent Orders</h3>
                <table class="min-w-full divide-y divide-gray-200 responsive-table">
                    <thead class="bg-brand-grey/50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Package</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($recentOrders as $order)
                            @php
                                $badge = match($order->delivery_status) {
                                    'delivered'        => ['bg-green-100 text-green-800',  'Delivered'],
                                    'processing'       => ['bg-yellow-100 text-yellow-800','Processing'],
                                    'out_for_delivery' => ['bg-blue-100 text-blue-800',   'Out for Delivery'],
                                    'pending'          => ['bg-gray-100 text-gray-700',   'Pending'],
                                    default            => match($order->status) {
                                        'cancelled' => ['bg-red-100 text-red-800',     'Cancelled'],
                                        'completed' => ['bg-green-100 text-green-800', 'Completed'],
                                        'failed'    => ['bg-red-100 text-red-800',     'Failed'],
                                        default     => ['bg-gray-100 text-gray-700',   ucfirst($order->status)],
                                    },
                                };
                                $customerName = $order->user
                                    ? $order->user->name
                                    : 'Unknown';
                                $packageName = $order->package
                                    ? $order->package->name
                                    : '—';
                            @endphp
                            <tr class="hover:bg-brand-grey transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Order ID">
                                    #FB{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Customer">
                                    {{ $customerName }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Package">
                                    {{ $packageName }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Amount">
                                    ₦{{ number_format($order->amount, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap" data-label="Status">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $badge[0] }}">
                                        {{ $badge[1] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Date">
                                    {{ $order->created_at->diffForHumans() }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Action">
                                    <button class="text-brand-teal hover:text-brand-blue transition-colors">View</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-sm text-gray-400 italic">
                                    <i class="fas fa-inbox text-2xl mb-2 block text-gray-300"></i>
                                    No orders found yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Inventory & Stock Alerts (1/3 width) -->
            <div class="bg-white p-6 rounded-2xl shadow-soft">
                <h3 class="text-xl font-semibold mb-4 text-brand-blue">Inventory Alerts</h3>
                <div class="space-y-4">
                    
                    <!-- Alert 1 -->
                    <div class="p-3 bg-brand-gold/10 border-l-4 border-brand-gold rounded-lg flex justify-between items-center">
                        <div>
                            <p class="font-semibold text-brand-blue">Palm Oil</p>
                            <p class="text-sm text-gray-600">Low Stock: 45 Litres left</p>
                        </div>
                        <button class="text-xs text-white px-3 py-1 rounded-full bg-brand-teal hover:bg-brand-teal/90">Restock</button>
                    </div>

                    <!-- Alert 2 -->
                    <div class="p-3 bg-brand-red/10 border-l-4 border-brand-red rounded-lg flex justify-between items-center">
                        <div>
                            <p class="font-semibold text-brand-blue">Semovita</p>
                            <p class="text-sm text-gray-600">Out of Stock</p>
                        </div>
                        <button class="text-xs text-white px-3 py-1 rounded-full bg-brand-red hover:bg-brand-red/90">Order</button>
                    </div>

                    <!-- Alert 3 -->
                    <div class="p-3 bg-brand-gold/10 border-l-4 border-brand-gold rounded-lg flex justify-between items-center">
                        <div>
                            <p class="font-semibold text-brand-blue">Dried Fish</p>
                            <p class="text-sm text-gray-600">Low Stock: 12kg left</p>
                        </div>
                        <button class="text-xs text-white px-3 py-1 rounded-full bg-brand-teal hover:bg-brand-teal/90">Restock</button>
                    </div>
                </div>
                <button class="w-full mt-4 text-sm text-brand-blue font-semibold hover:text-brand-teal transition-colors">
                    View All Inventory <i class="fas fa-arrow-right ml-1 text-xs"></i>
                </button>
            </div>
        </div>

        <!-- 7. Package Management Preview & 8. System Activity Log (Grid Layout) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6 mb-8">
             <!-- Package Management Preview -->
            <div>
                <h3 class="text-xl font-semibold mb-4 text-brand-blue">Top 3 Packages</h3>
                <div class="space-y-4">
                    
                    @forelse($topPackages as $pkg)
                        @php
                            $colors = ['2A9D8F', '264653', 'F4A261', 'E76F51', 'E9C46A'];
                            $color = $colors[$pkg->id % count($colors)];
                            $initial = strtoupper(substr($pkg->name, 0, 1));
                        @endphp
                        <!-- Package Card -->
                        <div class="bg-white p-4 rounded-2xl shadow-soft flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <img src="https://placehold.co/60x60/{{ $color }}/FFFFFF?text={{ $initial }}" 
                                    onerror="this.onerror=null; this.src='https://placehold.co/60x60/{{ $color }}/FFFFFF?text={{ $initial }}';" 
                                    alt="{{ $pkg->name }}" class="w-16 h-16 rounded-xl object-cover ring-1 ring-brand-teal/30">
                                <div>
                                    <p class="font-bold text-brand-blue">{{ $pkg->name }}</p>
                                    <p class="text-sm text-gray-500 text-nowrap">₦{{ number_format($pkg->price, 0) }} <span class="font-semibold text-brand-teal ml-2">{{ number_format($pkg->subscriptions_count) }} Sold</span></p>
                                </div>
                            </div>
                            <a href="{{ route('admin.managePackages') }}" class="text-brand-gold hover:text-brand-orange transition-colors p-2 rounded-full">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    @empty
                        <div class="p-6 text-center bg-white rounded-2xl shadow-soft">
                            <p class="text-gray-400 italic text-sm">No active packages found.</p>
                        </div>
                    @endforelse
                </div>
            </div>
            
            <!-- System Activity Log -->
            <div>
                <h3 class="text-xl font-semibold mb-4 text-brand-blue">Recent registered Users</h3>
                <div class="bg-white p-6 rounded-2xl shadow-soft h-full">
                    <ul class="space-y-4 text-sm">
                        @forelse($recentUsers as $user)
                        <!-- User Signup -->
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-user-plus mt-1 text-brand-teal"></i>
                            <div>
                                <p class="text-brand-blue font-medium">New user registered: <span class="font-bold">{{ $user->name }}</span></p>
                                <p class="text-xs text-gray-500">{{ $user->email }} • {{ $user->created_at->diffForHumans() }}</p>
                            </div>
                        </li>
                        @empty
                        <li class="text-gray-400 italic text-center py-4">
                            No recent user registrations found.
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <!-- Footer Spacer -->
        <div class="h-12"></div>
    </main>

    <!-- JavaScript for Mobile Sidebar Toggle -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const menuToggle = document.getElementById('menu-toggle');
        const backdrop = document.getElementById('backdrop');

        // --- Sidebar Toggle Functions ---
        function toggleSidebar() {
            const isOpen = sidebar.classList.toggle('open');
            backdrop.classList.toggle('hidden', !isOpen);
            if (isOpen) {
                backdrop.offsetWidth; 
                backdrop.classList.remove('opacity-0');
            } else {
                backdrop.classList.add('opacity-0');
            }
        }

        menuToggle.addEventListener('click', toggleSidebar);
        backdrop.addEventListener('click', toggleSidebar);

        // Close sidebar on navigation item click (Mobile only)
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024) { 
                    // Use a slight delay to allow the visual click state to show
                    setTimeout(() => toggleSidebar(), 150);
                }
            });
        });
    </script>
</body>
</html>