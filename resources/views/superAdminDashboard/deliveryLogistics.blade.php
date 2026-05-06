<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Logistics | FoodBox NG</title>
    
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

        /* Active Sidebar Link - Custom addition for Delivery Logistics */
        .nav-link.active {
            background-color: #3B5F6C;
            color: #E9C46A;
            border-left: 4px solid #2A9D8F;
            padding-left: 1.75rem;
        }
        .nav-link:not(.active) {
            border-left: 4px solid transparent;
        }

        /* Map Simulation Style */
        .map-sim {
            background: linear-gradient(135deg, #e0f2f1 0%, #b2dfdb 100%);
            min-height: 400px;
            border: 1px solid #2A9D8F;
            position: relative;
            overflow: hidden;
        }
        .map-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: #264653;
            opacity: 0.8;
        }
        
        /* Responsive Table Styles (Optional: if needed for the driver table) */
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
    <main class="mt-20 p-4 md:p-8 main-content max-w-full">
        
        <!-- Logistics Quick-View Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
            
            <!-- Card 1: Deliveries Today -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-teal">
                <div class="flex items-center justify-between">
                    <i class="fas fa-truck text-2xl text-brand-teal p-3 bg-brand-teal/10 rounded-xl"></i>
                    <p class="text-sm font-semibold text-gray-500">Scheduled Today</p>
                </div>
                <p class="text-sm text-gray-500 mt-2">Total Deliveries</p>
                <p class="text-2xl font-extrabold text-brand-blue">124</p>
            </div>

            <!-- Card 2: Drivers Active -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-blue">
                <div class="flex items-center justify-between">
                    <i class="fas fa-motorcycle text-2xl text-brand-blue p-3 bg-brand-blue/10 rounded-xl"></i>
                    <p class="text-sm font-semibold text-gray-500">Live on Road</p>
                </div>
                <p class="text-sm text-gray-500 mt-2">Active Drivers</p>
                <p class="text-2xl font-extrabold text-brand-blue">15 / 18</p>
            </div>

            <!-- Card 3: Avg. Delivery Time -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-gold">
                <div class="flex items-center justify-between">
                    <i class="fas fa-clock text-2xl text-brand-gold p-3 bg-brand-gold/10 rounded-xl"></i>
                    <p class="text-sm font-semibold text-gray-500">Last 7 Days</p>
                </div>
                <p class="text-sm text-gray-500 mt-2">Average Time</p>
                <p class="text-2xl font-extrabold text-brand-blue">45 min</p>
            </div>

            <!-- Card 4: Failed Deliveries -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-red">
                <div class="flex items-center justify-between">
                    <i class="fas fa-exclamation-circle text-2xl text-brand-red p-3 bg-brand-red/10 rounded-xl"></i>
                    <p class="text-sm font-semibold text-gray-500">Need Attention</p>
                </div>
                <p class="text-sm text-gray-500 mt-2">Failed (24hrs)</p>
                <p class="text-2xl font-extrabold text-brand-blue">2</p>
            </div>
        </div>

        <!-- Main Layout: Map & Dispatch Console -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Column 1: Live Map Simulation -->
            <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-soft">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold text-brand-blue">Live Route Tracker</h3>
                    <button class="text-brand-teal hover:text-brand-blue text-sm font-semibold" onclick="alertMessage('info', 'Refreshing map data...')">
                        <i class="fas fa-redo-alt mr-1"></i> Refresh
                    </button>
                </div>
                
                <div class="map-sim rounded-xl flex items-center justify-center">
                    <div class="map-overlay">
                        <i class="fas fa-map-marked-alt text-6xl mb-3"></i>
                        <p class="text-lg font-semibold">Simulated Live Map View</p>
                        <p class="text-sm text-gray-600">Showing 15 active drivers and 24 live orders.</p>
                        <div class="mt-4 flex justify-center space-x-4">
                            <!-- Visual Markers Simulation -->
                            <span class="p-2 rounded-full bg-brand-teal text-white text-xs font-bold">15 Drivers</span>
                            <span class="p-2 rounded-full bg-brand-orange text-white text-xs font-bold">4 Late</span>
                            <span class="p-2 rounded-full bg-brand-red text-white text-xs font-bold">1 Emergency</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Column 2: Dispatch Console / New Orders -->
            <div class="bg-white p-6 rounded-2xl shadow-soft">
                <h3 class="text-xl font-semibold text-brand-blue mb-4">Unassigned Orders (4)</h3>
                
                <div class="space-y-4 max-h-96 overflow-y-auto">
                    
                    <!-- Order 1 -->
                    <div class="p-3 border border-brand-grey rounded-xl bg-brand-grey/50">
                        <p class="font-semibold text-sm">#ORD-9021 <span class="text-brand-red ml-2">URGENT</span></p>
                        <p class="text-xs text-gray-600">Lekki Phase 1 - 3.4 km</p>
                        <p class="text-xs text-brand-blue font-medium mt-1">Weight: 5.2 kg | 2 Items</p>
                        <button onclick="assignOrder('9021')" class="mt-2 text-xs font-semibold text-white bg-brand-blue px-3 py-1 rounded-lg hover:bg-brand-teal transition-colors">
                            <i class="fas fa-route mr-1"></i> Assign Now
                        </button>
                    </div>

                    <!-- Order 2 -->
                    <div class="p-3 border border-brand-grey rounded-xl">
                        <p class="font-semibold text-sm">#ORD-9022</p>
                        <p class="text-xs text-gray-600">Victoria Island - 8.1 km</p>
                        <p class="text-xs text-brand-blue font-medium mt-1">Weight: 2.1 kg | 1 Item</p>
                        <button onclick="assignOrder('9022')" class="mt-2 text-xs font-semibold text-white bg-brand-blue px-3 py-1 rounded-lg hover:bg-brand-teal transition-colors">
                            <i class="fas fa-route mr-1"></i> Assign Now
                        </button>
                    </div>

                    <!-- Order 3 -->
                    <div class="p-3 border border-brand-grey rounded-xl">
                        <p class="font-semibold text-sm">#ORD-9023</p>
                        <p class="text-xs text-gray-600">Ikoyi - 6.5 km</p>
                        <p class="text-xs text-brand-blue font-medium mt-1">Weight: 4.0 kg | 3 Items</p>
                        <button onclick="assignOrder('9023')" class="mt-2 text-xs font-semibold text-white bg-brand-blue px-3 py-1 rounded-lg hover:bg-brand-teal transition-colors">
                            <i class="fas fa-route mr-1"></i> Assign Now
                        </button>
                    </div>

                     <!-- Order 4 -->
                    <div class="p-3 border border-brand-grey rounded-xl">
                        <p class="font-semibold text-sm">#ORD-9024</p>
                        <p class="text-xs text-gray-600">Yaba - 15.0 km</p>
                        <p class="text-xs text-brand-blue font-medium mt-1">Weight: 7.8 kg | 4 Items</p>
                        <button onclick="assignOrder('9024')" class="mt-2 text-xs font-semibold text-white bg-brand-blue px-3 py-1 rounded-lg hover:bg-brand-teal transition-colors">
                            <i class="fas fa-route mr-1"></i> Assign Now
                        </button>
                    </div>

                </div>
                
                <button onclick="bulkDispatch()" class="w-full mt-4 py-2 bg-brand-gold text-brand-blue font-bold rounded-xl hover:bg-brand-gold/80 transition-colors shadow-sm">
                    Bulk Dispatch All
                </button>
            </div>
        </div>

        <!-- Active Drivers Tracking Table -->
        <div class="bg-white p-6 rounded-2xl shadow-soft overflow-x-auto mt-6">
            <h3 class="text-xl font-semibold text-brand-blue mb-4">Active Driver Status</h3>
            
            <table class="min-w-full divide-y divide-gray-200 responsive-table">
                <thead class="bg-brand-grey/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Driver</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Route ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Orders Left</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    
                    <!-- Driver 1 (On Time) -->
                    <tr class="hover:bg-brand-grey transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap" data-label="Driver">
                            <p class="text-sm font-semibold">Bisi Kazeem</p>
                            <p class="text-xs text-gray-500">ID: D_1001</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Route ID">R-305 (Central)</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Orders Left">
                            <span class="font-bold text-brand-teal">2 / 5</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap" data-label="Status">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">En Route</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Location">On 3rd Mainland Bridge</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2" data-label="Actions">
                            <button onclick="viewRoute('R-305')" class="text-brand-blue hover:text-brand-teal transition-colors text-sm font-semibold"><i class="fas fa-eye"></i> Track</button>
                            <button onclick="messageDriver('D_1001')" class="text-brand-gold hover:text-brand-gold/70 transition-colors text-sm font-semibold"><i class="fas fa-sms"></i> Msg</button>
                        </td>
                    </tr>

                    <!-- Driver 2 (Late) -->
                    <tr class="hover:bg-brand-grey transition-colors bg-brand-orange/10">
                        <td class="px-6 py-4 whitespace-nowrap" data-label="Driver">
                            <p class="text-sm font-semibold">Chima Obi</p>
                            <p class="text-xs text-gray-500">ID: D_1002</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Route ID">R-412 (North East)</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Orders Left">
                            <span class="font-bold text-brand-red">1 / 4</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap" data-label="Status">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">Delayed (+20m)</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Location">Blocked Road near Agege</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2" data-label="Actions">
                            <button onclick="viewRoute('R-412')" class="text-brand-blue hover:text-brand-teal transition-colors text-sm font-semibold"><i class="fas fa-eye"></i> Track</button>
                            <button onclick="messageDriver('D_1002')" class="text-brand-red hover:text-brand-red/70 transition-colors text-sm font-semibold"><i class="fas fa-headset"></i> Call</button>
                        </td>
                    </tr>
                    
                    <!-- Driver 3 (Final Stop) -->
                    <tr class="hover:bg-brand-grey transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap" data-label="Driver">
                            <p class="text-sm font-semibold">Tayo Adeniyi</p>
                            <p class="text-xs text-gray-500">ID: D_1003</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Route ID">R-201 (South West)</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Orders Left">
                            <span class="font-bold text-brand-blue">0 / 6</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap" data-label="Status">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Completed</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Location">Returning to Depot</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2" data-label="Actions">
                            <button onclick="viewRoute('R-201')" class="text-gray-400 cursor-not-allowed transition-colors text-sm font-semibold"><i class="fas fa-eye"></i> Track</button>
                            <button onclick="messageDriver('D_1003')" class="text-brand-teal hover:text-brand-teal/70 transition-colors text-sm font-semibold"><i class="fas fa-user-check"></i> Debrief</button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        
        <!-- Footer Spacer -->
        <div class="h-12"></div>
    </main>

    <!-- JavaScript for Mobile Sidebar Toggle and Mock Actions -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('backdrop');

        // --- Mock Action Functions ---
        function optimizeRoutes() {
            alertMessage('success', 'Route optimization algorithm initiated. Checking for best paths...');
            console.log("Route Optimization requested.");
        }

        function assignOrder(id) {
            alertMessage('info', `Order ${id} is being manually assigned to the nearest available driver.`);
            console.log(`Assign Order requested for ID: ${id}.`);
        }

        function bulkDispatch() {
            alertMessage('success', '4 orders bulk dispatched using recommended routes.');
            console.log("Bulk Dispatch requested.");
        }
        
        function viewRoute(routeId) {
            alertMessage('info', `Displaying route map and history for ${routeId}.`);
            console.log(`View Route requested for ID: ${routeId}.`);
        }

        function messageDriver(driverId) {
            alertMessage('info', `Opening chat console for driver ${driverId}.`);
            console.log(`Message Driver requested for ID: ${driverId}.`);
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