<!-- Navigation -->
<nav class="fixed w-full z-50 bg-white/90 backdrop-blur-md border-b border-gray-100 transition-all duration-300" id="navbar">
    <div class="container mx-auto px-6 py-4">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <a href="/" class="flex items-center gap-2 group">
                <div class="w-10 h-10 bg-brand-teal rounded-lg flex items-center justify-center text-white shadow-lg group-hover:rotate-3 transition-transform">
                    <i class="fas fa-leaf"></i>
                </div>
                <span class="text-2xl font-bold text-brand-blue tracking-tight">
                    FoodBox
                    <span class="text-brand-teal">NG</span>
                </span>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center gap-8 font-medium text-gray-600">
                <a href="/" class="hover:text-brand-teal transition-colors">Home</a>
                <a href="{{ route('packages') }}" class="hover:text-brand-teal transition-colors">Packages</a>
                <a href="#features" class="hover:text-brand-teal transition-colors">Why Us</a>
                <a href="#testimonials" class="hover:text-brand-teal transition-colors">Reviews</a>
            </div>

            <!-- CTA Button -->
            <div class="hidden md:block">
                <a href="{{ route('register.index') }}"
                    class="bg-brand-blue text-white px-6 py-2.5 rounded-full font-semibold hover:bg-brand-teal transition-all shadow-lg shadow-brand-blue/20 hover:shadow-brand-teal/30">
                    Get Started
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button onclick="toggleMenu()" class="md:hidden text-brand-blue text-2xl focus:outline-none">
                <i class="fas fa-bars" id="menuIcon"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden md:hidden bg-white border-t border-gray-100 absolute w-full">
        <div class="flex flex-col p-6 space-y-4 font-medium">
            <a href="#home" class="text-gray-600 hover:text-brand-teal" onclick="toggleMenu()">Home</a>
            <a href="#packages" class="text-gray-600 hover:text-brand-teal" onclick="toggleMenu()">Packages</a>
            <a href="#features" class="text-gray-600 hover:text-brand-teal" onclick="toggleMenu()">Why Us</a>
            <a href="#testimonials" class="text-gray-600 hover:text-brand-teal" onclick="toggleMenu()">Reviews</a>
            <a href="#packages" class="bg-brand-teal text-white text-center py-3 rounded-lg font-bold shadow-md" onclick="toggleMenu()">Get Started</a>
        </div>
    </div>
</nav>