<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | FoodBox NG</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Tailwind Config -->
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
                            blue: '#264653', // Deep Text/Background
                            gold: '#E9C46A', // Secondary Highlight
                            orange: '#F4A261', // Tertiary/Alert
                            red: '#E76F51',   // Error/Danger
                            grey: '#F4F6F8',  // Light Background
                        }
                    },
                    boxShadow: {
                        'soft': '0 10px 40px -10px rgba(0,0,0,0.08)',
                        'sm-brand': '0 4px 6px -1px rgba(42, 157, 143, 0.1), 0 2px 4px -2px rgba(42, 157, 143, 0.1)',
                        'xl-heavy': '0 20px 60px -15px rgba(38, 70, 83, 0.2)',
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
            background: #E0E7E8; /* Lighter shade of grey */
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
            z-index: 50;
        }
        /* On mobile, hide the sidebar off-screen by default */
        @media (max-width: 1023px) {
            #sidebar {
                transform: translateX(-100%);
            }
            #sidebar.open {
                transform: translateX(0);
            }
        }
        /* On desktop (lg+), sidebar is always visible */
        @media (min-width: 1024px) {
            #sidebar {
                transform: translateX(0);
            }
        }
        
        /* Backdrop for mobile sidebar */
        #backdrop {
            transition: opacity 0.3s ease-in-out;
        }

        /* Styling for the main content area */
        .main-content {
            padding-top: 5rem; /* Space for the fixed header */
        }

        /* Active link styling */
        .nav-link.active {
            background-color: #2A9D8F;
            color: white;
            box-shadow: 0 5px 15px -5px rgba(42, 157, 143, 0.4);
        }
        .nav-link.active i {
            color: #E9C46A; /* Gold icon when active */
        }

        /* Pill status badges */
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.8rem;
            font-weight: 600;
        }

    </style>
</head>
<body class="bg-brand-grey text-brand-blue antialiased min-h-screen">

    @include('dashboard.header')
    
    <!-- Main Content Area -->
    <main class="p-4 mt-20 md:p-8 lg:ml-64 main-content">

        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif
        
        <!-- Welcome Banner -->
        <div class="bg-white p-6 rounded-2xl shadow-soft mb-8 border-l-4 border-brand-teal">
            <h2 class="text-2xl font-bold text-brand-blue mb-1">Hello, {{ $user->name }}!</h2>
            <p class="text-gray-600">Here is your quick overview of your FoodBox NG account and latest activities.</p>
        </div>

        <!-- 3. Main Dashboard Overview Section (4-Card Grid) -->
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            
            <!-- Card 1: Active Packages -->
            <div class="bg-white p-6 rounded-2xl shadow-soft border-t-4 border-brand-teal flex flex-col justify-between">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-sm font-semibold text-gray-500 uppercase">Active Packages</p>
                    <i class="fas fa-cubes text-xl text-brand-teal"></i>
                </div>
                <div class="flex items-end justify-between">
                    <span class="text-4xl font-extrabold text-brand-blue">{{ $activeSubscriptions }}</span>
                    <!-- <p class="text-xs text-brand-teal font-medium">+1 new this month</p> -->
                </div>
            </div>

            <!-- Card 2: Total Orders -->
            <div class="bg-white p-6 rounded-2xl shadow-soft border-t-4 border-brand-blue flex flex-col justify-between">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-sm font-semibold text-gray-500 uppercase">Total Orders</p>
                    <i class="fas fa-box text-xl text-brand-blue"></i>
                </div>
                <div class="flex items-end justify-between">
                    <span class="text-4xl font-extrabold text-brand-blue">{{ $totalOrders }}</span>
                    <p class="text-xs text-gray-500 font-medium">Lifetime count</p>
                </div>
            </div>

            <!-- Card 3: Subscription Status -->
            <div class="bg-white p-6 rounded-2xl shadow-soft border-t-4 border-brand-gold flex flex-col justify-between">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-sm font-semibold text-gray-500 uppercase">Subscription Status</p>
                    <i class="fas fa-sync-alt text-xl text-brand-gold"></i>
                </div>
                <div class="flex items-end">
                    <span class="text-xl font-extrabold text-brand-blue">
                        {{ $activeSubscription ? ucfirst($activeSubscription->status) : 'No Active Plan' }}
                    </span>
                    
                    @if($activeSubscription && $activeSubscription->package)
                        <p class="text-xs status-badge bg-brand-gold/20 text-brand-blue ml-2">
                            {{ $activeSubscription->package->name }}
                        </p>
                    @endif
                </div>
            </div>

            <!-- Card 4: Pending Deliveries -->
            <div class="bg-white p-6 rounded-2xl shadow-soft border-t-4 border-brand-orange flex flex-col justify-between">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-sm font-semibold text-gray-500 uppercase">Pending Deliveries</p>
                    <i class="fas fa-shipping-fast text-xl text-brand-orange"></i>
                </div>
                <div class="flex items-end justify-between">
                    <span class="text-4xl font-extrabold text-brand-blue">{{ $pendingOrders }}</span>
                    <p class="text-xs text-brand-orange font-medium">ETA: 2 days</p>
                </div>
            </div>
        </section>


        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Left Column: Recent Orders & Subscription Summary (2/3 width on desktop) -->
            <div class="lg:col-span-2 space-y-6">

                <!-- 5. Active Subscription Section -->
                <section class="bg-white p-6 rounded-2xl shadow-soft">

                    <h3 class="text-xl font-bold mb-4 text-brand-blue">
                        Active Subscription
                    </h3>

                    @if($activeSubscription)

                        <div class="flex flex-col md:flex-row items-center bg-brand-grey/50 p-4 rounded-xl border border-gray-100">

                            <!-- Package Image (optional later) -->
                            <img 
                                src="https://placehold.co/80x80/2A9D8F/ffffff?text={{ $activeSubscription->package->name ?? 'Box' }}" 
                                alt="Package Image"
                                class="w-20 h-20 object-cover rounded-lg mr-4 mb-4 md:mb-0 shadow-sm-brand"
                            >

                            <div class="flex-grow text-center md:text-left">

                                <p class="font-bold text-lg text-brand-blue">
                                    {{ $activeSubscription->package->name ?? 'No Package' }}
                                    ({{ ucfirst($activeSubscription->delivery_frequency) }})
                                </p>

                                <p class="text-sm text-gray-600 mt-1">
                                    Next Renewal: 
                                    <span class="font-semibold text-brand-teal">
                                        {{ $activeSubscription->next_renewal_date?->format('M d, Y') }}
                                    </span>
                                </p>

                                <p class="text-sm text-gray-600">
                                    Renewal Amount: 
                                    <span class="font-bold text-brand-blue">
                                        ₦{{ number_format($activeSubscription->package->price ?? 0) }}
                                    </span>
                                </p>

                            </div>

                            <a href="{{ route('manage_subscription') }}" type="button" class="w-full md:w-auto mt-4 md:mt-0 ml-0 md:ml-6 bg-brand-teal text-white font-medium py-2 px-4 rounded-full hover:bg-brand-blue transition-colors text-sm shadow-sm-brand">
                                <i class="fas fa-cog mr-2"></i> Manage Subscription
                            </a>

                        </div>

                    @else

                        <!-- No subscription state -->
                        <div class="text-center py-10 text-gray-500">
                            <i class="fas fa-box-open text-3xl mb-3"></i>
                            <p class="font-semibold">No active subscription</p>
                            <p class="text-sm">Subscribe to a package to start deliveries</p>
                        </div>

                    @endif

                </section>


                <!-- 4. Recent Orders Section -->
                <section class="bg-white p-6 rounded-2xl shadow-soft overflow-x-auto">

                    <h3 class="text-xl font-bold mb-4 text-brand-blue">
                        Recent Orders
                    </h3>

                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-brand-grey">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Order ID</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Package Name</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Amount</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Date</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold text-gray-600 uppercase">Action</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            @forelse($recentOrders as $order)

                                <tr class="hover:bg-brand-grey/50 transition-colors">

                                    <td class="px-4 py-4 text-sm font-medium text-brand-blue">
                                        #FBNG-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}
                                    </td>

                                    <td class="px-4 py-4 text-sm text-gray-600">
                                        {{ $order->package->name ?? 'N/A' }}
                                    </td>

                                    <td class="px-4 py-4 text-sm font-semibold text-brand-teal">
                                        ₦{{ number_format($order->amount) }}
                                    </td>

                                    <td class="px-4 py-4">
                                        @php
                                            $statusColors = [
                                                'pending' => 'bg-yellow-100 text-yellow-700',
                                                'processing' => 'bg-blue-100 text-blue-700',
                                                'completed' => 'bg-green-100 text-green-700',
                                                'delivered' => 'bg-green-100 text-green-700',
                                                'failed' => 'bg-red-100 text-red-700',
                                            ];
                                        @endphp

                                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                                            {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-600' }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-4 text-sm text-gray-500">
                                        {{ $order->created_at->format('Y-m-d') }}
                                    </td>

                                    <td class="px-4 py-4 text-right">
                                        <a href="#" class="text-brand-blue hover:text-brand-teal text-sm font-medium">
                                            View <i class="fas fa-chevron-right ml-1 text-xs"></i>
                                        </a>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6" class="text-center py-6 text-gray-500">
                                        No orders yet
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                    <div class="mt-4 text-center">
                        <a href="#" class="text-brand-teal font-semibold hover:text-brand-blue transition-colors text-sm">
                            View All Orders →
                        </a>
                    </div>

                </section>
            </div>

            <!-- Right Column: Quick Actions (1/3 width on desktop) -->
            <div class="lg:col-span-1 space-y-6">
                
                <!-- 6. Quick Actions Section -->
                <section class="bg-white p-6 rounded-2xl shadow-soft">
                    <h3 class="text-xl font-bold mb-4 text-brand-blue">Quick Actions</h3>
                    <div class="space-y-3">
                        
                        <button class="w-full flex items-center justify-center gap-3 bg-brand-teal text-white font-semibold py-3 rounded-xl hover:bg-brand-blue transition-colors shadow-sm-brand">
                            <i class="fas fa-shopping-basket"></i> Buy a New Package
                        </button>
                        
                        <button class="w-full flex items-center justify-center gap-3 bg-brand-gold text-brand-blue font-semibold py-3 rounded-xl hover:bg-brand-orange transition-colors shadow-sm-brand">
                            <i class="fas fa-arrow-up"></i> Upgrade Subscription
                        </button>
                        
                        <button class="w-full flex items-center justify-center gap-3 bg-brand-blue/10 border border-brand-blue/20 text-brand-blue font-semibold py-3 rounded-xl hover:bg-brand-teal/10 transition-colors">
                            <i class="fas fa-truck"></i> Track Latest Delivery
                        </button>

                        <button class="w-full flex items-center justify-center gap-3 bg-brand-blue/10 border border-brand-blue/20 text-brand-blue font-semibold py-3 rounded-xl hover:bg-brand-teal/10 transition-colors">
                            <i class="fas fa-headset"></i> Contact Support
                        </button>
                    </div>
                </section>
                
                <!-- Delivery Info Card -->
                <section class="bg-brand-blue/80 p-6 rounded-2xl shadow-soft border-t-4 border-brand-gold">

                    <h3 class="text-xl font-bold mb-3 text-white">
                        Next Delivery Window
                    </h3>

                    @if($nextDelivery)

                        <div class="text-white/90 space-y-2">

                            <p class="text-3xl font-extrabold text-brand-gold">
                                {{ $nextDelivery->next_renewal_date?->format('D, M d') }}
                            </p>

                            <p class="font-medium">
                                Between 10:00 AM and 2:00 PM
                                {{-- later you can make this dynamic --}}
                            </p>

                            <p class="text-sm">
                                Package: {{ $nextDelivery->package->name ?? 'N/A' }}
                            </p>

                            <p class="text-sm">
                                Frequency: {{ ucfirst($nextDelivery->delivery_frequency) }}
                            </p>

                            <button class="mt-3 text-sm font-semibold text-white/90 underline hover:text-brand-gold transition-colors">
                                Change Delivery Date
                            </button>

                        </div>

                    @else

                        <div class="text-white/80">
                            <p class="font-semibold">No upcoming delivery</p>
                            <p class="text-sm">Subscribe to a package to schedule deliveries</p>
                        </div>

                    @endif

                </section>

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

        function toggleSidebar() {
            const isOpen = sidebar.classList.toggle('open');
            backdrop.classList.toggle('hidden', !isOpen);
            // Request a reflow before changing opacity for smooth fade-in
            if (isOpen) {
                backdrop.offsetWidth; 
                backdrop.classList.remove('opacity-0');
            } else {
                backdrop.classList.add('opacity-0');
            }
        }

        menuToggle.addEventListener('click', toggleSidebar);
        backdrop.addEventListener('click', toggleSidebar);

        // Close sidebar on link click in mobile view
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024) { // 1024px is Tailwind's 'lg' breakpoint
                    toggleSidebar();
                }
            });
        });
    </script>
</body>
</html>