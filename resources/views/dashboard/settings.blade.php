<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Settings | FoodBox NG</title>
    
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

        /* Input field styling */
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #D1D5DB; /* Light gray border */
            border-radius: 0.75rem;
            background-color: white;
            transition: all 0.2s;
            outline: none;
        }
        .form-input:focus {
            border-color: #2A9D8F; /* Brand Teal on focus */
            box-shadow: 0 0 0 2px rgba(42, 157, 143, 0.2);
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

        /* Style for the settings tabs */
        .tab-button {
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            border-radius: 1.5rem;
            transition: all 0.2s;
            cursor: pointer;
        }
        .tab-button.active {
            background-color: #2A9D8F;
            color: white;
            box-shadow: 0 4px 15px -5px rgba(42, 157, 143, 0.4);
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

    <!-- 1. Sticky Sidebar Navigation (Reused) -->
    <aside id="sidebar" class="fixed top-0 left-0 h-full w-64 bg-brand-blue p-6 shadow-xl-heavy lg:translate-x-0">
        
        <!-- Logo/Brand -->
        <div class="flex items-center gap-2 mb-10 pb-4 border-b border-white/10">
            <div class="w-10 h-10 bg-brand-teal rounded-lg flex items-center justify-center text-white shadow-lg shadow-brand-teal/40">
                <i class="fas fa-leaf text-xl"></i>
            </div>
            <span class="text-2xl font-extrabold text-white tracking-tight">FoodBox<span class="text-brand-teal">NG</span></span>
        </div>

        <!-- Profile Info -->
        <div class="flex items-center gap-3 mb-8">
            <img src="https://placehold.co/40x40/E9C46A/264653?text=JO" onerror="this.onerror=null; this.src='https://placehold.co/40x40/E9C46A/264653?text=JO';" alt="Profile Avatar" class="w-10 h-10 rounded-full border-2 border-brand-gold/50 object-cover">
            <div class="text-white">
                <p class="font-semibold text-sm leading-tight">Jane Okoro</p>
                <p class="text-xs text-brand-teal">Premium User</p>
            </div>
        </div>

        <!-- Navigation Links (App Settings is Active) -->
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
            <!-- My Packages -->
            <a href="foodbox_my_packages.html" class="nav-link flex items-center gap-4 text-white/80 font-medium p-3 rounded-xl hover:bg-brand-teal transition-all hover:text-white">
                <i class="fas fa-cubes text-lg w-6 text-center"></i>
                <span>My Packages</span>
            </a>
            <a href="foodbox_subscriptions.html" class="nav-link flex items-center gap-4 text-white/80 font-medium p-3 rounded-xl hover:bg-brand-teal transition-all hover:text-white">
                <i class="fas fa-sync-alt text-lg w-6 text-center"></i>
                <span>Subscriptions</span>
            </a>
            <a href="foodbox_delivery_address.html" class="nav-link flex items-center gap-4 text-white/80 font-medium p-3 rounded-xl hover:bg-brand-teal transition-all hover:text-white">
                <i class="fas fa-map-marker-alt text-lg w-6 text-center"></i>
                <span>Delivery Address</span>
            </a>
            <a href="foodbox_payment_history.html" class="nav-link flex items-center gap-4 text-white/80 font-medium p-3 rounded-xl hover:bg-brand-teal transition-all hover:text-white">
                <i class="fas fa-credit-card text-lg w-6 text-center"></i>
                <span>Payment History</span>
            </a>
            <!-- Profile Settings -->
            <a href="foodbox_user_profile.html" class="nav-link flex items-center gap-4 text-white/80 font-medium p-3 rounded-xl hover:bg-brand-teal transition-all hover:text-white">
                <i class="fas fa-user-cog text-lg w-6 text-center"></i>
                <span>Profile Settings</span>
            </a>
            <!-- Application Settings (Active) -->
            <a href="#" class="nav-link active flex items-center gap-4 text-white font-medium p-3 rounded-xl">
                <i class="fas fa-cog text-lg w-6 text-center text-brand-gold"></i>
                <span>App Settings</span>
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

    <!-- 2. Top Header (Reused) -->
    <header class="fixed top-0 right-0 w-full lg:w-[calc(100%-16rem)] h-20 bg-white border-b border-gray-100 shadow-sm z-30 flex items-center px-4 md:px-8">
        <div class="flex-grow">
            <!-- Search Bar -->
            <div class="relative w-full max-w-sm hidden md:block">
                <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input 
                    type="search" 
                    placeholder="Search settings or help articles..."
                    class="w-full pl-12 pr-4 py-2 border border-gray-200 rounded-full focus:border-brand-teal focus:ring-1 focus:ring-brand-teal/20 outline-none transition-all text-sm bg-brand-grey/50"
                >
            </div>
            <h1 class="text-xl font-bold lg:hidden">Application Settings</h1>
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
                    <a href="foodbox_user_profile.html" class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-grey rounded-t-xl"><i class="fas fa-user-circle mr-2"></i> View Profile</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-grey"><i class="fas fa-cog mr-2"></i> App Settings</a>
                    <div class="border-t border-gray-100"></div>
                    <a href="#" class="block px-4 py-2 text-sm text-brand-red hover:bg-brand-red/10 rounded-b-xl"><i class="fas fa-sign-out-alt mr-2"></i> Log Out</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="lg:ml-64 p-4 md:p-8 main-content">
        
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-brand-blue mb-1">Application Preferences</h1>
            <p class="text-gray-600">Configure global app settings, data privacy, and accessibility options.</p>
        </div>

        <!-- Tabs Navigation for Settings -->
        <div class="mb-8 bg-white p-2 rounded-full shadow-soft/50 inline-flex space-x-2">
            <button class="tab-button active" onclick="showTab('general')">
                <i class="fas fa-sliders-h mr-2"></i> General
            </button>
            <button class="tab-button text-brand-blue/70 hover:bg-brand-grey" onclick="showTab('privacy')">
                <i class="fas fa-shield-virus mr-2"></i> Privacy & Data
            </button>
            <button class="tab-button text-brand-blue/70 hover:bg-brand-grey" onclick="showTab('accessibility')">
                <i class="fas fa-universal-access mr-2"></i> Accessibility
            </button>
        </div>

        <!-- Settings Content -->
        <div id="settings-content" class="space-y-8">

            <!-- 3. General Settings Tab (Default Active) -->
            <div id="tab-general" class="setting-tab bg-white p-6 md:p-8 rounded-3xl shadow-soft">
                <h3 class="text-xl font-bold text-brand-blue mb-6 border-b border-brand-grey pb-3 flex items-center gap-3"><i class="fas fa-sliders-h text-brand-teal"></i> General Preferences</h3>
                
                <div class="space-y-6">
                    
                    <!-- Theme Mode -->
                    <div class="flex justify-between items-start border-b border-brand-grey/50 pb-6">
                        <div>
                            <h4 class="font-semibold text-lg text-brand-blue">App Theme</h4>
                            <p class="text-sm text-gray-600">Switch between light mode (default) and dark mode.</p>
                        </div>
                        <div class="inline-flex rounded-full bg-brand-grey p-1 shadow-inner">
                            <button class="p-2 w-20 text-sm font-medium text-brand-blue rounded-full bg-white shadow-md">
                                Light
                            </button>
                            <button class="p-2 w-20 text-sm font-medium text-gray-500 hover:text-brand-blue transition-colors">
                                Dark
                            </button>
                        </div>
                    </div>

                    <!-- Default Language -->
                    <div class="border-b border-brand-grey/50 pb-6">
                        <label for="app_language" class="block text-sm font-medium text-gray-700 mb-2">Default Language</label>
                        <select id="app_language" class="form-input w-full md:w-1/2">
                            <option value="en">English (US)</option>
                            <option value="gb">English (UK)</option>
                            <option value="fr">French</option>
                            <option value="es">Spanish</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Changing this affects all in-app text and labels.</p>
                    </div>

                    <!-- Currency -->
                    <div>
                        <label for="default_currency" class="block text-sm font-medium text-gray-700 mb-2">Preferred Currency</label>
                        <select id="default_currency" class="form-input w-full md:w-1/2">
                            <option value="NGN">Nigerian Naira (NGN)</option>
                            <option value="USD">US Dollar (USD)</option>
                            <option value="GBP">British Pound (GBP)</option>
                            <option value="EUR">Euro (EUR)</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Used for pricing and payment history display.</p>
                    </div>

                </div>
            </div>

            <!-- 4. Privacy & Data Tab (Hidden by default) -->
            <div id="tab-privacy" class="setting-tab hidden bg-white p-6 md:p-8 rounded-3xl shadow-soft">
                <h3 class="text-xl font-bold text-brand-blue mb-6 border-b border-brand-grey pb-3 flex items-center gap-3"><i class="fas fa-shield-virus text-brand-teal"></i> Privacy & Data</h3>
                
                <div class="space-y-6">
                    <!-- Data Sharing Toggle -->
                    <div class="flex justify-between items-start border-b border-brand-grey/50 pb-6">
                        <div>
                            <h4 class="font-semibold text-lg text-brand-blue">Usage Data Sharing</h4>
                            <p class="text-sm text-gray-600">Allow us to use anonymized data to improve FoodBox NG services and products.</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer" checked>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-brand-teal/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-teal"></div>
                        </label>
                    </div>

                    <!-- Export Data -->
                    <div class="flex justify-between items-start border-b border-brand-grey/50 pb-6">
                        <div>
                            <h4 class="font-semibold text-lg text-brand-blue">Export Personal Data</h4>
                            <p class="text-sm text-gray-600">Download a copy of all your account and order history data (JSON/CSV format).</p>
                        </div>
                        <button class="py-2 px-4 text-sm font-semibold border border-brand-teal text-brand-teal rounded-xl hover:bg-brand-teal/10 transition-colors">
                            <i class="fas fa-download mr-2"></i> Request Export
                        </button>
                    </div>

                    <!-- Manage Cookies -->
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="font-semibold text-lg text-brand-blue">Manage Cookies</h4>
                            <p class="text-sm text-gray-600">Review and change your preferences for functional, performance, and marketing cookies.</p>
                        </div>
                        <button class="py-2 px-4 text-sm font-semibold bg-brand-gold text-brand-blue rounded-xl hover:bg-brand-gold/90 transition-colors">
                            Review Preferences
                        </button>
                    </div>
                </div>
            </div>

            <!-- 5. Accessibility Tab (Hidden by default) -->
            <div id="tab-accessibility" class="setting-tab hidden bg-white p-6 md:p-8 rounded-3xl shadow-soft">
                <h3 class="text-xl font-bold text-brand-blue mb-6 border-b border-brand-grey pb-3 flex items-center gap-3"><i class="fas fa-universal-access text-brand-teal"></i> Accessibility Options</h3>
                
                <div class="space-y-6">
                    <!-- High Contrast Toggle -->
                    <div class="flex justify-between items-start border-b border-brand-grey/50 pb-6">
                        <div>
                            <h4 class="font-semibold text-lg text-brand-blue">High Contrast Mode</h4>
                            <p class="text-sm text-gray-600">Increases color contrast for better text visibility and readability.</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-brand-teal/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-teal"></div>
                        </label>
                    </div>

                    <!-- Text Size Slider -->
                    <div>
                        <h4 class="font-semibold text-lg text-brand-blue mb-3">Text Scaling (Zoom)</h4>
                        <p class="text-sm text-gray-600 mb-4">Adjust the base font size for the entire application.</p>
                        <div class="relative pt-1">
                            <input type="range" min="100" max="150" value="100" step="10" class="w-full h-2 bg-brand-grey rounded-lg appearance-none cursor-pointer range-lg">
                            <div class="flex justify-between text-xs font-medium text-gray-500 mt-2">
                                <span>100% (Default)</span>
                                <span>110%</span>
                                <span>120%</span>
                                <span>130%</span>
                                <span>140%</span>
                                <span>150% (Max)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Save All Button -->
            <div class="flex justify-end pt-4">
                <button type="submit" class="px-8 py-3 bg-brand-teal text-white font-semibold rounded-xl hover:bg-brand-teal/90 transition-colors shadow-sm-brand">
                    Save All App Settings
                </button>
            </div>
        </div>

        <!-- Footer Spacer -->
        <div class="h-12"></div>
    </main>

    <!-- JavaScript for Mobile Sidebar Toggle & Tabs -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const menuToggle = document.getElementById('menu-toggle');
        const backdrop = document.getElementById('backdrop');
        const tabs = document.querySelectorAll('.setting-tab');
        const tabButtons = document.querySelectorAll('.tab-button');

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

        menuToggle.addEventListener('click', toggleSidebar);
        backdrop.addEventListener('click', toggleSidebar);

        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024) { 
                    setTimeout(() => toggleSidebar(), 150);
                }
            });
        });

        // --- Tab Switching Logic ---

        function showTab(tabId) {
            // Hide all tabs
            tabs.forEach(tab => {
                tab.classList.add('hidden');
            });

            // Deactivate all buttons
            tabButtons.forEach(btn => {
                btn.classList.remove('active', 'text-brand-blue/70', 'hover:bg-brand-grey');
                btn.classList.add('text-brand-blue/70', 'hover:bg-brand-grey');
            });

            // Show the selected tab
            const activeTab = document.getElementById(`tab-${tabId}`);
            if (activeTab) {
                activeTab.classList.remove('hidden');
            }

            // Activate the corresponding button
            const activeBtn = document.querySelector(`.tab-button[onclick*="'${tabId}'"]`);
            if (activeBtn) {
                activeBtn.classList.add('active');
                activeBtn.classList.remove('text-brand-blue/70', 'hover:bg-brand-grey');
            }
        }
    </script>
</body>
</html>