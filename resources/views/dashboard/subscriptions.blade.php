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

    @include('dashboard.header')

    <!-- Main Content Area -->
    <main class="p-4 mt-20 md:p-8 lg:ml-64 main-content">
        
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