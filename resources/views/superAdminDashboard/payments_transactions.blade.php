<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments & Transactions | FoodBox NG</title>
    
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

        /* Active Sidebar Link - Custom addition for Payments & Transactions */
        .nav-link.payments-active {
            background-color: #3B5F6C;
            color: #E9C46A;
            border-left: 4px solid #2A9D8F;
            padding-left: 1.75rem;
        }
        .nav-link:not(.payments-active, .active) {
            border-left: 4px solid transparent;
        }

        /* Responsive Table Styles */
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
        
        <!-- Financial Metrics Cards (Monthly Overview) -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
            
            <!-- Card 1: Gross Revenue (Teal/Green) -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-teal">
                <div class="flex items-center justify-between">
                    <i class="fas fa-money-check-alt text-2xl text-brand-teal p-3 bg-brand-teal/10 rounded-xl"></i>
                    @if(!is_null($revenueMoM))
                        <span class="text-sm font-semibold hidden md:block {{ $revenueMoM >= 0 ? 'text-green-500' : 'text-red-500' }}">
                            {{ $revenueMoM >= 0 ? '+' : '' }}{{ $revenueMoM }}% M/M
                        </span>
                    @else
                        <span class="text-sm font-semibold text-gray-400 hidden md:block">No prior data</span>
                    @endif
                </div>
                <p class="text-sm text-gray-500 mt-2">Gross Revenue (Mo)</p>
                <p class="text-2xl font-extrabold text-brand-blue">
                    @if($grossRevenue >= 1_000_000)
                        ₦ {{ number_format($grossRevenue / 1_000_000, 1) }}M
                    @elseif($grossRevenue >= 1_000)
                        ₦ {{ number_format($grossRevenue / 1_000, 1) }}k
                    @else
                        ₦ {{ number_format($grossRevenue, 2) }}
                    @endif
                </p>
            </div>

            <!-- Card 2: Refunds Issued (Red) -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-red">
                <div class="flex items-center justify-between">
                    <i class="fas fa-undo text-2xl text-brand-red p-3 bg-brand-red/10 rounded-xl"></i>
                    <span class="text-sm font-semibold text-red-500 hidden md:block">{{ $totalRefunds > 0 ? 'Needs Review' : 'All Clear' }}</span>
                </div>
                <p class="text-sm text-gray-500 mt-2">Total Refunds (Mo)</p>
                <p class="text-2xl font-extrabold text-brand-blue">
                    @if($totalRefunds >= 1_000_000)
                        ₦ {{ number_format($totalRefunds / 1_000_000, 1) }}M
                    @elseif($totalRefunds >= 1_000)
                        ₦ {{ number_format($totalRefunds / 1_000, 1) }}k
                    @else
                        ₦ {{ number_format($totalRefunds, 2) }}
                    @endif
                </p>
            </div>

            <!-- Card 3: Failed Transactions (Orange) -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-orange">
                <div class="flex items-center justify-between">
                    <i class="fas fa-exclamation-circle text-2xl text-brand-orange p-3 bg-brand-orange/10 rounded-xl"></i>
                    <span class="text-sm font-semibold text-brand-orange hidden md:block">{{ $failureRate }}% Rate</span>
                </div>
                <p class="text-sm text-gray-500 mt-2">Failed Transactions</p>
                <p class="text-2xl font-extrabold text-brand-blue">{{ number_format($failedCount) }}</p>
            </div>

            <!-- Card 4: Average Transaction Value (Blue) -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-blue">
                <div class="flex items-center justify-between">
                    <i class="fas fa-tag text-2xl text-brand-blue p-3 bg-brand-blue/10 rounded-xl"></i>
                    <span class="text-sm font-semibold text-brand-blue hidden md:block">This Month</span>
                </div>
                <p class="text-sm text-gray-500 mt-2">Avg. Transaction Value</p>
                <p class="text-2xl font-extrabold text-brand-blue">₦ {{ number_format($avgTransactionValue, 0) }}</p>
            </div>
        </div>

        <!-- Filter & Search Bar -->
        <form method="GET" action="{{ route('admin.paymentManagement') }}" id="filter-form">
            <div class="bg-white p-6 rounded-2xl shadow-soft mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-brand-blue">Transaction Filters</h3>
                    @if($search || $status || $type)
                        <a href="{{ route('admin.paymentManagement') }}" class="text-sm text-brand-red hover:underline flex items-center gap-1">
                            <i class="fas fa-times-circle"></i> Clear Filters
                        </a>
                    @endif
                </div>
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    
                    <!-- Search -->
                    <div class="md:col-span-2 relative">
                        <i class="fas fa-receipt absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="search" name="search" value="{{ $search }}"
                            placeholder="Search by Transaction ID, Customer, or Amount..."
                            class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:border-brand-teal focus:ring-1 focus:ring-brand-teal/20 outline-none transition-all text-sm bg-brand-grey/50">
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <select name="status" onchange="this.form.submit()" class="w-full py-3 px-4 border border-gray-200 rounded-xl text-sm bg-brand-grey/50 focus:border-brand-teal outline-none">
                            <option value="">All Statuses</option>
                            <option value="success" {{ $status === 'success' ? 'selected' : '' }}>Success</option>
                            <option value="failed" {{ $status === 'failed' ? 'selected' : '' }}>Failed</option>
                            <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="refunded" {{ $status === 'refunded' ? 'selected' : '' }}>Refunded</option>
                        </select>
                    </div>

                    <!-- Transaction Type -->
                    <div>
                        <select name="type" onchange="this.form.submit()" class="w-full py-3 px-4 border border-gray-200 rounded-xl text-sm bg-brand-grey/50 focus:border-brand-teal outline-none">
                            <option value="">All Types</option>
                            <option value="subscription" {{ $type === 'subscription' ? 'selected' : '' }}>Subscription Renewal</option>
                            <option value="order" {{ $type === 'order' ? 'selected' : '' }}>One-time Order</option>
                            <option value="wallet" {{ $type === 'wallet' ? 'selected' : '' }}>Wallet Top-up</option>
                        </select>
                    </div>

                    <!-- Search / Apply Button -->
                    <button type="submit" class="w-full py-3 bg-brand-blue text-white font-semibold rounded-xl hover:bg-brand-blue/90 transition-colors flex items-center justify-center gap-2">
                        <i class="fas fa-search"></i>
                        <span class="hidden sm:inline">Search</span>
                    </button>
                </div>
            </div>
        </form>

        <!-- Transactions Table -->
        <div class="bg-white p-6 rounded-2xl shadow-soft overflow-x-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-brand-blue">Detailed Transaction Log</h3>
                <button class="text-brand-teal hover:text-brand-blue text-sm font-semibold">
                    <i class="fas fa-download mr-1"></i> Export Full Log
                </button>
            </div>
            
            <table class="min-w-full divide-y divide-gray-200 responsive-table">
                <thead class="bg-brand-grey/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Txn ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($payments as $payment)
                        @php
                            // Determine transaction type
                            if ($payment->subscription_id) {
                                $type = 'Subscription Renewal';
                            } elseif ($payment->order_id) {
                                $type = 'One-time Order';
                            } else {
                                $type = ucfirst($payment->payment_method ?? 'Wallet Top-up');
                            }

                            // Status badge styles
                            $badge = match($payment->status) {
                                'success'  => 'bg-green-100 text-green-800',
                                'failed'   => 'bg-brand-red/10 text-brand-red',
                                'refunded' => 'bg-gray-200 text-gray-700',
                                'pending'  => 'bg-brand-gold/20 text-brand-orange',
                                default    => 'bg-gray-100 text-gray-600',
                            };

                            // Amount colour
                            $amountClass = match($payment->status) {
                                'success'  => 'text-green-700',
                                'failed'   => 'text-brand-red',
                                'refunded' => 'text-gray-700',
                                default    => 'text-brand-orange',
                            };

                            // Action label
                            $action = match($payment->status) {
                                'failed'   => 'Retry',
                                'refunded' => 'Audit',
                                default    => 'Details',
                            };
                        @endphp
                        <tr class="hover:bg-brand-grey transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Txn ID">
                                {{ $payment->transaction_reference ?? 'TXN' . str_pad($payment->id, 4, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Customer">
                                {{ $payment->user->name ?? '—' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Type">{{ $type }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold {{ $amountClass }}" data-label="Amount">
                                ₦ {{ number_format($payment->amount, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Date">
                                {{ ($payment->paid_at ?? $payment->created_at)->format('Y-m-d H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap" data-label="Status">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $badge }}">
                                    {{ ucfirst($payment->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Actions">
                                <button class="text-brand-blue hover:text-brand-teal transition-colors text-sm font-semibold">{{ $action }}</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-gray-400">
                                <i class="fas fa-receipt text-3xl mb-2 block"></i>
                                No transactions found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-6 flex justify-between items-center">
                <p class="text-sm text-gray-600">
                    @if($payments->total() > 0)
                        Showing {{ $payments->firstItem() }} to {{ $payments->lastItem() }} of {{ number_format($payments->total()) }} results
                    @else
                        No results
                    @endif
                </p>
                <div class="flex space-x-2">
                    {{ $payments->links() }}
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

        // Simple placeholder function for 'Manual Adjustment' button
        function promptForManualTransaction() {
            console.log("Manual Adjustment flow initiated. (In a real application, this would open a modal/form)");
        }

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