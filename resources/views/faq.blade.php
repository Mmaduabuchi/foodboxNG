<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQs | FoodBox NG</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            teal: '#2A9D8F',
                            blue: '#264653',
                            gold: '#E9C46A',
                            orange: '#F4A261',
                            red: '#E76F51',
                            grey: '#F4F6F8',
                        }
                    },
                    boxShadow: {
                        'soft': '0 10px 40px -10px rgba(0,0,0,0.08)',
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
            background: #F4F6F8;
        }
        ::-webkit-scrollbar-thumb {
            background: #2A9D8F;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #264653;
        }
        
        .pattern-grid {
            background-image: radial-gradient(#2A9D8F 1px, transparent 1px);
            background-size: 24px 24px;
            opacity: 0.1;
        }
    </style>
</head>
<body class="bg-brand-grey font-sans text-brand-blue antialiased selection:bg-brand-gold selection:text-brand-blue">

    <!-- Navigation -->
    @include('layouts.navbar')

    <!-- Header / Hero -->
    <section class="relative pt-40 pb-12 bg-white overflow-hidden">
        <div class="absolute inset-0 pattern-grid z-0"></div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <span class="text-brand-teal font-bold tracking-wider uppercase text-sm mb-4 block">Help Center</span>
            <h1 class="text-4xl md:text-6xl font-bold text-brand-blue mb-6">How can we help you?</h1>
            
            <!-- Search Bar -->
            <div class="max-w-xl mx-auto relative mb-8">
                <input type="text" placeholder="Search questions (e.g. 'refund', 'delivery time')..." class="w-full pl-12 pr-6 py-4 rounded-full border border-gray-200 shadow-lg focus:border-brand-teal focus:ring-2 focus:ring-brand-teal/20 outline-none transition-all">
                <i class="fas fa-search absolute left-5 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
        </div>
    </section>

    <!-- Quick Categories -->
    <section class="py-8 bg-white border-b border-gray-100">
        <div class="container mx-auto px-6">
            <div class="flex flex-wrap justify-center gap-4">
                <a href="#orders" class="px-6 py-3 rounded-full bg-brand-grey hover:bg-brand-teal hover:text-white text-gray-600 font-bold transition-colors text-sm flex items-center gap-2">
                    <i class="fas fa-shopping-basket"></i> Orders & Packages
                </a>
                <a href="#delivery" class="px-6 py-3 rounded-full bg-brand-grey hover:bg-brand-teal hover:text-white text-gray-600 font-bold transition-colors text-sm flex items-center gap-2">
                    <i class="fas fa-truck"></i> Shipping & Delivery
                </a>
                <a href="#payment" class="px-6 py-3 rounded-full bg-brand-grey hover:bg-brand-teal hover:text-white text-gray-600 font-bold transition-colors text-sm flex items-center gap-2">
                    <i class="fas fa-wallet"></i> Payments
                </a>
                <a href="#account" class="px-6 py-3 rounded-full bg-brand-grey hover:bg-brand-teal hover:text-white text-gray-600 font-bold transition-colors text-sm flex items-center gap-2">
                    <i class="fas fa-user-cog"></i> Account
                </a>
            </div>
        </div>
    </section>

    <!-- FAQ Content -->
    <section class="py-16 bg-brand-grey">
        <div class="container mx-auto px-6 max-w-3xl space-y-12">
            
            <!-- Category: Orders -->
            <div id="orders">
                <h3 class="text-2xl font-bold text-brand-blue mb-6 flex items-center gap-3">
                    <span class="w-8 h-8 bg-brand-teal rounded-lg flex items-center justify-center text-white text-sm"><i class="fas fa-shopping-basket"></i></span>
                    Orders & Packages
                </h3>
                <div class="space-y-4">
                    <!-- Q1 -->
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
                        <button class="w-full flex justify-between items-center p-6 hover:bg-gray-50 transition-colors text-left focus:outline-none group" onclick="toggleFAQ(this)">
                            <span class="font-bold text-brand-blue">Can I customize the items in a standard package?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform group-hover:text-brand-teal"></i>
                        </button>
                        <div class="hidden p-6 pt-0 text-gray-600 text-sm leading-relaxed border-t border-gray-100 mt-2">
                            Our standard packages (Student, Family, etc.) come pre-curated to offer the best bulk pricing. However, you can use our "Build Your Own" box feature to select individual items and create a package that perfectly suits your needs.
                        </div>
                    </div>
                    <!-- Q2 -->
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
                        <button class="w-full flex justify-between items-center p-6 hover:bg-gray-50 transition-colors text-left focus:outline-none group" onclick="toggleFAQ(this)">
                            <span class="font-bold text-brand-blue">Are the food items local or foreign?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform group-hover:text-brand-teal"></i>
                        </button>
                        <div class="hidden p-6 pt-0 text-gray-600 text-sm leading-relaxed border-t border-gray-100 mt-2">
                            We offer a mix of both! Our rice options include Premium Foreign Rice and Stone-free Local Rice. Tubers and vegetables are locally sourced fresh from Nigerian farms. Each product description clearly states its origin.
                        </div>
                    </div>
                    <!-- Q3 -->
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
                        <button class="w-full flex justify-between items-center p-6 hover:bg-gray-50 transition-colors text-left focus:outline-none group" onclick="toggleFAQ(this)">
                            <span class="font-bold text-brand-blue">Is there a minimum order amount?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform group-hover:text-brand-teal"></i>
                        </button>
                        <div class="hidden p-6 pt-0 text-gray-600 text-sm leading-relaxed border-t border-gray-100 mt-2">
                            Yes, the minimum order value for delivery is ₦10,000. This ensures we can maintain affordable delivery rates for everyone.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category: Delivery -->
            <div id="delivery">
                <h3 class="text-2xl font-bold text-brand-blue mb-6 flex items-center gap-3">
                    <span class="w-8 h-8 bg-brand-gold rounded-lg flex items-center justify-center text-brand-blue text-sm"><i class="fas fa-truck"></i></span>
                    Shipping & Delivery
                </h3>
                <div class="space-y-4">
                    <!-- Q1 -->
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
                        <button class="w-full flex justify-between items-center p-6 hover:bg-gray-50 transition-colors text-left focus:outline-none group" onclick="toggleFAQ(this)">
                            <span class="font-bold text-brand-blue">Do you deliver on weekends?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform group-hover:text-brand-teal"></i>
                        </button>
                        <div class="hidden p-6 pt-0 text-gray-600 text-sm leading-relaxed border-t border-gray-100 mt-2">
                            Yes, we deliver on Saturdays. Sunday deliveries are available only for "Express" orders in Lagos and attract a slightly higher delivery fee.
                        </div>
                    </div>
                    <!-- Q2 -->
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
                        <button class="w-full flex justify-between items-center p-6 hover:bg-gray-50 transition-colors text-left focus:outline-none group" onclick="toggleFAQ(this)">
                            <span class="font-bold text-brand-blue">Can I pick up my order myself?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform group-hover:text-brand-teal"></i>
                        </button>
                        <div class="hidden p-6 pt-0 text-gray-600 text-sm leading-relaxed border-t border-gray-100 mt-2">
                            Currently, we operate a delivery-only model to maintain logistics efficiency and keep our warehouse secure. We bring the market to you!
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category: Payments -->
            <div id="payment">
                <h3 class="text-2xl font-bold text-brand-blue mb-6 flex items-center gap-3">
                    <span class="w-8 h-8 bg-brand-blue rounded-lg flex items-center justify-center text-white text-sm"><i class="fas fa-wallet"></i></span>
                    Payments & Refunds
                </h3>
                <div class="space-y-4">
                    <!-- Q1 -->
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
                        <button class="w-full flex justify-between items-center p-6 hover:bg-gray-50 transition-colors text-left focus:outline-none group" onclick="toggleFAQ(this)">
                            <span class="font-bold text-brand-blue">Do you accept Pay on Delivery (POD)?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform group-hover:text-brand-teal"></i>
                        </button>
                        <div class="hidden p-6 pt-0 text-gray-600 text-sm leading-relaxed border-t border-gray-100 mt-2">
                            Yes! We accept Pay on Delivery via Bank Transfer or POS for orders under ₦50,000 within Lagos. Orders above this amount or outside Lagos require pre-payment.
                        </div>
                    </div>
                    <!-- Q2 -->
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
                        <button class="w-full flex justify-between items-center p-6 hover:bg-gray-50 transition-colors text-left focus:outline-none group" onclick="toggleFAQ(this)">
                            <span class="font-bold text-brand-blue">What is your refund policy for spoiled items?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform group-hover:text-brand-teal"></i>
                        </button>
                        <div class="hidden p-6 pt-0 text-gray-600 text-sm leading-relaxed border-t border-gray-100 mt-2">
                            We have a strict Freshness Guarantee. If you receive any spoiled or damaged items, please take a photo and contact us within 24 hours. We will process an instant refund to your wallet or send a replacement free of charge.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category: Account -->
            <div id="account">
                <h3 class="text-2xl font-bold text-brand-blue mb-6 flex items-center gap-3">
                    <span class="w-8 h-8 bg-brand-orange rounded-lg flex items-center justify-center text-white text-sm"><i class="fas fa-user-cog"></i></span>
                    Account & Subscriptions
                </h3>
                <div class="space-y-4">
                    <!-- Q1 -->
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
                        <button class="w-full flex justify-between items-center p-6 hover:bg-gray-50 transition-colors text-left focus:outline-none group" onclick="toggleFAQ(this)">
                            <span class="font-bold text-brand-blue">Can I pause my subscription if I travel?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform group-hover:text-brand-teal"></i>
                        </button>
                        <div class="hidden p-6 pt-0 text-gray-600 text-sm leading-relaxed border-t border-gray-100 mt-2">
                            Absolutely. You can "Skip a Month" or "Pause Subscription" directly from your account dashboard at any time before the billing date.
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Still Stuck? -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="bg-brand-blue rounded-3xl p-10 md:p-16 text-center relative overflow-hidden max-w-4xl mx-auto">
                <!-- Decor -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-brand-teal opacity-10 rounded-full translate-x-1/3 -translate-y-1/3"></div>
                <div class="absolute bottom-0 left-0 w-20 h-20 bg-brand-gold opacity-10 rounded-full -translate-x-1/3 translate-y-1/3"></div>

                <div class="relative z-10">
                    <h2 class="text-3xl font-bold text-white mb-4">Still have questions?</h2>
                    <p class="text-gray-300 mb-8">Our support team is just a click away.</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="https://wa.me/2348000000000" class="bg-green-500 text-white px-8 py-3 rounded-full font-bold hover:bg-green-600 transition-all shadow-lg flex items-center justify-center gap-2">
                            <i class="fab fa-whatsapp text-xl"></i> Chat on WhatsApp
                        </a>
                        <a href="foodbox_contact.html" class="bg-white text-brand-blue px-8 py-3 rounded-full font-bold hover:bg-brand-grey transition-all flex items-center justify-center gap-2">
                            <i class="fas fa-envelope"></i> Email Support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('layouts.footer')

    <!-- Scripts -->
    <script>
        function toggleMenu() {
            const menu = document.getElementById('mobileMenu');
            const icon = document.getElementById('menuIcon');
            
            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                menu.classList.add('hidden');
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        }

        // Toggle FAQ Accordion
        function toggleFAQ(button) {
            const content = button.nextElementSibling;
            const icon = button.querySelector('.fa-chevron-down');
            
            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                content.classList.add('block');
                icon.classList.add('rotate-180');
                button.classList.add('bg-gray-50');
            } else {
                content.classList.add('hidden');
                content.classList.remove('block');
                icon.classList.remove('rotate-180');
                button.classList.remove('bg-gray-50');
            }
        }

        // Navbar Scroll
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('shadow-md');
                navbar.classList.replace('py-4', 'py-2');
            } else {
                navbar.classList.remove('shadow-md');
                navbar.classList.replace('py-2', 'py-4');
            }
        });
    </script>
</body>
</html>