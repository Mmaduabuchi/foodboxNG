<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Support Management | FoodBox NG Admin</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                        'modal': '0 20px 40px -10px rgba(38, 70, 83, 0.25)'
                    }
                }
            }
        }
    </script>

    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
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
        
        .main-content { padding-top: 1rem; }

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

        .modal-backdrop {
            background-color: rgba(38, 70, 83, 0.6);
            backdrop-filter: blur(4px);
        }

        .pulse-urgent {
            animation: pulse-red 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse-red {
            0%, 100% { opacity: 1; }
            50% { opacity: .4; }
        }
    </style>
</head>
<body class="bg-brand-grey text-brand-blue font-sans min-h-screen antialiased selection:bg-brand-teal selection:text-white">

    <!-- Mobile Menu Button -->
    <div class="fixed top-4 left-4 z-50 lg:hidden">
        <button id="menu-toggle" onclick="toggleSidebar()" class="p-3 rounded-xl bg-white shadow-md text-brand-blue hover:bg-brand-grey transition-colors flex items-center justify-center">
            <i class="fas fa-bars text-xl"></i>
        </button>
    </div>

    <!-- Backdrop for Mobile Sidebar -->
    <div id="backdrop" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden opacity-0 transition-opacity duration-300" onclick="toggleSidebar()"></div>

    <!-- 1. Sidebar Navigation (Deep Blue Background) -->
    @include('superAdminDashboard.aside')

    <!-- 2. Top Header -->
    @include('superAdminDashboard.header')

    <!-- Main Content Area -->
    <main class="mt-20 lg:ml-64 p-4 sm:p-6 md:p-8 main-content max-w-full min-h-screen space-y-6 md:space-y-8">
        
        <!-- Toast Feedback Notifications -->
        @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            });
        </script>
        @endif

        @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: "{{ session('error') }}",
                    showConfirmButton: false,
                    timer: 3500,
                    timerProgressBar: true
                });
            });
        </script>
        @endif

        <!-- Page Header & Action Buttons -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 text-xs font-semibold text-gray-400 mb-1">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-brand-teal transition-colors">Admin Dashboard</a>
                    <i class="fas fa-chevron-right text-[10px]"></i>
                    <span class="text-brand-teal">Support & Tickets</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-brand-blue tracking-tight flex items-center gap-2.5 flex-wrap">
                    <span>Support & Tickets Management</span>
                    <span class="text-xs px-2.5 py-1 rounded-full font-bold bg-teal-50 text-brand-teal border border-brand-teal/20">
                        Live Desk
                    </span>
                </h1>
                <p class="text-xs sm:text-sm text-gray-500 mt-1">
                    Review inquiries, resolve delivery challenges, handle customer disputes, and reply to subscribers.
                </p>
            </div>

            <!-- Export & Refresh Quick Actions -->
            <div class="flex items-center gap-2 sm:gap-3 flex-wrap">
                <a href="{{ route('admin.support.export', request()->query()) }}" class="px-3.5 sm:px-4 py-2.5 bg-white border border-gray-200 text-brand-blue font-semibold rounded-xl text-xs sm:text-sm hover:bg-gray-50 transition-all shadow-soft flex items-center gap-2">
                    <i class="fas fa-file-csv text-brand-teal"></i>
                    <span>Export CSV</span>
                </a>
                <a href="{{ route('admin.support') }}" class="px-3.5 sm:px-4 py-2.5 bg-brand-teal text-white font-semibold rounded-xl text-xs sm:text-sm hover:bg-brand-blue transition-all shadow-md shadow-brand-teal/20 flex items-center gap-2">
                    <i class="fas fa-rotate"></i>
                    <span>Refresh</span>
                </a>
            </div>
        </div>

        <!-- 2. Metrics KPI Summary Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-6">
            
            <!-- Total Tickets -->
            <div class="p-4 sm:p-5 bg-white rounded-2xl shadow-soft border-t-4 border-brand-blue hover:shadow-lg transition-all">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-50 text-brand-blue flex items-center justify-center text-lg sm:text-xl font-bold">
                        <i class="fas fa-headset"></i>
                    </div>
                    <span class="text-[11px] sm:text-xs font-bold text-gray-400 hidden sm:inline">All Channels</span>
                </div>
                <p class="text-xs text-gray-500 font-medium mt-3 sm:mt-4">Total Support Tickets</p>
                <div class="flex items-baseline justify-between mt-1">
                    <p class="text-xl sm:text-2xl lg:text-3xl font-extrabold text-brand-blue">{{ number_format($totalTickets) }}</p>
                    <span class="text-[11px] sm:text-xs text-brand-teal font-semibold hidden sm:inline"><i class="fas fa-database text-[10px]"></i> Total</span>
                </div>
            </div>

            <!-- Open & Pending Tickets -->
            <div class="p-4 sm:p-5 bg-white rounded-2xl shadow-soft border-t-4 border-brand-orange hover:shadow-lg transition-all">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-orange-50 text-brand-orange flex items-center justify-center text-lg sm:text-xl font-bold">
                        <i class="fas fa-clock-rotate-left"></i>
                    </div>
                    <span class="text-[10px] sm:text-xs font-bold px-2 py-0.5 rounded-md bg-amber-50 text-amber-700 hidden sm:inline">Action Required</span>
                </div>
                <p class="text-xs text-gray-500 font-medium mt-3 sm:mt-4">Open & Pending</p>
                <div class="flex items-baseline justify-between mt-1">
                    <p class="text-xl sm:text-2xl lg:text-3xl font-extrabold text-brand-orange">{{ number_format($openTickets) }}</p>
                    <span class="text-[11px] sm:text-xs text-brand-red font-semibold hidden sm:inline"><i class="fas fa-bell text-[10px]"></i> Action</span>
                </div>
            </div>

            <!-- In Progress -->
            <div class="p-4 sm:p-5 bg-white rounded-2xl shadow-soft border-t-4 border-brand-teal hover:shadow-lg transition-all">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-teal-50 text-brand-teal flex items-center justify-center text-lg sm:text-xl font-bold">
                        <i class="fas fa-spinner"></i>
                    </div>
                    <span class="text-[10px] sm:text-xs font-bold px-2 py-0.5 rounded-md bg-teal-50 text-brand-teal hidden sm:inline">Under Review</span>
                </div>
                <p class="text-xs text-gray-500 font-medium mt-3 sm:mt-4">In Progress</p>
                <div class="flex items-baseline justify-between mt-1">
                    <p class="text-xl sm:text-2xl lg:text-3xl font-extrabold text-brand-blue">{{ number_format($inProgressTickets) }}</p>
                    <span class="text-[11px] sm:text-xs text-gray-500 font-semibold hidden sm:inline">Active</span>
                </div>
            </div>

            <!-- Resolved & Closed -->
            <div class="p-4 sm:p-5 bg-white rounded-2xl shadow-soft border-t-4 border-emerald-500 hover:shadow-lg transition-all">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg sm:text-xl font-bold">
                        <i class="fas fa-circle-check"></i>
                    </div>
                    <span class="text-[10px] sm:text-xs font-bold px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 hidden sm:inline">Resolved</span>
                </div>
                <p class="text-xs text-gray-500 font-medium mt-3 sm:mt-4">Resolved & Closed</p>
                <div class="flex items-baseline justify-between mt-1">
                    <p class="text-xl sm:text-2xl lg:text-3xl font-extrabold text-brand-teal">{{ number_format($resolvedTickets) }}</p>
                    <span class="text-[11px] sm:text-xs text-emerald-600 font-semibold hidden sm:inline"><i class="fas fa-check text-[10px]"></i> Done</span>
                </div>
            </div>

        </div>

        <!-- 3. Filter & Search Bar Form -->
        <div class="bg-white p-4 sm:p-6 rounded-2xl shadow-soft">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4 pb-3 border-b border-gray-100">
                <div>
                    <h3 class="text-base font-bold text-brand-blue">Filter & Search Tickets</h3>
                    <p class="text-xs text-gray-400">Search by ticket ID, customer name, email, or filter by resolution status and priority.</p>
                </div>
                
                <div class="flex flex-wrap items-center gap-1.5 sm:gap-2">
                    <span class="text-xs text-gray-400 font-medium mr-1">Quick:</span>
                    <a href="{{ route('admin.support', ['status' => 'OPEN']) }}" class="text-xs px-2.5 py-1 rounded-lg {{ strtoupper(request('status')) === 'OPEN' ? 'bg-brand-orange text-white' : 'bg-brand-grey hover:bg-orange-50 text-brand-orange' }} font-bold transition-colors">
                        Open
                    </a>
                    <a href="{{ route('admin.support', ['priority' => 'High']) }}" class="text-xs px-2.5 py-1 rounded-lg {{ strtolower(request('priority')) === 'high' ? 'bg-brand-red text-white' : 'bg-brand-grey hover:bg-red-50 text-brand-red' }} font-bold transition-colors">
                        High Priority
                    </a>
                    <a href="{{ route('admin.support') }}" class="text-xs px-2.5 py-1 rounded-lg {{ !request('status') && !request('priority') && !request('search') ? 'bg-brand-teal text-white' : 'bg-brand-grey hover:bg-teal-50 text-brand-teal' }} font-bold transition-colors">
                        All
                    </a>
                </div>
            </div>

            <form method="GET" action="{{ route('admin.support') }}" id="filterForm" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-3 sm:gap-4">
                
                <!-- Search Input Bar -->
                <div class="sm:col-span-2 lg:col-span-5 relative">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input 
                        type="search" 
                        name="search"
                        id="ticketSearchInput" 
                        value="{{ request('search') }}"
                        placeholder="Search by ID, Name, Email, or Issue..." 
                        class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl text-sm text-gray-700 bg-brand-grey/50 focus:bg-white focus:border-brand-teal focus:ring-1 focus:ring-brand-teal/20 outline-none transition-all"
                        oninput="filterTicketsClientSide()"
                    >
                </div>

                <!-- Status Filter Dropdown -->
                <div class="sm:col-span-1 lg:col-span-3 relative">
                    <select 
                        name="status" 
                        id="statusFilter" 
                        onchange="this.form.submit()" 
                        class="w-full py-3 px-3.5 border border-gray-200 rounded-xl text-sm bg-brand-grey/50 focus:bg-white font-medium text-gray-700 focus:border-brand-teal outline-none cursor-pointer"
                    >
                        <option value="ALL" {{ request('status') == 'ALL' || !request('status') ? 'selected' : '' }}>All Statuses</option>
                        <option value="OPEN" {{ strtoupper(request('status')) == 'OPEN' ? 'selected' : '' }}>Open (Pending)</option>
                        <option value="IN_PROGRESS" {{ strtoupper(request('status')) == 'IN_PROGRESS' || request('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="RESOLVED" {{ strtoupper(request('status')) == 'RESOLVED' ? 'selected' : '' }}>Resolved</option>
                        <option value="CLOSED" {{ strtoupper(request('status')) == 'CLOSED' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>

                <!-- Priority Filter Dropdown -->
                <div class="sm:col-span-1 lg:col-span-2 relative">
                    <select 
                        name="priority" 
                        id="priorityFilter" 
                        onchange="this.form.submit()" 
                        class="w-full py-3 px-3.5 border border-gray-200 rounded-xl text-sm bg-brand-grey/50 focus:bg-white font-medium text-gray-700 focus:border-brand-teal outline-none cursor-pointer"
                    >
                        <option value="ALL" {{ request('priority') == 'ALL' || !request('priority') ? 'selected' : '' }}>All Priorities</option>
                        <option value="High" {{ strtolower(request('priority')) == 'high' ? 'selected' : '' }}>High / Urgent</option>
                        <option value="Medium" {{ strtolower(request('priority')) == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="Low" {{ strtolower(request('priority')) == 'low' ? 'selected' : '' }}>Low</option>
                    </select>
                </div>

                <!-- Submit / Clear Button -->
                <div class="sm:col-span-2 lg:col-span-2 flex items-center gap-2">
                    <button type="submit" class="flex-1 py-3 bg-brand-blue text-white font-semibold rounded-xl hover:bg-brand-blue/90 transition-colors flex items-center justify-center gap-2 text-sm">
                        <i class="fas fa-filter"></i>
                        <span>Filter</span>
                    </button>
                    @if(request()->hasAny(['search', 'status', 'priority']))
                    <a href="{{ route('admin.support') }}" class="py-3 px-3.5 bg-brand-grey hover:bg-gray-200 text-brand-red font-semibold rounded-xl text-sm transition-colors flex items-center justify-center" title="Clear Filters">
                        <i class="fas fa-times"></i>
                    </a>
                    @endif
                </div>

            </form>
        </div>

        <!-- 4. Support Tickets Data Table Container -->
        <div class="bg-white p-4 sm:p-6 rounded-2xl shadow-soft overflow-hidden">
            
            <!-- Table Header Bar -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4 pb-3 border-b border-gray-100">
                <div class="flex items-center gap-2.5">
                    <h2 class="text-lg font-bold text-brand-blue">Support Tickets Directory</h2>
                    <span id="ticketCountBadge" class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-teal-50 text-brand-teal border border-brand-teal/20">
                        Showing {{ $tickets->count() }} of {{ $tickets->total() }} Tickets
                    </span>
                </div>

                <div class="flex items-center gap-2 text-xs text-gray-500">
                    <span class="inline-block w-2.5 h-2.5 rounded-full bg-emerald-500"></span> Live Sync Active
                </div>
            </div>

            <!-- Responsive Table Wrapper -->
            <div class="overflow-x-auto -mx-4 sm:mx-0">
                <div class="inline-block min-w-full align-middle">
                    <table class="min-w-full divide-y divide-gray-200 text-left text-sm" id="ticketsTable">
                        <thead class="bg-brand-grey/60 text-xs font-bold text-gray-500 uppercase tracking-wider">
                            <tr>
                                <th scope="col" class="px-4 sm:px-6 py-3.5">Ticket ID</th>
                                <th scope="col" class="px-4 sm:px-6 py-3.5">Customer Name</th>
                                <th scope="col" class="px-4 sm:px-6 py-3.5">Subject & Excerpt</th>
                                <th scope="col" class="px-4 sm:px-6 py-3.5">Priority</th>
                                <th scope="col" class="px-4 sm:px-6 py-3.5">Status</th>
                                <th scope="col" class="px-4 sm:px-6 py-3.5">Date Created</th>
                                <th scope="col" class="px-4 sm:px-6 py-3.5 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 font-medium" id="ticketsTableBody">
                            @forelse($tickets as $ticket)

                            @php
                                $statusUpper = strtoupper(str_replace(' ', '_', $ticket->status));
                                $statusClass = match($ticket->status){
                                    'Open', 'Pending' => 'bg-amber-100 text-amber-800 border-amber-200',
                                    'In Progress' => 'bg-blue-100 text-brand-blue border-blue-200',
                                    'Resolved' => 'bg-teal-100 text-brand-teal border-teal-200',
                                    'Closed' => 'bg-gray-100 text-gray-700 border-gray-200',
                                    default => 'bg-gray-100 text-gray-600 border-gray-200',
                                };

                                $priorityLower = strtolower($ticket->priority);
                                $priorityBadge = match($priorityLower) {
                                    'urgent', 'high' => 'bg-red-50 text-brand-red border-red-200',
                                    'medium' => 'bg-amber-50 text-amber-700 border-amber-200',
                                    'low' => 'bg-gray-100 text-gray-600 border-gray-200',
                                    default => 'bg-gray-100 text-gray-600 border-gray-200'
                                };

                                $userName = $ticket->user->name ?? 'Customer';
                                $userEmail = $ticket->user->email ?? 'N/A';
                                $userAddress = $ticket->user->addresses->first()->city ?? $ticket->user->addresses->first()->street_address ?? 'Abuja, Nigeria';
                                $initials = strtoupper(substr($userName, 0, 2));
                            @endphp

                            <tr class="hover:bg-brand-grey/50 transition-colors ticket-row"
                                data-id="{{ $ticket->ticket_id }}"
                                data-status="{{ $statusUpper }}"
                                data-priority="{{ strtoupper($ticket->priority) }}">

                                <!-- Ticket ID & Category -->
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <span class="font-mono font-bold text-brand-blue bg-gray-100 px-2.5 py-1 rounded-lg border border-gray-200 text-xs">
                                        #{{ $ticket->ticket_id }}
                                    </span>
                                    <div class="text-[11px] text-gray-400 mt-1 flex items-center gap-1">
                                        @if(stripos($ticket->subject, 'delivery') !== false || stripos($ticket->message, 'delivery') !== false)
                                            <i class="fas fa-truck-fast text-brand-orange"></i> Delivery
                                        @elseif(stripos($ticket->subject, 'payment') !== false || stripos($ticket->subject, 'paystack') !== false || stripos($ticket->subject, 'refund') !== false)
                                            <i class="fas fa-credit-card text-brand-teal"></i> Payment
                                        @elseif(stripos($ticket->subject, 'subscription') !== false)
                                            <i class="fas fa-sync text-brand-blue"></i> Subscription
                                        @elseif(stripos($ticket->subject, 'quality') !== false || stripos($ticket->subject, 'yam') !== false)
                                            <i class="fas fa-shield-halved text-emerald-600"></i> Quality
                                        @else
                                            <i class="fas fa-ticket text-gray-400"></i> Support
                                        @endif
                                    </div>
                                </td>

                                <!-- Customer Details -->
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-brand-teal/15 text-brand-teal font-bold flex items-center justify-center text-xs shrink-0 border border-brand-teal/30">
                                            {{ $initials }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-brand-blue customer-name">{{ $userName }}</p>
                                            <p class="text-xs text-gray-500 customer-email">{{ $userEmail }}</p>
                                            <p class="text-[11px] text-gray-400">📍 {{ $userAddress }}</p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Subject & Excerpt -->
                                <td class="px-4 sm:px-6 py-4 max-w-xs sm:max-w-sm md:max-w-md">
                                    <div class="font-bold text-brand-blue truncate ticket-subject" title="{{ $ticket->subject }}">
                                        {{ $ticket->subject }}
                                    </div>
                                    <p class="text-xs text-gray-500 line-clamp-1 mt-0.5 ticket-excerpt">
                                        "{{ Str::limit($ticket->message, 90) }}"
                                    </p>
                                </td>

                                <!-- Priority -->
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold border {{ $priorityBadge }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ in_array($priorityLower, ['urgent', 'high']) ? 'bg-brand-red pulse-urgent' : ($priorityLower === 'medium' ? 'bg-amber-500' : 'bg-gray-400') }}"></span>
                                        {{ ucfirst($ticket->priority) }}
                                    </span>
                                </td>

                                <!-- Status -->
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full border {{ $statusClass }}">
                                        {{ $ticket->status }}
                                    </span>
                                </td>

                                <!-- Date Created -->
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-xs text-gray-500">
                                    <p class="font-semibold text-gray-700">{{ $ticket->created_at->format('M d, Y') }}</p>
                                    <p class="text-[11px] text-gray-400">{{ $ticket->created_at->diffForHumans() }}</p>
                                </td>

                                <!-- Action Buttons -->
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-right text-xs font-semibold">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <!-- View Details Button -->
                                        <button onclick="openTicketModal('{{ $ticket->ticket_id }}')" title="View Full Details & Admin Notes" class="p-2 text-brand-blue hover:bg-brand-blue hover:text-white rounded-lg transition-colors border border-gray-200">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        <!-- Update Status Button -->
                                        <button onclick="openStatusModal('{{ $ticket->ticket_id }}', '{{ $statusUpper }}', '{{ addslashes($userName) }}')" title="Update Status Quickly" class="p-2 text-brand-orange hover:bg-brand-orange hover:text-white rounded-lg transition-colors border border-gray-200">
                                            <i class="fas fa-pen-to-square"></i>
                                        </button>

                                        <!-- Reply via Email Button -->
                                        <button onclick="openReplyModal('{{ $ticket->ticket_id }}', '{{ $userEmail }}', '{{ addslashes($userName) }}', '{{ addslashes($ticket->subject) }}')" title="Reply via Email" class="p-2 text-brand-teal hover:bg-brand-teal hover:text-white rounded-lg transition-colors border border-gray-200">
                                            <i class="fas fa-reply"></i>
                                        </button>

                                        <!-- Close Ticket Button -->
                                        @if($ticket->status !== 'Closed')
                                        <button onclick="confirmCloseTicket('{{ $ticket->ticket_id }}', '{{ addslashes($userName) }}')" title="Close Ticket" class="p-2 text-gray-400 hover:bg-brand-red hover:text-white rounded-lg transition-colors border border-gray-200">
                                            <i class="fas fa-check-double"></i>
                                        </button>
                                        @else
                                        <button disabled title="Ticket Closed" class="p-2 text-gray-300 rounded-lg border border-gray-100 cursor-not-allowed">
                                            <i class="fas fa-lock"></i>
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            @empty

                            <tr>
                                <td colspan="7" class="text-center py-16 px-4">
                                    <div class="w-16 h-16 rounded-full bg-brand-grey flex items-center justify-center text-gray-400 mx-auto mb-4 text-2xl">
                                        <i class="fas fa-inbox"></i>
                                    </div>
                                    <h3 class="text-base font-bold text-brand-blue mb-1">No Support Tickets Found</h3>
                                    <p class="text-xs text-gray-500 max-w-sm mx-auto mb-4">No inquiries match your active search keyword or filter settings.</p>
                                    <a href="{{ route('admin.support') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-brand-teal text-white rounded-xl text-xs font-bold hover:bg-brand-blue transition-colors shadow-sm">
                                        <i class="fas fa-rotate-left"></i> Reset All Filters
                                    </a>
                                </td>
                            </tr>

                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Fallback Zero State for Live JS Search -->
            <div id="noResultsState" class="hidden p-8 sm:p-12 text-center">
                <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-brand-grey flex items-center justify-center text-gray-400 mx-auto mb-3 sm:mb-4 text-xl sm:text-2xl">
                    <i class="fas fa-search"></i>
                </div>
                <h3 class="text-base font-bold text-brand-blue mb-1">No Matching Tickets Found</h3>
                <p class="text-xs text-gray-500 max-w-sm mx-auto mb-4">No support tickets match your current live filter criteria.</p>
                <button onclick="resetFilters()" class="px-4 py-2 bg-brand-teal text-white rounded-lg text-xs font-bold hover:bg-brand-blue transition-colors">
                    Reset Search
                </button>
            </div>

            <!-- Table Pagination Footer -->
            @if($tickets->hasPages() || $tickets->total() > 0)
            <div class="pt-5 mt-4 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-gray-500">
                <p class="text-center sm:text-left">
                    Showing <span class="font-bold text-brand-blue">{{ $tickets->firstItem() ?? 0 }}</span> to <span class="font-bold text-brand-blue">{{ $tickets->lastItem() ?? 0 }}</span> of <span class="font-bold text-brand-blue">{{ $tickets->total() }}</span> tickets
                </p>
                <div class="overflow-x-auto max-w-full">
                    {{ $tickets->links() }}
                </div>
            </div>
            @endif

        </div>

        <!-- Footer Spacer -->
        <div class="h-8"></div>

    </main>

    <!-- MODAL 1: TICKET DETAILS & ADMIN FEEDBACK DRAWER/MODAL -->
    <div id="ticketDetailsModal" class="fixed inset-0 z-50 hidden modal-backdrop flex items-center justify-center p-3 sm:p-4 overflow-y-auto">
        <div class="bg-white rounded-2xl sm:rounded-3xl shadow-modal w-full max-w-4xl max-h-[92vh] flex flex-col overflow-hidden border border-gray-100 animate-in fade-in zoom-in-95 duration-200 my-auto">
            
            <!-- Modal Header -->
            <div class="p-4 sm:p-6 border-b border-gray-100 flex items-center justify-between bg-gradient-to-r from-brand-grey/80 to-white">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-brand-teal/10 text-brand-teal flex items-center justify-center text-base sm:text-lg shrink-0">
                        <i class="fas fa-ticket"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 flex-wrap">
                            <h3 class="text-lg sm:text-xl font-bold text-brand-blue" id="detailTicketId">#FB-TK-8942</h3>
                            <span id="detailStatusBadge" class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-100 text-amber-800">
                                Open
                            </span>
                            <span id="detailPriorityBadge" class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-100 text-brand-red">
                                High Priority
                            </span>
                        </div>
                        <p class="text-xs text-gray-500 mt-0.5">Created: <span id="detailCreatedAt">Aug 07, 2026</span></p>
                    </div>
                </div>
                
                <button onclick="closeTicketModal()" class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-500 flex items-center justify-center transition-colors shrink-0">
                    <i class="fas fa-times text-xs sm:text-sm"></i>
                </button>
            </div>

            <!-- Modal Form for Saving Changes -->
            <form id="detailsForm" method="POST" action="" class="flex flex-col flex-1 overflow-hidden">
                @csrf
                @method('PUT')

                <!-- Modal Body (Scrollable) -->
                <div class="p-4 sm:p-6 overflow-y-auto space-y-4 sm:space-y-6 flex-1">
                    
                    <!-- Customer Details Card -->
                    <div class="bg-brand-grey/50 rounded-xl sm:rounded-2xl p-4 sm:p-5 border border-gray-200/60">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-gray-400 block mb-2.5">Customer Information</span>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4">
                            <div>
                                <p class="text-xs text-gray-500">Full Name</p>
                                <p class="font-bold text-brand-blue text-sm truncate" id="detailCustomerName">Amina Okonjo</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Email Address</p>
                                <p class="font-bold text-brand-blue text-sm truncate" id="detailCustomerEmail">amina.o@example.com</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Phone Number</p>
                                <p class="font-bold text-brand-blue text-sm truncate" id="detailCustomerPhone">+234 803 456 7890</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Delivery District</p>
                                <p class="font-bold text-brand-teal text-sm truncate" id="detailCustomerAddress">Maitama, Abuja</p>
                            </div>
                        </div>
                    </div>

                    <!-- Original Customer Inquiry Block -->
                    <div>
                        <span class="text-[11px] font-bold uppercase tracking-wider text-gray-400 block mb-2">Original Customer Message</span>
                        <div class="bg-white border border-gray-200 rounded-xl sm:rounded-2xl p-4 sm:p-5 shadow-sm">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 mb-2.5 border-b border-gray-100 pb-2.5">
                                <h4 class="font-bold text-brand-blue text-sm sm:text-base" id="detailSubject">
                                    Order delayed by 2 hours for Family Box
                                </h4>
                                <span class="text-xs text-gray-400" id="detailCategoryPill">Category: Customer Support</span>
                            </div>
                            <p class="text-xs sm:text-sm text-gray-700 leading-relaxed whitespace-pre-line" id="detailMessage">
                                Customer inquiry message details here.
                            </p>
                        </div>
                    </div>

                    <!-- Attachment Preview Card -->
                    <div id="attachmentSection" class="hidden">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-gray-400 block mb-2">Attachment Preview</span>
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between p-3.5 sm:p-4 bg-white border border-gray-200 rounded-xl sm:rounded-2xl shadow-sm gap-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-teal-50 text-brand-teal flex items-center justify-center text-lg sm:text-xl shrink-0 cursor-pointer" onclick="zoomAttachment()">
                                    <i class="fas fa-file-image"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="font-bold text-brand-blue text-sm truncate" id="attachmentName">attachment.jpg</p>
                                    <p class="text-xs text-gray-400">Attached Photo / Proof Document</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 self-end sm:self-auto">
                                <button type="button" onclick="zoomAttachment()" class="px-3 py-1.5 rounded-lg bg-brand-grey hover:bg-gray-200 text-brand-blue font-semibold text-xs transition-colors flex items-center gap-1.5">
                                    <i class="fas fa-expand"></i> Preview
                                </button>
                                <a id="attachmentDownloadLink" href="#" download class="px-3 py-1.5 rounded-lg bg-brand-teal text-white font-semibold text-xs hover:bg-brand-blue transition-colors flex items-center gap-1.5">
                                    <i class="fas fa-download"></i> Download
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Admin Internal Feedback & Ticket Controls -->
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 sm:gap-5 pt-2 border-t border-gray-100">
                        
                        <!-- Admin Feedback / Internal Notes -->
                        <div class="md:col-span-8 space-y-1.5">
                            <label for="adminFeedbackNotes" class="block text-xs font-bold uppercase tracking-wider text-brand-blue">
                                Admin Internal Notes / Resolution Log
                            </label>
                            <textarea id="adminFeedbackNotes" name="admin_feedback" rows="3" 
                                placeholder="Write internal staff notes, investigation findings, or courier dispatch updates here..." 
                                class="w-full p-3 sm:p-4 border border-gray-200 rounded-xl focus:border-brand-teal focus:ring-1 focus:ring-brand-teal/20 outline-none text-xs sm:text-sm text-gray-700 bg-white"
                            ></textarea>
                        </div>

                        <!-- Status & Priority Controls -->
                        <div class="md:col-span-4 space-y-3 bg-brand-grey/50 p-3.5 sm:p-4 rounded-xl sm:rounded-2xl border border-gray-200">
                            <div>
                                <label class="block text-xs font-bold text-gray-600 mb-1">Ticket Status</label>
                                <select id="modalStatusSelect" name="status" class="w-full p-2.5 border border-gray-200 rounded-xl text-xs sm:text-sm font-semibold bg-white text-brand-blue focus:border-brand-teal outline-none">
                                    <option value="Open">Open (Pending)</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Resolved">Resolved</option>
                                    <option value="Closed">Closed</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-600 mb-1">Priority Level</label>
                                <select id="modalPrioritySelect" name="priority" class="w-full p-2.5 border border-gray-200 rounded-xl text-xs sm:text-sm font-semibold bg-white text-brand-blue focus:border-brand-teal outline-none">
                                    <option value="High">High / Urgent</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Low">Low</option>
                                </select>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- Modal Footer / Action Buttons -->
                <div class="p-4 sm:p-6 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-3 bg-brand-grey/40">
                    <div class="text-xs text-gray-400 hidden sm:block">
                        <i class="fas fa-user-shield text-brand-teal mr-1"></i> Managed by {{ $adminName }}
                    </div>

                    <div class="flex items-center gap-2.5 w-full sm:w-auto">
                        <button type="button" onclick="closeTicketModal()" class="flex-1 sm:flex-initial px-4 py-2.5 bg-white border border-gray-200 text-gray-600 rounded-xl font-bold text-xs sm:text-sm hover:bg-gray-100 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" class="flex-1 sm:flex-initial px-5 py-2.5 bg-brand-teal text-white rounded-xl font-bold text-xs sm:text-sm hover:bg-brand-blue transition-all shadow-md shadow-brand-teal/20 flex items-center justify-center gap-2">
                            <i class="fas fa-floppy-disk"></i>
                            <span>Save Changes</span>
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>

    <!-- MODAL 2: UPDATE STATUS QUICK MODAL  -->
    <div id="updateStatusModal" class="fixed inset-0 z-50 hidden modal-backdrop flex items-center justify-center p-3 sm:p-4">
        <div class="bg-white rounded-2xl sm:rounded-3xl shadow-modal w-full max-w-md p-5 sm:p-6 border border-gray-100 animate-in fade-in zoom-in-95 duration-200 my-auto">
            
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-amber-50 text-brand-orange flex items-center justify-center text-base sm:text-lg shrink-0">
                        <i class="fas fa-pen-to-square"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-brand-blue text-base sm:text-lg">Update Ticket Status</h3>
                        <p class="text-xs text-gray-400" id="quickModalTicketId">#FB-TK-8942</p>
                    </div>
                </div>
                <button onclick="closeStatusModal()" class="w-8 h-8 rounded-full bg-gray-100 text-gray-500 flex items-center justify-center hover:bg-gray-200">
                    <i class="fas fa-times text-xs"></i>
                </button>
            </div>

            <form id="quickStatusForm" method="POST" action="" class="space-y-4">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block text-xs font-bold text-gray-600 mb-1.5">New Status</label>
                    <select id="quickStatusSelect" name="status" class="w-full p-2.5 sm:p-3 border border-gray-200 rounded-xl text-sm font-semibold bg-white text-brand-blue focus:border-brand-teal outline-none">
                        <option value="Open">Open (Pending)</option>
                        <option value="In Progress">In Progress / Investigating</option>
                        <option value="Resolved">Resolved</option>
                        <option value="Closed">Closed</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-600 mb-1.5">Resolution Comment / Note (Optional)</label>
                    <textarea id="quickStatusComment" name="admin_feedback" rows="3" placeholder="Briefly state reason for status change or resolution note..." class="w-full p-3 border border-gray-200 rounded-xl text-xs sm:text-sm text-gray-700 focus:border-brand-teal outline-none"></textarea>
                </div>

                <div class="flex items-center justify-end gap-2.5 pt-3 border-t border-gray-100">
                    <button type="button" onclick="closeStatusModal()" class="px-4 py-2 text-gray-600 font-bold text-xs sm:text-sm hover:bg-gray-100 rounded-xl">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2.5 bg-brand-teal text-white font-bold text-xs sm:text-sm rounded-xl hover:bg-brand-blue transition-colors shadow-md">
                        Update Status
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL 3: REPLY VIA EMAIL COMPOSER MODAL -->
    <div id="replyEmailModal" class="fixed inset-0 z-50 hidden modal-backdrop flex items-center justify-center p-3 sm:p-4 overflow-y-auto">
        <div class="bg-white rounded-2xl sm:rounded-3xl shadow-modal w-full max-w-2xl max-h-[92vh] flex flex-col overflow-hidden border border-gray-100 animate-in fade-in zoom-in-95 duration-200 my-auto">
            
            <!-- Modal Header -->
            <div class="p-4 sm:p-6 border-b border-gray-100 flex items-center justify-between bg-gradient-to-r from-brand-grey/80 to-white">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-brand-teal/10 text-brand-teal flex items-center justify-center text-base sm:text-lg shrink-0">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-brand-blue text-base sm:text-lg">Send Email Response</h3>
                        <p class="text-xs text-gray-400">Replying directly to customer inbox</p>
                    </div>
                </div>
                <button onclick="closeReplyModal()" class="w-8 h-8 rounded-full bg-gray-100 text-gray-500 flex items-center justify-center hover:bg-gray-200">
                    <i class="fas fa-times text-xs"></i>
                </button>
            </div>

            <!-- Modal Form -->
            <form id="replyForm" method="POST" action="" class="p-4 sm:p-6 space-y-4 overflow-y-auto flex-1">
                @csrf
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1">To (Customer Email)</label>
                        <input type="email" id="replyEmailTo" readonly class="w-full p-2.5 bg-gray-100 border border-gray-200 rounded-xl text-xs sm:text-sm font-semibold text-gray-700 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1">Customer Name</label>
                        <input type="text" id="replyCustomerName" readonly class="w-full p-2.5 bg-gray-100 border border-gray-200 rounded-xl text-xs sm:text-sm font-semibold text-gray-700 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-600 mb-1">Email Subject</label>
                    <input type="text" id="replyEmailSubject" name="subject" required class="w-full p-2.5 border border-gray-200 rounded-xl text-xs sm:text-sm font-semibold text-brand-blue focus:border-brand-teal outline-none">
                </div>

                <!-- Canned Responses Selector -->
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label class="text-xs font-bold text-gray-600">Insert Quick Template</label>
                        <span class="text-[11px] text-brand-teal font-semibold">Speed up reply</span>
                    </div>
                    <select onchange="insertCannedTemplate(this.value)" class="w-full p-2.5 border border-gray-200 rounded-xl text-xs bg-brand-grey/60 text-gray-700 focus:border-brand-teal outline-none cursor-pointer">
                        <option value="">-- Choose a standard response template --</option>
                        <option value="delivery_delay">Delivery Delay Apology & Courier Tracking Update</option>
                        <option value="payment_refund">Double Charge Refund Confirmation via Paystack</option>
                        <option value="swap_accepted">Package Item Swap Confirmation</option>
                        <option value="general_thanks">General Inquiry Resolution & Quality Promise</option>
                    </select>
                </div>

                <!-- Email Message Body -->
                <div>
                    <label class="block text-xs font-bold text-gray-600 mb-1">Message Content</label>
                    <textarea 
                        id="replyMessageContent" 
                        name="message"
                        rows="5" 
                        required 
                        placeholder="Write your email reply to the customer..." 
                        class="w-full p-3 sm:p-4 border border-gray-200 rounded-xl text-xs sm:text-sm text-gray-700 focus:border-brand-teal outline-none leading-relaxed"
                    ></textarea>
                </div>

                <!-- Status Update After Sending -->
                <div>
                    <label class="block text-xs font-bold text-gray-600 mb-1">Update Status After Sending</label>
                    <select id="replyUpdateStatus" name="status" class="w-full p-2.5 border border-gray-200 rounded-xl text-xs font-semibold bg-white text-brand-blue focus:border-brand-teal outline-none">
                        <option value="In Progress">Keep In Progress</option>
                        <option value="Resolved" selected>Mark as Resolved</option>
                        <option value="Closed">Close Ticket</option>
                    </select>
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center justify-end gap-2.5 pt-3 border-t border-gray-100">
                    <button type="button" onclick="closeReplyModal()" class="px-4 py-2.5 text-gray-600 font-bold text-xs sm:text-sm hover:bg-gray-100 rounded-xl">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 sm:px-6 py-2.5 bg-brand-teal text-white font-bold text-xs sm:text-sm rounded-xl hover:bg-brand-blue transition-all shadow-md flex items-center gap-2">
                        <i class="fas fa-paper-plane text-xs"></i>
                        <span>Send Response</span>
                    </button>
                </div>

            </form>

        </div>
    </div>

    <!-- MODAL 4: IMAGE ZOOM ATTACHMENT PREVIEW -->
    <div id="imageZoomModal" class="fixed inset-0 z-50 hidden modal-backdrop flex items-center justify-center p-3 sm:p-4" onclick="closeZoomModal()">
        <div class="bg-white p-2 rounded-2xl shadow-modal max-w-2xl max-h-[85vh] overflow-hidden my-auto" onclick="event.stopPropagation()">
            <div class="relative">
                <img id="zoomModalImage" src="{{ asset('assets/images/food_home.avif') }}" onerror="this.src='https://placehold.co/800x600/264653/FFFFFF?text=Attached+Photo+Evidence';" alt="Attachment Preview" class="rounded-xl w-full max-h-[70vh] object-contain">
                <button onclick="closeZoomModal()" class="absolute top-3 right-3 w-8 h-8 rounded-full bg-black/60 text-white flex items-center justify-center hover:bg-black">
                    <i class="fas fa-times text-xs"></i>
                </button>
            </div>
            <div class="p-2.5 text-center">
                <p class="text-xs text-gray-500 font-semibold" id="zoomModalCaption">Attachment Preview</p>
            </div>
        </div>
    </div>

    <!-- Hidden Form for Close Ticket Action -->
    <form id="closeTicketForm" method="POST" action="" class="hidden">
        @csrf
        @method('PATCH')
    </form>

    <!-- JAVASCRIPT LOGIC & DATABASE INTEGRATION -->
    @php
        $ticketDb = [];
        foreach($tickets as $t) {
            $userAddr = $t->user->addresses->first()->city ?? $t->user->addresses->first()->street_address ?? 'Abuja, Nigeria';
            $ticketDb[$t->ticket_id] = [
                'id' => '#' . $t->ticket_id,
                'ticket_id' => $t->ticket_id,
                'customerName' => $t->user->name ?? 'Customer',
                'customerEmail' => $t->user->email ?? 'N/A',
                'customerPhone' => $t->user->phone ?? 'N/A',
                'customerAddress' => $userAddr,
                'createdAt' => $t->created_at ? $t->created_at->format('M d, Y \a\t h:i A') : 'N/A',
                'subject' => $t->subject,
                'category' => 'Customer Support',
                'priority' => ucfirst(strtolower($t->priority)),
                'status' => $t->status,
                'message' => $t->message,
                'attachment' => $t->attachment ? asset($t->attachment) : null,
                'attachmentName' => $t->attachment ? basename($t->attachment) : null,
                'adminFeedback' => $t->admin_feedback ?? ''
            ];
        }
    @endphp

    <script>
        // Live Ticket Data store fetched directly from backend
        const ticketDatabase = @json($ticketDb);

        // Base Action URLs
        const updateDetailsBaseUrl = "{{ url('/admin/support') }}";
        const updateStatusBaseUrl = "{{ url('/admin/support') }}";
        const replyBaseUrl = "{{ url('/admin/support') }}";
        const closeBaseUrl = "{{ url('/admin/support') }}";

        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('backdrop');

        // --- Sidebar Toggle Functions ---
        function toggleSidebar() {
            if (sidebar && backdrop) {
                const isOpen = sidebar.classList.toggle('open');
                backdrop.classList.toggle('hidden', !isOpen);
                if (isOpen) {
                    backdrop.offsetWidth; 
                    backdrop.classList.remove('opacity-0');
                } else {
                    backdrop.classList.add('opacity-0');
                }
            }
        }

        // Close sidebar on navigation link click on mobile
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024) { 
                    setTimeout(() => toggleSidebar(), 150);
                }
            });
        });

        // --- Instant Client-Side Search Filtering ---
        function filterTicketsClientSide() {
            const searchQuery = document.getElementById('ticketSearchInput').value.toLowerCase().trim();
            const rows = document.querySelectorAll('#ticketsTableBody .ticket-row');
            
            let visibleCount = 0;

            rows.forEach(row => {
                const ticketId = row.getAttribute('data-id') ? row.getAttribute('data-id').toLowerCase() : '';
                const customerName = row.querySelector('.customer-name') ? row.querySelector('.customer-name').innerText.toLowerCase() : '';
                const customerEmail = row.querySelector('.customer-email') ? row.querySelector('.customer-email').innerText.toLowerCase() : '';
                const subject = row.querySelector('.ticket-subject') ? row.querySelector('.ticket-subject').innerText.toLowerCase() : '';
                const excerpt = row.querySelector('.ticket-excerpt') ? row.querySelector('.ticket-excerpt').innerText.toLowerCase() : '';
                
                const matchesSearch = !searchQuery || ticketId.includes(searchQuery) || customerName.includes(searchQuery) || customerEmail.includes(searchQuery) || subject.includes(searchQuery) || excerpt.includes(searchQuery);

                if (matchesSearch) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Update badge & empty state
            const badge = document.getElementById('ticketCountBadge');
            const emptyState = document.getElementById('noResultsState');
            if (badge) badge.innerText = `Showing ${visibleCount} Ticket${visibleCount === 1 ? '' : 's'}`;
            if (emptyState) {
                emptyState.classList.toggle('hidden', visibleCount > 0 || rows.length === 0);
            }
        }

        function resetFilters() {
            document.getElementById('ticketSearchInput').value = '';
            window.location.href = "{{ route('admin.support') }}";
        }

        //Modal 1: Open Ticket Details Modal
        function openTicketModal(ticketKey) {
            const data = ticketDatabase[ticketKey];
            if (!data) return;
            
            document.getElementById('detailTicketId').innerText = data.id;
            document.getElementById('detailCustomerName').innerText = data.customerName;
            document.getElementById('detailCustomerEmail').innerText = data.customerEmail;
            document.getElementById('detailCustomerPhone').innerText = data.customerPhone;
            document.getElementById('detailCustomerAddress').innerText = data.customerAddress;
            document.getElementById('detailCreatedAt').innerText = data.createdAt;
            document.getElementById('detailSubject').innerText = data.subject;
            document.getElementById('detailCategoryPill').innerText = 'Category: ' + data.category;
            document.getElementById('detailMessage').innerText = data.message;
            document.getElementById('adminFeedbackNotes').value = data.adminFeedback || '';
            document.getElementById('modalStatusSelect').value = data.status;
            document.getElementById('modalPrioritySelect').value = data.priority;

            // Set Form Action URL for PUT update
            const detailsForm = document.getElementById('detailsForm');
            detailsForm.action = `${updateDetailsBaseUrl}/${data.ticket_id}/details`;

            // Status Badge coloring
            const statusBadge = document.getElementById('detailStatusBadge');
            statusBadge.innerText = data.status;
            if (data.status === 'Open' || data.status === 'Pending') {
                statusBadge.className = 'px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-100 text-amber-800';
            } else if (data.status === 'In Progress') {
                statusBadge.className = 'px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-100 text-brand-blue';
            } else if (data.status === 'Resolved') {
                statusBadge.className = 'px-2.5 py-0.5 rounded-full text-xs font-bold bg-teal-100 text-brand-teal';
            } else {
                statusBadge.className = 'px-2.5 py-0.5 rounded-full text-xs font-bold bg-gray-100 text-gray-600';
            }

            // Priority Badge coloring
            const priorityBadge = document.getElementById('detailPriorityBadge');
            priorityBadge.innerText = data.priority + ' Priority';
            if (data.priority.toLowerCase() === 'high' || data.priority.toLowerCase() === 'urgent') {
                priorityBadge.className = 'px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-100 text-brand-red';
            } else if (data.priority.toLowerCase() === 'medium') {
                priorityBadge.className = 'px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-100 text-amber-800';
            } else {
                priorityBadge.className = 'px-2.5 py-0.5 rounded-full text-xs font-bold bg-gray-100 text-gray-600';
            }

            // Attachment visibility
            const attachSection = document.getElementById('attachmentSection');
            if (attachSection) {
                if (data.attachment) {
                    attachSection.classList.remove('hidden');
                    document.getElementById('attachmentName').innerText = data.attachmentName || 'Proof Document';
                    document.getElementById('attachmentDownloadLink').href = data.attachment;
                    document.getElementById('zoomModalImage').src = data.attachment;
                } else {
                    attachSection.classList.add('hidden');
                }
            }

            document.getElementById('ticketDetailsModal').classList.remove('hidden');
        }

        function closeTicketModal() {
            document.getElementById('ticketDetailsModal').classList.add('hidden');
        }

        //Modal 2: Quick Status Modal
        function openStatusModal(ticketKey, currentStatus, customerName) {
            const data = ticketDatabase[ticketKey];
            document.getElementById('quickModalTicketId').innerText = `#${ticketKey} • ${customerName}`;
            
            // Format status value
            const formattedStatus = data ? data.status : (currentStatus === 'IN_PROGRESS' ? 'In Progress' : (currentStatus === 'OPEN' ? 'Open' : (currentStatus === 'RESOLVED' ? 'Resolved' : 'Closed')));
            document.getElementById('quickStatusSelect').value = formattedStatus;
            document.getElementById('quickStatusComment').value = data ? (data.adminFeedback || '') : '';

            // Set Form Action URL
            const quickStatusForm = document.getElementById('quickStatusForm');
            quickStatusForm.action = `${updateStatusBaseUrl}/${ticketKey}/status`;

            document.getElementById('updateStatusModal').classList.remove('hidden');
        }

        function closeStatusModal() {
            document.getElementById('updateStatusModal').classList.add('hidden');
        }

        //Modal 3: Reply via Email Modal
        function openReplyModal(ticketKey, email, name, subject) {
            document.getElementById('replyEmailTo').value = email;
            document.getElementById('replyCustomerName').value = name;
            document.getElementById('replyEmailSubject').value = `Re: [${ticketKey}] ${subject}`;
            document.getElementById('replyMessageContent').value = `Dear ${name},\n\nThank you for contacting FoodBox Customer Support regarding your order.\n\n`;
            
            const replyForm = document.getElementById('replyForm');
            replyForm.action = `${replyBaseUrl}/${ticketKey}/reply`;

            document.getElementById('replyEmailModal').classList.remove('hidden');
        }

        function closeReplyModal() {
            document.getElementById('replyEmailModal').classList.add('hidden');
        }

        function insertCannedTemplate(templateType) {
            const customerName = document.getElementById('replyCustomerName').value || 'Valued Customer';
            const textarea = document.getElementById('replyMessageContent');

            if (templateType === 'delivery_delay') {
                textarea.value = `Dear ${customerName},\n\nWe sincerely apologize for the unexpected delay with your FoodBox delivery today. Our dispatch courier encountered minor traffic along the corridor, but is now en route with your fresh package.\n\nEstimated Arrival Time: Within 30 minutes.\n\nThank you for your patience and for choosing FoodBox NG!`;
            } else if (templateType === 'payment_refund') {
                textarea.value = `Dear ${customerName},\n\nWe have verified the duplicate billing on your account. Our finance team has processed a full refund via Paystack back to your original payment method.\n\nYou should see the funds reflected within 24 hours depending on your bank. Please let us know if you need any further assistance!`;
            } else if (templateType === 'swap_accepted') {
                textarea.value = `Dear ${customerName},\n\nYour request to swap package items has been approved and updated in our packaging facility. Your tailored essentials box will arrive precisely to your specifications.\n\nThank you for reaching out!`;
            } else if (templateType === 'general_thanks') {
                textarea.value = `Dear ${customerName},\n\nThank you for contacting FoodBox Customer Support. We have looked into your inquiry and resolved the issue as requested.\n\nPlease don't hesitate to reach out if you have any further questions. Have a wonderful week!`;
            }
        }

        //Close Ticket Action with SweetAlert Confirmation
        function confirmCloseTicket(ticketKey, customerName) {
            Swal.fire({
                title: `Close Ticket #${ticketKey}?`,
                html: `Are you sure you want to mark this support ticket for <strong>${customerName}</strong> as closed?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2A9D8F',
                cancelButtonColor: '#E76F51',
                confirmButtonText: '<i class="fas fa-check-circle mr-1"></i> Yes, Close Ticket',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    const closeForm = document.getElementById('closeTicketForm');
                    closeForm.action = `${closeBaseUrl}/${ticketKey}/close`;
                    closeForm.submit();
                }
            });
        }

        //Attachment Zoom & Lightbox
        function zoomAttachment() {
            document.getElementById('imageZoomModal').classList.remove('hidden');
        }

        function closeZoomModal() {
            document.getElementById('imageZoomModal').classList.add('hidden');
        }
    </script>
</body>
</html>