<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Management | FoodBox NG</title>
    
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

        /* Active Sidebar Link - Custom addition for Admin Management */
        .nav-link.active {
            background-color: #3B5F6C;
            color: #E9C46A;
            border-left: 4px solid #2A9D8F;
            padding-left: 1.75rem;
        }
        .nav-link:not(.active) {
            border-left: 4px solid transparent;
        }

        /* Responsive Table Styles */
        @media (max-width: 768px) {
            .responsive-table th, .responsive-table td {
                padding: 0.5rem 0.75rem;
                display: block;
                width: 100%;
                text-align: left !important;
            }
            .responsive-table th:before {
                content: attr(data-label);
                float: left;
                font-weight: 700;
                margin-right: 10px;
                color: #264653;
            }
            .responsive-table tr {
                margin-bottom: 1rem;
                display: block;
                border: 1px solid #E0E7E8;
                border-radius: 0.75rem;
                padding: 1rem;
            }
            .responsive-table thead {
                display: none;
            }
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
        
        <!-- Role Quick-View Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
            
            <!-- Card 1: Super Admin -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-red">
                <div class="flex items-center justify-between">
                    <i class="fas fa-crown text-2xl text-brand-red p-3 bg-brand-red/10 rounded-xl"></i>
                    <p class="text-sm font-semibold text-gray-500">Highest Access</p>
                </div>
                <p class="text-sm text-gray-500 mt-2">Super Admins</p>
                <p class="text-2xl font-extrabold text-brand-blue">1</p>
            </div>

            <!-- Card 2: Editors / Content Managers -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-teal">
                <div class="flex items-center justify-between">
                    <i class="fas fa-pen-nib text-2xl text-brand-teal p-3 bg-brand-teal/10 rounded-xl"></i>
                    <p class="text-sm font-semibold text-gray-500">Edit Products</p>
                </div>
                <p class="text-sm text-gray-500 mt-2">Content Editors</p>
                <p class="text-2xl font-extrabold text-brand-blue">3</p>
            </div>

            <!-- Card 3: Dispatch & Logistics -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-orange">
                <div class="flex items-center justify-between">
                    <i class="fas fa-shipping-fast text-2xl text-brand-orange p-3 bg-brand-orange/10 rounded-xl"></i>
                    <p class="text-sm font-semibold text-gray-500">Manage Deliveries</p>
                </div>
                <p class="text-sm text-gray-500 mt-2">Dispatch Staff</p>
                <p class="text-2xl font-extrabold text-brand-blue">8</p>
            </div>

            <!-- Card 4: Customer Support -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-gold">
                <div class="flex items-center justify-between">
                    <i class="fas fa-headset text-2xl text-brand-gold p-3 bg-brand-gold/10 rounded-xl"></i>
                    <p class="text-sm font-semibold text-gray-500">View Orders</p>
                </div>
                <p class="text-sm text-gray-500 mt-2">Support Agents</p>
                <p class="text-2xl font-extrabold text-brand-blue">5</p>
            </div>
        </div>

        <!-- Staff Directory Table -->
        <div class="bg-white p-6 rounded-2xl shadow-soft overflow-x-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-brand-blue">Active Staff Directory</h3>
                <button class="text-brand-blue hover:text-brand-teal text-sm font-semibold" onclick="alertMessage('info', 'Searching for a specific admin...')">
                    <i class="fas fa-search mr-1"></i> Quick Search
                </button>
            </div>
            
            <table class="min-w-full divide-y divide-gray-200 responsive-table">
                <thead class="bg-brand-grey/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name & ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Login</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    
                    <!-- Row 1: Current User (Super Admin) -->
                    <tr class="hover:bg-brand-grey transition-colors bg-brand-gold/10">
                        <td class="px-6 py-4 whitespace-nowrap" data-label="Name & ID">
                            <div class="flex items-center gap-3">
                                <img src="https://placehold.co/32x32/E76F51/FFFFFF?text=SA" onerror="this.onerror=null; this.src='https://placehold.co/32x32/E76F51/FFFFFF?text=SA';" class="w-8 h-8 rounded-full" />
                                <div>
                                    <p class="text-sm font-bold text-brand-blue">Admin J. Okoro (You)</p>
                                    <p class="text-xs text-gray-500">ID: A_SA001</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Email">john.okoro@fbng.com</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Role">
                            <span class="font-semibold text-brand-red">Super Admin</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Last Login">Online Now</td>
                        <td class="px-6 py-4 whitespace-nowrap" data-label="Status">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Actions">
                            <button class="text-gray-400 cursor-not-allowed text-sm font-semibold">Self-Manage</button>
                        </td>
                    </tr>

                    <!-- Row 2: Content Editor -->
                    <tr class="hover:bg-brand-grey transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap" data-label="Name & ID">
                            <div class="flex items-center gap-3">
                                <img src="https://placehold.co/32x32/2A9D8F/FFFFFF?text=OE" onerror="this.onerror=null; this.src='https://placehold.co/32x32/2A9D8F/FFFFFF?text=OE';" class="w-8 h-8 rounded-full" />
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Olaide Ekundayo</p>
                                    <p class="text-xs text-gray-500">ID: A_CM012</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Email">o.ekundayo@fbng.com</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Role">
                            <span class="font-semibold text-brand-teal">Content Editor</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Last Login">1 hour ago</td>
                        <td class="px-6 py-4 whitespace-nowrap" data-label="Status">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2" data-label="Actions">
                            <button onclick="editAdmin('A_CM012')" class="text-brand-blue hover:text-brand-teal transition-colors text-sm font-semibold"><i class="fas fa-edit"></i></button>
                            <button onclick="revokeAdmin('A_CM012', 'Olaide Ekundayo')" class="text-brand-red hover:text-brand-red/70 transition-colors text-sm font-semibold"><i class="fas fa-user-slash"></i></button>
                        </td>
                    </tr>

                    <!-- Row 3: Dispatch Staff (Inactive) -->
                    <tr class="hover:bg-brand-grey transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap" data-label="Name & ID">
                            <div class="flex items-center gap-3">
                                <img src="https://placehold.co/32x32/264653/FFFFFF?text=KU" onerror="this.onerror=null; this.src='https://placehold.co/32x32/264653/FFFFFF?text=KU';" class="w-8 h-8 rounded-full" />
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Kolawole Ugo</p>
                                    <p class="text-xs text-gray-500">ID: A_DM045</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Email">k.ugo@fbng.com</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Role">
                            <span class="font-semibold text-brand-orange">Dispatch Manager</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Last Login">3 days ago</td>
                        <td class="px-6 py-4 whitespace-nowrap" data-label="Status">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2" data-label="Actions">
                            <button onclick="editAdmin('A_DM045')" class="text-brand-blue hover:text-brand-teal transition-colors text-sm font-semibold"><i class="fas fa-edit"></i></button>
                            <button onclick="reInviteAdmin('A_DM045', 'Kolawole Ugo')" class="text-brand-gold hover:text-brand-gold/70 transition-colors text-sm font-semibold"><i class="fas fa-paper-plane"></i></button>
                        </td>
                    </tr>
                    
                    <!-- Row 4: Support Agent (Active) -->
                    <tr class="hover:bg-brand-grey transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap" data-label="Name & ID">
                            <div class="flex items-center gap-3">
                                <img src="https://placehold.co/32x32/E9C46A/FFFFFF?text=IO" onerror="this.onerror=null; this.src='https://placehold.co/32x32/E9C46A/FFFFFF?text=IO';" class="w-8 h-8 rounded-full" />
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Ifunanya Okeke</p>
                                    <p class="text-xs text-gray-500">ID: A_CS101</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Email">i.okeke@fbng.com</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Role">
                            <span class="font-semibold text-brand-blue">Support Agent</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Last Login">4 hours ago</td>
                        <td class="px-6 py-4 whitespace-nowrap" data-label="Status">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2" data-label="Actions">
                            <button onclick="editAdmin('A_CS101')" class="text-brand-blue hover:text-brand-teal transition-colors text-sm font-semibold"><i class="fas fa-edit"></i></button>
                            <button onclick="revokeAdmin('A_CS101', 'Ifunanya Okeke')" class="text-brand-red hover:text-brand-red/70 transition-colors text-sm font-semibold"><i class="fas fa-user-slash"></i></button>
                        </td>
                    </tr>

                </tbody>
            </table>

            <div class="mt-6 flex justify-between items-center">
                <p class="text-sm text-gray-600">Showing 1 to 4 of 17 active staff</p>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 rounded-lg bg-brand-grey text-brand-blue font-medium hover:bg-gray-300 transition-colors"><i class="fas fa-chevron-left text-xs"></i></button>
                    <span class="px-3 py-1 rounded-lg bg-brand-blue text-white font-medium">1</span>
                    <button class="px-3 py-1 rounded-lg bg-brand-grey text-brand-blue font-medium hover:bg-gray-300 transition-colors">2</button>
                    <button class="px-3 py-1 rounded-lg bg-brand-grey text-brand-blue font-medium hover:bg-gray-300 transition-colors">3</button>
                    <button class="px-3 py-1 rounded-lg bg-brand-grey text-brand-blue font-medium hover:bg-gray-300 transition-colors"><i class="fas fa-chevron-right text-xs"></i></button>
                </div>
            </div>
        </div>
        
        <!-- Footer Spacer -->
        <div class="h-12"></div>
    </main>

    <!-- JavaScript for Mobile Sidebar Toggle and Mock Actions -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('backdrop');

        // --- Mock Action Functions ---
        function openAddAdminModal() {
            alertMessage('info', 'Opening the "Invite New Admin" form...');
            console.log("Add New Admin modal simulated.");
        }

        function editAdmin(id) {
            alertMessage('info', `Editing staff member with ID: ${id}.`);
            console.log(`Edit Admin requested for ID: ${id}.`);
        }
        
        function revokeAdmin(id, name) {
            alertMessage('warning', `Confirming access revocation for ${name} (${id}).`);
            console.log(`Revoke Admin requested for ID: ${id}.`);
        }

        function reInviteAdmin(id, name) {
            alertMessage('success', `Re-invitation email sent to ${name} (${id}).`);
            console.log(`Re-Invite Admin requested for ID: ${id}.`);
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