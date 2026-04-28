<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Address | FoodBox NG</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Tailwind Config (Reused) -->
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
        
        /* Active link styling - Delivery Address is assumed active here */
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
    <main class="p-4 mt-20 md:p-8 lg:ml-64 main-content">
        
        <!-- Header Section -->
        <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center">
            <div>
                <h1 class="text-3xl font-bold text-brand-blue mb-1">Edit Delivery Address: Home</h1>
                <p class="text-gray-600">Update your details for Block 5, Apt 2B, Banana Island.</p>
            </div>
            <a href="foodbox_delivery_address.html" class="mt-4 md:mt-0 px-6 py-3 bg-brand-orange text-white font-semibold rounded-xl hover:bg-brand-orange/90 transition-colors shadow-sm flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Back to Addresses
            </a>
        </div>

        <!-- Address Form Card (This is the "page" content) -->
        <div class="bg-white p-6 md:p-10 rounded-3xl shadow-soft max-w-2xl mx-auto">
            <form id="address-form" class="space-y-6">
                
                <!-- Address Label -->
                <div>
                    <label for="address_label" class="block text-sm font-medium text-gray-700 mb-1">Address Label (e.g., Home, Work)</label>
                    <input type="text" id="address_label" class="form-input" value="Home" required>
                </div>
                
                <!-- Contact Name -->
                <div>
                    <label for="contact_name" class="block text-sm font-medium text-gray-700 mb-1">Recipient Name</label>
                    <input type="text" id="contact_name" class="form-input" value="Jane Okoro" required>
                </div>

                <!-- Phone Number -->
                <div>
                    <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <input type="tel" id="phone_number" class="form-input" value="+234 809 123 4567" required>
                </div>

                <!-- Street Address / Landmark -->
                <div>
                    <label for="street_address" class="block text-sm font-medium text-gray-700 mb-1">Street Address / Nearest Landmark</label>
                    <textarea id="street_address" rows="3" class="form-input resize-none" required>Block 5, Apt 2B, Banana Island Drive, Ikoyi, Lagos, Nigeria.</textarea>
                </div>

                <!-- City / State -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                        <input type="text" id="city" class="form-input" value="Ikoyi" required>
                    </div>
                    <div>
                        <label for="state" class="block text-sm font-medium text-gray-700 mb-1">State</label>
                        <select id="state" class="form-input">
                            <option value="">Select State</option>
                            <option value="LA" selected>Lagos</option>
                            <option value="RV">Rivers</option>
                            <option value="AB">Abuja FCT</option>
                            <option value="KN">Kano</option>
                            <!-- Add more states here -->
                        </select>
                    </div>
                </div>

                <!-- Set as Default Toggle -->
                <div class="flex items-center justify-between pt-2 border-t border-brand-grey/50">
                    <div>
                        <span class="font-medium text-gray-700">Set as Default Address</span>
                        <p class="text-xs text-gray-500">Use this address automatically for future orders.</p>
                    </div>
                    <!-- The checkbox is checked because this is the 'Home' address, which was the default in the previous file's mock data. -->
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" value="" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-brand-teal/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-teal"></div>
                    </label>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4 pt-6">
                    <button type="button" onclick="history.back()" class="px-6 py-3 border border-gray-300 text-brand-blue font-semibold rounded-xl hover:bg-brand-grey transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="px-6 py-3 bg-brand-teal text-white font-semibold rounded-xl hover:bg-brand-teal/90 transition-colors shadow-sm-brand">
                        <i class="fas fa-save mr-2"></i> Update Address
                    </button>
                </div>
            </form>
        </div>


        <!-- Footer Spacer -->
        <div class="h-12"></div>
    </main>

    <!-- JavaScript for Mobile Sidebar Toggle -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const menuToggle = document.getElementById('menu-toggle');
        const backdrop = document.getElementById('backdrop');
        const addressForm = document.getElementById('address-form');

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
        
        // Prevent form submission for this example
        addressForm.addEventListener('submit', (e) => {
            e.preventDefault();
            console.log("Address Updated!");
            // In a real app: Process form data, save to Firestore, then redirect back
            alertMessage("Address successfully updated!", 'success');
        });
        
        // Custom Alert/Message Box function (to replace browser alert())
        function alertMessage(message, type = 'info') {
            const existingAlert = document.getElementById('custom-alert');
            if (existingAlert) existingAlert.remove();

            const colors = {
                success: { bg: 'bg-green-100', text: 'text-green-800', icon: 'fas fa-check-circle' },
                error: { bg: 'bg-red-100', text: 'text-red-800', icon: 'fas fa-times-circle' },
                info: { bg: 'bg-blue-100', text: 'text-blue-800', icon: 'fas fa-info-circle' }
            };
            const color = colors[type] || colors.info;

            const alertDiv = document.createElement('div');
            alertDiv.id = 'custom-alert';
            alertDiv.className = `fixed top-20 right-4 max-w-xs w-full p-4 rounded-xl shadow-lg ${color.bg} ${color.text} flex items-center space-x-3 z-[100] transform translate-y-0 transition-all duration-300`;
            alertDiv.innerHTML = `
                <i class="${color.icon} text-xl"></i>
                <span class="font-medium text-sm">${message}</span>
                <button onclick="document.getElementById('custom-alert').remove()" class="ml-auto text-current opacity-70 hover:opacity-100">
                    <i class="fas fa-times"></i>
                </button>
            `;
            
            document.body.appendChild(alertDiv);
            
            // Auto-dismiss after 5 seconds
            setTimeout(() => {
                const currentAlert = document.getElementById('custom-alert');
                if (currentAlert) currentAlert.remove();
            }, 5000);
        }
    </script>
</body>
</html>