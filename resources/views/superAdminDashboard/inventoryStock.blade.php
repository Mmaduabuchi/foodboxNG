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
                        <a href="#" id="add-subpackage-btn" class="px-5 py-2.5 bg-brand-gold text-brand-blue font-bold rounded-xl hover:bg-brand-gold/90 transition-colors shadow-lg flex items-center gap-2 text-sm">
                            <i class="fas fa-plus-circle"></i>
                            <span>Add Sub Package</span>
                        </a>
                    </div>

                    <!-- Sub Packages Grid -->
                    <div class="p-6">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Sub Packages</p>

                        <div id="subpackages-container" class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">
                            @forelse($activeSubPackages as $sub)
                                <button onclick="selectSubPackage('{{ $sub->id }}', '{{ addslashes($sub->name) }}')"
                                    class="subpackage-card text-left p-4 rounded-2xl border-2 border-gray-100 hover:border-brand-teal hover:bg-brand-teal/5 transition-all group"
                                    data-sub-id="{{ $sub->id }}">
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
                                </button>
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
                    <button onclick="selectSubPackage(${sub.id}, '${sub.name.replace(/'/g, "\\'")}')"
                        class="subpackage-card text-left p-4 rounded-2xl border-2 border-gray-100 hover:border-brand-teal hover:bg-brand-teal/5 transition-all group"
                        data-sub-id="${sub.id}">
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
                    </button>`;
            });
        }

        function selectSubPackage(subId, subName) {
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
                            <button onclick="removeItemFromPackage(${item.id})" 
                                class="p-2 text-brand-red hover:bg-brand-red/10 rounded-lg transition-colors opacity-0 group-hover:opacity-100" title="Remove item">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>`;
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