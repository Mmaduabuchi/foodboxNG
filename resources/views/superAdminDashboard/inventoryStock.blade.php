<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Inventory & Stock | FoodBox NG</title>
    
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
                    <i class="fas fa-box text-2xl text-brand-gold p-3 bg-brand-gold/10 rounded-xl"></i>
                    <p class="text-sm font-semibold text-gray-500">Sub Packages</p>
                </div>
                <p class="text-2xl font-extrabold text-brand-blue mt-2">{{ $subpackages }}</p>
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
                    <i class="fas fa-box text-2xl text-brand-blue p-3 bg-brand-blue/10 rounded-xl"></i>
                    <p class="text-sm font-semibold text-gray-500">Total Items</p>
                </div>
                <p class="text-2xl font-extrabold text-brand-blue mt-2">{{ $packageItems }}</p>
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

                    <!-- Search -->
                    <div class="relative mb-4">
                        <input type="text" id="packageSearch" onkeyup="searchPackageSidebar()" placeholder="Search packages..."
                            class="w-full py-2 pl-9 pr-4 bg-brand-grey/50 border-none rounded-xl text-xs focus:ring-1 focus:ring-brand-teal">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                    </div>

                    <!-- Package List -->
                    <div class="space-y-2 max-h-[500px] overflow-y-auto pr-2">
                        @foreach($packages as $index => $package)
                            @php
                                $category = strtolower($package->category);
                                $colorClass = match($category) {
                                    'family'   => 'brand-teal',
                                    'bachelor' => 'brand-orange',
                                    'student'  => 'brand-gold',
                                    default    => 'brand-blue'
                                };
                                $dotClass = match($category) {
                                    'family'   => 'bg-brand-teal',
                                    'bachelor' => 'bg-brand-orange',
                                    'student'  => 'bg-brand-gold',
                                    default    => 'bg-brand-blue'
                                };
                                $icon = match($category) {
                                    'family'   => 'fa-users',
                                    'bachelor' => 'fa-user-tie',
                                    'student'  => 'fa-graduation-cap',
                                    default    => 'fa-box'
                                };
                                $isActive = $index === 0;
                            @endphp

                            <button
                                onclick="selectPackage('{{ $package->id }}', '{{ addslashes($package->name) }}')"
                                class="package-sidebar-item w-full text-left p-3 rounded-xl border-2 transition-all group {{ $isActive ? 'border-brand-teal bg-brand-teal/5' : 'border-transparent hover:border-brand-grey hover:bg-brand-grey/30' }}"
                                data-package-id="{{ $package->id }}"
                                data-name="{{ strtolower($package->name) }}">

                                <div class="flex justify-between items-start">
                                    <span class="text-xs font-bold text-{{ $colorClass }} uppercase tracking-wider">
                                        {{ $package->category ?? 'General' }}
                                    </span>
                                    <span class="w-2 h-2 rounded-full {{ $dotClass }}"></span>
                                </div>
                                <h4 class="font-bold text-brand-blue text-sm mt-1 group-hover:text-brand-teal transition-colors">
                                    {{ $package->name }}
                                </h4>
                                <p class="text-[10px] text-gray-500 mt-1 flex items-center gap-1">
                                    <i class="fas {{ $icon }}"></i>
                                    {{ $package->sub_packages_count }} Sub Package(s)
                                </p>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>



            <!-- Right Column: Package Content Management -->
            <div class="lg:col-span-3 space-y-6">

                <!-- Header -->
                <div class="bg-white rounded-2xl shadow-soft overflow-hidden">
                    <div class="p-6 border-b border-gray-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-brand-blue text-white">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="px-2 py-0.5 bg-brand-teal/20 text-brand-teal text-[10px] font-bold rounded uppercase">Active Package</span>
                                <span class="text-xs text-brand-gold font-semibold" id="active-package-id">
                                    PKG-{{ str_pad($activePackage?->id, 3, '0', STR_PAD_LEFT) }}
                                </span>
                            </div>
                            <h2 class="text-xl font-bold" id="active-package-name">
                                {{ $activePackage?->name ?? 'No Package Selected' }}
                            </h2>
                            <p class="text-xs text-gray-300 mt-1">Select a sub-package below to view its items.</p>
                        </div>
                        <a href="#" id="add-subpackage-btn" onclick="openAddSubPackageModal(); return false;" class="px-5 py-2.5 bg-brand-gold text-brand-blue font-bold rounded-xl hover:bg-brand-gold/90 transition-colors shadow-lg flex items-center gap-2 text-sm">
                            <i class="fas fa-plus-circle"></i>
                            <span>Add Sub Package</span>
                        </a>
                    </div>

                    <!-- Sub Packages Grid -->
                    <div class="p-6">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Sub Packages</p>

                        <div id="subpackages-container" class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">
                            @forelse($activeSubPackages as $sub)
                                <div class="subpackage-card relative text-left p-4 rounded-2xl border-2 border-gray-100 hover:border-brand-teal hover:bg-brand-teal/5 transition-all group cursor-pointer"
                                    data-sub-id="{{ $sub->id }}"
                                    onclick="selectSubPackage('{{ $sub->id }}', '{{ addslashes($sub->name) }}')">
                                    <!-- Delete Button -->
                                    <button onclick="event.stopPropagation(); deleteSubPackage('{{ $sub->id }}', '{{ addslashes($sub->name) }}')" 
                                        class="absolute top-2.5 right-2.5 w-7 h-7 rounded-lg bg-brand-red/0 hover:bg-brand-red/10 text-gray-300 hover:text-brand-red flex items-center justify-center transition-all opacity-0 group-hover:opacity-100 z-10" 
                                        title="Delete sub package">
                                        <i class="fas fa-trash-alt text-xs"></i>
                                    </button>
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="w-10 h-10 rounded-xl bg-brand-teal/10 text-brand-teal flex items-center justify-center font-bold text-sm">
                                            {{ strtoupper(substr($sub->name, 0, 2)) }}
                                        </div>
                                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-brand-grey text-gray-500">
                                            {{ $sub->items->count() }} items
                                        </span>
                                    </div>
                                    <h5 class="font-bold text-brand-blue text-sm group-hover:text-brand-teal transition-colors">{{ $sub->name }}</h5>
                                    <p class="text-[10px] text-gray-400 mt-1">₦{{ number_format($sub->price) }} / {{ $sub->billing_cycle }}</p>
                                </div>
                            @empty
                                <div id="empty-subpackages" class="col-span-3 py-10 text-center text-gray-400">
                                    <i class="fas fa-box-open text-3xl mb-3 block"></i>
                                    <p class="text-sm">No sub packages found for this package.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Items Table (hidden until sub package is selected) -->
                <div id="items-section" class="bg-white rounded-2xl shadow-soft overflow-hidden hidden">
                    <div class="p-5 border-b border-gray-100 flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-400 uppercase font-bold tracking-widest">Items in</p>
                            <h3 class="font-bold text-brand-blue" id="active-subpackage-name">—</h3>
                        </div>
                        <button onclick="addItemToPackage()" class="px-4 py-2 bg-brand-teal text-white text-xs font-bold rounded-xl hover:bg-brand-blue transition-colors flex items-center gap-2">
                            <i class="fas fa-plus"></i> Add Item
                        </button>
                    </div>

                    <div class="p-6 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-100">
                            <thead class="bg-brand-grey/30">
                                <tr>
                                    <th class="px-6 py-3 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Item Name</th>
                                    <th class="px-6 py-3 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Unit</th>
                                    <th class="px-6 py-3 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Quantity</th>
                                    <th class="px-6 py-3 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Est. Price</th>
                                    <th class="px-6 py-3 text-left text-[10px] font-bold text-gray-400 uppercase tracking-widest">Last Modified</th>
                                    <th class="px-6 py-3 text-right text-[10px] font-bold text-gray-400 uppercase tracking-widest">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="items-table-body" class="divide-y divide-gray-100">
                                <!-- Dynamically populated via JS -->
                            </tbody>
                        </table>

                        <div id="items-empty" class="hidden py-10 text-center text-gray-400">
                            <i class="fas fa-inbox text-3xl mb-3 block"></i>
                            <p class="text-sm">No items found in this sub package.</p>
                        </div>
                    </div>
                </div>

                <!-- Pro Tip -->
                <div class="bg-brand-teal/5 border border-brand-teal/10 p-4 rounded-2xl flex items-start gap-4">
                    <div class="w-10 h-10 bg-brand-teal/10 rounded-xl flex items-center justify-center shrink-0">
                        <i class="fas fa-lightbulb text-brand-teal"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-brand-blue text-sm">Quick Tip</h4>
                        <p class="text-xs text-gray-600 mt-1">Click any package on the left to see its sub packages, then click a sub package to view and manage its items.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer Spacer -->
        <div class="h-12"></div>
    </main>

    <!-- Add Item Modal -->
    <div id="addItemModal" class="fixed inset-0 z-[100] hidden">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity" onclick="closeAddItemModal()"></div>

        <!-- Modal Content -->
        <div class="relative flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-3xl shadow-admin w-full max-w-lg overflow-hidden transform transition-all scale-95 opacity-0" id="addItemModalContent">
                <!-- Modal Header -->
                <div class="bg-brand-blue p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="px-2 py-0.5 bg-brand-teal/20 text-brand-teal text-[10px] font-bold rounded uppercase">New Item</span>
                            </div>
                            <h3 class="text-lg font-bold text-white">Add Item to Sub Package</h3>
                            <p class="text-xs text-gray-300 mt-1" id="modal-subpackage-label">Select a sub package first</p>
                        </div>
                        <button onclick="closeAddItemModal()" class="w-9 h-9 rounded-xl bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <form id="addItemForm" class="p-6 space-y-5">
                    <input type="hidden" id="modal_sub_package_id" name="sub_package_id" value="">

                    <!-- Item Name -->
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Item Name <span class="text-brand-red">*</span></label>
                        <div class="relative">
                            <i class="fas fa-tag absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                            <input type="text" name="item_name" id="modal_item_name" required placeholder="e.g. Rice, Beans, Chicken..."
                                class="w-full pl-10 pr-4 py-3 bg-brand-grey/50 border-2 border-transparent rounded-xl text-sm font-semibold text-brand-blue placeholder-gray-400 focus:border-brand-teal focus:bg-white focus:outline-none transition-all">
                        </div>
                    </div>

                    <!-- Quantity & Unit Row -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Quantity <span class="text-brand-red">*</span></label>
                            <div class="relative">
                                <i class="fas fa-sort-numeric-up absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                                <input type="number" name="quantity" id="modal_quantity" required min="1" value="1" placeholder="1"
                                    class="w-full pl-10 pr-4 py-3 bg-brand-grey/50 border-2 border-transparent rounded-xl text-sm font-semibold text-brand-blue placeholder-gray-400 focus:border-brand-teal focus:bg-white focus:outline-none transition-all">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Unit <span class="text-brand-red">*</span></label>
                            <div class="relative">
                                <i class="fas fa-balance-scale absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                                <select name="unit" id="modal_unit" required
                                    class="w-full pl-10 pr-4 py-3 bg-brand-grey/50 border-2 border-transparent rounded-xl text-sm font-semibold text-brand-blue focus:border-brand-teal focus:bg-white focus:outline-none transition-all appearance-none">
                                    <option value="" disabled selected>Select</option>
                                    <option value="pcs">Pieces (pcs)</option>
                                    <option value="kg">Kilograms (kg)</option>
                                    <option value="litres">Litres</option>
                                    <option value="packs">Packs</option>
                                    <option value="bottles">Bottles</option>
                                    <option value="bags">Bags</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Estimated Price -->
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Estimated Price (₦) <span class="text-brand-red">*</span></label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm font-bold">₦</span>
                            <input type="number" name="estimated_price" id="modal_estimated_price" required min="0" step="0.01" placeholder="5000"
                                class="w-full pl-10 pr-4 py-3 bg-brand-grey/50 border-2 border-transparent rounded-xl text-sm font-semibold text-brand-blue placeholder-gray-400 focus:border-brand-teal focus:bg-white focus:outline-none transition-all">
                        </div>
                    </div>

                    <!-- Error Message -->
                    <div id="modal-error" class="hidden p-3 bg-brand-red/10 border border-brand-red/20 rounded-xl text-brand-red text-xs font-semibold"></div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end gap-3 pt-2">
                        <button type="button" onclick="closeAddItemModal()" class="px-5 py-2.5 border-2 border-gray-200 text-gray-500 font-bold rounded-xl hover:bg-brand-grey transition-colors text-sm">
                            Cancel
                        </button>
                        <button type="submit" id="modal-submit-btn" class="px-6 py-2.5 bg-brand-teal text-white font-bold rounded-xl hover:bg-brand-blue transition-colors text-sm flex items-center gap-2 shadow-lg">
                            <i class="fas fa-plus"></i>
                            <span>Add Item</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Sub Package Modal -->
    <div id="addSubPackageModal" class="fixed inset-0 z-[100] hidden">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity" onclick="closeAddSubPackageModal()"></div>

        <!-- Modal Content -->
        <div class="relative flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-3xl shadow-admin w-full max-w-lg overflow-hidden transform transition-all scale-95 opacity-0" id="addSubPackageModalContent">
                <!-- Modal Header -->
                <div class="bg-brand-blue p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="px-2 py-0.5 bg-brand-gold/20 text-brand-gold text-[10px] font-bold rounded uppercase">New Sub Package</span>
                            </div>
                            <h3 class="text-lg font-bold text-white">Add Sub Package</h3>
                            <p class="text-xs text-gray-300 mt-1" id="subpkg-modal-package-label">Adding to current package</p>
                        </div>
                        <button onclick="closeAddSubPackageModal()" class="w-9 h-9 rounded-xl bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <form id="addSubPackageForm" class="p-6 space-y-5 max-h-[70vh] overflow-y-auto">
                    <input type="hidden" id="subpkg_package_id" name="package_id" value="">

                    <!-- Sub Package Name -->
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Sub Package Name <span class="text-brand-red">*</span></label>
                        <div class="relative">
                            <i class="fas fa-box absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                            <input type="text" name="name" id="subpkg_name" required placeholder="e.g. Basic Breakfast, Premium Lunch..."
                                class="w-full pl-10 pr-4 py-3 bg-brand-grey/50 border-2 border-transparent rounded-xl text-sm font-semibold text-brand-blue placeholder-gray-400 focus:border-brand-teal focus:bg-white focus:outline-none transition-all">
                        </div>
                    </div>

                    <!-- Price & Billing Cycle Row -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Price (₦) <span class="text-brand-red">*</span></label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm font-bold">₦</span>
                                <input type="number" name="price" id="subpkg_price" required min="0" step="0.01" placeholder="15000"
                                    class="w-full pl-10 pr-4 py-3 bg-brand-grey/50 border-2 border-transparent rounded-xl text-sm font-semibold text-brand-blue placeholder-gray-400 focus:border-brand-teal focus:bg-white focus:outline-none transition-all">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Billing Cycle <span class="text-brand-red">*</span></label>
                            <div class="relative">
                                <i class="fas fa-calendar-alt absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                                <select name="billing_cycle" id="subpkg_billing_cycle" required
                                    class="w-full pl-10 pr-4 py-3 bg-brand-grey/50 border-2 border-transparent rounded-xl text-sm font-semibold text-brand-blue focus:border-brand-teal focus:bg-white focus:outline-none transition-all appearance-none">
                                    <option value="" disabled selected>Select</option>
                                    <option value="daily">Daily</option>
                                    <option value="weekly">Weekly</option>
                                    <option value="monthly">Monthly</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Short Description -->
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Short Description <span class="text-brand-red">*</span></label>
                        <div class="relative">
                            <i class="fas fa-align-left absolute left-3.5 top-3.5 text-gray-400 text-sm"></i>
                            <input type="text" name="short_description" id="subpkg_short_desc" required placeholder="Brief tagline for this sub package" maxlength="150"
                                class="w-full pl-10 pr-4 py-3 bg-brand-grey/50 border-2 border-transparent rounded-xl text-sm font-semibold text-brand-blue placeholder-gray-400 focus:border-brand-teal focus:bg-white focus:outline-none transition-all">
                        </div>
                    </div>

                    <!-- Full Description -->
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Full Description <span class="text-brand-red">*</span></label>
                        <div class="relative">
                            <i class="fas fa-file-alt absolute left-3.5 top-3.5 text-gray-400 text-sm"></i>
                            <textarea name="description" id="subpkg_description" required rows="3" placeholder="Detailed description of what this sub package includes..."
                                class="w-full pl-10 pr-4 py-3 bg-brand-grey/50 border-2 border-transparent rounded-xl text-sm font-semibold text-brand-blue placeholder-gray-400 focus:border-brand-teal focus:bg-white focus:outline-none transition-all resize-none"></textarea>
                        </div>
                    </div>

                    <!-- Image Upload -->
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Image <span class="text-gray-400">(Optional)</span></label>
                        <div class="relative">
                            <label for="subpkg_image" class="flex items-center gap-3 w-full px-4 py-3 bg-brand-grey/50 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-brand-teal hover:bg-white transition-all">
                                <i class="fas fa-cloud-upload-alt text-gray-400 text-lg"></i>
                                <span class="text-sm text-gray-400 font-semibold" id="subpkg_image_label">Choose an image...</span>
                            </label>
                            <input type="file" name="image" id="subpkg_image" accept="image/*" class="hidden"
                                onchange="document.getElementById('subpkg_image_label').textContent = this.files[0]?.name || 'Choose an image...'">
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Status</label>
                        <div class="flex gap-3">
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="status" value="active" checked class="hidden peer">
                                <div class="peer-checked:border-brand-teal peer-checked:bg-brand-teal/5 peer-checked:text-brand-teal border-2 border-gray-200 rounded-xl py-2.5 text-center text-xs font-bold text-gray-400 transition-all">
                                    <i class="fas fa-check-circle mr-1"></i> Active
                                </div>
                            </label>
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="status" value="inactive" class="hidden peer">
                                <div class="peer-checked:border-brand-orange peer-checked:bg-brand-orange/5 peer-checked:text-brand-orange border-2 border-gray-200 rounded-xl py-2.5 text-center text-xs font-bold text-gray-400 transition-all">
                                    <i class="fas fa-pause-circle mr-1"></i> Inactive
                                </div>
                            </label>
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="status" value="draft" class="hidden peer">
                                <div class="peer-checked:border-brand-blue peer-checked:bg-brand-blue/5 peer-checked:text-brand-blue border-2 border-gray-200 rounded-xl py-2.5 text-center text-xs font-bold text-gray-400 transition-all">
                                    <i class="fas fa-pencil-alt mr-1"></i> Draft
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Error Message -->
                    <div id="subpkg-modal-error" class="hidden p-3 bg-brand-red/10 border border-brand-red/20 rounded-xl text-brand-red text-xs font-semibold"></div>

                    <!-- Success Message -->
                    <div id="subpkg-modal-success" class="hidden p-3 bg-brand-teal/10 border border-brand-teal/20 rounded-xl text-brand-teal text-xs font-semibold"></div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end gap-3 pt-2">
                        <button type="button" onclick="closeAddSubPackageModal()" class="px-5 py-2.5 border-2 border-gray-200 text-gray-500 font-bold rounded-xl hover:bg-brand-grey transition-colors text-sm">
                            Cancel
                        </button>
                        <button type="submit" id="subpkg-modal-submit-btn" class="px-6 py-2.5 bg-brand-gold text-brand-blue font-bold rounded-xl hover:bg-brand-gold/90 transition-colors text-sm flex items-center gap-2 shadow-lg">
                            <i class="fas fa-plus"></i>
                            <span>Create Sub Package</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript for Mobile Sidebar Toggle and Mock Actions -->
    <script>
        // All packages data from blade (passed as JSON for JS use)
        const allPackages = @json($packages);

        function searchPackageSidebar() {
            const query = document.getElementById('packageSearch').value.toLowerCase();
            document.querySelectorAll('.package-sidebar-item').forEach(item => {
                item.style.display = item.getAttribute('data-name').includes(query) ? 'block' : 'none';
            });
        }

        function selectPackage(packageId, packageName) {
            // Update active state on sidebar buttons
            document.querySelectorAll('.package-sidebar-item').forEach(btn => {
                const isActive = btn.getAttribute('data-package-id') == packageId;
                btn.classList.toggle('border-brand-teal', isActive);
                btn.classList.toggle('bg-brand-teal/5', isActive);
                btn.classList.toggle('border-transparent', !isActive);
            });

            // Update header
            document.getElementById('active-package-name').textContent = packageName;
            document.getElementById('active-package-id').textContent = 'PKG-' + String(packageId).padStart(3, '0');

            // Hide items section while switching
            document.getElementById('items-section').classList.add('hidden');

            // Fetch sub packages via AJAX
            fetch(`/admin/packages/${packageId}/subpackages`)
                .then(res => res.json())
                .then(data => {
                    renderSubPackages(data.subPackages);
                })
                .catch(() => alertMessage('red', 'Failed to load sub packages.'));
        }

        function renderSubPackages(subPackages) {
            const container = document.getElementById('subpackages-container');
            container.innerHTML = '';

            if (subPackages.length === 0) {
                container.innerHTML = `
                    <div class="col-span-3 py-10 text-center text-gray-400">
                        <i class="fas fa-box-open text-3xl mb-3 block"></i>
                        <p class="text-sm">No sub packages found for this package.</p>
                    </div>`;
                return;
            }

            subPackages.forEach(sub => {
                container.innerHTML += `
                    <div class="subpackage-card relative text-left p-4 rounded-2xl border-2 border-gray-100 hover:border-brand-teal hover:bg-brand-teal/5 transition-all group cursor-pointer"
                        data-sub-id="${sub.id}"
                        onclick="selectSubPackage(${sub.id}, '${sub.name.replace(/'/g, "\\\'")}')">
                        <button onclick="event.stopPropagation(); deleteSubPackage(${sub.id}, '${sub.name.replace(/'/g, "\\\'")}')" 
                            class="absolute top-2.5 right-2.5 w-7 h-7 rounded-lg bg-brand-red/0 hover:bg-brand-red/10 text-gray-300 hover:text-brand-red flex items-center justify-center transition-all opacity-0 group-hover:opacity-100 z-10" 
                            title="Delete sub package">
                            <i class="fas fa-trash-alt text-xs"></i>
                        </button>
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-10 h-10 rounded-xl bg-brand-teal/10 text-brand-teal flex items-center justify-center font-bold text-sm">
                                ${sub.name.substring(0, 2).toUpperCase()}
                            </div>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-brand-grey text-gray-500">
                                ${sub.items_count} items
                            </span>
                        </div>
                        <h5 class="font-bold text-[#264653] text-sm group-hover:text-[#2A9D8F] transition-colors">${sub.name}</h5>
                        <p class="text-[10px] text-gray-400 mt-1">₦${Number(sub.price).toLocaleString()} / ${sub.billing_cycle}</p>
                    </div>`;
            });
        }

        function selectSubPackage(subId, subName) {
            // Track current selection for modal
            currentSubPackageId = subId;
            currentSubPackageName = subName;

            // Update active state on sub package cards
            document.querySelectorAll('.subpackage-card').forEach(card => {
                const isActive = card.getAttribute('data-sub-id') == subId;
                card.classList.toggle('border-brand-teal', isActive);
                card.classList.toggle('bg-brand-teal/5', isActive);
                card.classList.toggle('border-gray-100', !isActive);
            });

            document.getElementById('active-subpackage-name').textContent = subName;
            document.getElementById('items-section').classList.remove('hidden');
            document.getElementById('items-table-body').innerHTML = `
                <tr><td colspan="6" class="text-center py-8 text-gray-400 text-sm">
                    <i class="fas fa-spinner fa-spin mr-2"></i> Loading items...
                </td></tr>`;

            // Fetch items via AJAX
            fetch(`/admin/subpackages/${subId}/items`)
                .then(res => res.json())
                .then(data => renderItems(data.items))
                .catch(() => alertMessage('red', 'Failed to load items.'));
        }

        function renderItems(items) {
            const tbody = document.getElementById('items-table-body');
            const empty = document.getElementById('items-empty');
            tbody.innerHTML = '';

            if (items.length === 0) {
                empty.classList.remove('hidden');
                return;
            }

            empty.classList.add('hidden');
            items.forEach(item => {
                const initials = item.item_name.split(' ').map(w => w[0]).join('').substring(0, 2).toUpperCase();
                tbody.innerHTML += `
                    <tr class="hover:bg-brand-grey/20 transition-colors group">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-brand-teal/10 flex items-center justify-center text-brand-teal font-bold text-sm">${initials}</div>
                                <div>
                                    <p class="text-sm font-bold text-brand-blue">${item.item_name}</p>
                                    <p class="text-[10px] text-gray-400">ID: #${item.id}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 bg-brand-grey text-brand-blue text-[10px] font-bold rounded">${item.unit ?? '—'}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 bg-brand-teal/10 text-brand-teal text-[10px] font-bold rounded">${item.quantity}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-brand-teal"></span>
                                <span class="text-xs font-semibold text-brand-teal">₦${Number(item.estimated_price).toLocaleString()}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">
                            ${new Date(item.updated_at).toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' })}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <button onclick="removeItemFromPackage(this, ${item.id}, '${item.item_name.replace(/'/g, "\\\'")}')" 
                                class="p-2 text-brand-red hover:bg-brand-red/10 rounded-lg transition-colors opacity-0 group-hover:opacity-100" title="Remove item">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>`;
            });
        }

        // --- Currently selected sub package ID ---
        let currentSubPackageId = null;
        let currentSubPackageName = null;

        // --- Add Item Modal Functions ---
        function addItemToPackage() {
            if (!currentSubPackageId) {
                alert('Please select a sub package first.');
                return;
            }
            document.getElementById('modal_sub_package_id').value = currentSubPackageId;
            document.getElementById('modal-subpackage-label').textContent = 'Adding to: ' + currentSubPackageName;
            document.getElementById('modal-error').classList.add('hidden');
            document.getElementById('addItemForm').reset();
            document.getElementById('modal_sub_package_id').value = currentSubPackageId;

            const modal = document.getElementById('addItemModal');
            const content = document.getElementById('addItemModalContent');
            modal.classList.remove('hidden');
            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeAddItemModal() {
            const content = document.getElementById('addItemModalContent');
            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                document.getElementById('addItemModal').classList.add('hidden');
            }, 200);
        }

        // Handle form submission
        document.getElementById('addItemForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = document.getElementById('modal-submit-btn');
            const errorDiv = document.getElementById('modal-error');
            errorDiv.classList.add('hidden');

            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Saving...</span>';

            const formData = new FormData(this);

            fetch('/admin/subpackages/items/store', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    closeAddItemModal();
                    // Refresh items table
                    selectSubPackage(currentSubPackageId, currentSubPackageName);
                } else {
                    errorDiv.textContent = data.message || 'Something went wrong.';
                    errorDiv.classList.remove('hidden');
                }
            })
            .catch(() => {
                errorDiv.textContent = 'Network error. Please try again.';
                errorDiv.classList.remove('hidden');
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-plus"></i> <span>Add Item</span>';
            });
        });

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeAddItemModal();
                closeAddSubPackageModal();
            }
        });

        // --- Add Sub Package Modal Functions ---
        function getActivePackageId() {
            const idText = document.getElementById('active-package-id').textContent.trim();
            // Extract numeric ID from 'PKG-001' format
            return parseInt(idText.replace('PKG-', ''), 10);
        }

        function openAddSubPackageModal() {
            const packageId = getActivePackageId();
            const packageName = document.getElementById('active-package-name').textContent.trim();

            if (!packageId || isNaN(packageId)) {
                alert('Please select a package first.');
                return;
            }

            document.getElementById('subpkg_package_id').value = packageId;
            document.getElementById('subpkg-modal-package-label').textContent = 'Adding to: ' + packageName;
            document.getElementById('subpkg-modal-error').classList.add('hidden');
            document.getElementById('subpkg-modal-success').classList.add('hidden');
            document.getElementById('addSubPackageForm').reset();
            document.getElementById('subpkg_package_id').value = packageId;
            document.getElementById('subpkg_image_label').textContent = 'Choose an image...';

            const modal = document.getElementById('addSubPackageModal');
            const content = document.getElementById('addSubPackageModalContent');
            modal.classList.remove('hidden');
            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeAddSubPackageModal() {
            const content = document.getElementById('addSubPackageModalContent');
            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                document.getElementById('addSubPackageModal').classList.add('hidden');
            }, 200);
        }

        // Handle sub package form submission
        document.getElementById('addSubPackageForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = document.getElementById('subpkg-modal-submit-btn');
            const errorDiv = document.getElementById('subpkg-modal-error');
            const successDiv = document.getElementById('subpkg-modal-success');
            errorDiv.classList.add('hidden');
            successDiv.classList.add('hidden');

            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Creating...</span>';

            const formData = new FormData(this);

            fetch('/admin/subpackages/store', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    successDiv.textContent = data.message || 'Sub package created successfully!';
                    successDiv.classList.remove('hidden');
                    // Refresh sub packages after a brief delay
                    const packageId = document.getElementById('subpkg_package_id').value;
                    const packageName = document.getElementById('active-package-name').textContent.trim();
                    setTimeout(() => {
                        closeAddSubPackageModal();
                        selectPackage(packageId, packageName);
                    }, 800);
                } else {
                    // Handle validation errors
                    if (data.errors) {
                        const messages = Object.values(data.errors).flat().join(', ');
                        errorDiv.textContent = messages;
                    } else {
                        errorDiv.textContent = data.message || 'Something went wrong.';
                    }
                    errorDiv.classList.remove('hidden');
                }
            })
            .catch(() => {
                errorDiv.textContent = 'Network error. Please try again.';
                errorDiv.classList.remove('hidden');
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-plus"></i> <span>Create Sub Package</span>';
            });
        });

        // --- Delete Sub Package ---
        function deleteSubPackage(subId, subName) {
            Swal.fire({
                title: 'Delete Sub Package?',
                html: `Are you sure you want to delete <strong>"${subName}"</strong>? This will also remove all items inside it.<br><br><span style="color: #E76F51; font-weight: 600;">This action cannot be undone.</span>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#E76F51',
                cancelButtonColor: '#264653',
                confirmButtonText: '<i class="fas fa-trash-alt mr-1"></i> Yes, delete it',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                focusCancel: true,
            }).then((result) => {
                if (!result.isConfirmed) return;

                // Find and animate the card being deleted
                const card = document.querySelector(`.subpackage-card[data-sub-id="${subId}"]`);
                if (card) {
                    card.style.opacity = '0.5';
                    card.style.pointerEvents = 'none';
                }

                fetch(`/admin/subpackages/${subId}/delete`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        // Remove card with animation
                        if (card) {
                            card.style.transition = 'all 0.3s ease';
                            card.style.transform = 'scale(0.8)';
                            card.style.opacity = '0';
                            setTimeout(() => card.remove(), 300);
                        }

                        // If the deleted sub package was selected, hide items section
                        if (currentSubPackageId == subId) {
                            currentSubPackageId = null;
                            currentSubPackageName = null;
                            document.getElementById('items-section').classList.add('hidden');
                        }

                        // Check if container is now empty
                        setTimeout(() => {
                            const container = document.getElementById('subpackages-container');
                            const remaining = container.querySelectorAll('.subpackage-card');
                            if (remaining.length === 0) {
                                container.innerHTML = `
                                    <div class="col-span-3 py-10 text-center text-gray-400">
                                        <i class="fas fa-box-open text-3xl mb-3 block"></i>
                                        <p class="text-sm">No sub packages found for this package.</p>
                                    </div>`;
                            }
                        }, 350);

                        // Success toast
                        Swal.fire({
                            title: 'Deleted!',
                            text: `"${subName}" has been removed successfully.`,
                            icon: 'success',
                            confirmButtonColor: '#2A9D8F',
                            timer: 2500,
                            timerProgressBar: true,
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: data.message || 'Failed to delete sub package.',
                            icon: 'error',
                            confirmButtonColor: '#264653',
                        });
                        if (card) {
                            card.style.opacity = '1';
                            card.style.pointerEvents = 'auto';
                        }
                    }
                })
                .catch(() => {
                    Swal.fire({
                        title: 'Network Error',
                        text: 'Something went wrong. Please try again.',
                        icon: 'error',
                        confirmButtonColor: '#264653',
                    });
                    if (card) {
                        card.style.opacity = '1';
                        card.style.pointerEvents = 'auto';
                    }
                });
            });
        }

        // --- Remove Item From Package ---
        function removeItemFromPackage(button, itemId, itemName) {
            Swal.fire({
                title: 'Remove Item?',
                html: `Are you sure you want to remove <strong>"${itemName}"</strong> from this sub package?<br><br><span style="color: #E76F51; font-weight: 600;">This action cannot be undone.</span>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#E76F51',
                cancelButtonColor: '#264653',
                confirmButtonText: '<i class="fas fa-trash-alt mr-1"></i> Yes, remove it',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                focusCancel: true,
            }).then((result) => {
                if (!result.isConfirmed) return;

                // Find and animate the row being deleted
                const row = button.closest('tr');
                if (row) {
                    row.style.opacity = '0.5';
                    row.style.pointerEvents = 'none';
                }

                fetch(`/admin/subpackages/items/${itemId}/delete`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        if (row) {
                            row.style.transition = 'all 0.3s ease';
                            row.style.transform = 'scale(0.95)';
                            row.style.opacity = '0';
                            setTimeout(() => {
                                selectSubPackage(currentSubPackageId, currentSubPackageName);
                            }, 300);
                        } else {
                            selectSubPackage(currentSubPackageId, currentSubPackageName);
                        }

                        // Success toast
                        Swal.fire({
                            title: 'Removed!',
                            text: `"${itemName}" has been removed successfully.`,
                            icon: 'success',
                            confirmButtonColor: '#2A9D8F',
                            timer: 2500,
                            timerProgressBar: true,
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: data.message || 'Failed to remove item.',
                            icon: 'error',
                            confirmButtonColor: '#264653',
                        });
                        if (row) {
                            row.style.opacity = '1';
                            row.style.pointerEvents = 'auto';
                        }
                    }
                })
                .catch(() => {
                    Swal.fire({
                        title: 'Network Error',
                        text: 'Something went wrong. Please try again.',
                        icon: 'error',
                        confirmButtonColor: '#264653',
                    });
                    if (row) {
                        row.style.opacity = '1';
                        row.style.pointerEvents = 'auto';
                    }
                });
            });
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