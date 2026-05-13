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
    <main class="mt-20 lg:ml-64 p-4 md:p-8 main-content max-w-full">
        
        <!-- Role Quick-View Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
            
            <!-- Card 1: Super Admin -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-red">
                <div class="flex items-center justify-between">
                    <i class="fas fa-crown text-2xl text-brand-red p-3 bg-brand-red/10 rounded-xl"></i>
                    <p class="text-sm font-semibold text-gray-500">Highest Access</p>
                </div>
                <p class="text-sm text-gray-500 mt-2">Super Admins</p>
                <p class="text-2xl font-extrabold text-brand-blue">{{ $adminCount }}</p>
            </div>

            <!-- Card 2: Editors / Content Managers -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-teal">
                <div class="flex items-center justify-between">
                    <i class="fas fa-pen-nib text-2xl text-brand-teal p-3 bg-brand-teal/10 rounded-xl"></i>
                    <p class="text-sm font-semibold text-gray-500">Edit Products</p>
                </div>
                <p class="text-sm text-gray-500 mt-2">Content Editors</p>
                <p class="text-2xl font-extrabold text-brand-blue">{{ $editorCount }}</p>
            </div>

            <!-- Card 3: Dispatch & Logistics -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-orange">
                <div class="flex items-center justify-between">
                    <i class="fas fa-shipping-fast text-2xl text-brand-orange p-3 bg-brand-orange/10 rounded-xl"></i>
                    <p class="text-sm font-semibold text-gray-500">Manage Deliveries</p>
                </div>
                <p class="text-sm text-gray-500 mt-2">Dispatch Staff</p>
                <p class="text-2xl font-extrabold text-brand-blue">{{ $dispatcherCount }}</p>
            </div>

            <!-- Card 4: Customer Support -->
            <div class="p-4 bg-white rounded-2xl shadow-soft border-t-4 border-brand-gold">
                <div class="flex items-center justify-between">
                    <i class="fas fa-headset text-2xl text-brand-gold p-3 bg-brand-gold/10 rounded-xl"></i>
                    <p class="text-sm font-semibold text-gray-500">View Orders</p>
                </div>
                <p class="text-sm text-gray-500 mt-2">Support Agents</p>
                <p class="text-2xl font-extrabold text-brand-blue">{{ $supportCount }}</p>
            </div>
        </div>

        <!-- Staff Directory Table -->
        <div class="bg-white p-6 rounded-2xl shadow-soft overflow-x-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-brand-blue">Active Admin Directory</h3>
                <!-- <button class="text-brand-blue hover:text-brand-teal text-sm font-semibold" onclick="alertMessage('info', 'Searching for a specific admin...')">
                    <i class="fas fa-search mr-1"></i> Quick Search
                </button> -->
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
                    @foreach ($admins as $admin)
                        <tr class="hover:bg-brand-grey transition-colors {{ $admin->id == auth()->id() ? 'bg-brand-gold/10 font-semibold' : '' }}">
                            <td class="px-6 py-4 whitespace-nowrap" data-label="Name & ID">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-brand-red flex items-center justify-center text-white text-xs font-bold shadow-sm">
                                        {{ strtoupper(substr($admin->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm text-brand-blue">{{ $admin->name }} {{ $admin->id == auth()->id() ? '(You)' : '' }}</p>
                                        <p class="text-xs text-gray-500 font-mono">ID: ADMIN_{{ str_pad($admin->id, 3, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Email">{{ $admin->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Role">
                                <span class="px-2 py-1 bg-brand-red/10 text-brand-red rounded-lg text-xs font-bold uppercase tracking-wider">Super Admin</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Last Login">
                                {{ $admin->id == auth()->id() ? 'Online Now' : ($admin->last_login ? $admin->last_login->diffForHumans() : 'Never') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap" data-label="Status">
                                <span class="px-3 py-1 inline-flex text-[10px] leading-5 font-bold uppercase rounded-full bg-green-100 text-green-800 ring-1 ring-green-600/20">Active</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" data-label="Actions">
                                @if($admin->id == auth()->id())
                                    <button class="text-gray-400 cursor-not-allowed text-xs font-bold italic">Self-Manage Only</button>
                                @else
                                    <div class="flex items-center gap-2">
                                        <button onclick="editAdmin('{{ $admin->id }}')" class="p-2 bg-brand-blue/5 text-brand-blue rounded-lg hover:bg-brand-blue hover:text-white transition-all">
                                            <i class="fas fa-edit text-xs"></i>
                                        </button>
                                        <button onclick="revokeAdmin('{{ $admin->id }}', '{{ $admin->name }}')" class="p-2 bg-brand-red/5 text-brand-red rounded-lg hover:bg-brand-red hover:text-white transition-all">
                                            <i class="fas fa-user-slash text-xs"></i>
                                        </button>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

            <div class="mt-6 flex justify-between items-center text-sm border-t pt-4">
                <p class="text-gray-600">Total Super Admins: <span class="font-bold text-brand-blue">{{ count($admins) }}</span></p>
                <p class="text-gray-400 italic">Access is granted via secure backend only.</p>
            </div>
        </div>


        <!-- Footer Spacer -->
        <div class="h-12"></div>

        <section class="flex justify-between items-center mb-4">
            <div>
                <h3 class="text-xl font-semibold text-brand-blue">Staff Management</h3>
            </div>
            <div>
                <button onclick="openStaffModal()" class="px-4 py-2 bg-brand-blue text-white text-sm font-bold rounded-xl hover:bg-brand-teal transition-all shadow-lg shadow-brand-blue/20">
                    <i class="fas fa-plus mr-1"></i> Add New Staff
                </button>
            </div>
        </section>

        <div class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 backdrop-blur-sm" id="newStaffModal">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md transform transition-all scale-95 opacity-0 m-4">
                <!-- Modal Header -->
                <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-brand-grey/30 rounded-t-2xl">
                    <h3 class="text-xl font-semibold text-brand-blue">Add New Staff</h3>
                    <button onclick="closeStaffModal()" class="text-gray-400 hover:text-brand-red transition-colors p-1">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>

                <!-- Modal Body (Scrollable) -->
                <div class="p-6 max-h-[70vh] overflow-y-auto custom-scrollbar">
                    <form action="{{ route('admin.staffManagement') }}" method="POST" id="staffForm">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                <input type="text" name="fullname" id="name" placeholder="John Doe" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-teal focus:border-transparent outline-none transition-all" required>
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="text" name="phone" id="phone" placeholder="0800 000 0000" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-teal focus:border-transparent outline-none transition-all" required>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                                    <input type="email" name="email" id="email" placeholder="john@foodbox.ng" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-teal focus:border-transparent outline-none transition-all" required>
                                </div>
                                <div class="space-y-2">
                                    <label for="role" class="block text-sm font-medium text-gray-700">Staff Role</label>
                                    <select name="role" id="role" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-teal focus:border-transparent outline-none bg-white cursor-pointer transition-all" required>
                                        <option value="editor">Content Editor</option>
                                        <option value="dispatcher">Dispatch Manager</option>
                                        <option value="support">Support Agent</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label for="nin" class="block text-sm font-medium text-gray-700 mb-2">National ID Number (NIN)</label>
                                <input type="text" name="nin" id="nin" placeholder="12345678901" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-teal focus:border-transparent outline-none transition-all" required>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                    <input type="text" name="address" id="address" placeholder="123 Main St" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-teal focus:border-transparent outline-none transition-all" required>
                                </div>
                                <div class="space-y-2">
                                    <label for="state" class="block text-sm font-medium text-gray-700">State</label>
                                    <select name="state" id="state" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-teal focus:border-transparent outline-none bg-white cursor-pointer transition-all" required>
                                        <option value="Abuja">Abuja</option>
                                        <option value="Lagos">Lagos</option>
                                        <option value="Port Harcourt">Port Harcourt</option>
                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label for="password" class="block text-sm font-medium text-gray-700">Initial Password</label>
                                    <div class="relative group">
                                        <input type="password" name="password" id="password" placeholder="••••••••" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-teal focus:border-transparent outline-none transition-all pr-10" required>
                                        <button type="button" onclick="togglePasswordVisibility('password', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-brand-teal transition-colors">
                                            <i class="fas fa-eye text-sm"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                                    <div class="relative group">
                                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-teal focus:border-transparent outline-none transition-all pr-10" required>
                                        <button type="button" onclick="togglePasswordVisibility('password_confirmation', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-brand-teal transition-colors">
                                            <i class="fas fa-eye text-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal Footer -->
                <div class="p-6 border-t border-gray-100 flex justify-end gap-3 bg-brand-grey/10 rounded-b-2xl">
                    <button type="button" onclick="closeStaffModal()" class="px-4 py-2 text-gray-600 hover:text-brand-red font-medium transition-colors">Cancel</button>
                    <button type="submit" form="staffForm" id="submitButton" class="px-6 py-2 bg-brand-blue text-white font-bold rounded-xl hover:bg-brand-teal transition-all shadow-lg shadow-brand-blue/20 flex items-center gap-2">
                        <span id="buttonText">Add Staff</span>
                        <i id="buttonSpinner" class="fas fa-spinner fa-spin hidden"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Footer Spacer -->
        <div class="h-12"></div>


        <div class="bg-white p-6 rounded-2xl shadow-soft overflow-x-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-brand-blue">Active Staff Directory</h3>
                <form action="{{ route('admin.adminManagement') }}" method="GET" class="relative group">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm group-focus-within:text-brand-teal transition-colors"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Quick staff search..." 
                        class="pl-10 pr-4 py-2 w-48 md:w-64 bg-brand-grey border border-transparent rounded-xl text-sm focus:bg-white focus:border-brand-teal focus:ring-4 focus:ring-brand-teal/10 transition-all outline-none"
                    >
                    @if(request('search'))
                        <a href="{{ route('admin.adminManagement') }}" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-brand-red transition-colors">
                            <i class="fas fa-times-circle"></i>
                        </a>
                    @endif
                </form>
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
                    @forelse ($staffs as $staff)
                        @php
                            $roleColor = match($staff->role) {
                                'editor' => 'brand-teal',
                                'dispatcher' => 'brand-orange',
                                'support' => 'brand-blue',
                                default => 'gray-500'
                            };
                            $statusColor = match($staff->status) {
                                'active' => 'bg-green-100 text-green-800 ring-green-600/20',
                                'inactive' => 'bg-gray-100 text-gray-800 ring-gray-600/20',
                                'suspended' => 'bg-red-100 text-red-800 ring-red-600/20',
                                default => 'bg-gray-100 text-gray-800 ring-gray-600/20'
                            };
                        @endphp
                        <tr class="hover:bg-brand-grey transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap" data-label="Name & ID">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-{{ $roleColor }} flex items-center justify-center text-white text-[10px] font-bold shadow-sm">
                                        {{ strtoupper(substr($staff->fullname, 0, 2)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $staff->fullname }}</p>
                                        <p class="text-xs text-gray-500 font-mono italic">#STF_{{ str_pad($staff->id, 3, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Email">{{ $staff->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" data-label="Role">
                                <span class="px-2 py-1 bg-{{ $roleColor }}/10 text-{{ $roleColor }} rounded-lg text-[10px] font-bold uppercase tracking-wider">
                                    {{ str_replace('_', ' ', $staff->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Last Login">
                                {{ $staff->last_login ? $staff->last_login->diffForHumans() : 'Never' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap" data-label="Status">
                                <span class="px-3 py-1 inline-flex text-[10px] leading-5 font-bold uppercase rounded-full {{ $statusColor }} ring-1">
                                    {{ $staff->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2" data-label="Actions">
                                <button onclick="editAdmin('{{ $staff->id }}')" class="p-2 bg-brand-blue/5 text-brand-blue rounded-lg hover:bg-brand-blue hover:text-white transition-all">
                                    <i class="fas fa-edit text-xs"></i>
                                </button>
                                @if($staff->status === 'inactive')
                                    <button onclick="reInviteAdmin('{{ $staff->id }}', '{{ $staff->fullname }}')" class="p-2 bg-brand-gold/5 text-brand-gold rounded-lg hover:bg-brand-gold hover:text-white transition-all">
                                        <i class="fas fa-paper-plane text-xs"></i>
                                    </button>
                                @else
                                    <button onclick="suspendStaff('{{ $staff->id }}', '{{ $staff->fullname }}')" class="p-2 bg-brand-red/5 text-brand-red rounded-lg hover:bg-brand-red hover:text-white transition-all">
                                        <i class="fas fa-user-slash text-xs"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500 italic">
                                <i class="fas fa-users-slash text-4xl mb-3 block text-gray-300"></i>
                                No active staff members found in the directory.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-6">
                {{ $staffs->links() }}
            </div>
        </div>
        
        <!-- Footer Spacer -->
        <div class="h-12"></div>
    </main>

    <!-- JavaScript for Mobile Sidebar Toggle and Mock Actions -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('backdrop');

        //Mock Action Functions
        function openAddAdminModal() {
            alertMessage('info', 'Opening the "Invite New Admin" form...');
            console.log("Add New Admin modal simulated.");
        }

        function editAdmin(id) {
            alertMessage('info', `Editing staff member with ID: ${id}.`);
            console.log(`Edit Admin requested for ID: ${id}.`);
        }
        
        function suspendStaff(id, name) {
            alertMessage('warning', `Confirming access revocation for ${name} (${id}).`);
            console.log(`Revoke Admin requested for ID: ${id}.`);
        }

        function togglePasswordVisibility(inputId, button) {
            const input = document.getElementById(inputId);
            const icon = button.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        function reInviteAdmin(id, name) {
            alertMessage('success', `Re-invitation email sent to ${name} (${id}).`);
            console.log(`Re-Invite Admin requested for ID: ${id}.`);
        }

        function alertMessage(type, message) {
            const container = document.body;

            // Remove existing toast (prevents stacking bug)
            const existingToast = document.querySelector('.custom-toast');
            if (existingToast) existingToast.remove();

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

            alertDiv.className = `
                custom-toast fixed top-4 right-4 p-4 rounded-xl text-white shadow-lg
                flex items-center space-x-3 transition-transform duration-500 transform translate-x-full
                ${bgColor} z-50 max-w-sm break-words
            `;

            alertDiv.innerHTML = `
                ${icon}
                <span class="font-semibold text-sm">${message}</span>
            `;

            container.appendChild(alertDiv);

            // Slide in
            setTimeout(() => {
                alertDiv.classList.remove('translate-x-full');
            }, 50);

            // Slide out
            setTimeout(() => {
                alertDiv.classList.add('translate-x-full');

                alertDiv.addEventListener('transitionend', () => {
                    alertDiv.remove();
                });
            }, 3000);
        }


        //Sidebar Toggle Functions
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

        //Staff Form Submission
        document.getElementById('staffForm')?.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const form = this;
            const submitBtn = document.getElementById('submitButton');
            const buttonText = document.getElementById('buttonText');
            const buttonSpinner = document.getElementById('buttonSpinner');
            
            // Start Processing State
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-70', 'cursor-not-allowed');
            buttonText.textContent = 'Processing...';
            buttonSpinner.classList.remove('hidden');
            
            const formData = new FormData(form);
            
            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });
                
                const result = await response.json();
                
                if (result.status === "success") {
                    alertMessage('success', result.message || 'Staff member added successfully!');
                    form.reset();
                    closeStaffModal();
                    // Reload
                    setTimeout(() => window.location.reload(), 2000);
                } else {
                    // Handle Validation Errors
                    if (result.errors) {
                        const errorMsg = Object.values(result.errors).flat()[0];
                        alertMessage('warning', errorMsg);
                    } else {
                        alertMessage('warning', result.message || 'An unexpected error occurred.');
                    }
                }
            } catch (error) {
                console.error('Submission error:', error);
                alertMessage('warning', 'Network error. Please try again.');
            } finally {
                // End Processing State
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-70', 'cursor-not-allowed');
                buttonText.textContent = 'Add Staff';
                buttonSpinner.classList.add('hidden');
            }
        });

        //Staff Modal Functions
        function openStaffModal() {
            const modal = document.getElementById('newStaffModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            setTimeout(() => {
                modal.querySelector('div').classList.remove('scale-95', 'opacity-0');
                modal.querySelector('div').classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeStaffModal() {
            const modal = document.getElementById('newStaffModal');
            modal.querySelector('div').classList.remove('scale-100', 'opacity-100');
            modal.querySelector('div').classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }, 300); // Improved transition speed
        }
    </script>
</body>
</html>