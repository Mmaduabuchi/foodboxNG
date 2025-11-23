<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Subscriptions | FoodBox NG</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Tailwind Config (Reused from Dashboard) -->
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

        /* Styling for the main content area */
        .main-content {
            padding-top: 5rem; /* Space for the fixed header */
        }

        /* Active link styling (Subscriptions is active here) */
        .nav-link.active {
            background-color: #2A9D8F;
            color: white;
            box-shadow: 0 5px 15px -5px rgba(42, 157, 143, 0.4);
        }
        .nav-link.active i {
            color: #E9C46A; /* Gold icon when active */
        }

        /* Subscription Card Hover Effect */
        .sub-card {
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid transparent;
        }
        .sub-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px -10px rgba(42, 157, 143, 0.2);
            border-color: #2A9D8F;
        }

    </style>
</head>
<body class="bg-brand-grey text-brand-blue antialiased min-h-screen">

    <!-- Mobile Menu Button -->
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
            <!-- Dashboard -->
            <a href="foodbox_dashboard.html" class="nav-link flex items-center gap-4 text-white/80 font-medium p-3 rounded-xl hover:bg-brand-teal transition-all hover:text-white">
                <i class="fas fa-chart-line text-lg w-6 text-center"></i>
                <span>Dashboard</span>
            </a>
            <!-- My Orders -->
            <a href="foodbox_my_orders.html" class="nav-link flex items-center gap-4 text-white/80 font-medium p-3 rounded-xl hover:bg-brand-teal transition-all hover:text-white">
                <i class="fas fa-box text-lg w-6 text-center"></i>
                <span>My Orders</span>
            </a>
            <a href="#" class="nav-link flex items-center gap-4 text-white/80 font-medium p-3 rounded-xl hover:bg-brand-teal transition-all hover:text-white">
                <i class="fas fa-cubes text-lg w-6 text-center"></i>
                <span>My Packages</span>
            </a>
            <!-- Subscriptions (Active) -->
            <a href="#" class="nav-link active flex items-center gap-4 text-white font-medium p-3 rounded-xl hover:bg-brand-teal transition-all">
                <i class="fas fa-sync-alt text-lg w-6 text-center text-brand-gold"></i>
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

    <!-- 2. Top Header (Identical to Dashboard) -->
    <header class="fixed top-0 right-0 w-full lg:w-[calc(100%-16rem)] h-20 bg-white border-b border-gray-100 shadow-sm z-30 flex items-center px-4 md:px-8">
        <div class="flex-grow">
            <!-- Search Bar -->
            <div class="relative w-full max-w-sm hidden md:block">
                <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input 
                    type="search" 
                    placeholder="Search subscriptions, packages, or settings..."
                    class="w-full pl-12 pr-4 py-2 border border-gray-200 rounded-full focus:border-brand-teal focus:ring-1 focus:ring-brand-teal/20 outline-none transition-all text-sm bg-brand-grey/50"
                >
            </div>
            <h1 class="text-xl font-bold lg:hidden">Subscriptions</h1>
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
        
        <!-- Header Section -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-brand-blue mb-1">Manage Subscriptions</h1>
            <p class="text-gray-600">View and modify your active, paused, or cancelled recurring packages.</p>
        </div>

        <!-- Active Subscriptions Section -->
        <section class="mb-10">
            <h2 class="text-2xl font-semibold text-brand-blue mb-4 flex items-center gap-2">
                <i class="fas fa-heart text-brand-red"></i> Active Subscriptions (2)
            </h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Subscription Card 1: Family Feast (Active) -->
                <div class="sub-card bg-white p-6 rounded-2xl shadow-soft flex flex-col sm:flex-row gap-4">
                    <div class="w-full sm:w-24 h-24 sm:h-auto bg-brand-teal/20 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-utensils text-4xl text-brand-teal"></i>
                    </div>
                    <div class="flex-grow">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-brand-blue">The Family Feast</h3>
                            <span class="px-3 py-1 bg-brand-teal text-white text-xs font-semibold rounded-full shadow-sm-brand">Active</span>
                        </div>
                        
                        <p class="text-2xl font-extrabold text-brand-teal mb-3">
                            ₦45,000 <span class="text-sm font-medium text-gray-500">/ month</span>
                        </p>
                        
                        <div class="text-sm text-gray-600 space-y-1 mb-4">
                            <p><i class="fas fa-calendar-alt text-brand-gold w-4"></i> Next Renewal: <span class="font-semibold text-brand-blue">Nov 30, 2025</span></p>
                            <p><i class="fas fa-truck text-brand-gold w-4"></i> Delivery Frequency: <span class="font-semibold text-brand-blue">Bi-Weekly</span></p>
                            <p><i class="fas fa-map-marker-alt text-brand-gold w-4"></i> Delivery Zone: <span class="font-semibold text-brand-blue">Zone A (Lagos Mainland)</span></p>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row gap-2 mt-4 pt-4 border-t border-brand-grey">
                            <button class="flex-1 bg-brand-blue text-white py-2 rounded-xl text-sm font-semibold hover:bg-brand-blue/90 transition-colors">Modify Package</button>
                            <button class="flex-1 bg-brand-orange/10 text-brand-orange py-2 rounded-xl text-sm font-semibold hover:bg-brand-orange/20 transition-colors">Pause Subscription</button>
                        </div>
                    </div>
                </div>

                <!-- Subscription Card 2: Student Pack (Active) -->
                <div class="sub-card bg-white p-6 rounded-2xl shadow-soft flex flex-col sm:flex-row gap-4">
                    <div class="w-full sm:w-24 h-24 sm:h-auto bg-brand-gold/20 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-book text-4xl text-brand-gold"></i>
                    </div>
                    <div class="flex-grow">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-brand-blue">The Student Pack</h3>
                            <span class="px-3 py-1 bg-brand-teal text-white text-xs font-semibold rounded-full shadow-sm-brand">Active</span>
                        </div>
                        
                        <p class="text-2xl font-extrabold text-brand-teal mb-3">
                            ₦15,000 <span class="text-sm font-medium text-gray-500">/ month</span>
                        </p>
                        
                        <div class="text-sm text-gray-600 space-y-1 mb-4">
                            <p><i class="fas fa-calendar-alt text-brand-gold w-4"></i> Next Renewal: <span class="font-semibold text-brand-blue">Dec 10, 2025</span></p>
                            <p><i class="fas fa-truck text-brand-gold w-4"></i> Delivery Frequency: <span class="font-semibold text-brand-blue">Monthly</span></p>
                            <p><i class="fas fa-map-marker-alt text-brand-gold w-4"></i> Delivery Zone: <span class="font-semibold text-brand-blue">Zone D (Ikeja)</span></p>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row gap-2 mt-4 pt-4 border-t border-brand-grey">
                            <button class="flex-1 bg-brand-blue text-white py-2 rounded-xl text-sm font-semibold hover:bg-brand-blue/90 transition-colors">Modify Package</button>
                            <button class="flex-1 bg-brand-orange/10 text-brand-orange py-2 rounded-xl text-sm font-semibold hover:bg-brand-orange/20 transition-colors">Pause Subscription</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Paused/Inactive Subscriptions Section -->
        <section class="mb-10">
            <h2 class="text-2xl font-semibold text-brand-blue mb-4 flex items-center gap-2">
                <i class="fas fa-stopwatch text-brand-orange"></i> Inactive/Paused (1)
            </h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 opacity-60">

                <!-- Subscription Card 3: Keto Health Pack (Paused) -->
                <div class="sub-card bg-white p-6 rounded-2xl shadow-soft flex flex-col sm:flex-row gap-4">
                    <div class="w-full sm:w-24 h-24 sm:h-auto bg-brand-red/10 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-pause-circle text-4xl text-brand-red"></i>
                    </div>
                    <div class="flex-grow">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-brand-blue">Keto Health Pack</h3>
                            <span class="px-3 py-1 bg-brand-red/70 text-white text-xs font-semibold rounded-full shadow-sm">Paused</span>
                        </div>
                        
                        <p class="text-2xl font-extrabold text-brand-teal mb-3">
                            ₦28,000 <span class="text-sm font-medium text-gray-500">/ month</span>
                        </p>
                        
                        <div class="text-sm text-gray-600 space-y-1 mb-4">
                            <p><i class="fas fa-calendar-times text-brand-gold w-4"></i> Last Renewal: <span class="font-semibold text-brand-blue">Sep 01, 2025</span></p>
                            <p><i class="fas fa-truck text-brand-gold w-4"></i> Delivery Frequency: <span class="font-semibold text-brand-blue">Weekly</span></p>
                            <p><i class="fas fa-info-circle text-brand-gold w-4"></i> Status Info: <span class="font-semibold text-brand-red">Paused indefinitely by user</span></p>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row gap-2 mt-4 pt-4 border-t border-brand-grey">
                            <button class="flex-1 bg-brand-teal text-white py-2 rounded-xl text-sm font-semibold hover:bg-brand-teal/90 transition-colors">Resume Subscription</button>
                            <button class="flex-1 bg-brand-red/10 text-brand-red py-2 rounded-xl text-sm font-semibold hover:bg-brand-red/20 transition-colors">Cancel Permanently</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Explore Packages CTA -->
        <section class="mb-10 p-6 bg-brand-blue rounded-2xl text-white flex flex-col md:flex-row items-center justify-between shadow-xl-heavy">
            <div class="mb-4 md:mb-0">
                <h3 class="text-xl font-bold flex items-center gap-2">
                    <i class="fas fa-tag text-brand-gold"></i> Find Your Next Package
                </h3>
                <p class="text-white/80">Discover new weekly, bi-weekly, or monthly food subscription plans.</p>
            </div>
            <button class="w-full md:w-auto bg-brand-teal text-white px-6 py-3 rounded-xl font-bold shadow-md shadow-brand-teal/50 hover:bg-brand-teal/90 transition-colors flex items-center justify-center gap-2">
                <i class="fas fa-arrow-right"></i> Browse All Packages
            </button>
        </section>
        
        <!-- Footer Spacer -->
        <div class="h-12"></div>
    </main>

    <!-- JavaScript for Mobile Sidebar Toggle (Identical to Dashboard) -->
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