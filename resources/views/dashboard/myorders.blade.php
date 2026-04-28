<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders | FoodBox NG</title>
    
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

        /* Active link styling (My Orders is active here) */
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
            padding: 0.3rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        /* Custom Order List styling for mobile */
        @media (max-width: 768px) {
            .order-row {
                display: block;
                border-bottom: 1px solid #e5e7eb;
                padding-bottom: 1rem;
                margin-bottom: 1rem;
            }
            .order-row > * {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.3rem 0;
            }
            .order-row > *:before {
                content: attr(data-label);
                font-weight: 600;
                color: #4b5563; /* Gray-600 */
                flex-basis: 40%;
            }
            .order-row .action-cell {
                justify-content: center;
                margin-top: 0.5rem;
            }
            .order-table-header {
                display: none; /* Hide standard header on mobile */
            }
        }

    </style>
</head>
<body class="bg-brand-grey text-brand-blue antialiased min-h-screen">

    @include('dashboard.header')

    <!-- Main Content Area -->
    <main class="p-4 mt-20 md:p-8 lg:ml-64 main-content">
        
        <!-- Header Section -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-brand-blue mb-1">My Orders & History</h1>
            <p class="text-gray-600">Review all your past and currently processing food package deliveries.</p>
        </div>

        <!-- Order Management Card -->
        <section class="bg-white p-6 rounded-2xl shadow-soft">
            
            <!-- Filter & Search Bar -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 space-y-4 md:space-y-0">
                
                <!-- Filter Tabs -->
                <div class="flex space-x-2 p-1 bg-brand-grey rounded-xl overflow-x-auto">
                    <button class="px-4 py-2 text-sm font-semibold rounded-lg bg-brand-teal text-white shadow-md transition-colors hover:bg-brand-blue">All Orders (14)</button>
                    <button class="px-4 py-2 text-sm font-medium rounded-lg text-brand-blue transition-colors hover:bg-brand-teal/20">Processing (1)</button>
                    <button class="px-4 py-2 text-sm font-medium rounded-lg text-brand-blue transition-colors hover:bg-brand-teal/20">Delivered (13)</button>
                    <button class="px-4 py-2 text-sm font-medium rounded-lg text-brand-blue transition-colors hover:bg-brand-teal/20">Cancelled (0)</button>
                </div>
                
                <!-- Search Input -->
                <div class="relative w-full md:w-64">
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input 
                        type="search" 
                        placeholder="Search by ID or Package..."
                        class="w-full pl-12 pr-4 py-2 border border-gray-200 rounded-full focus:border-brand-teal focus:ring-1 focus:ring-brand-teal/20 outline-none transition-all text-sm"
                    >
                </div>
            </div>

            <!-- Order Table (Desktop View) -->
            <div class="overflow-x-auto hidden md:block">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="order-table-header bg-brand-grey">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider rounded-tl-lg">Order ID</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Package Name</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Amount Paid</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date Placed</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="px-4 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider rounded-tr-lg">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <!-- Order 1: Processing -->
                        <tr class="hover:bg-brand-grey/50 transition-colors">
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-brand-blue">#FBNG-2512</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">The Student Pack</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-brand-teal">₦15,000</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">2025-10-12</td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span class="status-badge bg-brand-gold/20 text-brand-blue">Processing</span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-right">
                                <button class="bg-brand-orange text-white px-3 py-1 rounded-full text-xs font-medium hover:bg-brand-red transition-colors">Track Delivery</button>
                            </td>
                        </tr>
                        <!-- Order 2: Delivered -->
                        <tr class="hover:bg-brand-grey/50 transition-colors">
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-brand-blue">#FBNG-2511</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">The Family Feast</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-brand-teal">₦45,000</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">2025-09-28</td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span class="status-badge bg-brand-teal/20 text-brand-teal">Delivered</span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-right">
                                <button class="bg-brand-blue text-white px-3 py-1 rounded-full text-xs font-medium hover:opacity-90 transition-opacity">Download Invoice</button>
                            </td>
                        </tr>
                        <!-- Order 3: Delivered -->
                        <tr class="hover:bg-brand-grey/50 transition-colors">
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-brand-blue">#FBNG-2510</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">The Starter Kit</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-brand-teal">₦8,500</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">2025-08-15</td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span class="status-badge bg-brand-teal/20 text-brand-teal">Delivered</span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-right">
                                <button class="bg-brand-blue text-white px-3 py-1 rounded-full text-xs font-medium hover:opacity-90 transition-opacity">Download Invoice</button>
                            </td>
                        </tr>
                        <!-- Order 4: Cancelled -->
                        <tr class="hover:bg-brand-grey/50 transition-colors opacity-70">
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-brand-blue">#FBNG-2509</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">The Deluxe Box</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-brand-red line-through">₦55,000</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">2025-07-01</td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span class="status-badge bg-brand-red/20 text-brand-red">Cancelled</span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-right">
                                <button class="bg-gray-400 text-white px-3 py-1 rounded-full text-xs font-medium cursor-not-allowed" disabled>View Details</button>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>

            <!-- Order List (Mobile/Card View) -->
            <div class="md:hidden divide-y divide-gray-200">
                
                <!-- Mobile Order 1: Processing -->
                <div class="order-row">
                    <p data-label="Order ID" class="text-brand-blue font-semibold">#FBNG-2512</p>
                    <p data-label="Package Name" class="text-gray-700">The Student Pack</p>
                    <p data-label="Amount Paid" class="font-bold text-brand-teal">₦15,000</p>
                    <p data-label="Date Placed" class="text-gray-500">2025-10-12</p>
                    <p data-label="Status">
                        <span class="status-badge bg-brand-gold/20 text-brand-blue">Processing</span>
                    </p>
                    <div class="action-cell">
                        <button class="w-full bg-brand-orange text-white px-3 py-2 rounded-xl text-sm font-medium hover:bg-brand-red transition-colors">Track Delivery</button>
                    </div>
                </div>

                <!-- Mobile Order 2: Delivered -->
                <div class="order-row">
                    <p data-label="Order ID" class="text-brand-blue font-semibold">#FBNG-2511</p>
                    <p data-label="Package Name" class="text-gray-700">The Family Feast</p>
                    <p data-label="Amount Paid" class="font-bold text-brand-teal">₦45,000</p>
                    <p data-label="Date Placed" class="text-gray-500">2025-09-28</p>
                    <p data-label="Status">
                        <span class="status-badge bg-brand-teal/20 text-brand-teal">Delivered</span>
                    </p>
                    <div class="action-cell">
                        <button class="w-full bg-brand-blue text-white px-3 py-2 rounded-xl text-sm font-medium hover:opacity-90 transition-opacity">Download Invoice</button>
                    </div>
                </div>
            </div>

            <!-- Pagination/View All Footer -->
            <div class="mt-8 flex justify-center text-sm">
                <nav class="flex items-center space-x-2">
                    <button class="p-2 rounded-full text-gray-500 hover:bg-brand-grey/50 disabled:opacity-50" disabled>
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <span class="px-4 py-1 font-semibold bg-brand-teal text-white rounded-full">1</span>
                    <button class="px-4 py-1 font-medium text-brand-blue hover:bg-brand-grey/50 rounded-full">2</button>
                    <button class="p-2 rounded-full text-gray-500 hover:bg-brand-grey/50">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </nav>
            </div>

        </section>
        
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