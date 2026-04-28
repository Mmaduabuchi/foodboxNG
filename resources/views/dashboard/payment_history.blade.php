<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment History | FoodBox NG</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Tailwind Config (Reused) -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            teal: '#2A9D8F',
                            blue: '#264653',
                            gold: '#E9C46A',
                            orange: '#F4A261',
                            red: '#E76F51',
                            grey: '#F4F6F8',
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
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #E0E7E8; }
        ::-webkit-scrollbar-thumb { background: #2A9D8F; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #264653; }

        /* Sidebar transition */
        #sidebar {
            transition: transform 0.3s ease-in-out;
            z-index: 50;
        }
        @media (max-width: 1023px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.open { transform: translateX(0); }
        }
        @media (min-width: 1024px) {
            #sidebar { transform: translateX(0); }
        }

        #backdrop { transition: opacity 0.3s ease-in-out; }

        .main-content { padding-top: 5rem; }

        /* Active nav link */
        .nav-link.active {
            background-color: #2A9D8F;
            color: white;
            box-shadow: 0 5px 15px -5px rgba(42, 157, 143, 0.4);
        }
        .nav-link.active i { color: #E9C46A; }

        /* Status badges */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.3rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.03em;
        }
        .badge-success  { background: rgba(42,157,143,0.15); color: #2A9D8F; }
        .badge-pending  { background: rgba(233,196,106,0.2);  color: #b07d10; }
        .badge-failed   { background: rgba(231,111,81,0.15);  color: #E76F51; }
        .badge-refunded { background: rgba(38,70,83,0.1);     color: #264653; }

        /* Stat cards hover */
        .stat-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px -8px rgba(42, 157, 143, 0.18);
        }

        /* Table row hover */
        .pay-row { transition: background-color 0.15s; }
        .pay-row:hover { background-color: #f0f7f6; }

        /* Mobile card layout */
        @media (max-width: 767px) {
            .pay-row-mobile {
                border-bottom: 1px solid #e5e7eb;
                padding: 1rem 0;
            }
            .pay-row-mobile > * {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.25rem 0;
            }
            .pay-row-mobile > *:before {
                content: attr(data-label);
                font-weight: 600;
                color: #4b5563;
                flex-basis: 40%;
                font-size: 0.8rem;
            }
        }

        /* Search input */
        .search-input {
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .search-input:focus {
            border-color: #2A9D8F;
            box-shadow: 0 0 0 3px rgba(42,157,143,0.15);
            outline: none;
        }

        /* Filter tab animate */
        .filter-tab {
            transition: background-color 0.2s, color 0.2s, box-shadow 0.2s;
        }
    </style>
</head>
<body class="bg-brand-grey text-brand-blue antialiased min-h-screen">

    @include('dashboard.header')

    <!-- Main Content Area -->
    <main class="p-4 mt-20 md:p-8 lg:ml-64 main-content">

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-xl flex items-center gap-2">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="mb-4 p-4 mt-4 bg-red-100 text-red-700 rounded-lg">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- ── Page Header ── -->
        <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-brand-blue mb-1">Payment History</h1>
                <p class="text-gray-500 text-sm">A full log of all transactions made on your account.</p>
            </div>
            <!-- Export hint pill -->
            <span class="inline-flex items-center gap-2 bg-white border border-gray-200 text-gray-500 text-xs font-medium px-4 py-2 rounded-full shadow-sm">
                <i class="fas fa-clock-rotate-left text-brand-teal"></i>
                Last updated: {{ now()->format('d M Y, H:i') }}
            </span>
        </div>

        <!-- ── Summary Stat Cards ── -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

            <!-- Total -->
            <div class="stat-card bg-white rounded-2xl p-5 shadow-soft flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-brand-blue/10 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-receipt text-brand-blue text-lg"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Total</p>
                    <p class="text-2xl font-bold text-brand-blue">{{ $totalPayments }}</p>
                </div>
            </div>

            <!-- Successful -->
            <div class="stat-card bg-white rounded-2xl p-5 shadow-soft flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-brand-teal/10 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-circle-check text-brand-teal text-lg"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Successful</p>
                    <p class="text-2xl font-bold text-brand-teal">{{ $successPayments }}</p>
                </div>
            </div>

            <!-- Pending -->
            <div class="stat-card bg-white rounded-2xl p-5 shadow-soft flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-brand-gold/20 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-hourglass-half text-amber-600 text-lg"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Pending</p>
                    <p class="text-2xl font-bold text-amber-600">{{ $pendingPayments }}</p>
                </div>
            </div>

            <!-- Failed -->
            <div class="stat-card bg-white rounded-2xl p-5 shadow-soft flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-brand-red/10 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-circle-xmark text-brand-red text-lg"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Failed</p>
                    <p class="text-2xl font-bold text-brand-red">{{ $failedPayments }}</p>
                </div>
            </div>

        </div>

        <!-- ── Payment Table Card ── -->
        <section class="bg-white rounded-2xl shadow-soft overflow-hidden">

            <!-- Card Header: Filters + Search -->
            <div class="px-6 pt-6 pb-4 border-b border-gray-100">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">

                    <!-- Status Filter Tabs -->
                    <div class="flex flex-wrap gap-2 p-1 bg-brand-grey rounded-xl">
                        @php
                            $tab = function($label, $value, $count) use ($statusFilter, $search) {
                                $isActive = (!$value && !$statusFilter) || $statusFilter === $value;
                                $params   = $value ? ['status' => $value] : [];
                                if ($search) $params['search'] = $search;
                                $url = route('payment_history', $params);
                                $cls = $isActive
                                    ? 'bg-brand-teal text-white shadow-md'
                                    : 'text-brand-blue hover:bg-brand-teal/15';
                                echo "<a href=\"{$url}\" class=\"filter-tab px-4 py-1.5 text-xs font-semibold rounded-lg {$cls}\">{$label} ({$count})</a>";
                            };
                        @endphp
                        {!! (function() use ($tab, $totalPayments, $successPayments, $pendingPayments, $failedPayments) {
                            ob_start();
                            $tab('All', null, $totalPayments);
                            $tab('Success', 'success', $successPayments);
                            $tab('Pending', 'pending', $pendingPayments);
                            $tab('Failed', 'failed', $failedPayments);
                            return ob_get_clean();
                        })() !!}
                    </div>

                    <!-- Search Form -->
                    <form method="GET" action="{{ route('payment_history') }}" class="relative w-full md:w-72">
                        @if($statusFilter)
                            <input type="hidden" name="status" value="{{ $statusFilter }}">
                        @endif
                        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm pointer-events-none"></i>
                        <input
                            id="payment-search"
                            type="search"
                            name="search"
                            value="{{ $search ?? '' }}"
                            placeholder="Search by reference, method..."
                            class="search-input w-full pl-11 pr-4 py-2.5 border border-gray-200 rounded-full text-sm bg-brand-grey/50"
                        >
                    </form>

                </div>
            </div>

            <!-- ── Desktop Table ── -->
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead class="bg-brand-grey/60">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">#</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Reference</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Method</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Gateway</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 bg-white">

                        @forelse($payments as $payment)
                        @php
                            $isSuccess  = $payment->status === 'success';
                            $isPending  = $payment->status === 'pending';
                            $isFailed   = $payment->status === 'failed';
                            $isRefunded = $payment->status === 'refunded';

                            // Determine what the payment was for
                            if ($payment->order_id && $payment->order) {
                                $type = 'Order #' . $payment->order_id;
                            } elseif ($payment->subscription_id && $payment->subscription) {
                                $type = 'Subscription #' . $payment->subscription_id;
                            } else {
                                $type = '—';
                            }
                        @endphp
                        <tr class="pay-row">
                            <td class="px-6 py-4 text-xs text-gray-400 font-mono">
                                {{ $payments->firstItem() + $loop->index }}
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm font-semibold text-brand-blue font-mono">
                                    {{ $payment->transaction_reference ?? '—' }}
                                </p>
                                @if($payment->gateway_reference)
                                    <p class="text-xs text-gray-400 mt-0.5">GW: {{ $payment->gateway_reference }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $type }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 bg-gray-100 text-gray-600 text-xs font-medium px-3 py-1 rounded-full capitalize">
                                    <i class="fas fa-credit-card text-gray-400 text-[10px]"></i>
                                    {{ $payment->payment_method ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 capitalize">
                                {{ $payment->gateway ?? '—' }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-bold {{ $isFailed ? 'text-brand-red' : ($isSuccess ? 'text-brand-teal' : 'text-gray-600') }}">
                                    ₦{{ number_format($payment->amount, 2) }}
                                </span>
                                <span class="text-xs text-gray-400 ml-1 uppercase">{{ $payment->currency ?? 'NGN' }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{ $payment->paid_at ? $payment->paid_at->format('d M Y') : $payment->created_at->format('d M Y') }}
                                <p class="text-xs text-gray-400">
                                    {{ $payment->paid_at ? $payment->paid_at->format('H:i') : $payment->created_at->format('H:i') }}
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                @if($isSuccess)
                                    <span class="badge badge-success"><i class="fas fa-circle-check text-[9px]"></i> Success</span>
                                @elseif($isPending)
                                    <span class="badge badge-pending"><i class="fas fa-hourglass-half text-[9px]"></i> Pending</span>
                                @elseif($isFailed)
                                    <span class="badge badge-failed"><i class="fas fa-circle-xmark text-[9px]"></i> Failed</span>
                                @elseif($isRefunded)
                                    <span class="badge badge-refunded"><i class="fas fa-rotate-left text-[9px]"></i> Refunded</span>
                                @else
                                    <span class="badge bg-gray-100 text-gray-500">{{ ucfirst($payment->status) }}</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3 text-gray-400">
                                    <div class="w-16 h-16 rounded-full bg-brand-grey flex items-center justify-center">
                                        <i class="fas fa-file-invoice text-3xl text-gray-300"></i>
                                    </div>
                                    <p class="font-semibold text-gray-500">No payments found</p>
                                    <p class="text-sm">
                                        @if($search)
                                            No records match your search "<strong>{{ $search }}</strong>".
                                        @else
                                            Your payment transactions will appear here once you make a purchase.
                                        @endif
                                    </p>
                                    @if($search)
                                        <a href="{{ route('payment_history') }}" class="mt-2 px-5 py-2 bg-brand-teal text-white text-sm font-semibold rounded-full hover:opacity-90 transition-opacity">
                                            Clear Search
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            <!-- ── Mobile Card List ── -->
            <div class="md:hidden divide-y divide-gray-100 px-4">
                @forelse($payments as $payment)
                @php
                    $isSuccess  = $payment->status === 'success';
                    $isPending  = $payment->status === 'pending';
                    $isFailed   = $payment->status === 'failed';
                    $isRefunded = $payment->status === 'refunded';
                    if ($payment->order_id && $payment->order) {
                        $type = 'Order #' . $payment->order_id;
                    } elseif ($payment->subscription_id && $payment->subscription) {
                        $type = 'Subscription #' . $payment->subscription_id;
                    } else {
                        $type = '—';
                    }
                @endphp
                <div class="pay-row-mobile">
                    <p data-label="Reference" class="text-xs font-mono text-brand-blue font-semibold">{{ $payment->transaction_reference ?? '—' }}</p>
                    <p data-label="Type" class="text-sm text-gray-600">{{ $type }}</p>
                    <p data-label="Method" class="text-sm text-gray-600 capitalize">{{ $payment->payment_method ?? 'N/A' }}</p>
                    <p data-label="Amount">
                        <span class="text-sm font-bold {{ $isFailed ? 'text-brand-red' : ($isSuccess ? 'text-brand-teal' : 'text-gray-600') }}">
                            ₦{{ number_format($payment->amount, 2) }}
                        </span>
                    </p>
                    <p data-label="Date" class="text-sm text-gray-500">
                        {{ $payment->paid_at ? $payment->paid_at->format('d M Y, H:i') : $payment->created_at->format('d M Y, H:i') }}
                    </p>
                    <p data-label="Status">
                        @if($isSuccess)
                            <span class="badge badge-success"><i class="fas fa-circle-check text-[9px]"></i> Success</span>
                        @elseif($isPending)
                            <span class="badge badge-pending"><i class="fas fa-hourglass-half text-[9px]"></i> Pending</span>
                        @elseif($isFailed)
                            <span class="badge badge-failed"><i class="fas fa-circle-xmark text-[9px]"></i> Failed</span>
                        @elseif($isRefunded)
                            <span class="badge badge-refunded"><i class="fas fa-rotate-left text-[9px]"></i> Refunded</span>
                        @else
                            <span class="badge bg-gray-100 text-gray-500">{{ ucfirst($payment->status) }}</span>
                        @endif
                    </p>
                </div>
                @empty
                <div class="py-14 text-center text-gray-400">
                    <i class="fas fa-file-invoice text-4xl mb-3 block"></i>
                    <p class="font-semibold">No payments found.</p>
                    @if($search)
                        <a href="{{ route('payment_history') }}" class="mt-3 inline-block px-5 py-2 bg-brand-teal text-white text-sm font-semibold rounded-full">Clear Search</a>
                    @endif
                </div>
                @endforelse
            </div>

            <!-- ── Pagination ── -->
            @if($payments->hasPages())
            <div class="px-6 py-5 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-3">

                <!-- Info text -->
                <p class="text-sm text-gray-500">
                    Showing <span class="font-semibold text-brand-blue">{{ $payments->firstItem() }}</span>–<span class="font-semibold text-brand-blue">{{ $payments->lastItem() }}</span>
                    of <span class="font-semibold text-brand-blue">{{ $payments->total() }}</span> payments
                </p>

                <!-- Page links -->
                <nav class="flex items-center gap-1">

                    {{-- Previous --}}
                    @if($payments->onFirstPage())
                        <span class="w-9 h-9 flex items-center justify-center rounded-full text-gray-300 cursor-not-allowed">
                            <i class="fas fa-chevron-left text-sm"></i>
                        </span>
                    @else
                        <a href="{{ $payments->previousPageUrl() }}"
                           class="w-9 h-9 flex items-center justify-center rounded-full text-gray-500 hover:bg-brand-grey transition-colors">
                            <i class="fas fa-chevron-left text-sm"></i>
                        </a>
                    @endif

                    {{-- Page Numbers --}}
                    @foreach($payments->getUrlRange(1, $payments->lastPage()) as $page => $url)
                        @if($page == $payments->currentPage())
                            <span class="w-9 h-9 flex items-center justify-center rounded-full bg-brand-teal text-white font-bold text-sm shadow-sm">
                                {{ $page }}
                            </span>
                        @elseif(abs($page - $payments->currentPage()) <= 2)
                            <a href="{{ $url }}"
                               class="w-9 h-9 flex items-center justify-center rounded-full text-brand-blue hover:bg-brand-grey font-medium text-sm transition-colors">
                                {{ $page }}
                            </a>
                        @elseif($page == 1 || $page == $payments->lastPage())
                            <a href="{{ $url }}"
                               class="w-9 h-9 flex items-center justify-center rounded-full text-brand-blue hover:bg-brand-grey font-medium text-sm transition-colors">
                                {{ $page }}
                            </a>
                        @elseif(abs($page - $payments->currentPage()) == 3)
                            <span class="w-9 h-9 flex items-center justify-center text-gray-400 text-sm">…</span>
                        @endif
                    @endforeach

                    {{-- Next --}}
                    @if($payments->hasMorePages())
                        <a href="{{ $payments->nextPageUrl() }}"
                           class="w-9 h-9 flex items-center justify-center rounded-full text-gray-500 hover:bg-brand-grey transition-colors">
                            <i class="fas fa-chevron-right text-sm"></i>
                        </a>
                    @else
                        <span class="w-9 h-9 flex items-center justify-center rounded-full text-gray-300 cursor-not-allowed">
                            <i class="fas fa-chevron-right text-sm"></i>
                        </span>
                    @endif

                </nav>
            </div>
            @else
            <!-- No pagination needed — show simple count -->
            @if($payments->count() > 0)
            <div class="px-6 py-4 border-t border-gray-100">
                <p class="text-sm text-gray-400">Showing all {{ $payments->count() }} payment{{ $payments->count() !== 1 ? 's' : '' }}.</p>
            </div>
            @endif
            @endif

        </section>

        <!-- Footer Spacer -->
        <div class="h-12"></div>
    </main>

    <!-- JavaScript for Mobile Sidebar Toggle -->
    <script>
        const sidebar    = document.getElementById('sidebar');
        const menuToggle = document.getElementById('menu-toggle');
        const backdrop   = document.getElementById('backdrop');

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

        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024) {
                    setTimeout(() => toggleSidebar(), 150);
                }
            });
        });

        // Auto-submit search form on input (debounced)
        const searchInput = document.getElementById('payment-search');
        if (searchInput) {
            let debounceTimer;
            searchInput.addEventListener('input', () => {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    searchInput.closest('form').submit();
                }, 450);
            });
        }
    </script>
</body>
</html>