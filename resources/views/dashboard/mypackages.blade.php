<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Packages | FoodBox NG</title>
    
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
            z-index: 50;
        }
        /* On mobile, hide the sidebar off-screen by default */
        @media (max-width: 1023px) {
            #sidebar {
                transform: translateX(-100%);
            }
            #sidebar.open {
                transform: translateX(0);
            }
        }
        /* On desktop (lg+), sidebar is always visible */
        @media (min-width: 1024px) {
            #sidebar {
                transform: translateX(0);
            }
        }
        
        /* Backdrop for mobile sidebar */
        #backdrop {
            transition: opacity 0.3s ease-in-out;
        }

        /* Styling for the main content area */
        .main-content {
            padding-top: 5rem; /* Space for the fixed header */
        }

        /* Active link styling (My Packages is active here) */
        .nav-link.active {
            background-color: #2A9D8F;
            color: white;
            box-shadow: 0 5px 15px -5px rgba(42, 157, 143, 0.4);
        }
        .nav-link.active i {
            color: #E9C46A; /* Gold icon when active */
        }

        /* Package Card Hover Effect */
        .package-card {
            transition: all 0.3s ease;
            cursor: pointer;
            border-left: 5px solid transparent;
        }
        .package-card:hover {
            transform: translateX(5px);
            box-shadow: 0 8px 25px -10px rgba(38, 70, 83, 0.1);
        }
        .package-card.status-upcoming {
            border-left-color: #2A9D8F;
        }
        .package-card.status-delivered {
            border-left-color: #E9C46A;
        }

    </style>
</head>
<body class="bg-brand-grey text-brand-blue antialiased min-h-screen">

    @include('dashboard.header')

    <!-- Main Content Area -->
    <main class="p-4 mt-20 md:p-8 lg:ml-64 main-content">
        
        <!-- Header Section -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-brand-blue mb-1">Your Food Packages</h1>
            <p class="text-gray-600">Track upcoming deliveries and review the contents of your past FoodBox NG packages.</p>
        </div>

        <!-- Upcoming Packages Section -->
        <section class="mb-10">
            <h2 class="text-2xl font-semibold text-brand-blue mb-4 flex items-center gap-2">
                <i class="fas fa-shipping-fast text-brand-teal"></i> Upcoming Deliveries (2)
            </h2>
            
            <div class="grid grid-cols-1 gap-6">

                <!-- Package Card 1: Next Week's Delivery (Awaiting Customization) -->
                <div class="package-card status-upcoming bg-white p-6 rounded-2xl shadow-soft">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 border-b border-brand-grey pb-4">
                        <div class="mb-3 md:mb-0">
                            <span class="text-xs font-semibold text-brand-blue/70 block">Package ID: #FB-5489</span>
                            <h3 class="text-xl font-bold text-brand-blue flex items-center gap-2">
                                Weekly Family Box <i class="fas fa-star text-brand-gold text-sm"></i>
                            </h3>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="px-3 py-1 bg-brand-orange/20 text-brand-orange text-xs font-semibold rounded-full">Awaiting Customization</span>
                            <span class="px-3 py-1 bg-brand-teal/20 text-brand-teal text-xs font-semibold rounded-full">Subscription: Family Feast</span>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 text-sm mb-4">
                        <div>
                            <p class="text-gray-500">Scheduled Date</p>
                            <p class="font-semibold text-brand-blue">Monday, Dec 15, 2025</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Estimated Delivery Time</p>
                            <p class="font-semibold text-brand-blue">2:00 PM - 4:00 PM</p>
                        </div>
                        <div class="col-span-2">
                            <p class="text-gray-500">Current Contents Summary</p>
                            <p class="font-semibold text-brand-blue">Default mix: Chicken, Rice, Yam, Spinach, & assorted spices.</p>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-brand-grey">
                        <button class="flex-1 bg-brand-teal text-white py-3 rounded-xl font-semibold hover:bg-brand-teal/90 transition-colors shadow-sm-brand">
                            <i class="fas fa-pencil-alt mr-2"></i> Customize This Package
                        </button>
                        <button class="flex-1 bg-brand-blue/10 text-brand-blue py-3 rounded-xl font-semibold hover:bg-brand-blue/20 transition-colors">
                            <i class="fas fa-route mr-2"></i> Track Delivery Status
                        </button>
                    </div>
                </div>

                <!-- Package Card 2: Later Delivery (Default Manifest) -->
                <div class="package-card status-upcoming bg-white p-6 rounded-2xl shadow-soft">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 border-b border-brand-grey pb-4">
                        <div class="mb-3 md:mb-0">
                            <span class="text-xs font-semibold text-brand-blue/70 block">Package ID: #FB-5501</span>
                            <h3 class="text-xl font-bold text-brand-blue">Monthly Student Box</h3>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="px-3 py-1 bg-brand-teal/20 text-brand-teal text-xs font-semibold rounded-full">Default Manifest Set</span>
                            <span class="px-3 py-1 bg-brand-teal/20 text-brand-teal text-xs font-semibold rounded-full">Subscription: Student Pack</span>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 text-sm mb-4">
                        <div>
                            <p class="text-gray-500">Scheduled Date</p>
                            <p class="font-semibold text-brand-blue">Friday, Jan 10, 2026</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Estimated Delivery Time</p>
                            <p class="font-semibold text-brand-blue">10:00 AM - 1:00 PM</p>
                        </div>
                        <div class="col-span-2">
                            <p class="text-gray-500">Current Contents Summary</p>
                            <p class="font-semibold text-brand-blue">Beans, Garri, Instant Noodles, Canned Tomatoes, and Groundnut Oil.</p>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-brand-grey">
                        <button class="flex-1 bg-brand-teal text-white py-3 rounded-xl font-semibold hover:bg-brand-teal/90 transition-colors shadow-sm-brand">
                            <i class="fas fa-box-open mr-2"></i> View/Edit Default Manifest
                        </button>
                        <button class="flex-1 bg-brand-blue/10 text-brand-blue py-3 rounded-xl font-semibold hover:bg-brand-blue/20 transition-colors">
                            <i class="fas fa-route mr-2"></i> Track Delivery Status
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Delivered Packages Section -->
        <section class="mb-10">
            <h2 class="text-2xl font-semibold text-brand-blue mb-4 flex items-center gap-2">
                <i class="fas fa-check-circle text-brand-gold"></i> Past Delivered Packages (3)
            </h2>
            
            <div class="grid grid-cols-1 gap-6">

                <!-- Package Card 3: Delivered Package -->
                <div class="package-card status-delivered bg-white p-6 rounded-2xl shadow-soft">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 border-b border-brand-grey pb-4">
                        <div class="mb-3 md:mb-0">
                            <span class="text-xs font-semibold text-brand-blue/70 block">Package ID: #FB-5477</span>
                            <h3 class="text-xl font-bold text-brand-blue">Weekly Family Box</h3>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="px-3 py-1 bg-green-500/10 text-green-700 text-xs font-semibold rounded-full">Delivered</span>
                            <span class="px-3 py-1 bg-brand-teal/20 text-brand-teal text-xs font-semibold rounded-full">Subscription: Family Feast</span>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 text-sm mb-4">
                        <div>
                            <p class="text-gray-500">Delivered On</p>
                            <p class="font-semibold text-brand-blue">Monday, Nov 27, 2025</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Delivered Time</p>
                            <p class="font-semibold text-brand-blue">3:15 PM</p>
                        </div>
                        <div class="col-span-2">
                            <p class="text-gray-500">Contents</p>
                            <p class="font-semibold text-brand-blue">Customized: Fish, Plantain, Peppers, Onions, and cooking oil.</p>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-brand-grey">
                        <button class="flex-1 bg-brand-blue/10 text-brand-blue py-3 rounded-xl font-semibold hover:bg-brand-blue/20 transition-colors">
                            <i class="fas fa-file-invoice mr-2"></i> View Full Manifest
                        </button>
                        <button class="flex-1 bg-brand-red/10 text-brand-red py-3 rounded-xl font-semibold hover:bg-brand-red/20 transition-colors">
                            <i class="fas fa-times-circle mr-2"></i> Report Missing Item
                        </button>
                    </div>
                </div>

                <!-- Package Card 4: Another Delivered Package (Scroll Example) -->
                 <div class="package-card status-delivered bg-white p-6 rounded-2xl shadow-soft">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 border-b border-brand-grey pb-4">
                        <div class="mb-3 md:mb-0">
                            <span class="text-xs font-semibold text-brand-blue/70 block">Package ID: #FB-5463</span>
                            <h3 class="text-xl font-bold text-brand-blue">Keto Health Pack</h3>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="px-3 py-1 bg-green-500/10 text-green-700 text-xs font-semibold rounded-full">Delivered</span>
                            <span class="px-3 py-1 bg-brand-teal/20 text-brand-teal text-xs font-semibold rounded-full">Subscription: Keto Health</span>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 text-sm mb-4">
                        <div>
                            <p class="text-gray-500">Delivered On</p>
                            <p class="font-semibold text-brand-blue">Tuesday, Nov 07, 2025</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Delivered Time</p>
                            <p class="font-semibold text-brand-blue">1:50 PM</p>
                        </div>
                        <div class="col-span-2">
                            <p class="text-gray-500">Contents</p>
                            <p class="font-semibold text-brand-blue">Beef, Avocados, Broccoli, Eggs, and Cheese.</p>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-brand-grey">
                        <button class="flex-1 bg-brand-blue/10 text-brand-blue py-3 rounded-xl font-semibold hover:bg-brand-blue/20 transition-colors">
                            <i class="fas fa-file-invoice mr-2"></i> View Full Manifest
                        </button>
                        <button class="flex-1 bg-brand-red/10 text-brand-red py-3 rounded-xl font-semibold hover:bg-brand-red/20 transition-colors">
                            <i class="fas fa-times-circle mr-2"></i> Report Missing Item
                        </button>
                    </div>
                </div>

            </div>
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