<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory & Stock | FoodBox NG</title>
    
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

        <!-- Navigation Links (Highlight Inventory & Stock) -->
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
            <a href="superAdmin_delivery_logistics.html" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
                <i class="fas fa-route text-lg w-6 text-center"></i>
                <span>Delivery & Logistics</span>
            </a>
            <!-- NEW ACTIVE PAGE -->
            <a href="#" class="nav-link active flex items-center gap-4 text-white/90 font-semibold p-3 rounded-xl transition-all hover:bg-brand-blue/70">
                <i class="fas fa-warehouse text-lg w-6 text-center"></i>
                <span>Inventory & Stock</span>
            </a>
            <a href="superAdmin_subscriptions_management.html" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
                <i class="fas fa-sync-alt text-lg w-6 text-center"></i>
                <span>Subscriptions</span>
            </a>
            <a href="superAdmin_users_management.html" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl hover:bg-brand-blue/70 hover:text-white">
                <i class="fas fa-users text-lg w-6 text-center"></i>
                <span>Users Management</span>
            </a>
            <a href="superAdmin_admin_management.html" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl hover:bg-brand-blue/70 hover:text-white">
                <i class="fas fa-shield-alt text-lg w-6 text-center"></i>
                <span>Admin Management</span>
            </a>
            <a href="superAdmin_payments_transactions.html" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl hover:bg-brand-blue/70 hover:text-white">
                <i class="fas fa-wallet text-lg w-6 text-center"></i>
                <span>Payments & Funds</span>
            </a>
            <a href="superAdmin_system_settings.html" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl hover:bg-brand-blue/70 hover:text-white">
                <i class="fas fa-cog text-lg w-6 text-center"></i>
                <span>System Settings</span>
            </a>
        </nav>
    </aside>

    <!-- 2. Top Header -->
    <header class="fixed top-0 right-0 w-full lg:w-[calc(100%-16rem)] h-20 bg-white border-b border-gray-100 shadow-soft z-30 flex items-center px-4 md:px-8 justify-between">
        <h1 class="text-xl font-bold text-brand-blue">Inventory & Stock Management</h1>
        
        <!-- Right Side Actions -->
        <div class="flex items-center space-x-4">
            
            <!-- Notifications Bell -->
            <button class="p-2 rounded-full text-gray-500 hover:bg-brand-grey transition-colors relative">
                <i class="fas fa-bell text-lg"></i>
                <span class="absolute top-0.5 right-0.5 block h-2 w-2 rounded-full ring-2 ring-white bg-brand-orange"></span>
            </button>

            <!-- Quick Action Button: Audit Inventory -->
            <button onclick="quickAudit()" class="px-4 py-2 bg-brand-teal text-white font-semibold rounded-xl hover:bg-brand-teal/90 transition-colors shadow-sm-brand flex items-center gap-2">
                <i class="fas fa-search"></i>
                <span class="hidden md:inline">Quick Audit</span>
            </button>
            
            <!-- Profile Avatar -->
            <img src="https://placehold.co/36x36/E76F51/FFFFFF?text=SA" onerror="this.onerror=null; this.src='https://placehold.co/36x36/E76F51/FFFFFF?text=SA';" alt="Admin Avatar" class="w-9 h-9 rounded-full object-cover ring-2 ring-brand-blue/50 hidden sm:block">
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="lg:ml-64 p-4 md:p-8 main-content max-w-full">
        
        <!-- Inventory Quick-View Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
            
            <!-- Card 1: Total Stock Keeping Units (SKUs) -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-teal">
                <div class="flex items-center justify-between">
                    <i class="fas fa-boxes text-2xl text-brand-teal p-3 bg-brand-teal/10 rounded-xl"></i>
                    <p class="text-sm font-semibold text-gray-500">Active SKUs</p>
                </div>
                <p class="text-sm text-gray-500 mt-2">Total Unique Products</p>
                <p class="text-2xl font-extrabold text-brand-blue">485</p>
            </div>

            <!-- Card 2: Low Stock Items -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-orange">
                <div class="flex items-center justify-between">
                    <i class="fas fa-exclamation-circle text-2xl text-brand-orange p-3 bg-brand-orange/10 rounded-xl"></i>
                    <p class="text-sm font-semibold text-gray-500">Below Threshold</p>
                </div>
                <p class="text-sm text-gray-500 mt-2">Critical Restock Needed</p>
                <p class="text-2xl font-extrabold text-brand-blue">14</p>
            </div>

            <!-- Card 3: Stock Value -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-gold">
                <div class="flex items-center justify-between">
                    <i class="fas fa-coins text-2xl text-brand-gold p-3 bg-brand-gold/10 rounded-xl"></i>
                    <p class="text-sm font-semibold text-gray-500">Current Valuation</p>
                </div>
                <p class="text-sm text-gray-500 mt-2">Estimated Total Cost</p>
                <p class="text-2xl font-extrabold text-brand-blue">₦12.4M</p>
            </div>

            <!-- Card 4: Expired/Wastage -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-red">
                <div class="flex items-center justify-between">
                    <i class="fas fa-trash-alt text-2xl text-brand-red p-3 bg-brand-red/10 rounded-xl"></i>
                    <p class="text-sm font-semibold text-gray-500">Due/Expired (7 days)</p>
                </div>
                <p class="text-sm text-gray-500 mt-2">Immediate Disposal</p>
                <p class="text-2xl font-extrabold text-brand-blue">4 items</p>
            </div>
        </div>

        <!-- Main Layout: Alerts & Stock Table -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            
            <!-- Column 1: Stock Alerts Panel -->
            <div class="lg:col-span-1 bg-white p-6 rounded-2xl shadow-soft">
                <h3 class="text-xl font-semibold text-brand-blue mb-4 flex items-center gap-2">
                    <i class="fas fa-bell text-brand-orange"></i> Stock Alerts
                </h3>
                
                <div class="space-y-3">
                    
                    <!-- Alert 1: Critical Low Stock -->
                    <div class="p-3 border border-brand-red/50 rounded-xl bg-brand-red/10">
                        <p class="font-semibold text-sm text-brand-red">Critical Low Stock</p>
                        <p class="text-xs text-gray-700">SKU #1002 - Basmati Rice (5 units left)</p>
                        <button onclick="restockItem('1002')" class="mt-1 text-xs font-semibold text-white bg-brand-red px-3 py-1 rounded-lg hover:bg-brand-red/90 transition-colors">
                            <i class="fas fa-plus mr-1"></i> Restock
                        </button>
                    </div>

                    <!-- Alert 2: Due to Expire -->
                    <div class="p-3 border border-brand-orange/50 rounded-xl bg-brand-orange/10">
                        <p class="font-semibold text-sm text-brand-orange">Due to Expire</p>
                        <p class="text-xs text-gray-700">SKU #3045 - Fresh Milk (Expires in 3 days)</p>
                        <button onclick="manageExpiry('3045')" class="mt-1 text-xs font-semibold text-white bg-brand-orange px-3 py-1 rounded-lg hover:bg-brand-orange/90 transition-colors">
                            <i class="fas fa-tag mr-1"></i> Discount
                        </button>
                    </div>

                    <!-- Alert 3: Overstocked Item -->
                    <div class="p-3 border border-brand-teal/50 rounded-xl bg-brand-teal/10">
                        <p class="font-semibold text-sm text-brand-teal">High Stock Warning</p>
                        <p class="text-xs text-gray-700">SKU #5011 - Bottled Water (1,200 units)</p>
                        <button onclick="checkSalesRate('5011')" class="mt-1 text-xs font-semibold text-white bg-brand-teal px-3 py-1 rounded-lg hover:bg-brand-teal/90 transition-colors">
                            <i class="fas fa-chart-line mr-1"></i> Check Rate
                        </button>
                    </div>

                </div>
                
                <button onclick="viewAllAlerts()" class="w-full mt-4 py-2 text-brand-blue border border-brand-blue/30 font-bold rounded-xl hover:bg-brand-grey transition-colors text-sm">
                    View All 18 Alerts
                </button>
            </div>

            <!-- Column 2: Inventory List and Management -->
            <div class="lg:col-span-3 bg-white p-6 rounded-2xl shadow-soft">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 gap-4">
                    <h3 class="text-xl font-semibold text-brand-blue">Product Stock List</h3>
                    
                    <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                        <div class="relative w-full sm:w-64">
                            <input type="text" id="searchInput" placeholder="Search by SKU or Name..." class="w-full py-2 pl-10 pr-4 border border-gray-300 rounded-xl focus:border-brand-teal focus:ring-1 focus:ring-brand-teal text-sm">
                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                        <button onclick="addItem()" class="px-4 py-2 bg-brand-gold text-brand-blue font-semibold rounded-xl hover:bg-brand-gold/80 transition-colors shadow-sm flex items-center justify-center gap-2">
                            <i class="fas fa-cart-plus"></i>
                            <span>Add New Item</span>
                        </button>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 responsive-table">
                        <thead class="bg-brand-grey/50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKU</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Current Stock</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Restock</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            
                            <!-- Product 1 (Good Stock) -->
                            <tr class="hover:bg-brand-grey transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap" data-label="SKU">1001</td>
                                <td class="px-6 py-4 whitespace-nowrap" data-label="Product Name">Premium Groundnuts (5kg)</td>
                                <td class="px-6 py-4 whitespace-nowrap" data-label="Current Stock">
                                    <span class="font-bold text-brand-teal">245 units</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Last Restock">2024-10-20</td>
                                <td class="px-6 py-4 whitespace-nowrap" data-label="Status">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">In Stock</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2" data-label="Actions">
                                    <button onclick="editStock('1001')" class="text-brand-blue hover:text-brand-teal transition-colors text-sm font-semibold"><i class="fas fa-edit"></i> Edit</button>
                                    <button onclick="requestRestock('1001')" class="text-brand-gold hover:text-brand-gold/70 transition-colors text-sm font-semibold"><i class="fas fa-plus-square"></i> Order</button>
                                </td>
                            </tr>

                            <!-- Product 2 (Low Stock) -->
                            <tr class="hover:bg-brand-grey transition-colors bg-brand-orange/5">
                                <td class="px-6 py-4 whitespace-nowrap" data-label="SKU">1002</td>
                                <td class="px-6 py-4 whitespace-nowrap" data-label="Product Name">Imported Basmati Rice (10kg)</td>
                                <td class="px-6 py-4 whitespace-nowrap" data-label="Current Stock">
                                    <span class="font-bold text-brand-orange">5 units</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Last Restock">2024-08-15</td>
                                <td class="px-6 py-4 whitespace-nowrap" data-label="Status">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">Low Stock</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2" data-label="Actions">
                                    <button onclick="editStock('1002')" class="text-brand-blue hover:text-brand-teal transition-colors text-sm font-semibold"><i class="fas fa-edit"></i> Edit</button>
                                    <button onclick="requestRestock('1002')" class="text-brand-red hover:text-brand-red/70 transition-colors text-sm font-semibold"><i class="fas fa-exclamation-triangle"></i> URGENT Order</button>
                                </td>
                            </tr>
                            
                            <!-- Product 3 (Out of Stock) -->
                            <tr class="hover:bg-brand-grey transition-colors bg-brand-red/5">
                                <td class="px-6 py-4 whitespace-nowrap" data-label="SKU">2040</td>
                                <td class="px-6 py-4 whitespace-nowrap" data-label="Product Name">Frozen Tilapia Fillets (1kg)</td>
                                <td class="px-6 py-4 whitespace-nowrap" data-label="Current Stock">
                                    <span class="font-bold text-brand-red">0 units</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Last Restock">2024-10-01</td>
                                <td class="px-6 py-4 whitespace-nowrap" data-label="Status">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Out of Stock</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2" data-label="Actions">
                                    <button onclick="editStock('2040')" class="text-gray-400 cursor-not-allowed transition-colors text-sm font-semibold"><i class="fas fa-edit"></i> Edit</button>
                                    <button onclick="requestRestock('2040')" class="text-brand-teal hover:text-brand-teal/70 transition-colors text-sm font-semibold"><i class="fas fa-plus-square"></i> Re-Order</button>
                                </td>
                            </tr>

                            <!-- Product 4 (Near Expiry) -->
                            <tr class="hover:bg-brand-grey transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap" data-label="SKU">3045</td>
                                <td class="px-6 py-4 whitespace-nowrap" data-label="Product Name">Fresh Full Cream Milk (1L)</td>
                                <td class="px-6 py-4 whitespace-nowrap" data-label="Current Stock">
                                    <span class="font-bold text-brand-blue">80 units</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Last Restock">2024-11-10</td>
                                <td class="px-6 py-4 whitespace-nowrap" data-label="Status">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Near Exp.</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2" data-label="Actions">
                                    <button onclick="editStock('3045')" class="text-brand-blue hover:text-brand-teal transition-colors text-sm font-semibold"><i class="fas fa-edit"></i> Edit</button>
                                    <button onclick="manageExpiry('3045')" class="text-brand-orange hover:text-brand-orange/70 transition-colors text-sm font-semibold"><i class="fas fa-percent"></i> Promote</button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination Mockup -->
                <div class="flex justify-end items-center mt-4">
                    <p class="text-sm text-gray-600 mr-4 hidden sm:block">Showing 1 to 4 of 485 items</p>
                    <div class="flex space-x-1">
                        <button class="px-3 py-1 text-sm rounded-lg border border-gray-300 text-gray-600 hover:bg-brand-grey transition-colors cursor-not-allowed">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="px-3 py-1 text-sm rounded-lg bg-brand-blue text-white font-semibold">1</button>
                        <button class="px-3 py-1 text-sm rounded-lg border border-gray-300 text-gray-600 hover:bg-brand-grey transition-colors">2</button>
                        <button class="px-3 py-1 text-sm rounded-lg border border-gray-300 text-gray-600 hover:bg-brand-grey transition-colors">...</button>
                        <button class="px-3 py-1 text-sm rounded-lg border border-gray-300 text-gray-600 hover:bg-brand-grey transition-colors">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer Spacer -->
        <div class="h-12"></div>
    </main>

    <!-- JavaScript for Mobile Sidebar Toggle and Mock Actions -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('backdrop');

        // --- Mock Action Functions ---
        function quickAudit() {
            alertMessage('success', 'Full inventory count requested. Status update expected in 15 minutes.');
            console.log("Quick Audit requested.");
        }

        function addItem() {
            alertMessage('info', 'Opening form to add a new product/SKU to the inventory list.');
            console.log("Add New Item requested.");
        }

        function editStock(sku) {
            alertMessage('info', `Opening modal to adjust stock quantity and details for SKU #${sku}.`);
            console.log(`Edit Stock requested for SKU: ${sku}.`);
        }

        function requestRestock(sku) {
            alertMessage('info', `Restock request placed for SKU #${sku}. Dispatching purchase order.`);
            console.log(`Restock requested for SKU: ${sku}.`);
        }
        
        function manageExpiry(sku) {
             alertMessage('warning', `Actioning expiry management (e.g., promotional pricing) for SKU #${sku}.`);
            console.log(`Expiry Management requested for SKU: ${sku}.`);
        }
        
        function viewAllAlerts() {
            alertMessage('info', 'Redirecting to detailed Inventory Alerts Report page.');
            console.log("View All Alerts requested.");
        }
        
        function checkSalesRate(sku) {
            alertMessage('info', `Analyzing recent sales velocity for SKU #${sku} to determine optimal stock level.`);
            console.log(`Sales Rate Check requested for SKU: ${sku}.`);
        }


        // Simple custom alert/toast simulation (since alert() is forbidden)
        function alertMessage(type, message) {
            const container = document.body;
            let bgColor, icon;
            if (type === 'success') {
                bgColor = 'bg-brand-teal';
                icon = '<i class="fas fa-check-circle"></i>';
            } else if (type === 'warning') {
                bgColor = 'bg-brand-orange';
                icon = '<i class="fas fa-exclamation-triangle"></i>';
            } else if (type === 'red') {
                bgColor = 'bg-brand-red';
                icon = '<i class="fas fa-times-circle"></i>';
            } else {
                bgColor = 'bg-brand-blue';
                icon = '<i class="fas fa-info-circle"></i>';
            }

            const alertDiv = document.createElement('div');
            alertDiv.className = `fixed top-4 right-4 p-4 rounded-xl text-white shadow-lg flex items-center space-x-3 transition-transform duration-500 transform translate-x-full ${bgColor}`;
            alertDiv.innerHTML = `${icon} <span class="font-semibold">${message}</span>`;
            
            container.appendChild(alertDiv);
            
            // Show the toast
            setTimeout(() => {
                alertDiv.classList.remove('translate-x-full');
            }, 50);

            // Hide and remove the toast
            setTimeout(() => {
                alertDiv.classList.add('translate-x-full');
                alertDiv.addEventListener('transitionend', () => alertDiv.remove());
            }, 3000);
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