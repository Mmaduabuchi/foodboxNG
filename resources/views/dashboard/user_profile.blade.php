<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings | FoodBox NG</title>
    
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

        <!-- Navigation Links (Profile Settings is Active) -->
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
            <!-- Profile Settings (Active) -->
            <a href="#" class="nav-link active flex items-center gap-4 text-white font-medium p-3 rounded-xl">
                <i class="fas fa-cog text-lg w-6 text-center text-brand-gold"></i>
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
            <h1 class="text-xl font-bold lg:hidden">Profile Settings</h1>
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
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-brand-blue mb-1">Profile & Account Settings</h1>
            <p class="text-gray-600">Manage your personal information, security preferences, and communication settings.</p>
        </div>

        <!-- Main Settings Grid -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            
            <!-- Column 1: Profile Card & Quick Actions (md:col-span-1) -->
            <div class="xl:col-span-1 space-y-8">
                
                <!-- Profile Summary Card -->
                <div class="bg-white p-6 rounded-3xl shadow-soft text-center">
                    <div class="relative w-24 h-24 mx-auto mb-4">
                        <img src="https://placehold.co/100x100/E9C46A/264653?text=JO" onerror="this.onerror=null; this.src='https://placehold.co/100x100/E9C46A/264653?text=JO';" alt="Profile Avatar" class="w-full h-full rounded-full object-cover border-4 border-brand-teal/20">
                        <button class="absolute bottom-0 right-0 p-2 bg-brand-teal text-white rounded-full border-2 border-white shadow-md hover:bg-brand-teal/90 transition-colors">
                            <i class="fas fa-camera text-sm"></i>
                        </button>
                    </div>
                    <h2 class="text-xl font-bold text-brand-blue">Jane Okoro</h2>
                    <p class="text-sm text-gray-500 mb-3">jane.okoro@example.com</p>
                    <div class="inline-flex items-center text-xs font-semibold px-3 py-1 rounded-full bg-brand-gold/20 text-brand-gold">
                        <i class="fas fa-crown mr-1"></i> Premium Member
                    </div>
                    <p class="text-xs text-gray-400 mt-4">Member since January 2024</p>
                </div>

                <!-- Account Status / Deactivation -->
                <div class="bg-white p-6 rounded-3xl shadow-soft">
                    <h3 class="text-lg font-semibold text-brand-blue mb-4 flex items-center gap-2"><i class="fas fa-shield-alt text-brand-teal"></i> Account Status</h3>
                    <p class="text-sm text-gray-600 mb-4">Your account is active and protected. If you wish to leave, you can deactivate your account.</p>
                    <button class="w-full py-2 border border-brand-red text-brand-red font-semibold rounded-xl hover:bg-brand-red/10 transition-colors">
                        Deactivate Account
                    </button>
                </div>
            </div>

            <!-- Column 2 & 3: Forms and Sections (xl:col-span-2) -->
            <div class="xl:col-span-2 space-y-8">

                <!-- 3. Personal Information Form -->
                <div id="personal-info" class="bg-white p-6 md:p-8 rounded-3xl shadow-soft">
                    <h3 class="text-xl font-bold text-brand-blue mb-6 border-b border-brand-grey pb-3 flex items-center gap-3"><i class="fas fa-user-circle text-brand-teal"></i> Personal Information</h3>
                    <form>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- First Name -->
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                <input type="text" id="first_name" name="first_name" value="Jane" class="form-input" required>
                            </div>
                            <!-- Last Name -->
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                                <input type="text" id="last_name" name="last_name" value="Okoro" class="form-input" required>
                            </div>
                            <!-- Email -->
                            <div class="md:col-span-2">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                <input type="email" id="email" name="email" value="jane.okoro@example.com" class="form-input" disabled>
                                <p class="text-xs text-gray-500 mt-1">Email address cannot be changed here. Contact support.</p>
                            </div>
                            <!-- Phone Number -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="tel" id="phone" name="phone" value="+234 803 123 4567" class="form-input">
                            </div>
                            <!-- Date of Birth -->
                            <div>
                                <label for="dob" class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                                <input type="date" id="dob" name="dob" value="1995-10-25" class="form-input">
                            </div>
                        </div>
                        <div class="mt-8 flex justify-end">
                            <button type="submit" class="px-6 py-3 bg-brand-teal text-white font-semibold rounded-xl hover:bg-brand-teal/90 transition-colors shadow-sm-brand">
                                Save Profile Changes
                            </button>
                        </div>
                    </form>
                </div>

                <!-- 4. Security Settings -->
                <div id="security" class="bg-white p-6 md:p-8 rounded-3xl shadow-soft">
                    <h3 class="text-xl font-bold text-brand-blue mb-6 border-b border-brand-grey pb-3 flex items-center gap-3"><i class="fas fa-lock text-brand-teal"></i> Security Settings</h3>
                    
                    <div class="space-y-6">
                        <!-- Change Password Section -->
                        <div class="border-b border-brand-grey pb-6">
                            <h4 class="font-semibold text-lg text-brand-blue mb-3">Change Password</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                                    <input type="password" id="current_password" class="form-input" placeholder="Enter current password">
                                </div>
                                <div>
                                    <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                                    <input type="password" id="new_password" class="form-input" placeholder="Enter new password">
                                </div>
                            </div>
                            <button class="mt-4 px-5 py-2 text-sm bg-brand-blue text-white font-semibold rounded-xl hover:bg-brand-blue/90 transition-colors">
                                Update Password
                            </button>
                        </div>

                        <!-- Two-Factor Authentication Toggle -->
                        <div class="flex justify-between items-center">
                            <div>
                                <h4 class="font-semibold text-lg text-brand-blue">Two-Factor Authentication (2FA)</h4>
                                <p class="text-sm text-gray-600">Adds an extra layer of security to your account.</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" value="" class="sr-only peer" checked>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-brand-teal/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-teal"></div>
                            </label>
                        </div>
                    </div>
                </div>
                
                <!-- 5. Notifications Preferences -->
                <div id="notifications" class="bg-white p-6 md:p-8 rounded-3xl shadow-soft">
                    <h3 class="text-xl font-bold text-brand-blue mb-6 border-b border-brand-grey pb-3 flex items-center gap-3"><i class="fas fa-bell text-brand-teal"></i> Notification Preferences</h3>
                    
                    <div class="space-y-4">
                        <!-- Package Updates -->
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="font-semibold text-brand-blue">Package Delivery Updates</h4>
                                <p class="text-sm text-gray-600">Get alerts on delivery, delays, and successful drop-offs.</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" value="" class="sr-only peer" checked>
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer-checked:bg-brand-teal transition-all"></div>
                                <span class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-full"></span>
                            </label>
                        </div>
                        
                        <!-- Subscription Billing -->
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="font-semibold text-brand-blue">Billing and Payment Notifications</h4>
                                <p class="text-sm text-gray-600">Receive receipts, subscription renewal reminders, and payment failure alerts.</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" value="" class="sr-only peer" checked>
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer-checked:bg-brand-teal transition-all"></div>
                                <span class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-full"></span>
                            </label>
                        </div>

                        <!-- Marketing Emails -->
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="font-semibold text-brand-blue">Special Offers and Promotions</h4>
                                <p class="text-sm text-gray-600">Occasional emails about new boxes, discounts, and partnership offers.</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" value="" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer-checked:bg-brand-teal transition-all"></div>
                                <span class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-full"></span>
                            </label>
                        </div>
                    </div>
                    <div class="mt-8 flex justify-end">
                        <button type="submit" class="px-6 py-3 bg-brand-teal text-white font-semibold rounded-xl hover:bg-brand-teal/90 transition-colors shadow-sm-brand">
                            Update Preferences
                        </button>
                    </div>
                </div>

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
                    // Small delay to let the click action register visually before closing
                    setTimeout(() => toggleSidebar(), 150);
                }
            });
        });
    </script>
</body>
</html>