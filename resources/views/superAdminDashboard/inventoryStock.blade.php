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
    @include('superAdminDashboard.aside')

    <!-- 2. Top Header -->
    @include('superAdminDashboard.header')

    <!-- Main Content Area -->
    <main class="mt-20 lg:ml-64 p-4 md:p-8 main-content max-w-full">
        
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-extrabold text-brand-blue">Package Items Management</h1>
                <p class="text-sm text-gray-500 mt-0.5">Configure and manage food items contained within subscription packages.</p>
            </div>
            <div class="flex gap-3">
                <button onclick="exportPackageList()" class="px-4 py-2 border border-brand-blue/20 text-brand-blue font-semibold rounded-xl hover:bg-brand-grey transition-colors flex items-center gap-2">
                    <i class="fas fa-download"></i>
                    <span>Export List</span>
                </button>
            </div>
        </div>

        <!-- Package Inventory Stats -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-teal">
                <div class="flex items-center justify-between">
                    <i class="fas fa-cubes text-2xl text-brand-teal p-3 bg-brand-teal/10 rounded-xl"></i>
                    <p class="text-sm font-semibold text-gray-500">Total Packages</p>
                </div>
                <p class="text-2xl font-extrabold text-brand-blue mt-2">{{ $packagesCount }}</p>
            </div>

            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-gold">
                <div class="flex items-center justify-between">
                    <i class="fas fa-utensils text-2xl text-brand-gold p-3 bg-brand-gold/10 rounded-xl"></i>
                    <p class="text-sm font-semibold text-gray-500">Unique Items</p>
                </div>
                <p class="text-2xl font-extrabold text-brand-blue mt-2">{{ $packageItems }}</p>
            </div>

            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-orange">
                <div class="flex items-center justify-between">
                    <i class="fas fa-exclamation-triangle text-2xl text-brand-orange p-3 bg-brand-orange/10 rounded-xl"></i>
                    <p class="text-sm font-semibold text-gray-500">Out of Stock</p>
                </div>
                <p class="text-2xl font-extrabold text-brand-blue mt-2">3 Items</p>
            </div>

            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-blue">
                <div class="flex items-center justify-between">
                    <i class="fas fa-sync text-2xl text-brand-blue p-3 bg-brand-blue/10 rounded-xl"></i>
                    <p class="text-sm font-semibold text-gray-500">Last Sync</p>
                </div>
                <p class="text-sm font-extrabold text-brand-blue mt-2">2 mins ago</p>
            </div>
        </div>

        <!-- Main Workspace Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            
            <!-- Left Column: Package Selection -->
            <div class="lg:col-span-1 space-y-4">
                <div class="bg-white p-5 rounded-2xl shadow-soft">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-bold text-brand-blue">Select Package</h3>
                        <span class="text-xs font-semibold px-2 py-1 bg-brand-grey rounded-lg text-gray-500">{{ $packagesCount }} Total</span>
                    </div>
                    
                    <!-- Search Packages -->
                    <div class="relative mb-4">
                        <input type="text" placeholder="Search packages..." class="w-full py-2 pl-9 pr-4 bg-brand-grey/50 border-none rounded-xl text-xs focus:ring-1 focus:ring-brand-teal">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                    </div>

                    <!-- Package List -->
                    <div class="space-y-2 max-h-[500px] overflow-y-auto pr-2 custom-scrollbar">
                        @foreach($packages as $index => $package)
                            @php
                                $category = strtolower($package->category);
                                $colorClass = match($category) {
                                    'family' => 'brand-teal',
                                    'solo' => 'gray-400',
                                    'premium' => 'brand-gold',
                                    'budget' => 'brand-orange',
                                    default => 'brand-blue'
                                };
                                $dotClass = match($category) {
                                    'family' => 'bg-brand-teal',
                                    'solo' => 'bg-gray-300',
                                    'premium' => 'bg-brand-gold',
                                    'budget' => 'bg-brand-orange',
                                    default => 'bg-brand-blue'
                                };
                                $icon = match($category) {
                                    'family' => 'fa-users',
                                    'solo' => 'fa-user',
                                    'premium' => 'fa-crown',
                                    'budget' => 'fa-wallet',
                                    default => 'fa-box'
                                };
                                $isActive = $index === 0; // Mark first as active for layout demo
                            @endphp
                            
                            <button onclick="selectPackage('{{ $package->id }}')" 
                                class="w-full text-left p-3 rounded-xl border-2 transition-all group {{ $isActive ? 'border-brand-teal bg-brand-teal/5' : 'border-transparent hover:border-brand-grey hover:bg-brand-grey/30' }}">
                                <div class="flex justify-between items-start">
                                    <span class="text-xs font-bold text-{{ $colorClass }} uppercase tracking-wider">{{ $package->category ?? 'General' }}</span>
                                    <span class="w-2 h-2 rounded-full {{ $dotClass }}"></span>
                                </div>
                                <h4 class="font-bold text-brand-blue text-sm mt-1 {{ !$isActive ? 'group-hover:text-brand-teal' : '' }} transition-colors">{{ $package->name }}</h4>
                                <p class="text-[10px] text-gray-500 mt-1 flex items-center gap-1">
                                    <i class="fas {{ $icon }}"></i> {{ number_format($package->subscriptions_count) }} Subscribers
                                </p>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Column: Package Content Management -->
            <div class="lg:col-span-3 space-y-6">
                
                <!-- Package Details Card -->
                <div class="bg-white rounded-2xl shadow-soft overflow-hidden">
                    <div class="p-6 border-b border-gray-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-brand-blue text-white">
                        <div>
                            @if($packages->isNotEmpty())
                                @php $firstPackage = $packages->first(); @endphp
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="px-2 py-0.5 bg-brand-teal/20 text-brand-teal text-[10px] font-bold rounded uppercase">Active Package</span>
                                    <span class="text-xs text-brand-gold font-semibold">PKG-{{ str_pad($firstPackage->id, 3, '0', STR_PAD_LEFT) }}</span>
                                </div>
                                <h2 class="text-xl font-bold">{{ $firstPackage->name }}</h2>
                                <p class="text-xs text-gray-300 mt-1">Manage items included in this subscription tier.</p>
                            @else
                                <h2 class="text-xl font-bold">No Packages Found</h2>
                                <p class="text-xs text-gray-300 mt-1">Please create a package to manage its items.</p>
                            @endif
                        </div>
                        <button onclick="addItemToPackage()" class="px-5 py-2.5 bg-brand-gold text-brand-blue font-bold rounded-xl hover:bg-brand-gold/90 transition-colors shadow-lg flex items-center gap-2 text-sm">
                            <i class="fas fa-plus-circle"></i>
                            <span>Add New Item</span>
                        </button>
                    </div>

                    <div class="p-6">
                        <!-- Filters & View Options -->
                        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
                            <div class="flex items-center gap-2 overflow-x-auto pb-2 sm:pb-0 w-full sm:w-auto">
                                <button class="px-4 py-1.5 text-xs font-bold rounded-lg bg-brand-blue text-white whitespace-nowrap">All Items ({{ $packageItems }})</button>
                            </div>
                            <div class="relative w-full sm:w-64">
                                <input type="text" placeholder="Search items in package..." class="w-full py-2 pl-10 pr-4 border border-gray-200 rounded-xl text-xs focus:border-brand-teal focus:ring-1 focus:ring-brand-teal">
                                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Items Table -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-100">
                                <thead class="bg-brand-grey/30">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Item Name</th>
                                        <th class="px-6 py-3 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Unit</th>
                                        <th class="px-6 py-3 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Quantity</th>
                                        <th class="px-6 py-3 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Estimated Price</th>
                                        <th class="px-6 py-3 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Last Modified</th>
                                        <th class="px-6 py-3 text-right text-[10px] font-bold text-gray-400 uppercase tracking-widest">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    <!-- Item 1 -->
                                    <tr class="hover:bg-brand-grey/20 transition-colors group">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-lg bg-brand-teal/10 flex items-center justify-center text-brand-teal font-bold text-sm">BR</div>
                                                <div>
                                                    <p class="text-sm font-bold text-brand-blue">Basmati Rice (5kg)</p>
                                                    <p class="text-[10px] text-gray-400">SKU: #1002</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 bg-blue-50 text-blue-600 text-[10px] font-bold rounded">Carbs</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 bg-blue-50 text-blue-600 text-[10px] font-bold rounded">20</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-1.5">
                                                <span class="w-1.5 h-1.5 rounded-full bg-brand-teal"></span>
                                                <span class="text-xs font-semibold text-brand-teal">₦245</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">24 Oct, 2024</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            <button onclick="removeItemFromPackage('1002')" class="p-2 text-brand-red hover:bg-brand-red/10 rounded-lg transition-colors opacity-0 group-hover:opacity-100" title="Remove from package">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Item 2 -->
                                    <tr class="hover:bg-brand-grey/20 transition-colors group">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-lg bg-brand-orange/10 flex items-center justify-center text-brand-orange font-bold text-sm">CH</div>
                                                <div>
                                                    <p class="text-sm font-bold text-brand-blue">Grilled Chicken Breast</p>
                                                    <p class="text-[10px] text-gray-400">SKU: #3045</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 bg-orange-50 text-orange-600 text-[10px] font-bold rounded">Protein</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 bg-orange-50 text-orange-600 text-[10px] font-bold rounded">2</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-1.5">
                                                <span class="w-1.5 h-1.5 rounded-full bg-brand-orange"></span>
                                                <span class="text-xs font-semibold text-brand-orange">₦150</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">22 Oct, 2024</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            <button onclick="removeItemFromPackage('3045')" class="p-2 text-brand-red hover:bg-brand-red/10 rounded-lg transition-colors opacity-0 group-hover:opacity-100" title="Remove from package">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Item 3 -->
                                    <tr class="hover:bg-brand-grey/20 transition-colors group">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-lg bg-brand-gold/10 flex items-center justify-center text-brand-gold font-bold text-sm">SM</div>
                                                <div>
                                                    <p class="text-sm font-bold text-brand-blue">Fresh Full Cream Milk</p>
                                                    <p class="text-[10px] text-gray-400">SKU: #2040</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 bg-yellow-50 text-yellow-600 text-[10px] font-bold rounded">Dairy</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 bg-yellow-50 text-yellow-600 text-[10px] font-bold rounded">10</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-1.5">
                                                <span class="w-1.5 h-1.5 rounded-full bg-brand-red"></span>
                                                <span class="text-xs font-semibold text-brand-red">₦150</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">20 Oct, 2024</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            <button onclick="removeItemFromPackage('2040')" class="p-2 text-brand-red hover:bg-brand-red/10 rounded-lg transition-colors opacity-0 group-hover:opacity-100" title="Remove from package">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Table Footer -->
                        <div class="mt-6 flex justify-between items-center pt-6 border-t border-gray-100">
                            <p class="text-xs text-gray-400">Showing 3 of 14 items in this package</p>
                            <button class="text-xs font-bold text-brand-teal hover:underline">View All Items <i class="fas fa-arrow-right ml-1"></i></button>
                        </div>
                    </div>
                </div>

                <!-- Bulk Actions / Tips -->
                <div class="bg-brand-teal/5 border border-brand-teal/10 p-4 rounded-2xl flex items-start gap-4">
                    <div class="w-10 h-10 bg-brand-teal/10 rounded-xl flex items-center justify-center shrink-0">
                        <i class="fas fa-lightbulb text-brand-teal"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-brand-blue text-sm">Quick Pro-Tip</h4>
                        <p class="text-xs text-gray-600 mt-1">You can drag and drop items between packages in the list to quickly re-assign them, or use the bulk editor for seasonal menu changes.</p>
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

        // --- Package Item Management Actions ---
        function selectPackage(pkgId) {
            // Mock switching packages
            const pkgNames = {
                'family-feast': 'Family Feast Weekly',
                'solo-standard': 'Solo Standard Monthly',
                'premium-gold': 'Premium Gold Weekend',
                'budget-basic': 'Budget Basic Weekly'
            };
            
            // In a real app, this would fetch the items for the package via AJAX
            alertMessage('info', `Switching to ${pkgNames[pkgId]} configuration...`);
            console.log(`Package selected: ${pkgId}`);
            
            // Visual feedback: would normally update the DOM with new data
        }

        function addItemToPackage() {
            alertMessage('info', 'Opening product catalog to select items for this package.');
            console.log("Add Item to Package requested.");
        }

        function removeItemFromPackage(sku) {
            if(confirm(`Are you sure you want to remove SKU #${sku} from this package?`)) {
                alertMessage('warning', `Item #${sku} removed from package.`);
                console.log(`Item removed: ${sku}`);
            }
        }

        function exportPackageList() {
            alertMessage('success', 'Preparing package inventory manifest for download...');
            console.log("Export requested.");
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
            alertDiv.className = `fixed top-4 right-4 z-[100] p-4 rounded-xl text-white shadow-lg flex items-center space-x-3 transition-transform duration-500 transform translate-x-full ${bgColor}`;
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