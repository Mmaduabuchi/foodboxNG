<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Addresses | FoodBox NG</title>
    
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

        /* Modal specific styles for animation */
        .modal {
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
        .modal.hidden {
            opacity: 0;
            pointer-events: none;
        }
        .modal-content {
            transition: transform 0.3s ease-out;
            transform: scale(0.95);
        }
        .modal.visible .modal-content {
            transform: scale(1);
        }
    </style>
</head>
<body class="bg-brand-grey text-brand-blue antialiased min-h-screen">

    @include('dashboard.header')

    <!-- Main Content Area -->
    <main class="mt-20 p-4 md:p-8 main-content">
        
        <!-- Header Section -->
        <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center">
            <div>
                <h1 class="text-3xl font-bold text-brand-blue mb-1">My Delivery Locations</h1>
                <p class="text-gray-600">Manage saved addresses for quick checkout and package deliveries.</p>
            </div>
            <button onclick="showModal()" class="mt-4 md:mt-0 px-6 py-3 bg-brand-teal text-white font-semibold rounded-xl hover:bg-brand-teal/90 transition-colors shadow-sm-brand flex items-center">
                <i class="fas fa-plus mr-2"></i> Add New Address
            </button>
        </div>

        <!-- Address Cards Grid -->
        <div id="address-list" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

            <!-- Address Card 1 (Default/Home) -->
            <div class="bg-white p-6 rounded-3xl shadow-soft border-2 border-brand-teal relative">
                <span class="absolute top-0 right-0 -mt-3 -mr-3 px-3 py-1 bg-brand-teal text-white text-xs font-bold rounded-full shadow-md">DEFAULT</span>
                <div class="flex items-start mb-4">
                    <i class="fas fa-home text-2xl text-brand-gold mr-4 mt-1"></i>
                    <div>
                        <h4 class="font-bold text-xl text-brand-blue flex items-center">Home <span class="ml-3 text-xs text-brand-teal border border-brand-teal px-2 py-0.5 rounded-full font-medium">Primary</span></h4>
                        <p class="text-sm text-gray-600">Jane Okoro (+234 809 123 4567)</p>
                    </div>
                </div>
                <p class="text-gray-700 leading-relaxed mb-4">
                    Block 5, Apt 2B, Banana Island Drive, Ikoyi, Lagos, Nigeria.
                </p>
                <div class="flex space-x-3">
                    <button onclick="showModal('edit')" class="text-sm text-brand-teal font-medium hover:text-brand-blue transition-colors">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </button>
                    <button class="text-sm text-brand-red font-medium hover:text-brand-orange transition-colors">
                        <i class="fas fa-trash-alt mr-1"></i> Delete
                    </button>
                </div>
            </div>

            <!-- Address Card 2 (Work) -->
            <div class="bg-white p-6 rounded-3xl shadow-soft border border-gray-200">
                <div class="flex items-start mb-4">
                    <i class="fas fa-briefcase text-2xl text-brand-blue/70 mr-4 mt-1"></i>
                    <div>
                        <h4 class="font-bold text-xl text-brand-blue">Work Office</h4>
                        <p class="text-sm text-gray-600">Reception Desk (Extension 42)</p>
                    </div>
                </div>
                <p class="text-gray-700 leading-relaxed mb-4">
                    Floor 10, Heritage Towers, 145 Akin Adesola St., Victoria Island, Lagos.
                </p>
                <div class="flex space-x-3">
                    <button onclick="showModal('edit')" class="text-sm text-brand-teal font-medium hover:text-brand-blue transition-colors">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </button>
                    <button class="text-sm text-brand-red font-medium hover:text-brand-orange transition-colors">
                        <i class="fas fa-trash-alt mr-1"></i> Delete
                    </button>
                </div>
            </div>

            <!-- Address Card 3 (Friend's House) -->
            <div class="bg-white p-6 rounded-3xl shadow-soft border border-gray-200">
                <div class="flex items-start mb-4">
                    <i class="fas fa-user-friends text-2xl text-brand-blue/70 mr-4 mt-1"></i>
                    <div>
                        <h4 class="font-bold text-xl text-brand-blue">Friend's Place (Bimpe)</h4>
                        <p class="text-sm text-gray-600">Bimpe Adebayo (+234 810 987 6543)</p>
                    </div>
                </div>
                <p class="text-gray-700 leading-relaxed mb-4">
                    12 Olubunmi Ojo Street, Phase 3 Estate, Lekki, Lagos.
                </p>
                <div class="flex space-x-3">
                    <button onclick="showModal('edit')" class="text-sm text-brand-teal font-medium hover:text-brand-blue transition-colors">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </button>
                    <button class="text-sm text-brand-red font-medium hover:text-brand-orange transition-colors">
                        <i class="fas fa-trash-alt mr-1"></i> Delete
                    </button>
                </div>
            </div>
            
        </div>

        <!-- Empty State Placeholder (Optional) -->
        <!-- <div class="text-center py-16 mt-8 bg-white rounded-3xl shadow-soft/50 border border-dashed border-gray-300">
            <i class="fas fa-map-marked-alt text-6xl text-brand-teal/50 mb-4"></i>
            <h4 class="text-xl font-semibold text-brand-blue">No Saved Addresses Found</h4>
            <p class="text-gray-600 mb-6">Click 'Add New Address' to save your first delivery location.</p>
            <button onclick="showModal()" class="px-6 py-2 bg-brand-teal text-white font-medium rounded-xl hover:bg-brand-teal/90 transition-colors shadow-sm-brand">
                <i class="fas fa-plus mr-2"></i> Add Now
            </button>
        </div> -->


        <!-- Footer Spacer -->
        <div class="h-12"></div>
    </main>
    
    <!-- 3. Add/Edit Address Modal -->
    <div id="address-modal" class="modal fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4 z-50 hidden">
        <div class="modal-content bg-white w-full max-w-lg rounded-3xl shadow-xl-heavy p-6 md:p-8" role="dialog" aria-modal="true" aria-labelledby="modal-title">
            <div class="flex justify-between items-center border-b border-brand-grey/50 pb-4 mb-6">
                <h3 id="modal-title" class="text-2xl font-bold text-brand-blue">Add New Delivery Address</h3>
                <button onclick="hideModal()" class="text-gray-500 hover:text-brand-red transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <form id="address-form" class="space-y-4">
                
                <!-- Address Label -->
                <div>
                    <label for="address_label" class="block text-sm font-medium text-gray-700 mb-1">Address Label (e.g., Home, Work, Mum's Place)</label>
                    <input type="text" id="address_label" class="form-input" placeholder="e.g., Home" required>
                </div>
                
                <!-- Contact Name -->
                <div>
                    <label for="contact_name" class="block text-sm font-medium text-gray-700 mb-1">Recipient Name</label>
                    <input type="text" id="contact_name" class="form-input" placeholder="Name for package delivery" required>
                </div>

                <!-- Phone Number -->
                <div>
                    <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <input type="tel" id="phone_number" class="form-input" placeholder="+234 800 000 0000" required>
                </div>

                <!-- Street Address / Landmark -->
                <div>
                    <label for="street_address" class="block text-sm font-medium text-gray-700 mb-1">Street Address / Nearest Landmark</label>
                    <textarea id="street_address" rows="3" class="form-input resize-none" placeholder="House number, Street Name, or detailed directions" required></textarea>
                </div>

                <!-- City / State -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                        <input type="text" id="city" class="form-input" placeholder="e.g., Lagos" required>
                    </div>
                    <div>
                        <label for="state" class="block text-sm font-medium text-gray-700 mb-1">State</label>
                        <select id="state" class="form-input">
                            <option value="">Select State</option>
                            <option value="LA">Lagos</option>
                            <option value="RV">Rivers</option>
                            <option value="AB">Abuja FCT</option>
                            <option value="KN">Kano</option>
                            <!-- Add more states here -->
                        </select>
                    </div>
                </div>

                <!-- Set as Default Toggle -->
                <div class="flex items-center justify-between pt-2">
                    <div>
                        <span class="font-medium text-gray-700">Set as Default Address</span>
                        <p class="text-xs text-gray-500">Use this address automatically for future orders.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" value="" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-brand-teal/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-teal"></div>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="pt-6">
                    <button type="submit" class="w-full px-6 py-3 bg-brand-teal text-white font-semibold rounded-xl hover:bg-brand-teal/90 transition-colors shadow-sm-brand">
                        Save Address
                    </button>
                </div>
            </form>
        </div>
    </div>


    <!-- JavaScript for Mobile Sidebar Toggle & Modal -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const menuToggle = document.getElementById('menu-toggle');
        const backdrop = document.getElementById('backdrop');
        const modal = document.getElementById('address-modal');
        const modalTitle = document.getElementById('modal-title');
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

        // --- Modal Functions ---

        function showModal(mode = 'add', addressData = null) {
            if (mode === 'edit' && addressData) {
                modalTitle.textContent = 'Edit Delivery Address';
                // In a real app, you would populate the form fields here:
                // document.getElementById('address_label').value = addressData.label;
                // etc.
            } else {
                modalTitle.textContent = 'Add New Delivery Address';
                addressForm.reset(); // Clear form for adding
            }
            modal.classList.remove('hidden');
            modal.classList.add('visible');
            document.body.style.overflow = 'hidden'; // Prevent scrolling background
        }

        function hideModal() {
            modal.classList.remove('visible');
            // Use a timeout to hide the modal after the transition finishes
            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.style.overflow = ''; // Restore scrolling
            }, 300);
        }

        // Close modal on click outside (but not on the content itself)
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                hideModal();
            }
        });
        
        // Prevent form submission for this example
        addressForm.addEventListener('submit', (e) => {
            e.preventDefault();
            console.log("Address saved!");
            // In a real app: Process form data, save to Firestore, then hideModal()
            hideModal();
        });
    </script>
</body>
</html>