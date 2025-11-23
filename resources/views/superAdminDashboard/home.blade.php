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
    <aside id="sidebar" class="fixed top-0 left-0 h-full w-64 bg-brand-blue p-6 shadow-admin lg:translate-x-0">
        
        <!-- Logo/Brand -->
        <div class="flex items-center gap-2 mb-8 pb-4 border-b border-white/10">
            <div class="w-10 h-10 bg-brand-teal rounded-lg flex items-center justify-center text-white shadow-lg shadow-brand-teal/40">
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

        <!-- Navigation Links -->
        <nav class="space-y-1.5">
            <!-- Dashboard Overview (Active) -->
            <a href="#" class="nav-link active flex items-center gap-4 text-white/90 font-semibold p-3 rounded-xl transition-all hover:bg-brand-blue/70">
                <i class="fas fa-tachometer-alt text-lg w-6 text-center"></i>
                <span>Dashboard Overview</span>
            </a>
            <!-- Manage Packages -->
            <a href="#" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
                <i class="fas fa-cubes text-lg w-6 text-center"></i>
                <span>Manage Packages</span>
            </a>
            <!-- Orders Management -->
            <a href="#" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
                <i class="fas fa-shopping-cart text-lg w-6 text-center"></i>
                <span>Orders Management</span>
            </a>
            <!-- Subscriptions -->
            <a href="#" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
                <i class="fas fa-sync-alt text-lg w-6 text-center"></i>
                <span>Subscriptions</span>
            </a>
            <!-- Users Management -->
            <a href="#" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
                <i class="fas fa-users text-lg w-6 text-center"></i>
                <span>Users Management</span>
            </a>
            <!-- Delivery Logistics -->
            <a href="#" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
                <i class="fas fa-truck-fast text-lg w-6 text-center"></i>
                <span>Delivery Logistics</span>
            </a>
            <!-- Inventory / Stock -->
            <a href="#" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
                <i class="fas fa-warehouse text-lg w-6 text-center"></i>
                <span>Inventory / Stock</span>
            </a>
            <!-- Payments & Transactions -->
            <a href="#" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
                <i class="fas fa-credit-card text-lg w-6 text-center"></i>
                <span>Payments & Transactions</span>
            </a>
             <!-- System Settings -->
            <a href="#" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
                <i class="fas fa-cog text-lg w-6 text-center"></i>
                <span>System Settings</span>
            </a>
            <!-- Admin Management -->
            <a href="#" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
                <i class="fas fa-user-shield text-lg w-6 text-center"></i>
                <span>Admin Management</span>
            </a>
        </nav>

        <!-- Logout link at the bottom -->
        <div class="absolute bottom-6 left-6 right-6">
            <a href="superAdmin_login.html" class="flex items-center gap-4 text-brand-red font-semibold p-3 rounded-xl bg-white/10 transition-all hover:bg-brand-red/20">
                <i class="fas fa-sign-out-alt text-lg w-6 text-center"></i>
                <span>Log Out</span>
            </a>
        </div>
    </aside>

    <!-- 2. Top Header -->
    <header class="fixed top-0 right-0 w-full lg:w-[calc(100%-16rem)] h-20 bg-white border-b border-gray-100 shadow-soft z-30 flex items-center px-4 md:px-8">
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
        <div class="flex items-center space-x-4">
            
            <!-- Notifications Bell -->
            <button class="p-2 rounded-full text-gray-500 hover:bg-brand-grey transition-colors relative">
                <i class="fas fa-bell text-lg"></i>
                <span class="absolute top-0.5 right-0.5 block h-2 w-2 rounded-full ring-2 ring-white bg-brand-orange"></span>
            </button>

            <!-- Quick Action Button -->
            <div class="relative group">
                <button class="px-4 py-2 bg-brand-teal text-white font-semibold rounded-xl hover:bg-brand-teal/90 transition-colors shadow-sm-brand flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    <span class="hidden md:inline">Add New</span>
                </button>
                <!-- Quick Action Dropdown -->
                <div class="absolute right-0 mt-3 w-40 bg-white border border-gray-100 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform scale-95 origin-top-right z-40">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-grey rounded-t-xl"><i class="fas fa-cube mr-2"></i> Add Package</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-grey"><i class="fas fa-box-open mr-2"></i> Add Item</a>
                    <div class="border-t border-gray-100"></div>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-grey rounded-b-xl"><i class="fas fa-user-plus mr-2"></i> Add Admin</a>
                </div>
            </div>
            
            <!-- Profile Avatar Dropdown -->
            <div class="relative group cursor-pointer hidden sm:block">
                <img src="https://placehold.co/36x36/E76F51/FFFFFF?text=SA" onerror="this.onerror=null; this.src='https://placehold.co/36x36/E76F51/FFFFFF?text=SA';" alt="Admin Avatar" class="w-9 h-9 rounded-full object-cover ring-2 ring-brand-blue/50">
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="lg:ml-64 p-4 md:p-8 main-content">
        
        <!-- 3. Dashboard Overview Cards -->
        <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-6 lg:gap-6 mb-8">
            
            <!-- Card 1: Total Users -->
            <div class="p-4 bg-white rounded-2xl shadow-soft">
                <div class="flex items-center justify-between">
                    <i class="fas fa-users text-2xl text-brand-teal p-3 bg-brand-teal/10 rounded-xl"></i>
                    <span class="text-sm font-semibold text-green-500 hidden md:block">+12%</span>
                </div>
                <p class="text-sm text-gray-500 mt-2">Total Users</p>
                <p class="text-2xl font-extrabold text-brand-blue">14,321</p>
            </div>

            <!-- Card 2: Total Orders -->
            <div class="p-4 bg-white rounded-2xl shadow-soft">
                <div class="flex items-center justify-between">
                    <i class="fas fa-shopping-basket text-2xl text-brand-blue p-3 bg-brand-blue/10 rounded-xl"></i>
                    <span class="text-sm font-semibold text-red-500 hidden md:block">-4%</span>
                </div>
                <p class="text-sm text-gray-500 mt-2">Total Orders</p>
                <p class="text-2xl font-extrabold text-brand-blue">3,125</p>
            </div>

            <!-- Card 3: Active Subscriptions -->
            <div class="p-4 bg-white rounded-2xl shadow-soft">
                <div class="flex items-center justify-between">
                    <i class="fas fa-sync-alt text-2xl text-brand-gold p-3 bg-brand-gold/10 rounded-xl"></i>
                    <span class="text-sm font-semibold text-green-500 hidden md:block">+5%</span>
                </div>
                <p class="text-sm text-gray-500 mt-2">Active Subs</p>
                <p class="text-2xl font-extrabold text-brand-blue">1,450</p>
            </div>

            <!-- Card 4: Revenue This Month -->
            <div class="p-4 bg-white rounded-2xl shadow-soft">
                <div class="flex items-center justify-between">
                    <i class="fas fa-money-bill-wave text-2xl text-brand-teal p-3 bg-brand-teal/10 rounded-xl"></i>
                    <span class="text-sm font-semibold text-green-500 hidden md:block">+2.5%</span>
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

            <!-- Card 6: Out of Stock Items -->
            <div class="p-4 bg-white rounded-2xl shadow-soft">
                <div class="flex items-center justify-between">
                    <i class="fas fa-exclamation-triangle text-2xl text-brand-red p-3 bg-brand-red/10 rounded-xl"></i>
                    <span class="text-sm text-gray-500 hidden md:block">Critical</span>
                </div>
                <p class="text-sm text-gray-500 mt-2">Out of Stock</p>
                <p class="text-2xl font-extrabold text-brand-blue">11</p>
            </div>
        </div>

        <!-- 4. Sales & Orders Analytics Section (2-Column Layout) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            
            <!-- Sales Line Chart (Main Area) -->
            <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-soft">
                <h3 class="text-xl font-semibold mb-2 text-brand-blue">Revenue Over 30 Days</h3>
                <p class="text-sm text-gray-500 mb-4">Total revenue generated: ₦15,489,000</p>
                <!-- Chart Placeholder -->
                <div class="chart-placeholder h-72 rounded-xl">
                    <i class="fas fa-chart-line mr-2"></i> Placeholder: Large Sales Line Chart (Teal & Blue)
                </div>
                <div class="flex justify-end mt-3 space-x-2">
                    <button class="text-xs text-brand-blue px-3 py-1 rounded-lg bg-brand-grey hover:bg-brand-blue/10">7 Days</button>
                    <button class="text-xs text-white px-3 py-1 rounded-lg bg-brand-teal">30 Days</button>
                    <button class="text-xs text-brand-blue px-3 py-1 rounded-lg bg-brand-grey hover:bg-brand-blue/10">Year</button>
                </div>
            </div>

            <!-- Revenue Breakdown (Donut Chart) -->
            <div class="bg-white p-6 rounded-2xl shadow-soft">
                <h3 class="text-xl font-semibold mb-4 text-brand-blue">Revenue Breakdown</h3>
                <!-- Chart Placeholder -->
                <div class="chart-placeholder h-40 rounded-xl mb-4">
                    <i class="fas fa-chart-pie mr-2"></i> Placeholder: Donut Chart (Packages vs. Add-ons)
                </div>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between items-center">
                        <span class="flex items-center"><span class="w-2 h-2 rounded-full bg-brand-blue mr-2"></span> Package Subscriptions</span>
                        <span class="font-bold">65%</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="flex items-center"><span class="w-2 h-2 rounded-full bg-brand-teal mr-2"></span> Custom Orders</span>
                        <span class="font-bold">25%</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="flex items-center"><span class="w-2 h-2 rounded-full bg-brand-gold mr-2"></span> Premium Add-ons</span>
                        <span class="font-bold">10%</span>
                    </div>
                </div>
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
                        <!-- Row 1 -->
                        <tr class="hover:bg-brand-grey transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Order ID">#FB9001</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Customer">Ngozi A.</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Package">Standard Basic</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Amount">₦15,000</td>
                            <td class="px-6 py-4 whitespace-nowrap" data-label="Status">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Delivered</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Date">1 hour ago</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Action">
                                <button class="text-brand-teal hover:text-brand-blue transition-colors">View</button>
                            </td>
                        </tr>
                         <!-- Row 2 -->
                        <tr class="hover:bg-brand-grey transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Order ID">#FB9002</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Customer">Kunle D.</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Package">Premium Family</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Amount">₦45,500</td>
                            <td class="px-6 py-4 whitespace-nowrap" data-label="Status">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Processing</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Date">2 hours ago</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Action">
                                <button class="text-brand-teal hover:text-brand-blue transition-colors">View</button>
                            </td>
                        </tr>
                         <!-- Row 3 -->
                        <tr class="hover:bg-brand-grey transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Order ID">#FB9003</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Customer">Jane I.</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Package">Starter Pack</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Amount">₦8,500</td>
                            <td class="px-6 py-4 whitespace-nowrap" data-label="Status">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Cancelled</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Date">1 day ago</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Action">
                                <button class="text-brand-teal hover:text-brand-blue transition-colors">View</button>
                            </td>
                        </tr>
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
                    
                    <!-- Package Card 1 -->
                    <div class="bg-white p-4 rounded-2xl shadow-soft flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <img src="https://placehold.co/60x60/2A9D8F/FFFFFF?text=P1" onerror="this.onerror=null; this.src='https://placehold.co/60x60/2A9D8F/FFFFFF?text=P1';" alt="Package 1" class="w-16 h-16 rounded-xl object-cover ring-1 ring-brand-teal/30">
                            <div>
                                <p class="font-bold text-brand-blue">The Family Deluxe</p>
                                <p class="text-sm text-gray-500">₦45,500 <span class="font-semibold text-brand-teal ml-2">2,100 Sold</span></p>
                            </div>
                        </div>
                        <button class="text-brand-gold hover:text-brand-orange transition-colors p-2 rounded-full">
                            <i class="fas fa-edit"></i>
                        </button>
                    </div>

                    <!-- Package Card 2 -->
                    <div class="bg-white p-4 rounded-2xl shadow-soft flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <img src="https://placehold.co/60x60/264653/FFFFFF?text=P2" onerror="this.onerror=null; this.src='https://placehold.co/60x60/264653/FFFFFF?text=P2';" alt="Package 2" class="w-16 h-16 rounded-xl object-cover ring-1 ring-brand-blue/30">
                            <div>
                                <p class="font-bold text-brand-blue">Standard Basic</p>
                                <p class="text-sm text-gray-500">₦15,000 <span class="font-semibold text-brand-teal ml-2">1,580 Sold</span></p>
                            </div>
                        </div>
                        <button class="text-brand-gold hover:text-brand-orange transition-colors p-2 rounded-full">
                            <i class="fas fa-edit"></i>
                        </button>
                    </div>

                    <!-- Package Card 3 -->
                    <div class="bg-white p-4 rounded-2xl shadow-soft flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <img src="https://placehold.co/60x60/F4A261/FFFFFF?text=P3" onerror="this.onerror=null; this.src='https://placehold.co/60x60/F4A261/FFFFFF?text=P3';" alt="Package 3" class="w-16 h-16 rounded-xl object-cover ring-1 ring-brand-orange/30">
                            <div>
                                <p class="font-bold text-brand-blue">Student Starter</p>
                                <p class="text-sm text-gray-500">₦8,500 <span class="font-semibold text-brand-teal ml-2">890 Sold</span></p>
                            </div>
                        </div>
                        <button class="text-brand-gold hover:text-brand-orange transition-colors p-2 rounded-full">
                            <i class="fas fa-edit"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- System Activity Log -->
            <div>
                <h3 class="text-xl font-semibold mb-4 text-brand-blue">System Activity Log</h3>
                <div class="bg-white p-6 rounded-2xl shadow-soft h-full">
                    <ul class="space-y-4 text-sm">
                        <!-- Activity 1: Order Update (Teal) -->
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-check-circle mt-1 text-brand-teal"></i>
                            <div>
                                <p class="text-brand-blue font-medium">Order <span class="font-bold">#FB9001</span> marked as Delivered.</p>
                                <p class="text-xs text-gray-500">By Admin J. Okoro, 2 min ago.</p>
                            </div>
                        </li>
                        <!-- Activity 2: User Signup (Blue) -->
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-user-plus mt-1 text-brand-blue"></i>
                            <div>
                                <p class="text-brand-blue font-medium">New user registered: <span class="font-bold">Nneka G.</span></p>
                                <p class="text-xs text-gray-500">Via Mobile App, 5 min ago.</p>
                            </div>
                        </li>
                         <!-- Activity 3: Critical Error (Red) -->
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-bug mt-1 text-brand-red"></i>
                            <div>
                                <p class="text-brand-red font-medium">CRITICAL: Payment Gateway API Timeout.</p>
                                <p class="text-xs text-gray-500">System Alert, 10 min ago.</p>
                            </div>
                        </li>
                         <!-- Activity 4: Package Update (Gold) -->
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-cube mt-1 text-brand-gold"></i>
                            <div>
                                <p class="text-brand-blue font-medium">Package: Family Deluxe price updated to <span class="font-bold">₦45,500</span>.</p>
                                <p class="text-xs text-gray-500">By Admin S. Tobi, 30 min ago.</p>
                            </div>
                        </li>
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