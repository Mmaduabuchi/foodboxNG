<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Packages | FoodBox NG</title>
    
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
            #sidebar { transform: translateX(0); }
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

        /* Modal Animation */
        #packageModal {
            transition: opacity 0.25s ease;
        }
        #packageModal.hidden { opacity: 0; pointer-events: none; }

        /* Package card image placeholder */
        .pkg-color-1 { background: linear-gradient(135deg, #2A9D8F22, #2A9D8F55); }
        .pkg-color-2 { background: linear-gradient(135deg, #E9C46A22, #E9C46A55); }
        .pkg-color-3 { background: linear-gradient(135deg, #F4A26122, #F4A26155); }
        .pkg-color-4 { background: linear-gradient(135deg, #E76F5122, #E76F5155); }
        .pkg-color-5 { background: linear-gradient(135deg, #26465322, #26465355); }

        /* Filter tab active state */
        .filter-tab.active-tab {
            background-color: #264653;
            color: white;
        }
        .filter-tab:not(.active-tab) {
            background-color: white;
            color: #264653;
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

    <!-- 1. Sidebar Navigation -->
    @include('superAdminDashboard.aside')

    <!-- 2. Top Header -->
    @include('superAdminDashboard.header')

    <!-- Main Content Area -->
    <main class="mt-20 lg:ml-64 p-4 md:p-8 main-content max-w-full">

        <!-- Page Title Row -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-extrabold text-brand-blue">Manage Packages</h1>
                <p class="text-sm text-gray-500 mt-0.5">Create, edit, and control all meal subscription packages.</p>
            </div>
            <button
                id="openModalBtn"
                onclick="openPackageModal()"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-brand-teal text-white font-semibold rounded-xl hover:bg-brand-teal/90 transition-colors shadow-sm shrink-0">
                <i class="fas fa-plus"></i>
                <span>Create New Package</span>
            </button>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">

            <!-- Card 1: Total Packages -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-teal">
                <div class="flex items-center justify-between">
                    <i class="fas fa-cubes text-2xl text-brand-teal p-3 bg-brand-teal/10 rounded-xl"></i>
                    <p class="text-sm font-semibold text-gray-500">All Time</p>
                </div>
                <p class="text-sm text-gray-500 mt-2">Total Packages</p>
                <p class="text-2xl font-extrabold text-brand-blue">{{ $totalPackages }}</p>
            </div>

            <!-- Card 2: Active Packages -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-green-500">
                <div class="flex items-center justify-between">
                    <i class="fas fa-check-circle text-2xl text-green-500 p-3 bg-green-500/10 rounded-xl"></i>
                    <p class="text-sm font-semibold text-gray-500">Live Now</p>
                </div>
                <p class="text-sm text-gray-500 mt-2">Active Packages</p>
                <p class="text-2xl font-extrabold text-brand-blue">{{ $activePackages }}</p>
            </div>

            <!-- Card 3: Most Popular -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-gold">
                <div class="flex items-center justify-between">
                    <i class="fas fa-fire-alt text-2xl text-brand-gold p-3 bg-brand-gold/10 rounded-xl"></i>
                    <p class="text-sm font-semibold text-gray-500">Top Seller</p>
                </div>
                <p class="text-sm text-gray-500 mt-2">Most Subscribed</p>
                <p class="text-lg font-extrabold text-brand-blue truncate">{{ $topSeller->name ?? 'None Yet' }}</p>
            </div>

            <!-- Card 4: Draft / Inactive -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-orange">
                <div class="flex items-center justify-between">
                    <i class="fas fa-pencil-alt text-2xl text-brand-orange p-3 bg-brand-orange/10 rounded-xl"></i>
                    <p class="text-sm font-semibold text-gray-500">Unpublished</p>
                </div>
                <p class="text-sm text-gray-500 mt-2">Drafts / Inactive</p>
                <p class="text-2xl font-extrabold text-brand-blue">{{ $inactivePackages + $draftPackages }}</p>
            </div>
        </div>

        <!-- Package List Table -->
        <div class="bg-white p-6 rounded-2xl shadow-soft">

            <!-- Table Header: Filters + Search + Actions -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                <h3 class="text-xl font-semibold text-brand-blue">All Packages</h3>

                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 w-full md:w-auto">
                    <!-- Filter Tabs -->
                    <div class="flex items-center gap-2 flex-wrap">
                        <button onclick="filterTable('all', this)" class="filter-tab active-tab px-4 py-1.5 text-sm font-semibold rounded-lg border border-gray-200 transition-colors">All</button>
                        <button onclick="filterTable('active', this)" class="filter-tab px-4 py-1.5 text-sm font-semibold rounded-lg border border-gray-200 transition-colors">Active</button>
                        <button onclick="filterTable('inactive', this)" class="filter-tab px-4 py-1.5 text-sm font-semibold rounded-lg border border-gray-200 transition-colors">Inactive</button>
                        <button onclick="filterTable('draft', this)" class="filter-tab px-4 py-1.5 text-sm font-semibold rounded-lg border border-gray-200 transition-colors">Draft</button>
                    </div>

                    <!-- Search Input -->
                    <div class="relative w-full sm:w-56">
                        <input type="text" id="pkgSearchInput" onkeyup="searchPackages()" placeholder="Search packages..." class="w-full py-2 pl-10 pr-4 border border-gray-300 rounded-xl focus:border-brand-teal focus:ring-1 focus:ring-brand-teal text-sm outline-none transition-all">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    </div>
                </div>
            </div>

            <!-- Packages Table -->
            <div class="overflow-x-auto">
                <table id="packagesTable" class="min-w-full divide-y divide-gray-200 responsive-table">
                    <thead class="bg-brand-grey/50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Package</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price / Week</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subscribers</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($packages as $package)
                            @php
                                $status = strtolower($package->status);
                                $statusClass = match($status) {
                                    'active' => 'bg-green-100 text-green-800',
                                    'inactive' => 'bg-red-100 text-red-800',
                                    'draft' => 'bg-yellow-100 text-yellow-800',
                                    default => 'bg-gray-100 text-gray-800'
                                };
                                
                                // Dynamic Category/Cycle mapping for icons and colors
                                $category = strtolower($package->billing_cycle);
                                $icon = match($category) {
                                    'weekly' => 'fa-calendar-week',
                                    'bi-weekly' => 'fa-calendar-alt',
                                    'monthly' => 'fa-calendar-check',
                                    default => 'fa-box'
                                };
                                $colorIdx = ($package->id % 5) + 1;
                            @endphp
                            <tr class="hover:bg-brand-grey transition-colors {{ $status === 'active' && $package->subscriptions_count > 100 ? 'bg-brand-gold/5' : '' }}" 
                                data-status="{{ $status }}" data-name="{{ strtolower($package->name) }}">
                                <td class="px-6 py-4 whitespace-nowrap" data-label="Package">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl pkg-color-{{ $colorIdx }} flex items-center justify-center shrink-0">
                                            <i class="fas {{ $icon }} text-lg"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-brand-blue">{{ $package->name }}</p>
                                            <p class="text-xs text-gray-500">ID: PKG-{{ str_pad($package->id, 3, '0', STR_PAD_LEFT) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700" data-label="Category">
                                    <span class="px-2 py-1 bg-brand-teal/15 text-brand-teal rounded-md text-xs font-medium">{{ ucfirst($package->billing_cycle) }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-brand-blue" data-label="Price / Week">₦{{ number_format($package->price) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700" data-label="Subscribers">
                                    <span class="font-bold text-brand-teal">{{ number_format($package->subscriptions_count) }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap" data-label="Status">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">{{ ucfirst($status) }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Actions">
                                    <div class="flex items-center gap-3">
                                        <button onclick="editPackage('{{ $package->id }}', '{{ addslashes($package->name) }}')" class="text-brand-blue hover:text-brand-teal transition-colors" title="Edit Package">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        @if($status === 'active')
                                            <button onclick="togglePackageStatus('{{ $package->id }}', '{{ addslashes($package->name) }}', 'active')" class="text-brand-orange hover:text-brand-orange/70 transition-colors" title="Deactivate">
                                                <i class="fas fa-toggle-on text-lg"></i>
                                            </button>
                                        @elseif($status === 'inactive')
                                            <button onclick="togglePackageStatus('{{ $package->id }}', '{{ addslashes($package->name) }}', 'inactive')" class="text-gray-400 hover:text-brand-teal transition-colors" title="Activate">
                                                <i class="fas fa-toggle-off text-lg"></i>
                                            </button>
                                        @else
                                            <button onclick="publishPackage('{{ $package->id }}', '{{ addslashes($package->name) }}')" class="text-brand-teal hover:text-brand-teal/70 transition-colors font-semibold text-xs" title="Publish Package">
                                                <i class="fas fa-paper-plane mr-1"></i>Publish
                                            </button>
                                        @endif
                                        <button onclick="deletePackage('{{ $package->id }}', '{{ addslashes($package->name) }}')" class="text-brand-red hover:text-brand-red/70 transition-colors" title="Delete Package">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-500 italic">No packages found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="flex flex-col sm:flex-row justify-between items-center mt-6 gap-3">
                <p class="text-sm text-gray-600">
                    Showing {{ $packages->firstItem() ?? 0 }} to {{ $packages->lastItem() ?? 0 }} of {{ number_format($packages->total()) }} packages
                </p>
                <div class="flex space-x-1">
                    {{-- Previous Page Link --}}
                    @if ($packages->onFirstPage())
                        <button class="px-3 py-1 text-sm rounded-lg border border-gray-300 text-gray-400 cursor-not-allowed">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                    @else
                        <a href="{{ $packages->previousPageUrl() }}" class="px-3 py-1 text-sm rounded-lg border border-gray-300 text-gray-600 hover:bg-brand-grey transition-colors flex items-center justify-center">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($packages->getUrlRange(max(1, $packages->currentPage() - 1), min($packages->lastPage(), $packages->currentPage() + 1)) as $page => $url)
                        @if ($page == $packages->currentPage())
                            <button class="px-3 py-1 text-sm rounded-lg bg-brand-blue text-white font-semibold">{{ $page }}</button>
                        @else
                            <a href="{{ $url }}" class="px-3 py-1 text-sm rounded-lg border border-gray-300 text-gray-600 hover:bg-brand-grey transition-colors flex items-center justify-center">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if($packages->lastPage() > $packages->currentPage() + 1)
                        <span class="px-2 py-1 text-gray-400">...</span>
                        <a href="{{ $packages->url($packages->lastPage()) }}" class="px-3 py-1 text-sm rounded-lg border border-gray-300 text-gray-600 hover:bg-brand-grey transition-colors flex items-center justify-center">{{ $packages->lastPage() }}</a>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($packages->hasMorePages())
                        <a href="{{ $packages->nextPageUrl() }}" class="px-3 py-1 text-sm rounded-lg border border-gray-300 text-gray-600 hover:bg-brand-grey transition-colors flex items-center justify-center">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <button class="px-3 py-1 text-sm rounded-lg border border-gray-300 text-gray-400 cursor-not-allowed">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Footer Spacer -->
        <div class="h-12"></div>
    </main>

    <!-- Create / Edit Package Modal -->
    <div id="packageModal" class="hidden fixed inset-0 z-[60] flex items-center justify-center p-4 bg-black/50">
        <div class="bg-white w-full max-w-xl rounded-2xl shadow-admin overflow-y-auto max-h-[90vh]">

            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-brand-teal/10 rounded-xl flex items-center justify-center">
                        <i class="fas fa-cube text-brand-teal text-lg"></i>
                    </div>
                    <h2 id="modalTitle" class="text-xl font-bold text-brand-blue">Create New Package</h2>
                </div>
                <button onclick="closePackageModal()" class="p-2 rounded-lg text-gray-400 hover:text-brand-red hover:bg-brand-red/10 transition-colors">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6 space-y-5">

                <!-- Package Name -->
                <div class="space-y-1.5">
                    <label for="pkgName" class="block text-sm font-semibold text-gray-700">Package Name <span class="text-brand-red">*</span></label>
                    <input type="text" id="pkgName" placeholder="e.g., Family Feast Weekly" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:border-brand-teal focus:ring-1 focus:ring-brand-teal outline-none transition-all bg-brand-grey/30">
                </div>

                <!-- Category + Price -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label for="pkgCategory" class="block text-sm font-semibold text-gray-700">Category <span class="text-brand-red">*</span></label>
                        <select id="pkgCategory" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:border-brand-teal focus:ring-1 focus:ring-brand-teal outline-none transition-all bg-brand-grey/30">
                            <option value="">-- Select Category --</option>
                            <option value="solo">Solo</option>
                            <option value="couple">Couple</option>
                            <option value="family">Family</option>
                            <option value="premium">Premium</option>
                            <option value="budget">Budget</option>
                            <option value="weekend">Weekend</option>
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label for="pkgPrice" class="block text-sm font-semibold text-gray-700">Price (₦) <span class="text-brand-red">*</span></label>
                        <input type="number" id="pkgPrice" placeholder="e.g., 18500" min="0" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:border-brand-teal focus:ring-1 focus:ring-brand-teal outline-none transition-all bg-brand-grey/30">
                    </div>
                </div>

                <!-- Servings + Delivery Days -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label for="pkgServings" class="block text-sm font-semibold text-gray-700">Servings / Day</label>
                        <input type="number" id="pkgServings" placeholder="e.g., 3" min="1" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:border-brand-teal focus:ring-1 focus:ring-brand-teal outline-none transition-all bg-brand-grey/30">
                    </div>
                    <div class="space-y-1.5">
                        <label for="pkgDeliveryDays" class="block text-sm font-semibold text-gray-700">Delivery Days / Week</label>
                        <select id="pkgDeliveryDays" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:border-brand-teal focus:ring-1 focus:ring-brand-teal outline-none transition-all bg-brand-grey/30">
                            <option value="">-- Select --</option>
                            <option value="5">5 days (Weekdays)</option>
                            <option value="7">7 days (Daily)</option>
                            <option value="2">2 days (Weekends)</option>
                            <option value="3">3 days (Mon/Wed/Fri)</option>
                        </select>
                    </div>
                </div>

                <!-- Description -->
                <div class="space-y-1.5">
                    <label for="pkgDescription" class="block text-sm font-semibold text-gray-700">Package Description</label>
                    <textarea id="pkgDescription" rows="3" placeholder="Describe what's included in this package, dietary options, etc." class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:border-brand-teal focus:ring-1 focus:ring-brand-teal outline-none transition-all resize-none bg-brand-grey/30"></textarea>
                </div>

                <!-- Status -->
                <div class="space-y-1.5">
                    <label for="pkgStatus" class="block text-sm font-semibold text-gray-700">Publication Status</label>
                    <select id="pkgStatus" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:border-brand-teal focus:ring-1 focus:ring-brand-teal outline-none transition-all bg-brand-grey/30">
                        <option value="draft">Save as Draft</option>
                        <option value="active">Publish Immediately</option>
                        <option value="inactive">Save as Inactive</option>
                    </select>
                    <p class="text-xs text-gray-400">Drafts are only visible to admins. Published packages are live for users.</p>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex items-center justify-end gap-3 p-6 border-t border-gray-100 bg-brand-grey/30">
                <button onclick="closePackageModal()" class="px-5 py-2.5 border border-gray-300 text-gray-600 font-semibold rounded-xl hover:bg-gray-100 transition-colors text-sm">
                    Cancel
                </button>
                <button id="modalSubmitBtn" onclick="savePackage()" class="px-5 py-2.5 bg-brand-teal text-white font-semibold rounded-xl hover:bg-brand-teal/90 transition-colors text-sm flex items-center gap-2">
                    <i class="fas fa-save"></i>
                    <span>Save Package</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteConfirmModal" class="hidden fixed inset-0 z-[70] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-admin overflow-hidden">
            <div class="p-6 text-center">
                <div class="w-16 h-16 bg-red-100 text-brand-red rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-brand-blue mb-2">Confirm Delete</h3>
                <p class="text-gray-500 mb-6 font-medium">Are you sure you want to delete the package <span id="deletePkgName" class="font-bold text-brand-blue"></span>? This action cannot be undone.</p>
                
                <div class="flex items-center justify-center gap-3">
                    <button onclick="closeDeleteModal()" class="px-6 py-2.5 border border-gray-300 text-gray-600 font-semibold rounded-xl hover:bg-gray-100 transition-colors text-sm">
                        Cancel
                    </button>
                    <button onclick="submitDelete()" class="px-6 py-2.5 bg-brand-red text-white font-semibold rounded-xl hover:bg-brand-red/90 transition-colors text-sm flex items-center gap-2 shadow-lg shadow-brand-red/20">
                        <i class="fas fa-trash-alt"></i>
                        <span>Delete Package</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden Delete Form -->
    <form id="deletePackageForm" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <!-- JavaScript -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('backdrop');
        const packageModal = document.getElementById('packageModal');
        const deleteConfirmModal = document.getElementById('deleteConfirmModal');
        let packageToDeleteId = null;

        // Modal Controls
        function openPackageModal(editMode = false, id = null, name = null) {
            if (editMode) {
                document.getElementById('modalTitle').textContent = `Edit: ${name}`;
                document.getElementById('modalSubmitBtn').innerHTML = '<i class="fas fa-save"></i> <span>Update Package</span>';
                // For now, simulate by pre-filling the name
                document.getElementById('pkgName').value = name;
            } else {
                document.getElementById('modalTitle').textContent = 'Create New Package';
                document.getElementById('modalSubmitBtn').innerHTML = '<i class="fas fa-save"></i> <span>Save Package</span>';
                resetModalForm();
            }
            packageModal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closePackageModal() {
            packageModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        function resetModalForm() {
            document.getElementById('pkgName').value = '';
            document.getElementById('pkgCategory').value = '';
            document.getElementById('pkgPrice').value = '';
            document.getElementById('pkgServings').value = '';
            document.getElementById('pkgDeliveryDays').value = '';
            document.getElementById('pkgDescription').value = '';
            document.getElementById('pkgStatus').value = 'draft';
        }

        // Close modal on backdrop click
        packageModal.addEventListener('click', function(e) {
            if (e.target === packageModal) closePackageModal();
        });

        // Package Action Functions
        function savePackage() {
            const name = document.getElementById('pkgName').value.trim();
            const category = document.getElementById('pkgCategory').value;
            const price = document.getElementById('pkgPrice').value;

            if (!name || !category || !price) {
                alertMessage('warning', 'Please fill in all required fields (Name, Category, Price).');
                return;
            }
            alertMessage('success', `Package "${name}" saved successfully!`);
            closePackageModal();
        }

        function editPackage(id, name) {
            openPackageModal(true, id, name);
        }

        function togglePackageStatus(id, name, currentStatus) {
            if (currentStatus === 'active') {
                alertMessage('warning', `Package "${name}" (${id}) has been deactivated.`);
            } else {
                alertMessage('success', `Package "${name}" (${id}) is now live and active.`);
            }
            console.log(`Toggle status for ${id}: ${currentStatus} => ${currentStatus === 'active' ? 'inactive' : 'active'}`);
        }

        function publishPackage(id, name) {
            alertMessage('success', `Package "${name}" (${id}) is now published and live!`);
            console.log(`Publish requested for ${id}.`);
        }

        function deletePackage(id, name) {
            packageToDeleteId = id;
            document.getElementById('deletePkgName').textContent = name;
            deleteConfirmModal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeDeleteModal() {
            deleteConfirmModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            packageToDeleteId = null;
        }

        function submitDelete() {
            if (!packageToDeleteId) return;
            const form = document.getElementById('deletePackageForm');
            form.action = `/admin/managePackages/${packageToDeleteId}`;
            form.submit();
        }

        // Filter Tabs
        function filterTable(status, btn) {
            // Update active tab style
            document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active-tab'));
            btn.classList.add('active-tab');

            // Filter table rows
            const rows = document.querySelectorAll('#packagesTable tbody tr');
            rows.forEach(row => {
                if (status === 'all' || row.dataset.status === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Search Packages
        function searchPackages() {
            const query = document.getElementById('pkgSearchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#packagesTable tbody tr');
            rows.forEach(row => {
                const name = row.dataset.name || '';
                row.style.display = name.includes(query) ? '' : 'none';
            });
        }

        // Toast Notifications
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

            setTimeout(() => { alertDiv.classList.remove('translate-x-full'); }, 50);
            setTimeout(() => {
                alertDiv.classList.add('translate-x-full');
                alertDiv.addEventListener('transitionend', () => alertDiv.remove());
            }, 3500);
        }

        // Sidebar Toggle
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

        // Close sidebar on nav link click (mobile)
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024) {
                    setTimeout(() => toggleSidebar(), 150);
                }
            });
        });

        // Handle Session Messages
        @if(session('success'))
            setTimeout(() => {
                alertMessage('success', "{{ session('success') }}");
            }, 500);
        @endif

        @if(session('error'))
            setTimeout(() => {
                alertMessage('red', "{{ session('error') }}");
            }, 500);
        @endif
    </script>
</body>
</html>
