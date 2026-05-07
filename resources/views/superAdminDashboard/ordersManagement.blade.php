<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Management | FoodBox NG</title>
    
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
                            teal: '#2A9D8F', // Primary Action
                            blue: '#264653', // Deep Text/Background
                            gold: '#E9C46A', // Highlights
                            orange: '#F4A261', // Alerts/Warning
                            red: '#E76F51',   // Error/Danger
                            grey: '#F4F6F8',  // Light Background
                        }
                    },
                    boxShadow: {
                        'soft': '0 8px 30px -10px rgba(0,0,0,0.06)',
                        'admin': '0 15px 45px -15px rgba(38, 70, 83, 0.3)',
                    }
                }
            }
        }
    </script>

    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #E0E7E8; }
        ::-webkit-scrollbar-thumb { background: #2A9D8F; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #264653; }

        /* Sidebar & Main Layout */
        #sidebar {
            transition: transform 0.3s ease-in-out;
            transform: translateX(-100%);
            z-index: 50;
        }
        #sidebar.open { transform: translateX(0); }
        @media (min-width: 1024px) {
            #sidebar { transform: translateX(0); } /* Always open on desktop */
        }
        
        .main-content { padding-top: 5rem; }

        /* Active Sidebar Link */
        .nav-link.active {
            background-color: #3B5F6C;
            color: #E9C46A;
            border-left: 4px solid #2A9D8F;
            padding-left: 1.75rem;
        }
        .nav-link:not(.active) {
            border-left: 4px solid transparent;
        }

        /* Responsive Table Styles (Copied from Dashboard) */
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
        <button id="menu-toggle" onclick="toggleSidebar()" class="p-3 rounded-xl bg-white shadow-md text-brand-blue hover:bg-brand-grey transition-colors">
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
    <main class="mt-20 lg:ml-64 p-4 md:p-8 main-content max-w-full">
        
        <!-- Order Summary Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
            
            <!-- Card 1: Total Orders (Overall) -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-blue">
                <div class="flex items-center justify-between">
                    <i class="fas fa-shopping-basket text-2xl text-brand-blue p-3 bg-brand-blue/10 rounded-xl"></i>
                    <span class="text-sm font-semibold text-gray-500 hidden md:block">Total</span>
                </div>
                <p class="text-sm text-gray-500 mt-2">All Orders</p>
                <p class="text-2xl font-extrabold text-brand-blue">{{ number_format($totalOrders) }}</p>
            </div>

            <!-- Card 2: Processing (Teal) -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-teal">
                <div class="flex items-center justify-between">
                    <i class="fas fa-box-open text-2xl text-brand-teal p-3 bg-brand-teal/10 rounded-xl"></i>
                    <span class="text-sm font-semibold text-green-500 hidden md:block">+{{ $processingToday ?: 0 }} Today</span>
                </div>
                <p class="text-sm text-gray-500 mt-2">Processing</p>
                <p class="text-2xl font-extrabold text-brand-blue">{{ number_format($processingOrders) }}</p>
            </div>

            <!-- Card 3: Pending Payment (Gold) -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-gold">
                <div class="flex items-center justify-between">
                    <i class="fas fa-credit-card text-2xl text-brand-gold p-3 bg-brand-gold/10 rounded-xl"></i>
                    <span class="text-sm font-semibold text-brand-gold hidden md:block">High Risk</span>
                </div>
                <p class="text-sm text-gray-500 mt-2">Pending Payment</p>
                <p class="text-2xl font-extrabold text-brand-blue">{{ number_format($pendingOrders) }}</p>
            </div>

            <!-- Card 4: Cancelled (Red) -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-red">
                <div class="flex items-center justify-between">
                    <i class="fas fa-times-circle text-2xl text-brand-red p-3 bg-brand-red/10 rounded-xl"></i>
                    <span class="text-sm font-semibold hidden md:block {{ $cancelledChange >= 0 ? 'text-red-500' : 'text-green-500' }}">
                        {{ $cancelledChange >= 0 ? '+' : '' }}{{ number_format($cancelledChange, 1) }}% MTD
                    </span>
                </div>
                <p class="text-sm text-gray-500 mt-2">Cancelled</p>
                <p class="text-2xl font-extrabold text-brand-blue">{{ number_format($cancelledOrders) }}</p>
            </div>
        </div>

        <!-- Advanced Filtering & Actions -->
        <form method="GET" action="{{ url()->current() }}" class="bg-white p-6 rounded-2xl shadow-soft mb-8">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-brand-blue">Filter &amp; Search</h3>
                @if(request()->hasAny(['search', 'status', 'date']))
                    <a href="{{ url()->current() }}"
                       class="text-sm text-brand-red hover:text-brand-red/80 font-medium flex items-center gap-1 transition-colors">
                        <i class="fas fa-times-circle"></i> Clear Filters
                    </a>
                @endif
            </div>
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">

                <!-- Search -->
                <div class="md:col-span-2 relative">
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input
                        type="search"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search by Order ID or Customer Name..."
                        class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:border-brand-teal focus:ring-1 focus:ring-brand-teal/20 outline-none transition-all text-sm bg-brand-grey/50"
                    >
                </div>

                <!-- Status Filter -->
                <div>
                    <select name="status" class="w-full py-3 px-4 border border-gray-200 rounded-xl text-sm bg-brand-grey/50 focus:border-brand-teal outline-none">
                        <option value="">All Statuses</option>
                        <option value="delivered"        {{ request('status') === 'delivered'        ? 'selected' : '' }}>Delivered</option>
                        <option value="processing"       {{ request('status') === 'processing'       ? 'selected' : '' }}>Processing</option>
                        <option value="out_for_delivery" {{ request('status') === 'out_for_delivery' ? 'selected' : '' }}>Out for Delivery</option>
                        <option value="pending"          {{ request('status') === 'pending'          ? 'selected' : '' }}>Pending Payment</option>
                        <option value="cancelled"        {{ request('status') === 'cancelled'        ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <!-- Date Filter -->
                <div>
                    <input
                        type="date"
                        name="date"
                        value="{{ request('date') }}"
                        class="w-full py-3 px-4 border border-gray-200 rounded-xl text-sm bg-brand-grey/50 focus:border-brand-teal outline-none"
                    >
                </div>

                <!-- Apply Button -->
                <button type="submit" class="w-full py-3 bg-brand-blue text-white font-semibold rounded-xl hover:bg-brand-blue/90 transition-colors flex items-center justify-center gap-2">
                    <i class="fas fa-filter"></i>
                    <span class="hidden sm:inline">Apply Filters</span>
                </button>
            </div>
        </form>

        <!-- Real-Time Orders Table -->
        <div class="bg-white p-6 rounded-2xl shadow-soft overflow-x-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-brand-blue">Order History (Last 30 Days)</h3>
                <button class="text-brand-teal hover:text-brand-blue text-sm font-semibold">
                    <i class="fas fa-download mr-1"></i> Export CSV
                </button>
            </div>
            
            <table class="min-w-full divide-y divide-gray-200 responsive-table">
                <thead class="bg-brand-grey/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Package</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount (₦)</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Placed</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($orders as $order)
                        @php
                            $badge = match($order->delivery_status) {
                                'delivered' => ['bg-green-100 text-green-800', 'Delivered'],
                                'processing' => ['bg-brand-teal/10 text-brand-teal', 'Processing'],
                                'out_for_delivery' => ['bg-blue-100 text-blue-800', 'Out for Delivery'],
                                'pending' => ['bg-brand-gold/10 text-brand-orange', 'Pending Delivery'],
                                default => match($order->status) {
                                    'cancelled' => ['bg-red-100 text-brand-red', 'Cancelled'],
                                    'completed' => ['bg-green-100 text-green-800', 'Completed'],
                                    'failed' => ['bg-red-100 text-red-800', 'Failed'],
                                    'pending' => ['bg-brand-gold/10 text-brand-orange', 'Pending Payment'],
                                    default => ['bg-gray-100 text-gray-700', ucfirst($order->status)],
                                },
                            };
                        @endphp
                        <tr class="hover:bg-brand-grey transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Order ID">
                                #FB-ORD-{{ $order->transaction_id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Customer">
                                {{ $order->user->name ?? 'Unknown' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Package">
                                {{ $order->package->name ?? '—' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Amount (₦)">
                                {{ number_format($order->amount, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap" data-label="Status">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $badge[0] }}">
                                    {{ $badge[1] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Date Placed">
                                {{ $order->created_at->format('Y-m-d') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Action">
                                <button class="text-brand-blue hover:text-brand-teal transition-colors text-sm font-semibold">View Details</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-sm text-gray-400 italic">
                                <i class="fas fa-inbox text-3xl mb-3 block text-gray-300"></i>
                                No orders found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-6 flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-sm text-gray-600">
                    Showing {{ $orders->firstItem() ?? 0 }} to {{ $orders->lastItem() ?? 0 }} of {{ number_format($orders->total()) }} results
                </p>
                <div>
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
        
        <!-- Footer Spacer -->
        <div class="h-12"></div>
    </main>

    <!-- JavaScript for Mobile Sidebar Toggle -->
    <script>
        const sidebar = document.getElementById('sidebar');
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

        // Close sidebar on navigation item click (Mobile only)
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024) { 
                    setTimeout(() => toggleSidebar(), 150);
                }
            });
        });
    </script>
</body>
</html>