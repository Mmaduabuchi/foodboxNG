<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Management | FoodBox NG</title>
    
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
    <main class="mt-20 p-4 md:p-8 main-content max-w-full">
        
        <!-- User Metrics Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
            
            <!-- Card 1: Total Registered Users -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-blue">
                <div class="flex items-center justify-between">
                    <i class="fas fa-users text-2xl text-brand-blue p-3 bg-brand-blue/10 rounded-xl"></i>
                    <span class="text-sm font-semibold text-gray-500 hidden md:block">All Accounts</span>
                </div>
                <p class="text-sm text-gray-500 mt-2">Total Users</p>
                <p class="text-2xl font-extrabold text-brand-blue">15,670</p>
            </div>

            <!-- Card 2: Active Customer Users (Teal) -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-teal">
                <div class="flex items-center justify-between">
                    <i class="fas fa-user-check text-2xl text-brand-teal p-3 bg-brand-teal/10 rounded-xl"></i>
                    <span class="text-sm font-semibold text-green-500 hidden md:block">92% Active</span>
                </div>
                <p class="text-sm text-gray-500 mt-2">Active Customers</p>
                <p class="text-2xl font-extrabold text-brand-blue">14,416</p>
            </div>

            <!-- Card 3: New Users This Month (Gold) -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-gold">
                <div class="flex items-center justify-between">
                    <i class="fas fa-user-plus text-2xl text-brand-gold p-3 bg-brand-gold/10 rounded-xl"></i>
                    <span class="text-sm font-semibold text-brand-gold hidden md:block">Growth</span>
                </div>
                <p class="text-sm text-gray-500 mt-2">New Users (Month)</p>
                <p class="text-2xl font-extrabold text-brand-blue">485</p>
            </div>

            <!-- Card 4: Deactivated/Banned (Red) -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-red">
                <div class="flex items-center justify-between">
                    <i class="fas fa-user-slash text-2xl text-brand-red p-3 bg-brand-red/10 rounded-xl"></i>
                    <span class="text-sm font-semibold text-red-500 hidden md:block">Flagged</span>
                </div>
                <p class="text-sm text-gray-500 mt-2">Deactivated Accounts</p>
                <p class="text-2xl font-extrabold text-brand-blue">42</p>
            </div>
        </div>

        <!-- Filter & Search Bar -->
        <div class="bg-white p-6 rounded-2xl shadow-soft mb-8">
            <h3 class="text-lg font-semibold mb-4 text-brand-blue">User Filtering & Search</h3>
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                
                <!-- Search -->
                <div class="md:col-span-2 relative">
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="search" placeholder="Search by Name, Email, or Phone..."
                        class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:border-brand-teal focus:ring-1 focus:ring-brand-teal/20 outline-none transition-all text-sm bg-brand-grey/50">
                </div>

                <!-- Role Filter -->
                <div>
                    <select class="w-full py-3 px-4 border border-gray-200 rounded-xl text-sm bg-brand-grey/50 focus:border-brand-teal outline-none">
                        <option>All Roles</option>
                        <option>Customer</option>
                        <option>Admin</option>
                        <option>Delivery Agent</option>
                        <option>Partner</option>
                    </select>
                </div>

                <!-- Status Filter -->
                <div>
                    <select class="w-full py-3 px-4 border border-gray-200 rounded-xl text-sm bg-brand-grey/50 focus:border-brand-teal outline-none">
                        <option>All Statuses</option>
                        <option>Active</option>
                        <option>Inactive</option>
                        <option>Banned</option>
                    </select>
                </div>

                <!-- Action Button -->
                <button class="w-full py-3 bg-brand-blue text-white font-semibold rounded-xl hover:bg-brand-blue/90 transition-colors flex items-center justify-center gap-2">
                    <i class="fas fa-filter"></i>
                    <span class="hidden sm:inline">Apply Filters</span>
                </button>
            </div>
        </div>

        <!-- User List Table -->
        <div class="bg-white p-6 rounded-2xl shadow-soft overflow-x-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-brand-blue">Registered User Accounts</h3>
                <button class="text-brand-teal hover:text-brand-blue text-sm font-semibold">
                    <i class="fas fa-download mr-1"></i> Export Users
                </button>
            </div>
            
            <table class="min-w-full divide-y divide-gray-200 responsive-table">
                <thead class="bg-brand-grey/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name/Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Login</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <!-- User Row 1: Active Customer -->
                    <tr class="hover:bg-brand-grey transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="User ID">UID-5421</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Name/Email">
                            <div class="flex items-center space-x-3">
                                <img src="https://placehold.co/32x32/2A9D8F/FFFFFF?text=AO" class="w-8 h-8 rounded-full" />
                                <div>
                                    <p class="font-semibold">Amara Okoro</p>
                                    <p class="text-xs text-gray-500">amara.o@mail.com</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Role">Customer</td>
                        <td class="px-6 py-4 whitespace-nowrap" data-label="Status">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Last Login">3 min ago</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Actions">
                            <button class="text-brand-blue hover:text-brand-teal transition-colors text-sm font-semibold mr-3">Edit</button>
                            <button class="text-brand-red hover:text-brand-red/80 transition-colors text-sm font-semibold">Deactivate</button>
                        </td>
                    </tr>
                     <!-- User Row 2: Inactive Customer -->
                    <tr class="hover:bg-brand-grey transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="User ID">UID-6889</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Name/Email">
                            <div class="flex items-center space-x-3">
                                <img src="https://placehold.co/32x32/E9C46A/FFFFFF?text=TB" class="w-8 h-8 rounded-full" />
                                <div>
                                    <p class="font-semibold">Tunde Bello</p>
                                    <p class="text-xs text-gray-500">tunde.b@mail.com</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Role">Customer</td>
                        <td class="px-6 py-4 whitespace-nowrap" data-label="Status">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-200 text-gray-700">Inactive</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Last Login">1 month ago</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Actions">
                            <button class="text-brand-blue hover:text-brand-teal transition-colors text-sm font-semibold mr-3">Edit</button>
                            <button class="text-brand-teal hover:text-brand-blue transition-colors text-sm font-semibold">Activate</button>
                        </td>
                    </tr>
                     <!-- User Row 3: Admin -->
                    <tr class="hover:bg-brand-grey transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="User ID">UID-0010</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Name/Email">
                            <div class="flex items-center space-x-3">
                                <img src="https://placehold.co/32x32/264653/FFFFFF?text=CE" class="w-8 h-8 rounded-full" />
                                <div>
                                    <p class="font-semibold">Chinedu Eze</p>
                                    <p class="text-xs text-gray-500">admin.ce@foodbox.ng</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Role">Admin</td>
                        <td class="px-6 py-4 whitespace-nowrap" data-label="Status">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-brand-teal/10 text-brand-blue">Active</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Last Login">15 hours ago</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Actions">
                            <button class="text-brand-blue hover:text-brand-teal transition-colors text-sm font-semibold mr-3">Edit Role</button>
                            <button class="text-brand-red hover:text-brand-red/80 transition-colors text-sm font-semibold">Suspend</button>
                        </td>
                    </tr>
                    <!-- User Row 4: Delivery Agent -->
                    <tr class="hover:bg-brand-grey transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="User ID">UID-9011</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Name/Email">
                            <div class="flex items-center space-x-3">
                                <img src="https://placehold.co/32x32/F4A261/FFFFFF?text=FM" class="w-8 h-8 rounded-full" />
                                <div>
                                    <p class="font-semibold">Fatimah Musa</p>
                                    <p class="text-xs text-gray-500">fmusadeli@box.ng</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Role">Delivery Agent</td>
                        <td class="px-6 py-4 whitespace-nowrap" data-label="Status">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-brand-orange/10 text-brand-orange">On Duty</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Last Login">5 min ago</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Actions">
                            <button class="text-brand-blue hover:text-brand-teal transition-colors text-sm font-semibold mr-3">Edit</button>
                            <button class="text-brand-teal hover:text-brand-blue transition-colors text-sm font-semibold">Track</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-6 flex justify-between items-center">
                <p class="text-sm text-gray-600">Showing 1 to 4 of 15,670 results</p>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 rounded-lg bg-brand-grey text-brand-blue font-medium hover:bg-gray-300 transition-colors"><i class="fas fa-chevron-left text-xs"></i></button>
                    <span class="px-3 py-1 rounded-lg bg-brand-blue text-white font-medium">1</span>
                    <button class="px-3 py-1 rounded-lg bg-brand-grey text-brand-blue font-medium hover:bg-gray-300 transition-colors">2</button>
                    <button class="px-3 py-1 rounded-lg bg-brand-grey text-brand-blue font-medium hover:bg-gray-300 transition-colors">3</button>
                    <button class="px-3 py-1 rounded-lg bg-brand-grey text-brand-blue font-medium hover:bg-gray-300 transition-colors">...</button>
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

        // Simple placeholder function for 'Add New User' button
        function promptForNewUser() {
            console.log("Add New User flow initiated. (In a real application, this would open a modal/form)");
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