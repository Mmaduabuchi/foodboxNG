<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | FoodBox NG</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Tailwind Config -->
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

        /* Styling for the main content area */
        .main-content {
            padding-top: 5rem; /* Space for the fixed header */
        }

        /* Active link styling */
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
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.8rem;
            font-weight: 600;
        }

    </style>
</head>
<body class="bg-brand-grey text-brand-blue antialiased min-h-screen">

    <!-- Mobile Menu Button (Outside Sidebar) -->
    <div class="fixed top-4 left-4 z-50 lg:hidden">
        <button id="menu-toggle" class="p-3 rounded-xl bg-white shadow-md text-brand-blue hover:bg-brand-grey transition-colors">
            <i class="fas fa-bars text-xl"></i>
        </button>
    </div>

    <!-- Backdrop for Mobile Sidebar -->
    <div id="backdrop" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden opacity-0" onclick="toggleSidebar()"></div>

    <!-- 1. Sticky Sidebar Navigation -->
    <aside id="sidebar" class="fixed top-0 left-0 h-full w-64 bg-brand-blue p-6 shadow-xl-heavy lg:translate-x-0">
        
        <!-- Logo/Brand -->
        <div class="flex items-center gap-2 mb-10 pb-4 border-b border-white/10">
            <div class="w-10 h-10 bg-brand-teal rounded-lg flex items-center justify-center text-white shadow-lg shadow-brand-teal/40">
                <i class="fas fa-leaf text-xl"></i>
            </div>
            <span class="text-2xl font-extrabold text-white tracking-tight">FoodBox<span class="text-brand-teal">NG</span></span>
        </div>

        <!-- Profile Info (Top of Sidebar) -->
        <div class="flex items-center gap-3 mb-8">
            <img src="https://placehold.co/40x40/E9C46A/264653?text=JO" onerror="this.onerror=null; this.src='https://placehold.co/40x40/E9C46A/264653?text=JO';" alt="Profile Avatar" class="w-10 h-10 rounded-full border-2 border-brand-gold/50 object-cover">
            <div class="text-white">
                <p class="font-semibold text-sm leading-tight">Jane Okoro</p>
                <p class="text-xs text-brand-teal">Premium User</p>
            </div>
        </div>

        <!-- Navigation Links -->
        <nav class="space-y-2">
            <!-- Dashboard (Active) -->
            <a href="#" class="nav-link active flex items-center gap-4 text-white font-medium p-3 rounded-xl hover:bg-brand-teal transition-all">
                <i class="fas fa-chart-line text-lg text-brand-gold w-6 text-center"></i>
                <span>Dashboard</span>
            </a>
            <a href="#" class="nav-link flex items-center gap-4 text-white/80 font-medium p-3 rounded-xl hover:bg-brand-teal transition-all hover:text-white">
                <i class="fas fa-box text-lg w-6 text-center"></i>
                <span>My Orders</span>
            </a>
            <a href="#" class="nav-link flex items-center gap-4 text-white/80 font-medium p-3 rounded-xl hover:bg-brand-teal transition-all hover:text-white">
                <i class="fas fa-cubes text-lg w-6 text-center"></i>
                <span>My Packages</span>
            </a>
            <a href="#" class="nav-link flex items-center gap-4 text-white/80 font-medium p-3 rounded-xl hover:bg-brand-teal transition-all hover:text-white">
                <i class="fas fa-sync-alt text-lg w-6 text-center"></i>
                <span>Subscriptions</span>
            </a>
            <a href="#" class="nav-link flex items-center gap-4 text-white/80 font-medium p-3 rounded-xl hover:bg-brand-teal transition-all hover:text-white">
                <i class="fas fa-map-marker-alt text-lg w-6 text-center"></i>
                <span>Delivery Address</span>
            </a>
            <a href="#" class="nav-link flex items-center gap-4 text-white/80 font-medium p-3 rounded-xl hover:bg-brand-teal transition-all hover:text-white">
                <i class="fas fa-credit-card text-lg w-6 text-center"></i>
                <span>Payment History</span>
            </a>
            <a href="#" class="nav-link flex items-center gap-4 text-white/80 font-medium p-3 rounded-xl hover:bg-brand-teal transition-all hover:text-white">
                <i class="fas fa-cog text-lg w-6 text-center"></i>
                <span>Profile Settings</span>
            </a>
        </nav>

        <!-- Logout link at the bottom -->
        <div class="absolute bottom-6 left-6 right-6">
            <a href="#" class="flex items-center gap-4 text-brand-red font-medium p-3 rounded-xl hover:bg-brand-red/10 transition-all">
                <i class="fas fa-sign-out-alt text-lg w-6 text-center"></i>
                <span>Log Out</span>
            </a>
        </div>
    </aside>

    <!-- 2. Top Header -->
    <header class="fixed top-0 right-0 w-full lg:w-[calc(100%-16rem)] h-20 bg-white border-b border-gray-100 shadow-sm z-30 flex items-center px-4 md:px-8">
        <div class="flex-grow">
            <!-- Search Bar -->
            <div class="relative w-full max-w-sm hidden md:block">
                <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input 
                    type="search" 
                    placeholder="Search orders, packages, or settings..."
                    class="w-full pl-12 pr-4 py-2 border border-gray-200 rounded-full focus:border-brand-teal focus:ring-1 focus:ring-brand-teal/20 outline-none transition-all text-sm bg-brand-grey/50"
                >
            </div>
            <h1 class="text-xl font-bold lg:hidden">Dashboard</h1>
        </div>

        <!-- Right Side Icons -->
        <div class="flex items-center space-x-4">
            <!-- Notifications Bell -->
            <button class="p-2 rounded-full text-gray-500 hover:bg-brand-grey transition-colors relative">
                <i class="fas fa-bell text-lg"></i>
                <span class="absolute top-0.5 right-0.5 block h-2 w-2 rounded-full ring-2 ring-white bg-brand-orange"></span>
            </button>
            
            <!-- Profile Avatar Dropdown -->
            <div class="relative group cursor-pointer">
                <img src="https://placehold.co/36x36/E9C46A/264653?text=JO" onerror="this.onerror=null; this.src='https://placehold.co/36x36/E9C46A/264653?text=JO';" alt="Profile Avatar" class="w-9 h-9 rounded-full object-cover ring-2 ring-brand-teal/50">
                <!-- Dropdown Menu (Hidden by default) -->
                <div class="absolute right-0 mt-3 w-48 bg-white border border-gray-100 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform scale-95 group-hover:scale-100 origin-top-right">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-grey rounded-t-xl"><i class="fas fa-user-circle mr-2"></i> View Profile</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-grey"><i class="fas fa-cog mr-2"></i> Settings</a>
                    <div class="border-t border-gray-100"></div>
                    <a href="#" class="block px-4 py-2 text-sm text-brand-red hover:bg-brand-red/10 rounded-b-xl"><i class="fas fa-sign-out-alt mr-2"></i> Log Out</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="lg:ml-64 p-4 md:p-8 main-content">
        
        <!-- Welcome Banner -->
        <div class="bg-white p-6 rounded-2xl shadow-soft mb-8 border-l-4 border-brand-teal">
            <h2 class="text-2xl font-bold text-brand-blue mb-1">Hello, Jane!</h2>
            <p class="text-gray-600">Here is your quick overview of your FoodBox NG account and latest activities.</p>
        </div>

        <!-- 3. Main Dashboard Overview Section (4-Card Grid) -->
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            
            <!-- Card 1: Active Packages -->
            <div class="bg-white p-6 rounded-2xl shadow-soft border-t-4 border-brand-teal flex flex-col justify-between">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-sm font-semibold text-gray-500 uppercase">Active Packages</p>
                    <i class="fas fa-cubes text-xl text-brand-teal"></i>
                </div>
                <div class="flex items-end justify-between">
                    <span class="text-4xl font-extrabold text-brand-blue">2</span>
                    <p class="text-xs text-brand-teal font-medium">+1 new this month</p>
                </div>
            </div>

            <!-- Card 2: Total Orders -->
            <div class="bg-white p-6 rounded-2xl shadow-soft border-t-4 border-brand-blue flex flex-col justify-between">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-sm font-semibold text-gray-500 uppercase">Total Orders</p>
                    <i class="fas fa-box text-xl text-brand-blue"></i>
                </div>
                <div class="flex items-end justify-between">
                    <span class="text-4xl font-extrabold text-brand-blue">14</span>
                    <p class="text-xs text-gray-500 font-medium">Lifetime count</p>
                </div>
            </div>

            <!-- Card 3: Subscription Status -->
            <div class="bg-white p-6 rounded-2xl shadow-soft border-t-4 border-brand-gold flex flex-col justify-between">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-sm font-semibold text-gray-500 uppercase">Subscription Status</p>
                    <i class="fas fa-sync-alt text-xl text-brand-gold"></i>
                </div>
                <div class="flex items-end">
                    <span class="text-xl font-extrabold text-brand-blue">Active</span>
                    <p class="text-xs status-badge bg-brand-gold/20 text-brand-blue ml-2">Premium Plan</p>
                </div>
            </div>

            <!-- Card 4: Pending Deliveries -->
            <div class="bg-white p-6 rounded-2xl shadow-soft border-t-4 border-brand-orange flex flex-col justify-between">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-sm font-semibold text-gray-500 uppercase">Pending Deliveries</p>
                    <i class="fas fa-shipping-fast text-xl text-brand-orange"></i>
                </div>
                <div class="flex items-end justify-between">
                    <span class="text-4xl font-extrabold text-brand-blue">1</span>
                    <p class="text-xs text-brand-orange font-medium">ETA: 2 days</p>
                </div>
            </div>
        </section>


        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Left Column: Recent Orders & Subscription Summary (2/3 width on desktop) -->
            <div class="lg:col-span-2 space-y-6">

                <!-- 5. Active Subscription Section -->
                <section class="bg-white p-6 rounded-2xl shadow-soft">
                    <h3 class="text-xl font-bold mb-4 text-brand-blue">Active Subscription</h3>
                    <div class="flex flex-col md:flex-row items-center bg-brand-grey/50 p-4 rounded-xl border border-gray-100">
                        <img src="https://placehold.co/80x80/2A9D8F/ffffff?text=Premium" onerror="this.onerror=null; this.src='https://placehold.co/80x80/2A9D8F/ffffff?text=Premium';" alt="Package Image" class="w-20 h-20 object-cover rounded-lg mr-4 mb-4 md:mb-0 shadow-sm-brand">
                        <div class="flex-grow text-center md:text-left">
                            <p class="font-bold text-lg text-brand-blue">The Family Feast Package (Monthly)</p>
                            <p class="text-sm text-gray-600 mt-1">Next Renewal: <span class="font-semibold text-brand-teal">October 15, 2025</span></p>
                            <p class="text-sm text-gray-600">Renewal Amount: <span class="font-bold text-brand-blue">₦45,000</span></p>
                        </div>
                        <button class="w-full md:w-auto mt-4 md:mt-0 ml-0 md:ml-6 bg-brand-teal text-white font-medium py-2 px-4 rounded-full hover:bg-brand-blue transition-colors text-sm shadow-sm-brand">
                            <i class="fas fa-cog mr-2"></i> Manage Subscription
                        </button>
                    </div>
                </section>


                <!-- 4. Recent Orders Section -->
                <section class="bg-white p-6 rounded-2xl shadow-soft overflow-x-auto">
                    <h3 class="text-xl font-bold mb-4 text-brand-blue">Recent Orders</h3>
                    
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-brand-grey">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider rounded-tl-lg">Order ID</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Package Name</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Amount</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider rounded-tr-lg">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <!-- Order 1 -->
                            <tr class="hover:bg-brand-grey/50 transition-colors">
                                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-brand-blue">#FBNG-2510</td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">The Student Pack</td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-brand-teal">₦15,000</td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="status-badge bg-brand-teal/20 text-brand-teal">Delivered</span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">2025-09-25</td>
                                <td class="px-4 py-4 whitespace-nowrap text-right">
                                    <button class="text-brand-blue hover:text-brand-teal text-sm font-medium">View <i class="fas fa-chevron-right ml-1 text-xs"></i></button>
                                </td>
                            </tr>
                            <!-- Order 2 (Processing) -->
                            <tr class="hover:bg-brand-grey/50 transition-colors">
                                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-brand-blue">#FBNG-2511</td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">The Family Feast</td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-brand-teal">₦45,000</td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="status-badge bg-brand-gold/20 text-brand-blue">Processing</span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">2025-10-10</td>
                                <td class="px-4 py-4 whitespace-nowrap text-right">
                                    <button class="text-brand-blue hover:text-brand-teal text-sm font-medium">View <i class="fas fa-chevron-right ml-1 text-xs"></i></button>
                                </td>
                            </tr>
                            <!-- Order 3 -->
                            <tr class="hover:bg-brand-grey/50 transition-colors">
                                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-brand-blue">#FBNG-2509</td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">The Starter Kit</td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-brand-teal">₦8,500</td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="status-badge bg-brand-teal/20 text-brand-teal">Delivered</span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">2025-08-30</td>
                                <td class="px-4 py-4 whitespace-nowrap text-right">
                                    <button class="text-brand-blue hover:text-brand-teal text-sm font-medium">View <i class="fas fa-chevron-right ml-1 text-xs"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <div class="mt-4 text-center">
                        <a href="#" class="text-brand-teal font-semibold hover:text-brand-blue transition-colors text-sm">View All Orders &rarr;</a>
                    </div>
                </section>
            </div>

            <!-- Right Column: Quick Actions (1/3 width on desktop) -->
            <div class="lg:col-span-1 space-y-6">
                
                <!-- 6. Quick Actions Section -->
                <section class="bg-white p-6 rounded-2xl shadow-soft">
                    <h3 class="text-xl font-bold mb-4 text-brand-blue">Quick Actions</h3>
                    <div class="space-y-3">
                        
                        <button class="w-full flex items-center justify-center gap-3 bg-brand-teal text-white font-semibold py-3 rounded-xl hover:bg-brand-blue transition-colors shadow-sm-brand">
                            <i class="fas fa-shopping-basket"></i> Buy a New Package
                        </button>
                        
                        <button class="w-full flex items-center justify-center gap-3 bg-brand-gold text-brand-blue font-semibold py-3 rounded-xl hover:bg-brand-orange transition-colors shadow-sm-brand">
                            <i class="fas fa-arrow-up"></i> Upgrade Subscription
                        </button>
                        
                        <button class="w-full flex items-center justify-center gap-3 bg-brand-blue/10 border border-brand-blue/20 text-brand-blue font-semibold py-3 rounded-xl hover:bg-brand-teal/10 transition-colors">
                            <i class="fas fa-truck"></i> Track Latest Delivery
                        </button>

                        <button class="w-full flex items-center justify-center gap-3 bg-brand-blue/10 border border-brand-blue/20 text-brand-blue font-semibold py-3 rounded-xl hover:bg-brand-teal/10 transition-colors">
                            <i class="fas fa-headset"></i> Contact Support
                        </button>
                    </div>
                </section>
                
                <!-- Delivery Info Card -->
                <section class="bg-brand-blue/80 p-6 rounded-2xl shadow-soft border-t-4 border-brand-gold">
                    <h3 class="text-xl font-bold mb-3 text-white">Next Delivery Window</h3>
                    <div class="text-white/90 space-y-2">
                        <p class="text-3xl font-extrabold text-brand-gold">Mon, Oct 14</p>
                        <p class="font-medium">Between 10:00 AM and 2:00 PM</p>
                        <p class="text-sm">To: 14 Ikeja Road, Lagos, NG</p>
                        <button class="mt-3 text-sm font-semibold text-white/90 underline hover:text-brand-gold transition-colors">
                            Change Delivery Date
                        </button>
                    </div>
                </section>

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