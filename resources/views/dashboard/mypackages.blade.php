<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Packages | FoodBox NG</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Tailwind Config (Reused from Dashboard) -->
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

        /* Active link styling (My Packages is active here) */
        .nav-link.active {
            background-color: #2A9D8F;
            color: white;
            box-shadow: 0 5px 15px -5px rgba(42, 157, 143, 0.4);
        }
        .nav-link.active i {
            color: #E9C46A; /* Gold icon when active */
        }

        /* Package Card Hover Effect */
        .package-card {
            transition: all 0.3s ease;
            cursor: pointer;
            border-left: 5px solid transparent;
        }
        .package-card:hover {
            transform: translateX(5px);
            box-shadow: 0 8px 25px -10px rgba(38, 70, 83, 0.1);
        }
        .package-card.status-upcoming {
            border-left-color: #2A9D8F;
        }
        .package-card.status-delivered {
            border-left-color: #E9C46A;
        }

    </style>
</head>
<body class="bg-brand-grey text-brand-blue antialiased min-h-screen">

    @include('dashboard.header')

    <!-- Main Content Area -->
    <main class="p-4 mt-20 md:p-8 lg:ml-64 main-content">
        
        <!-- Header Section -->
        <div class="mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-brand-blue mb-1">Your Food Packages</h1>
                    <p class="text-gray-600">Track upcoming deliveries and review the contents of your past FoodBox NG packages.</p>
                </div>
                <a href="{{ route('report') }}" class="mt-4 md:mt-0 px-6 py-3 bg-brand-red text-white font-semibold rounded-xl hover:bg-brand-red/90 transition-colors shadow-sm-brand flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i> Report an Issue
                </a>
            </div>
        </div>

        <!-- Stats Bar -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-2xl p-4 shadow-soft flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-brand-teal/10 flex items-center justify-center">
                    <i class="fas fa-box text-brand-teal"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Total Orders</p>
                    <p class="text-xl font-bold text-brand-blue">{{ $totalOrders }}</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-4 shadow-soft flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-brand-orange/10 flex items-center justify-center">
                    <i class="fas fa-clock text-brand-orange"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Pending</p>
                    <p class="text-xl font-bold text-brand-blue">{{ $pendingOrders }}</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-4 shadow-soft flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-brand-gold/20 flex items-center justify-center">
                    <i class="fas fa-check-circle text-brand-gold"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Completed</p>
                    <p class="text-xl font-bold text-brand-blue">{{ $completedOrders }}</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-4 shadow-soft flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-brand-red/10 flex items-center justify-center">
                    <i class="fas fa-times-circle text-brand-red"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Cancelled</p>
                    <p class="text-xl font-bold text-brand-blue">{{ $cancelledOrders }}</p>
                </div>
            </div>
        </div>

        @php
            $upcomingOrders = $recentOrders->filter(fn($o) => $o->delivery_status !== 'delivered');
            $deliveredOrders = $recentOrders->filter(fn($o) => $o->delivery_status === 'delivered');
        @endphp

        <!-- Upcoming Packages Section -->
        <section class="mb-10">
            <h2 class="text-2xl font-semibold text-brand-blue mb-4 flex items-center gap-2">
                <i class="fas fa-shipping-fast text-brand-teal"></i>
                Upcoming Deliveries ({{ $upcomingOrders->count() }})
            </h2>

            <div class="grid grid-cols-1 gap-6">

                @forelse ($upcomingOrders as $order)
                @php
                    $pkg = $order->package;
                    $deliveryStatus = $order->delivery_status;

                    // Badge colour & label based on delivery_status
                    $statusConfig = match($deliveryStatus) {
                        'processing'       => ['bg-blue-100 text-blue-700',   'Processing'],
                        'out_for_delivery' => ['bg-brand-orange/20 text-brand-orange', 'Out for Delivery'],
                        default            => ['bg-brand-teal/20 text-brand-teal', 'Pending'],
                    };

                    $orderBadgeCls = $statusConfig[0];
                    $orderBadgeLabel = $statusConfig[1];
                @endphp

                <div class="package-card status-upcoming bg-white p-6 rounded-2xl shadow-soft">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 border-b border-brand-grey pb-4">
                        <div class="mb-3 md:mb-0">
                            <span class="text-xs font-semibold text-brand-blue/70 block">Order ID: #{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</span>
                            <h3 class="text-xl font-bold text-brand-blue flex items-center gap-2">
                                {{ $pkg?->name ?? 'Unknown Package' }}
                            </h3>
                        </div>
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $orderBadgeCls }}">
                                {{ $orderBadgeLabel }}
                            </span>
                            @if ($order->delivery_frequency)
                                <span class="px-3 py-1 bg-brand-teal/20 text-brand-teal text-xs font-semibold rounded-full capitalize">
                                    {{ ucfirst($order->delivery_frequency) }} delivery
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 text-sm mb-4">
                        <div>
                            <p class="text-gray-500">Scheduled Date</p>
                            <p class="font-semibold text-brand-blue">
                                {{ $order->scheduled_date ? \Carbon\Carbon::parse($order->scheduled_date)->format('D, M d, Y') : '—' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-500">Delivery Window</p>
                            <p class="font-semibold text-brand-blue">
                                @if ($order->delivery_start_time && $order->delivery_end_time)
                                    {{ \Carbon\Carbon::parse($order->delivery_start_time)->format('g:i A') }}
                                    – {{ \Carbon\Carbon::parse($order->delivery_end_time)->format('g:i A') }}
                                @else
                                    TBC
                                @endif
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-500">Zone</p>
                            <p class="font-semibold text-brand-blue capitalize">{{ $order->delivery_zone ?? '—' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Amount</p>
                            <p class="font-semibold text-brand-blue">₦{{ number_format($order->amount, 2) }}</p>
                        </div>
                    </div>

                    @if ($pkg)
                        <div class="text-sm mb-4 bg-brand-grey rounded-xl px-4 py-3">
                            <p class="text-gray-500 mb-1">Package Description</p>
                            <p class="font-semibold text-brand-blue">{{ $pkg->short_description ?? $pkg->description ?? 'No description available.' }}</p>
                        </div>
                    @endif

                    <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-brand-grey">
                        <button class="flex-1 bg-brand-teal text-white py-3 rounded-xl font-semibold hover:bg-brand-teal/90 transition-colors shadow-sm-brand">
                            <i class="fas fa-pencil-alt mr-2"></i> Customize This Package
                        </button>
                        <button class="flex-1 bg-brand-blue/10 text-brand-blue py-3 rounded-xl font-semibold hover:bg-brand-blue/20 transition-colors">
                            <i class="fas fa-route mr-2"></i> Track Delivery Status
                        </button>
                    </div>
                </div>
                @empty
                <div class="bg-white rounded-2xl p-10 shadow-soft text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-brand-teal/10 rounded-full flex items-center justify-center">
                        <i class="fas fa-box-open text-brand-teal text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-brand-blue mb-1">No Upcoming Deliveries</h3>
                    <p class="text-gray-500 text-sm">You don't have any scheduled deliveries right now.</p>
                </div>
                @endforelse

            </div>
        </section>

        <!-- Delivered Packages Section -->
        <section class="mb-10">
            <h2 class="text-2xl font-semibold text-brand-blue mb-4 flex items-center gap-2">
                <i class="fas fa-check-circle text-brand-gold"></i>
                Past Delivered Packages ({{ $deliveredOrders->count() }})
            </h2>

            <div class="grid grid-cols-1 gap-6">

                @forelse ($deliveredOrders as $order)
                @php
                    $pkg = $order->package;
                @endphp

                <div class="package-card status-delivered bg-white p-6 rounded-2xl shadow-soft">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 border-b border-brand-grey pb-4">
                        <div class="mb-3 md:mb-0">
                            <span class="text-xs font-semibold text-brand-blue/70 block">Order ID: #{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</span>
                            <h3 class="text-xl font-bold text-brand-blue">{{ $pkg?->name ?? 'Unknown Package' }}</h3>
                        </div>
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="px-3 py-1 bg-green-500/10 text-green-700 text-xs font-semibold rounded-full">Delivered</span>
                            @if ($order->delivery_frequency)
                                <span class="px-3 py-1 bg-brand-teal/20 text-brand-teal text-xs font-semibold rounded-full capitalize">
                                    {{ ucfirst($order->delivery_frequency) }} delivery
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 text-sm mb-4">
                        <div>
                            <p class="text-gray-500">Delivered On</p>
                            <p class="font-semibold text-brand-blue">
                                {{ $order->updated_at ? $order->updated_at->format('D, M d, Y') : '—' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-500">Zone</p>
                            <p class="font-semibold text-brand-blue capitalize">{{ $order->delivery_zone ?? '—' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Amount Paid</p>
                            <p class="font-semibold text-brand-blue">₦{{ number_format($order->amount, 2) }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Payment Method</p>
                            <p class="font-semibold text-brand-blue capitalize">{{ $order->payment_method ?? '—' }}</p>
                        </div>
                    </div>

                    @if ($pkg)
                        <div class="text-sm mb-4 bg-brand-grey rounded-xl px-4 py-3">
                            <p class="text-gray-500 mb-1">Package</p>
                            <p class="font-semibold text-brand-blue">{{ $pkg->short_description ?? $pkg->description ?? 'No description available.' }}</p>
                        </div>
                    @endif

                    <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-brand-grey">
                        <button class="flex-1 bg-brand-blue/10 text-brand-blue py-3 rounded-xl font-semibold hover:bg-brand-blue/20 transition-colors">
                            <i class="fas fa-file-invoice mr-2"></i> View Full Manifest
                        </button>
                        <button class="flex-1 bg-brand-red/10 text-brand-red py-3 rounded-xl font-semibold hover:bg-brand-red/20 transition-colors">
                            <i class="fas fa-times-circle mr-2"></i> Report Missing Item
                        </button>
                    </div>
                </div>
                @empty
                <div class="bg-white rounded-2xl p-10 shadow-soft text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-brand-gold/10 rounded-full flex items-center justify-center">
                        <i class="fas fa-check-circle text-brand-gold text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-brand-blue mb-1">No Deliveries Yet</h3>
                    <p class="text-gray-500 text-sm">Your delivered packages will appear here once completed.</p>
                </div>
                @endforelse

            </div>
        </section>

        <!-- Pagination -->
        @if ($recentOrders->hasPages())
            <div class="flex justify-center mt-4 mb-8">
                {{ $recentOrders->links() }}
            </div>
        @endif

        <!-- Footer Spacer -->
        <div class="h-12"></div>
    </main>

    <!-- JavaScript for Mobile Sidebar Toggle (Identical to Dashboard) -->
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