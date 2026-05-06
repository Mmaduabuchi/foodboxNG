<header class="fixed top-0 right-0 w-full h-20 bg-white border-b border-gray-100 shadow-soft z-30 flex items-center px-4 md:px-8">
    <div class="flex-grow flex items-center space-x-6">
        <h1 class="text-xl font-bold text-brand-blue hidden md:block">Dashboard Overview</h1>
        <!-- Search Bar -->
        <div class="relative w-full max-w-sm">
            <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            <input 
                type="search" 
                placeholder="Search orders, users, or packages..."
                class="w-full pl-12 pr-4 py-2 border border-gray-200 rounded-full focus:border-brand-teal focus:ring-1 focus:ring-brand-teal/20 outline-none transition-all text-sm bg-brand-grey/50"
            >
        </div>
    </div>

    <!-- Right Side Actions -->
    <div class="flex items-center space-x-4">
        
        <!-- Notifications Bell -->
        <button class="p-2 rounded-full text-gray-500 hover:bg-brand-grey transition-colors relative">
            <i class="fas fa-bell text-lg"></i>
            <span class="absolute top-0.5 right-0.5 block h-2 w-2 rounded-full ring-2 ring-white bg-brand-orange"></span>
        </button>

        <!-- Quick Action Button -->
        <div class="relative group">
            <button class="px-4 py-2 bg-brand-teal text-white font-semibold rounded-xl hover:bg-brand-teal/90 transition-colors shadow-sm-brand flex items-center gap-2">
                <i class="fas fa-plus"></i>
                <span class="hidden md:inline">Add New</span>
            </button>
            <!-- Quick Action Dropdown -->
            <div class="absolute right-0 mt-3 w-40 bg-white border border-gray-100 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform scale-95 origin-top-right z-40">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-grey rounded-t-xl"><i class="fas fa-cube mr-2"></i> Add Package</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-grey"><i class="fas fa-box-open mr-2"></i> Add Item</a>
                <div class="border-t border-gray-100"></div>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-grey rounded-b-xl"><i class="fas fa-user-plus mr-2"></i> Add Admin</a>
            </div>
        </div>
        
        <!-- Profile Avatar Dropdown -->
        <div class="relative group cursor-pointer hidden sm:block">
            <img src="https://placehold.co/36x36/E76F51/FFFFFF?text=SA" onerror="this.onerror=null; this.src='https://placehold.co/36x36/E76F51/FFFFFF?text=SA';" alt="Admin Avatar" class="w-9 h-9 rounded-full object-cover ring-2 ring-brand-blue/50">
        </div>
    </div>
</header>