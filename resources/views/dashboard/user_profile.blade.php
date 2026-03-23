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

    @include('dashboard.header')

    <!-- Main Content Area -->
    <main class="mt-20 p-4 md:p-8 main-content">

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        
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
                    <h2 class="text-xl font-bold text-brand-blue">{{ $user->name }}</h2>
                    <p class="text-sm text-gray-500 mb-3">{{ $user->email }}</p>
                    <div class="inline-flex items-center text-xs font-semibold px-3 py-1 rounded-full bg-brand-gold/20 text-brand-gold">
                        <i class="fas fa-crown mr-1"></i> Premium Member
                    </div>
                    <p class="text-xs text-gray-400 mt-4">Member since {{ $user->created_at->format('F Y') }}</p>
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
                    <form action="{{ route('userprofile.update') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- First Name -->
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                <input type="text" id="first_name" name="name" value="{{ $user->name }}" class="form-input" required>
                                @error('name')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Phone Number -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="tel" id="phone" name="phone" value="{{ $user->phone }}" class="form-input" required>
                                @error('phone')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Email -->
                            <div class="md:col-span-2">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                <input type="email" id="email" name="email" value="{{ $user->email }}" class="form-input" disabled>
                                <p class="text-xs text-gray-500 mt-1">Email address cannot be changed here. Contact support.</p>
                            </div>
                        </div>
                        @if(session('profile_success'))
                            <div class="mb-4 p-4 mt-4 bg-green-100 text-green-700 rounded-lg">
                                {{ session('profile_success') }}
                            </div>
                        @endif
                        <div class="mt-8 flex justify-end">
                            <button id="submitBtn" type="submit" class="px-6 py-3 bg-brand-teal text-white font-semibold rounded-xl hover:bg-brand-teal/90 transition-colors shadow-sm-brand flex items-center gap-2">

                                <!-- Spinner (hidden by default) -->
                                <svg id="spinner" class="w-5 h-5 animate-spin hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="white" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="white"
                                        d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                                    </path>
                                </svg>

                                <span id="btnText">Save Profile Changes</span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- 4. Security Settings -->
                <div id="security" class="bg-white p-6 md:p-8 rounded-3xl shadow-soft">
                    <h3 class="text-xl font-bold text-brand-blue mb-6 border-b border-brand-grey pb-3 flex items-center gap-3"><i class="fas fa-lock text-brand-teal"></i> Security Settings</h3>
                    
                    <div class="space-y-6">
                        <!-- Change Password Section -->
                        <form id="passwordForm" action="{{ route('password.update') }}" method="POST" class="border-b border-brand-grey pb-6">
                            @csrf
                            <h4 class="font-semibold text-lg text-brand-blue mb-3">Change Password</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="relative">
                                    <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-brand-teal"></i>
                                    <input type="password" name="current_password" id="current_password" placeholder="Enter current password" required class="w-full pl-12 pr-12 py-3 border border-gray-300 rounded-xl focus:border-brand-teal focus:ring-2 focus:ring-brand-teal/20 outline-none transition-all">
                                    <button type="button" onclick="toggleVisibility('current_password', 'toggleIcon1')" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-brand-teal transition-colors focus:outline-none">
                                        <i id="toggleIcon1" class="fas fa-eye"></i>
                                    </button>
                                </div>

                                <div class="relative">
                                    <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-brand-teal"></i>
                                    <input type="password" name="password" id="new_password" placeholder="Enter new password" required class="w-full pl-12 pr-12 py-3 border border-gray-300 rounded-xl focus:border-brand-teal focus:ring-2 focus:ring-brand-teal/20 outline-none transition-all">
                                    <button type="button" onclick="toggleVisibility('new_password', 'toggleIcon3')" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-brand-teal transition-colors focus:outline-none">
                                        <i id="toggleIcon3" class="fas fa-eye"></i>
                                    </button>
                                </div>

                                <!-- Confirm Password -->
                                <div class="md:col-span-2 relative">
                                    <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-brand-teal"></i>
                                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm new password" required class="w-full pl-12 pr-12 py-3 border border-gray-300 rounded-xl focus:border-brand-teal focus:ring-2 focus:ring-brand-teal/20 outline-none transition-all">
                                    <button type="button" onclick="toggleVisibility('password_confirmation', 'toggleIcon4')" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-brand-teal transition-colors focus:outline-none">
                                        <i id="toggleIcon4" class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            @if(session('password_success'))
                                <div class="mb-4 p-4 mt-4 bg-green-100 text-green-700 rounded-lg">
                                    {{ session('password_success') }}
                                </div>
                            @endif

                            @if(session('password_error'))
                                <div class="mb-4 p-4 mt-4 bg-red-100 text-red-700 rounded-lg">
                                    {{ session('password_error') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="mb-4 p-4 mt-4 bg-red-100 text-red-700 rounded-lg">
                                    <ul class="list-disc pl-5">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Button with Spinner -->
                            <button id="passwordBtn" type="submit" class="mt-4 px-5 py-2 text-sm bg-brand-blue text-white font-semibold rounded-xl hover:bg-brand-blue/90 transition-colors flex items-center gap-2">

                                <svg id="passwordSpinner" class="w-4 h-4 animate-spin hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="white" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="white"
                                        d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                                    </path>
                                </svg>

                                <span id="passwordBtnText">Update Password</span>
                            </button>
                        </form>

                        <!-- Two-Factor Authentication Toggle -->
                        <div class="flex justify-between items-center">
                            <div>
                                <h4 class="font-semibold text-lg text-brand-blue">Two-Factor Authentication (2FA)</h4>
                                <p class="text-sm text-gray-600">Adds an extra layer of security to your account.</p>
                            </div>
                            <form action="{{ route('2fa.toggle') }}" method="POST">
                                @csrf
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="two_factor_enabled" value="1" class="sr-only peer" {{ $user->two_factor_enabled ? 'checked' : '' }} onchange="this.form.submit()">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-brand-teal/30 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 peer-checked:bg-brand-teal"></div>
                                </label>
                            </form>
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



        document.querySelector("#personal-info form").addEventListener("submit", function () {
            const btn = document.getElementById("submitBtn");
            const spinner = document.getElementById("spinner");
            const text = document.getElementById("btnText");

            // Show spinner
            spinner.classList.remove("hidden");

            // Change text
            text.innerText = "Saving...";

            // Disable button
            btn.disabled = true;
        });



        document.getElementById("passwordForm").addEventListener("submit", function () {
            const btn = document.getElementById("passwordBtn");
            const spinner = document.getElementById("passwordSpinner");
            const text = document.getElementById("passwordBtnText");

            spinner.classList.remove("hidden");
            text.innerText = "Updating...";
            btn.disabled = true;
        });


        // Toggle password visibility
        function toggleVisibility(fieldId, iconId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }


        if (window.location.hash === "#security") {
            document.getElementById("security").scrollIntoView({
                behavior: "smooth"
            });
        }
    </script>
</body>
</html>