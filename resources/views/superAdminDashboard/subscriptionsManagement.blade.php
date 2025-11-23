<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscriptions Management | FoodBox NG</title>
    
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
    <aside id="sidebar" class="fixed top-0 left-0 h-full w-64 bg-brand-blue p-6 shadow-admin lg:translate-x-0">
        
        <!-- Logo/Brand -->
        <div class="flex items-center gap-2 mb-8 pb-4 border-b border-white/10">
            <div class="w-10 h-10 bg-brand-teal rounded-lg flex items-center justify-center text-white shadow-lg">
                <i class="fas fa-box-open text-xl"></i>
            </div>
            <span class="text-2xl font-extrabold text-white tracking-tight">FoodBox<span class="text-brand-teal">NG</span></span>
        </div>

        <!-- Admin Profile -->
        <div class="flex items-center gap-3 mb-10 pb-4 border-b border-white/10">
            <img src="https://placehold.co/40x40/E76F51/FFFFFF?text=SA" onerror="this.onerror=null; this.src='https://placehold.co/40x40/E76F51/FFFFFF?text=SA';" alt="Admin Avatar" class="w-10 h-10 rounded-full border-2 border-brand-gold/50 object-cover">
            <div class="text-white">
                <p class="font-semibold text-sm leading-tight">Admin J. Okoro</p>
                <p class="text-xs text-brand-gold font-medium">Super Admin</p>
            </div>
        </div>

        <!-- Navigation Links (Highlight Subscriptions) -->
        <nav class="space-y-1.5">
            <a href="superAdmin_dashboard.html" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
                <i class="fas fa-tachometer-alt text-lg w-6 text-center"></i>
                <span>Dashboard Overview</span>
            </a>
             <a href="superAdmin_add_new.html" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
                <i class="fas fa-plus-circle text-lg w-6 text-center"></i>
                <span>Add New</span>
            </a>
            <a href="superAdmin_orders_management.html" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
                <i class="fas fa-shopping-cart text-lg w-6 text-center"></i>
                <span>Orders Management</span>
            </a>
            <!-- Subscriptions (Active) -->
            <a href="#" class="nav-link active flex items-center gap-4 text-white/90 font-semibold p-3 rounded-xl transition-all hover:bg-brand-blue/70">
                <i class="fas fa-sync-alt text-lg w-6 text-center"></i>
                <span>Subscriptions</span>
            </a>
            <a href="#" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
                <i class="fas fa-users text-lg w-6 text-center"></i>
                <span>Users Management</span>
            </a>
            <a href="#" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl hover:bg-brand-blue/70 hover:text-white">
                <i class="fas fa-cog text-lg w-6 text-center"></i>
                <span>System Settings</span>
            </a>
        </nav>
    </aside>

    <!-- 2. Top Header -->
    <header class="fixed top-0 right-0 w-full lg:w-[calc(100%-16rem)] h-20 bg-white border-b border-gray-100 shadow-soft z-30 flex items-center px-4 md:px-8 justify-between">
        <h1 class="text-xl font-bold text-brand-blue">Subscriptions Management</h1>
        
        <!-- Right Side Actions -->
        <div class="flex items-center space-x-4">
            
            <!-- Notifications Bell -->
            <button class="p-2 rounded-full text-gray-500 hover:bg-brand-grey transition-colors relative">
                <i class="fas fa-bell text-lg"></i>
                <span class="absolute top-0.5 right-0.5 block h-2 w-2 rounded-full ring-2 ring-white bg-brand-orange"></span>
            </button>

            <!-- Quick Action Button -->
            <a href="superAdmin_add_new.html" class="px-4 py-2 bg-brand-teal text-white font-semibold rounded-xl hover:bg-brand-teal/90 transition-colors shadow-sm-brand flex items-center gap-2">
                <i class="fas fa-plus"></i>
                <span class="hidden md:inline">New Package</span>
            </a>
            
            <!-- Profile Avatar -->
            <img src="https://placehold.co/36x36/E76F51/FFFFFF?text=SA" onerror="this.onerror=null; this.src='https://placehold.co/36x36/E76F51/FFFFFF?text=SA';" alt="Admin Avatar" class="w-9 h-9 rounded-full object-cover ring-2 ring-brand-blue/50 hidden sm:block">
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="lg:ml-64 p-4 md:p-8 main-content max-w-full">
        
        <!-- Subscription Metrics Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
            
            <!-- Card 1: Active Subscriptions -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-teal">
                <div class="flex items-center justify-between">
                    <i class="fas fa-check-circle text-2xl text-brand-teal p-3 bg-brand-teal/10 rounded-xl"></i>
                    <span class="text-sm font-semibold text-green-500 hidden md:block">+25 this week</span>
                </div>
                <p class="text-sm text-gray-500 mt-2">Active Subscriptions</p>
                <p class="text-2xl font-extrabold text-brand-blue">1,240</p>
            </div>

            <!-- Card 2: Annual Recurring Revenue (ARR) -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-blue">
                <div class="flex items-center justify-between">
                    <i class="fas fa-chart-line text-2xl text-brand-blue p-3 bg-brand-blue/10 rounded-xl"></i>
                    <span class="text-sm font-semibold text-brand-teal hidden md:block">Up 8%</span>
                </div>
                <p class="text-sm text-gray-500 mt-2">Annual Revenue (Est.)</p>
                <p class="text-2xl font-extrabold text-brand-blue">₦ 75M</p>
            </div>

            <!-- Card 3: Expiring Soon (Orange/Gold) -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-orange">
                <div class="flex items-center justify-between">
                    <i class="fas fa-clock text-2xl text-brand-orange p-3 bg-brand-orange/10 rounded-xl"></i>
                    <span class="text-sm font-semibold text-brand-orange hidden md:block">Action Required</span>
                </div>
                <p class="text-sm text-gray-500 mt-2">Expiring Next 7 Days</p>
                <p class="text-2xl font-extrabold text-brand-blue">48</p>
            </div>

            <!-- Card 4: Failed Payments (Red) -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-red">
                <div class="flex items-center justify-between">
                    <i class="fas fa-exclamation-triangle text-2xl text-brand-red p-3 bg-brand-red/10 rounded-xl"></i>
                    <span class="text-sm font-semibold text-red-500 hidden md:block">Immediate Attention</span>
                </div>
                <p class="text-sm text-gray-500 mt-2">Failed Renewals</p>
                <p class="text-2xl font-extrabold text-brand-blue">12</p>
            </div>
        </div>

        <!-- Filter & Search Bar -->
        <div class="bg-white p-6 rounded-2xl shadow-soft mb-8">
            <h3 class="text-lg font-semibold mb-4 text-brand-blue">Subscription Filters</h3>
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                
                <!-- Search -->
                <div class="md:col-span-2 relative">
                    <i class="fas fa-user absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="search" placeholder="Search by Customer Name or Email..."
                        class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:border-brand-teal focus:ring-1 focus:ring-brand-teal/20 outline-none transition-all text-sm bg-brand-grey/50">
                </div>

                <!-- Status Filter -->
                <div>
                    <select class="w-full py-3 px-4 border border-gray-200 rounded-xl text-sm bg-brand-grey/50 focus:border-brand-teal outline-none">
                        <option>All Statuses</option>
                        <option>Active</option>
                        <option>Paused</option>
                        <option>Cancelled</option>
                        <option>In Grace Period</option>
                    </select>
                </div>

                <!-- Renewal Date -->
                <div>
                    <input type="date" class="w-full py-3 px-4 border border-gray-200 rounded-xl text-sm bg-brand-grey/50 focus:border-brand-teal outline-none">
                </div>

                <!-- Action Button -->
                <button class="w-full py-3 bg-brand-blue text-white font-semibold rounded-xl hover:bg-brand-blue/90 transition-colors flex items-center justify-center gap-2">
                    <i class="fas fa-search"></i>
                    <span class="hidden sm:inline">Search Subscriptions</span>
                </button>
            </div>
        </div>

        <!-- Subscriptions Table -->
        <div class="bg-white p-6 rounded-2xl shadow-soft overflow-x-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-brand-blue">Current Subscription List</h3>
                <button class="text-brand-teal hover:text-brand-blue text-sm font-semibold">
                    <i class="fas fa-download mr-1"></i> Export Data
                </button>
            </div>
            
            <table class="min-w-full divide-y divide-gray-200 responsive-table">
                <thead class="bg-brand-grey/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sub ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Package</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Frequency</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Next Renewal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <!-- Row 1: Active -->
                    <tr class="hover:bg-brand-grey transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Sub ID">SUB1001</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Customer">Aisha Lawal</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Package">Family Jumbo</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Frequency">Monthly</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-brand-teal font-semibold" data-label="Next Renewal">2023-12-05</td>
                        <td class="px-6 py-4 whitespace-nowrap" data-label="Status">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Action">
                            <button class="text-brand-blue hover:text-brand-teal transition-colors text-sm font-semibold">Manage</button>
                        </td>
                    </tr>
                     <!-- Row 2: Paused -->
                    <tr class="hover:bg-brand-grey transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Sub ID">SUB1002</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Customer">Ngozi Ezenwa</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Package">Standard Basic</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Frequency">Quarterly</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Next Renewal">2024-01-15</td>
                        <td class="px-6 py-4 whitespace-nowrap" data-label="Status">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-200 text-gray-700">Paused</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Action">
                            <button class="text-brand-blue hover:text-brand-teal transition-colors text-sm font-semibold">Activate</button>
                        </td>
                    </tr>
                     <!-- Row 3: Payment Failed -->
                    <tr class="hover:bg-brand-grey transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Sub ID">SUB1003</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Customer">Kunle Adebayo</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Package">Premium Vegan</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Frequency">Bi-Weekly</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-brand-red font-semibold" data-label="Next Renewal">2023-11-25 (Retrying)</td>
                        <td class="px-6 py-4 whitespace-nowrap" data-label="Status">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-brand-red/10 text-brand-red">Payment Failed</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Action">
                            <button class="text-brand-blue hover:text-brand-teal transition-colors text-sm font-semibold">Update Card</button>
                        </td>
                    </tr>
                    <!-- Row 4: Expiring Soon -->
                    <tr class="hover:bg-brand-grey transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Sub ID">SUB1004</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Customer">Hassan Musa</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Package">Custom Build</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Frequency">Monthly</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-brand-orange font-semibold" data-label="Next Renewal">2023-11-28 (Final Cycle)</td>
                        <td class="px-6 py-4 whitespace-nowrap" data-label="Status">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-brand-orange/10 text-brand-orange">Expiring</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Action">
                            <button class="text-brand-blue hover:text-brand-teal transition-colors text-sm font-semibold">View History</button>
                        </td>
                    </tr>
                    <!-- Row 5: Active -->
                    <tr class="hover:bg-brand-grey transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Sub ID">SUB1005</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Customer">Jessica P.</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Package">Student Starter</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Frequency">Monthly</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-brand-teal font-semibold" data-label="Next Renewal">2023-12-10</td>
                        <td class="px-6 py-4 whitespace-nowrap" data-label="Status">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Action">
                            <button class="text-brand-blue hover:text-brand-teal transition-colors text-sm font-semibold">Manage</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-6 flex justify-between items-center">
                <p class="text-sm text-gray-600">Showing 1 to 5 of 1,240 results</p>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 rounded-lg bg-brand-grey text-brand-blue font-medium hover:bg-gray-300 transition-colors"><i class="fas fa-chevron-left text-xs"></i></button>
                    <span class="px-3 py-1 rounded-lg bg-brand-blue text-white font-medium">1</span>
                    <button class="px-3 py-1 rounded-lg bg-brand-grey text-brand-blue font-medium hover:bg-gray-300 transition-colors">2</button>
                    <button class="px-3 py-1 rounded-lg bg-brand-grey text-brand-blue font-medium hover:bg-gray-300 transition-colors">3</button>
                    <button class="px-3 py-1 rounded-lg bg-brand-grey text-brand-blue font-medium hover:bg-gray-300 transition-colors"><i class="fas fa-chevron-right text-xs"></i></button>
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