<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Settings | FoodBox NG</title>
    
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

        /* Custom Toggle Switch for features */
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 44px;
            height: 24px;
        }
        .toggle-switch input { opacity: 0; width: 0; height: 0; }
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }
        input:checked + .slider {
            background-color: #2A9D8F; /* brand-teal */
        }
        input:checked + .slider:before {
            transform: translateX(20px);
        }

        /* Input Focus Styling */
        input[type="text"], input[type="email"], select, textarea {
            border: 1px solid #E5E7EB;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            transition: all 0.2s;
        }
        input[type="text"]:focus, input[type="email"]:focus, select:focus, textarea:focus {
            border-color: #2A9D8F;
            box-shadow: 0 0 0 1px #2A9D8F;
            outline: none;
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
        
        <form class="space-y-8">
            
            <!-- Section 1: General Platform Configuration -->
            <div class="bg-white p-6 md:p-8 rounded-2xl shadow-soft border-t-4 border-brand-blue">
                <div class="flex items-center space-x-3 mb-6 border-b pb-4">
                    <i class="fas fa-cogs text-3xl text-brand-blue"></i>
                    <h2 class="text-2xl font-bold text-brand-blue">1. Platform Configuration</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- App Name -->
                    <div class="space-y-2">
                        <label for="appName" class="block text-sm font-medium text-gray-700">Application Name</label>
                        <input type="text" id="appName" value="FoodBox NG" class="w-full bg-brand-grey/50">
                        <p class="text-xs text-gray-500">The primary display name for the platform.</p>
                    </div>

                    <!-- Default Timezone -->
                    <div class="space-y-2">
                        <label for="timezone" class="block text-sm font-medium text-gray-700">Default Timezone</label>
                        <select id="timezone" class="w-full bg-brand-grey/50">
                            <option value="WAT" selected>WAT (West Africa Time) - Lagos</option>
                            <option value="GMT">GMT (Greenwich Mean Time)</option>
                            <option value="CET">CET (Central European Time)</option>
                        </select>
                        <p class="text-xs text-gray-500">Affects all order and transaction timestamps.</p>
                    </div>

                    <!-- Contact Email -->
                    <div class="space-y-2">
                        <label for="contactEmail" class="block text-sm font-medium text-gray-700">Support Contact Email</label>
                        <input type="email" id="contactEmail" value="support@foodbox.ng" class="w-full bg-brand-grey/50">
                        <p class="text-xs text-gray-500">Used for automated support messages and communication.</p>
                    </div>
                    
                    <!-- Currency Symbol -->
                    <div class="space-y-2">
                        <label for="currencySymbol" class="block text-sm font-medium text-gray-700">Primary Currency Symbol</label>
                        <select id="currencySymbol" class="w-full bg-brand-grey/50">
                            <option value="NGN" selected>₦ (Nigerian Naira)</option>
                            <option value="USD">$ (US Dollar)</option>
                            <option value="GBP">£ (British Pound)</option>
                        </select>
                        <p class="text-xs text-gray-500">Sets the currency for all prices and transactions.</p>
                    </div>
                </div>
                
                <div class="mt-6 pt-6 border-t border-gray-100 flex justify-end">
                    <button type="button" onclick="saveSection(1)" class="px-6 py-2 bg-brand-blue text-white font-semibold rounded-xl hover:bg-brand-blue/90 transition-colors">
                        Save General Settings
                    </button>
                </div>
            </div>

            <!-- Section 2: Security & Integrations -->
            <div class="bg-white p-6 md:p-8 rounded-2xl shadow-soft border-t-4 border-brand-gold">
                <div class="flex items-center space-x-3 mb-6 border-b pb-4">
                    <i class="fas fa-lock text-3xl text-brand-gold"></i>
                    <h2 class="text-2xl font-bold text-brand-blue">2. Security & Integrations</h2>
                </div>

                <!-- Feature Toggles -->
                <div class="space-y-6 mb-6 border-b pb-6">
                    <h3 class="text-lg font-semibold text-brand-blue">Feature Control</h3>
                    <div class="flex justify-between items-center py-2">
                        <div>
                            <p class="font-medium">Enable Subscription System</p>
                            <p class="text-xs text-gray-500">Allow users to create and manage recurring meal subscriptions.</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="flex justify-between items-center py-2">
                        <div>
                            <p class="font-medium">Guest Checkout Enabled</p>
                            <p class="text-xs text-gray-500">Allow users to place orders without creating an account.</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>

                <!-- API Keys -->
                <div class="space-y-2">
                    <h3 class="text-lg font-semibold text-brand-blue mb-4">Payment Gateway (Paystack)</h3>
                    
                    <label for="paystackKey" class="block text-sm font-medium text-gray-700">Paystack Secret Key</label>
                    <div class="flex space-x-2">
                        <input type="text" id="paystackKey" value="pk_live_xxxxxxxxxxxxxxxxxxxxxx" class="w-full font-mono text-sm bg-brand-grey/50">
                        <button type="button" onclick="regenerateKey('paystack')" class="px-4 py-2 bg-brand-orange text-white font-semibold rounded-xl hover:bg-brand-orange/90 transition-colors shrink-0">
                            Regenerate
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Caution: Regenerating will invalidate the current key.</p>
                </div>
                
                <div class="mt-6 pt-6 border-t border-gray-100 flex justify-end">
                    <button type="button" onclick="saveSection(2)" class="px-6 py-2 bg-brand-blue text-white font-semibold rounded-xl hover:bg-brand-blue/90 transition-colors">
                        Save Security & Integrations
                    </button>
                </div>
            </div>

            <!-- Section 3: Maintenance & Data Management -->
            <div class="bg-white p-6 md:p-8 rounded-2xl shadow-soft border-t-4 border-brand-teal">
                <div class="flex items-center space-x-3 mb-6 border-b pb-4">
                    <i class="fas fa-database text-3xl text-brand-teal"></i>
                    <h2 class="text-2xl font-bold text-brand-blue">3. Maintenance & Data</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    <!-- Cache Management -->
                    <div class="space-y-3 p-4 border border-gray-100 rounded-xl bg-brand-grey/50">
                        <h4 class="font-semibold text-lg flex items-center gap-2"><i class="fas fa-broom text-brand-teal"></i> Clear Application Cache</h4>
                        <p class="text-sm text-gray-600">Clears compiled views, configuration, and session data. Recommended after updates.</p>
                        <button type="button" onclick="performAction('cache')" class="w-full py-2 bg-brand-teal text-white font-semibold rounded-lg hover:bg-brand-teal/90 transition-colors">
                            Run Cache Clear
                        </button>
                    </div>
                    
                    <!-- Database Backup -->
                    <div class="space-y-3 p-4 border border-gray-100 rounded-xl bg-brand-grey/50">
                        <h4 class="font-semibold text-lg flex items-center gap-2"><i class="fas fa-cloud-download-alt text-brand-blue"></i> Database Backup</h4>
                        <p class="text-sm text-gray-600">Generates and downloads a full SQL dump of the production database.</p>
                        <button type="button" onclick="performAction('backup')" class="w-full py-2 bg-brand-blue text-white font-semibold rounded-lg hover:bg-brand-blue/90 transition-colors">
                            Initiate Backup
                        </button>
                    </div>
                    
                    <!-- Logs & Reporting -->
                    <div class="space-y-3 p-4 border border-gray-100 rounded-xl bg-brand-grey/50">
                        <h4 class="font-semibold text-lg flex items-center gap-2"><i class="fas fa-file-alt text-brand-orange"></i> View System Logs</h4>
                        <p class="text-sm text-gray-600">Downloads the past 7 days of application error and access logs for debugging.</p>
                        <button type="button" onclick="performAction('logs')" class="w-full py-2 bg-brand-orange text-white font-semibold rounded-lg hover:bg-brand-orange/90 transition-colors">
                            Download Logs
                        </button>
                    </div>
                </div>
                
                <div class="mt-6 pt-6 border-t border-gray-100 flex justify-end">
                    <p class="text-sm text-brand-red font-medium italic">Warning: Maintenance actions are irreversible.</p>
                </div>
            </div>

        </form>
        
        <!-- Footer Spacer -->
        <div class="h-12"></div>
    </main>

    <!-- JavaScript for Mobile Sidebar Toggle and Mock Actions -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('backdrop');

        // --- Mock Action Functions ---
        function saveAllSettings() {
            alertMessage('success', 'All system settings saved successfully!');
            console.log("All settings form submitted and saved.");
        }

        function saveSection(sectionNumber) {
            alertMessage('success', `Section ${sectionNumber} settings saved.`);
            console.log(`Section ${sectionNumber} settings saved.`);
        }

        function regenerateKey(name) {
             alertMessage('warning', `New ${name} key generated. Remember to update external services!`);
            console.log(`Regenerate key requested for ${name}.`);
        }

        function performAction(action) {
            let message = '';
            if (action === 'cache') {
                message = 'Application cache cleared successfully.';
            } else if (action === 'backup') {
                message = 'Database backup initiated and downloaded.';
            } else if (action === 'logs') {
                message = 'System logs successfully downloaded.';
            }
             alertMessage('success', message);
            console.log(`Maintenance action: ${action} performed.`);
        }

        // Simple custom alert/toast simulation (since alert() is forbidden)
        function alertMessage(type, message) {
            const container = document.body;
            let bgColor, icon;
            if (type === 'success') {
                bgColor = 'bg-brand-teal';
                icon = '<i class="fas fa-check-circle"></i>';
            } else if (type === 'warning') {
                bgColor = 'bg-brand-orange';
                icon = '<i class="fas fa-exclamation-triangle"></i>';
            } else {
                bgColor = 'bg-brand-blue';
                icon = '<i class="fas fa-info-circle"></i>';
            }

            const alertDiv = document.createElement('div');
            alertDiv.className = `fixed top-4 right-4 p-4 rounded-xl text-white shadow-lg flex items-center space-x-3 transition-transform duration-500 transform translate-x-full ${bgColor}`;
            alertDiv.innerHTML = `${icon} <span class="font-semibold">${message}</span>`;
            
            container.appendChild(alertDiv);
            
            // Show the toast
            setTimeout(() => {
                alertDiv.classList.remove('translate-x-full');
            }, 50);

            // Hide and remove the toast
            setTimeout(() => {
                alertDiv.classList.add('translate-x-full');
                alertDiv.addEventListener('transitionend', () => alertDiv.remove());
            }, 3000);
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