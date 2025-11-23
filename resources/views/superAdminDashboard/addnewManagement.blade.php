<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New | Super Admin FoodBox NG</title>
    
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
                            orange: '#F4A261', 
                            red: '#E76F51',   
                            grey: '#F4F6F8',  
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
            z-index: 50;
        }
        #sidebar.open { transform: translateX(0); }
        #sidebar.closed { transform: translateX(-100%); }
        @media (min-width: 1024px) {
            #sidebar.closed { transform: translateX(0); } /* Always open on desktop */
        }
        
        .main-content { padding-top: 5rem; }

        /* Form Styling */
        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #264653;
            margin-bottom: 0.5rem;
        }
        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #E2E8F0;
            border-radius: 0.75rem;
            background-color: #F8FAFC;
            transition: all 0.2s;
            outline: none;
            color: #264653;
        }
        .form-input:focus {
            border-color: #2A9D8F;
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(42, 157, 143, 0.1);
        }
        
        /* Tab Transitions */
        .tab-content {
            display: none;
            animation: fadeIn 0.3s ease-in-out;
        }
        .tab-content.active {
            display: block;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Active Tab Button Style */
        .tab-btn.active {
            background-color: #264653;
            color: #E9C46A;
            border-color: #264653;
        }
    </style>
</head>
<body class="bg-brand-grey text-brand-blue font-sans min-h-screen">

    <!-- Mobile Backdrop -->
    <div id="backdrop" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden opacity-0 transition-opacity duration-300" onclick="toggleSidebar()"></div>

    <!-- 1. Sidebar Navigation (Reused) -->
    <aside id="sidebar" class="fixed top-0 left-0 h-full w-64 bg-brand-blue p-6 shadow-admin closed lg:translate-x-0">
        <!-- Logo -->
        <div class="flex items-center gap-2 mb-8 pb-4 border-b border-white/10">
            <div class="w-10 h-10 bg-brand-teal rounded-lg flex items-center justify-center text-white shadow-lg">
                <i class="fas fa-box-open text-xl"></i>
            </div>
            <span class="text-2xl font-extrabold text-white tracking-tight">FoodBox<span class="text-brand-teal">NG</span></span>
        </div>

        <!-- Admin Profile -->
        <div class="flex items-center gap-3 mb-10 pb-4 border-b border-white/10">
            <img src="https://placehold.co/40x40/E76F51/FFFFFF?text=SA" alt="Admin Avatar" class="w-10 h-10 rounded-full border-2 border-brand-gold/50 object-cover">
            <div class="text-white">
                <p class="font-semibold text-sm leading-tight">Admin J. Okoro</p>
                <p class="text-xs text-brand-gold font-medium">Super Admin</p>
            </div>
        </div>

        <!-- Nav Links -->
        <nav class="space-y-1.5">
            <a href="superAdmin_dashboard.html" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl transition-all hover:bg-brand-blue/70 hover:text-white">
                <i class="fas fa-tachometer-alt text-lg w-6 text-center"></i>
                <span>Dashboard Overview</span>
            </a>
            <a href="#" class="nav-link active flex items-center gap-4 text-white/90 font-semibold p-3 rounded-xl transition-all bg-brand-blue/50 border-l-4 border-brand-teal">
                <i class="fas fa-plus-circle text-lg w-6 text-center text-brand-gold"></i>
                <span>Add New</span>
            </a>
            <!-- Other links simplified for brevity -->
            <a href="#" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl hover:bg-brand-blue/70 hover:text-white"><i class="fas fa-cubes w-6 text-center"></i> Packages</a>
            <a href="#" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl hover:bg-brand-blue/70 hover:text-white"><i class="fas fa-shopping-cart w-6 text-center"></i> Orders</a>
            <a href="#" class="nav-link flex items-center gap-4 text-white/70 font-medium p-3 rounded-xl hover:bg-brand-blue/70 hover:text-white"><i class="fas fa-warehouse w-6 text-center"></i> Inventory</a>
        </nav>
    </aside>

    <!-- 2. Top Header -->
    <header class="fixed top-0 right-0 w-full lg:w-[calc(100%-16rem)] h-20 bg-white border-b border-gray-100 shadow-soft z-30 flex items-center px-4 md:px-8 justify-between">
        <div class="flex items-center gap-4">
            <button onclick="toggleSidebar()" class="lg:hidden p-2 text-brand-blue hover:bg-brand-grey rounded-lg">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <h1 class="text-xl font-bold text-brand-blue">Create Management</h1>
        </div>
        
        <div class="flex items-center gap-4">
            <button class="p-2 rounded-full text-gray-400 hover:text-brand-blue hover:bg-brand-grey transition-colors relative">
                <i class="fas fa-bell"></i>
                <span class="absolute top-1 right-1 w-2 h-2 bg-brand-orange rounded-full"></span>
            </button>
            <img src="https://placehold.co/36x36/E76F51/FFFFFF?text=SA" class="w-9 h-9 rounded-full border border-gray-200">
        </div>
    </header>

    <!-- Main Content -->
    <main class="lg:ml-64 p-4 md:p-8 main-content max-w-7xl mx-auto">
        
        <!-- Tab Navigation -->
        <div class="flex flex-col md:flex-row gap-4 mb-8">
            <button onclick="switchTab('package')" id="btn-package" class="tab-btn active flex-1 py-4 px-6 rounded-2xl bg-white border border-gray-100 shadow-sm text-brand-blue font-bold text-lg flex items-center justify-center gap-3 hover:shadow-md transition-all">
                <i class="fas fa-cube"></i> New Package
            </button>
            <button onclick="switchTab('item')" id="btn-item" class="tab-btn flex-1 py-4 px-6 rounded-2xl bg-white border border-gray-100 shadow-sm text-gray-500 font-semibold text-lg flex items-center justify-center gap-3 hover:shadow-md transition-all hover:text-brand-blue">
                <i class="fas fa-carrot"></i> Inventory Item
            </button>
            <button onclick="switchTab('admin')" id="btn-admin" class="tab-btn flex-1 py-4 px-6 rounded-2xl bg-white border border-gray-100 shadow-sm text-gray-500 font-semibold text-lg flex items-center justify-center gap-3 hover:shadow-md transition-all hover:text-brand-blue">
                <i class="fas fa-user-shield"></i> Admin User
            </button>
        </div>

        <!-- FORM 1: CREATE PACKAGE -->
        <div id="tab-package" class="tab-content active bg-white p-6 md:p-10 rounded-3xl shadow-soft">
            <div class="flex justify-between items-center mb-8 border-b border-brand-grey pb-4">
                <h2 class="text-2xl font-bold text-brand-blue">Create Subscription Package</h2>
                <span class="text-sm text-gray-500">Step 1 of 1</span>
            </div>

            <form>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                    <!-- Left: Image Upload -->
                    <div class="lg:col-span-1">
                        <label class="form-label">Package Cover Image</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center hover:border-brand-teal transition-colors cursor-pointer bg-brand-grey/30 h-64 flex flex-col items-center justify-center group">
                            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-sm mb-3 group-hover:scale-110 transition-transform">
                                <i class="fas fa-cloud-upload-alt text-2xl text-brand-teal"></i>
                            </div>
                            <p class="text-sm font-medium text-brand-blue">Click to upload or drag & drop</p>
                            <p class="text-xs text-gray-400 mt-1">PNG, JPG up to 5MB</p>
                        </div>
                        
                        <div class="mt-6">
                            <label class="form-label">Visibility Status</label>
                            <div class="flex gap-4">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="status" checked class="text-brand-teal focus:ring-brand-teal">
                                    <span class="text-sm">Active (Public)</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="status" class="text-brand-teal focus:ring-brand-teal">
                                    <span class="text-sm">Draft (Hidden)</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Details -->
                    <div class="lg:col-span-2 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="form-label">Package Name</label>
                                <input type="text" class="form-input" placeholder="e.g. Family Jumbo Pack">
                            </div>
                            <div>
                                <label class="form-label">Price (₦)</label>
                                <input type="number" class="form-input" placeholder="0.00">
                            </div>
                        </div>

                        <div>
                            <label class="form-label">Description</label>
                            <textarea class="form-input" rows="3" placeholder="Describe the package value..."></textarea>
                        </div>

                        <!-- Item Selector -->
                        <div class="bg-brand-grey/50 p-6 rounded-2xl">
                            <div class="flex justify-between items-center mb-4">
                                <label class="form-label mb-0">Package Contents</label>
                                <button type="button" class="text-xs font-bold text-brand-teal uppercase hover:underline">+ Add Item Row</button>
                            </div>
                            
                            <div class="space-y-3">
                                <!-- Item Row 1 -->
                                <div class="flex gap-3">
                                    <select class="form-input flex-grow">
                                        <option>Premium Parboiled Rice (50kg)</option>
                                        <option>Vegetable Oil (5L)</option>
                                    </select>
                                    <input type="number" class="form-input w-24" value="1" placeholder="Qty">
                                    <button type="button" class="p-3 text-brand-red hover:bg-white rounded-lg transition-colors"><i class="fas fa-trash"></i></button>
                                </div>
                                <!-- Item Row 2 -->
                                <div class="flex gap-3">
                                    <select class="form-input flex-grow">
                                        <option selected>Kings Vegetable Oil (5L)</option>
                                    </select>
                                    <input type="number" class="form-input w-24" value="2" placeholder="Qty">
                                    <button type="button" class="p-3 text-brand-red hover:bg-white rounded-lg transition-colors"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4 flex justify-end gap-4">
                            <button type="button" class="px-6 py-3 rounded-xl text-brand-blue font-semibold hover:bg-brand-grey transition-colors">Cancel</button>
                            <button type="submit" class="px-8 py-3 rounded-xl bg-brand-teal text-white font-bold shadow-lg shadow-brand-teal/30 hover:bg-brand-teal/90 transition-all">Create Package</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- FORM 2: ADD INVENTORY ITEM -->
        <div id="tab-item" class="tab-content bg-white p-6 md:p-10 rounded-3xl shadow-soft">
            <div class="flex justify-between items-center mb-8 border-b border-brand-grey pb-4">
                <h2 class="text-2xl font-bold text-brand-blue">Add Inventory Item</h2>
                <span class="text-sm text-gray-500">Stock Management</span>
            </div>

            <form>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="form-label">Item Name</label>
                        <input type="text" class="form-input" placeholder="e.g. Dangote Sugar">
                    </div>
                    <div>
                        <label class="form-label">Category</label>
                        <select class="form-input">
                            <option>Grains & Flours</option>
                            <option>Oils & Spices</option>
                            <option>Tubers</option>
                            <option>Proteins</option>
                            <option>Canned Goods</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div>
                        <label class="form-label">Initial Quantity</label>
                        <input type="number" class="form-input" placeholder="0">
                    </div>
                    <div>
                        <label class="form-label">Unit Type</label>
                        <select class="form-input">
                            <option>Pieces (pcs)</option>
                            <option>Kilograms (kg)</option>
                            <option>Liters (L)</option>
                            <option>Cartons</option>
                            <option>Bags</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Low Stock Alert Level</label>
                        <input type="number" class="form-input" placeholder="e.g. 10">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label class="form-label">Cost Price (₦)</label>
                        <input type="number" class="form-input" placeholder="0.00">
                    </div>
                    <div>
                        <label class="form-label">Selling Price (₦) <span class="text-xs font-normal text-gray-400">(Optional)</span></label>
                        <input type="number" class="form-input" placeholder="0.00">
                    </div>
                </div>

                <div class="bg-brand-orange/10 p-4 rounded-xl mb-8 flex items-start gap-3">
                    <i class="fas fa-info-circle text-brand-orange mt-1"></i>
                    <p class="text-sm text-brand-blue/80"><strong>Note:</strong> New items will be automatically available for "Build Your Own" packages unless marked as "Internal Use Only".</p>
                </div>

                <div class="flex justify-end gap-4">
                    <button type="button" class="px-6 py-3 rounded-xl text-brand-blue font-semibold hover:bg-brand-grey transition-colors">Cancel</button>
                    <button type="submit" class="px-8 py-3 rounded-xl bg-brand-blue text-white font-bold shadow-lg shadow-brand-blue/30 hover:bg-brand-blue/90 transition-all">Save Item</button>
                </div>
            </form>
        </div>

        <!-- FORM 3: ADD ADMIN USER -->
        <div id="tab-admin" class="tab-content bg-white p-6 md:p-10 rounded-3xl shadow-soft">
            <div class="flex justify-between items-center mb-8 border-b border-brand-grey pb-4">
                <h2 class="text-2xl font-bold text-brand-blue">Register New Admin</h2>
                <span class="text-sm text-gray-500">Access Control</span>
            </div>

            <form>
                <div class="flex flex-col md:flex-row gap-8">
                    <!-- Role Selection -->
                    <div class="md:w-1/3 space-y-4">
                        <label class="form-label">Select Role</label>
                        
                        <label class="block relative cursor-pointer">
                            <input type="radio" name="role" class="peer sr-only" checked>
                            <div class="p-4 rounded-xl border-2 border-brand-grey peer-checked:border-brand-teal peer-checked:bg-brand-teal/5 transition-all hover:border-brand-teal/50">
                                <div class="flex items-center gap-3 mb-1">
                                    <div class="w-8 h-8 rounded-full bg-brand-teal text-white flex items-center justify-center"><i class="fas fa-user-shield"></i></div>
                                    <span class="font-bold text-brand-blue">Super Admin</span>
                                </div>
                                <p class="text-xs text-gray-500 pl-11">Full access to all settings, payments, and user management.</p>
                            </div>
                        </label>

                        <label class="block relative cursor-pointer">
                            <input type="radio" name="role" class="peer sr-only">
                            <div class="p-4 rounded-xl border-2 border-brand-grey peer-checked:border-brand-teal peer-checked:bg-brand-teal/5 transition-all hover:border-brand-teal/50">
                                <div class="flex items-center gap-3 mb-1">
                                    <div class="w-8 h-8 rounded-full bg-brand-blue text-white flex items-center justify-center"><i class="fas fa-truck"></i></div>
                                    <span class="font-bold text-brand-blue">Logistics Manager</span>
                                </div>
                                <p class="text-xs text-gray-500 pl-11">Access to orders, delivery schedules, and riders only.</p>
                            </div>
                        </label>

                        <label class="block relative cursor-pointer">
                            <input type="radio" name="role" class="peer sr-only">
                            <div class="p-4 rounded-xl border-2 border-brand-grey peer-checked:border-brand-teal peer-checked:bg-brand-teal/5 transition-all hover:border-brand-teal/50">
                                <div class="flex items-center gap-3 mb-1">
                                    <div class="w-8 h-8 rounded-full bg-brand-gold text-white flex items-center justify-center"><i class="fas fa-headset"></i></div>
                                    <span class="font-bold text-brand-blue">Support Agent</span>
                                </div>
                                <p class="text-xs text-gray-500 pl-11">View-only access to orders and user details for support.</p>
                            </div>
                        </label>
                    </div>

                    <!-- User Details -->
                    <div class="md:w-2/3 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-input" placeholder="John">
                            </div>
                            <div>
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-input" placeholder="Doe">
                            </div>
                        </div>

                        <div>
                            <label class="form-label">Official Email</label>
                            <input type="email" class="form-input" placeholder="john.doe@foodbox.ng">
                        </div>

                        <div>
                            <label class="form-label">Phone Number</label>
                            <input type="tel" class="form-input" placeholder="+234">
                        </div>

                        <div>
                            <label class="form-label">Temporary Password</label>
                            <input type="text" class="form-input font-mono bg-gray-100" value="FoodBox-User-2023" readonly>
                            <p class="text-xs text-gray-400 mt-1">User will be prompted to change this on first login.</p>
                        </div>

                        <div class="pt-4 flex justify-end gap-4">
                            <button type="button" class="px-6 py-3 rounded-xl text-brand-blue font-semibold hover:bg-brand-grey transition-colors">Cancel</button>
                            <button type="submit" class="px-8 py-3 rounded-xl bg-brand-gold text-brand-blue font-bold shadow-lg shadow-brand-gold/30 hover:bg-brand-gold/90 transition-all">Create Admin</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Spacing -->
        <div class="h-20"></div>
    </main>

    <!-- Scripts -->
    <script>
        // Sidebar Toggle (Mobile)
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('backdrop');

        function toggleSidebar() {
            const isClosed = sidebar.classList.contains('closed');
            if (isClosed) {
                sidebar.classList.remove('closed');
                sidebar.classList.add('open');
                backdrop.classList.remove('hidden');
                setTimeout(() => backdrop.classList.remove('opacity-0'), 10);
            } else {
                sidebar.classList.remove('open');
                sidebar.classList.add('closed');
                backdrop.classList.add('opacity-0');
                setTimeout(() => backdrop.classList.add('hidden'), 300);
            }
        }

        // Tab Switching Logic
        function switchTab(tabName) {
            // Update Buttons
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active', 'bg-brand-blue', 'text-white', 'border-brand-blue');
                btn.classList.add('bg-white', 'text-gray-500', 'border-gray-100');
                
                // Reset icons color
                const icon = btn.querySelector('i');
                if(btn.id !== `btn-${tabName}`) {
                    icon.className = icon.className.replace('text-white', ''); 
                }
            });

            const activeBtn = document.getElementById(`btn-${tabName}`);
            activeBtn.classList.remove('bg-white', 'text-gray-500', 'border-gray-100');
            activeBtn.classList.add('active'); // Trigger CSS class for active state styling

            // Hide all contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });

            // Show selected content
            document.getElementById(`tab-${tabName}`).classList.add('active');
        }
    </script>
</body>
</html>