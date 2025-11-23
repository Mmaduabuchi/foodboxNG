<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Returns & Refunds | FoodBox NG</title>
    
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
    <nav class="fixed w-full z-50 bg-white/90 backdrop-blur-md border-b border-gray-100 transition-all duration-300" id="navbar">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="foodbox_landing.html" class="flex items-center gap-2 group">
                    <div class="w-10 h-10 bg-brand-teal rounded-lg flex items-center justify-center text-white shadow-lg group-hover:rotate-3 transition-transform">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <span class="text-2xl font-bold text-brand-blue tracking-tight">FoodBox<span class="text-brand-teal">NG</span></span>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-8 font-medium text-gray-600">
                    <a href="foodbox_landing.html" class="hover:text-brand-teal transition-colors">Home</a>
                    <a href="foodbox_landing.html#packages" class="hover:text-brand-teal transition-colors">Packages</a>
                    <a href="foodbox_about.html" class="hover:text-brand-teal transition-colors">About Us</a>
                    <a href="foodbox_contact.html" class="hover:text-brand-teal transition-colors">Contact</a>
                </div>

                <!-- CTA Button -->
                <div class="hidden md:block">
                    <a href="foodbox_landing.html#packages" class="bg-brand-blue text-white px-6 py-2.5 rounded-full font-semibold hover:bg-brand-teal transition-all shadow-lg shadow-brand-blue/20 hover:shadow-brand-teal/30">
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
                <a href="foodbox_landing.html" class="text-gray-600 hover:text-brand-teal" onclick="toggleMenu()">Home</a>
                <a href="foodbox_landing.html#packages" class="text-gray-600 hover:text-brand-teal" onclick="toggleMenu()">Packages</a>
                <a href="foodbox_about.html" class="text-gray-600 hover:text-brand-teal" onclick="toggleMenu()">About Us</a>
                <a href="foodbox_contact.html" class="text-gray-600 hover:text-brand-teal" onclick="toggleMenu()">Contact</a>
                <a href="foodbox_landing.html#packages" class="bg-brand-teal text-white text-center py-3 rounded-lg font-bold shadow-md" onclick="toggleMenu()">Get Started</a>
            </div>
        </div>
    </nav>

    <!-- Header / Hero -->
    <section class="relative pt-40 pb-20 bg-white overflow-hidden">
        <div class="absolute inset-0 pattern-grid z-0"></div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <span class="text-brand-teal font-bold tracking-wider uppercase text-sm mb-4 block">Our Promise to You</span>
            <h1 class="text-4xl md:text-6xl font-bold text-brand-blue mb-6">Returns & Refunds</h1>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto leading-relaxed">
                We take pride in the freshness of our produce. If you aren't satisfied, we are committed to making it right immediately.
            </p>
        </div>
    </section>

    <!-- The Guarantee Card -->
    <section class="pb-12 -mt-10 relative z-20">
        <div class="container mx-auto px-6">
            <div class="bg-brand-blue text-white rounded-3xl p-8 md:p-12 shadow-xl max-w-4xl mx-auto flex flex-col md:flex-row items-center gap-8">
                <div class="w-24 h-24 bg-white/10 rounded-full flex items-center justify-center shrink-0">
                    <i class="fas fa-certificate text-4xl text-brand-gold"></i>
                </div>
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold mb-3">The "Freshness Guarantee"</h2>
                    <p class="text-gray-300 leading-relaxed">
                        We guarantee that every vegetable, tuber, and grain in your FoodBox is fresh and of high quality. If you receive spoiled, damaged, or incorrect items, we will replace them or refund you—no questions asked.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Policy Details -->
    <section class="py-16 bg-brand-grey">
        <div class="container mx-auto px-6 max-w-5xl">
            
            <!-- Section Title -->
            <div class="mb-12">
                <h3 class="text-2xl font-bold text-brand-blue mb-4 border-l-4 border-brand-teal pl-4">Return Windows</h3>
                <p class="text-gray-600">Because we deal with food, time is of the essence. Please adhere to the following timelines:</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 mb-16">
                <!-- Perishables -->
                <div class="bg-white p-8 rounded-3xl shadow-soft border-t-4 border-brand-red">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-12 h-12 bg-brand-red/10 rounded-xl flex items-center justify-center text-brand-red">
                            <i class="fas fa-apple-alt text-xl"></i>
                        </div>
                        <span class="bg-brand-red/10 text-brand-red px-3 py-1 rounded-full text-xs font-bold">Within 24 Hours</span>
                    </div>
                    <h4 class="text-xl font-bold text-brand-blue mb-3">Perishable Items</h4>
                    <p class="text-sm text-gray-500 mb-4">Fresh vegetables, fruits, meats, tubers, bread, and eggs.</p>
                    <ul class="space-y-2 text-gray-600 text-sm">
                        <li class="flex items-start gap-2"><i class="fas fa-check text-green-500 mt-1"></i> Report visibly spoiled items immediately.</li>
                        <li class="flex items-start gap-2"><i class="fas fa-check text-green-500 mt-1"></i> Report broken eggs or crushed produce.</li>
                        <li class="flex items-start gap-2"><i class="fas fa-times text-red-500 mt-1"></i> We cannot accept returns after 24 hours due to storage conditions.</li>
                    </ul>
                </div>

                <!-- Non-Perishables -->
                <div class="bg-white p-8 rounded-3xl shadow-soft border-t-4 border-brand-teal">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-12 h-12 bg-brand-teal/10 rounded-xl flex items-center justify-center text-brand-teal">
                            <i class="fas fa-box-open text-xl"></i>
                        </div>
                        <span class="bg-brand-teal/10 text-brand-teal px-3 py-1 rounded-full text-xs font-bold">Within 3 Days</span>
                    </div>
                    <h4 class="text-xl font-bold text-brand-blue mb-3">Non-Perishable Items</h4>
                    <p class="text-sm text-gray-500 mb-4">Canned goods, sealed grains (rice/beans), oil, spices, and packaged dry foods.</p>
                    <ul class="space-y-2 text-gray-600 text-sm">
                        <li class="flex items-start gap-2"><i class="fas fa-check text-green-500 mt-1"></i> Return if seal is broken upon delivery.</li>
                        <li class="flex items-start gap-2"><i class="fas fa-check text-green-500 mt-1"></i> Return if item is expired or incorrect brand.</li>
                        <li class="flex items-start gap-2"><i class="fas fa-times text-red-500 mt-1"></i> Item must be unopened and in original packaging.</li>
                    </ul>
                </div>
            </div>

            <!-- How it Works -->
            <div class="mb-12">
                <h3 class="text-2xl font-bold text-brand-blue mb-4 border-l-4 border-brand-gold pl-4">How to Request a Return</h3>
            </div>

            <div class="grid md:grid-cols-3 gap-8 relative">
                <!-- Connector Line (Desktop) -->
                <div class="hidden md:block absolute top-12 left-0 w-full h-0.5 bg-gray-200 -z-10"></div>

                <!-- Step 1 -->
                <div class="bg-white p-6 rounded-2xl shadow-sm text-center">
                    <div class="w-16 h-16 mx-auto bg-brand-blue text-white rounded-full flex items-center justify-center text-2xl mb-4 font-bold border-4 border-white">1</div>
                    <h5 class="font-bold text-brand-blue mb-2">Snap a Photo</h5>
                    <p class="text-sm text-gray-500">Take a clear picture of the damaged or incorrect item immediately upon delivery.</p>
                </div>

                <!-- Step 2 -->
                <div class="bg-white p-6 rounded-2xl shadow-sm text-center">
                    <div class="w-16 h-16 mx-auto bg-brand-blue text-white rounded-full flex items-center justify-center text-2xl mb-4 font-bold border-4 border-white">2</div>
                    <h5 class="font-bold text-brand-blue mb-2">Contact Support</h5>
                    <p class="text-sm text-gray-500">Send the photo via WhatsApp to <strong>+234 800 FOOD BOX</strong> or email <strong>support@foodbox.ng</strong> with your Order ID.</p>
                </div>

                <!-- Step 3 -->
                <div class="bg-white p-6 rounded-2xl shadow-sm text-center">
                    <div class="w-16 h-16 mx-auto bg-brand-blue text-white rounded-full flex items-center justify-center text-2xl mb-4 font-bold border-4 border-white">3</div>
                    <h5 class="font-bold text-brand-blue mb-2">Get Refunded</h5>
                    <p class="text-sm text-gray-500">We will either dispatch a replacement rider within 24 hours or credit your FoodBox wallet instantly.</p>
                </div>
            </div>

        </div>
    </section>

    <!-- FAQ Specific to Returns -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6 max-w-3xl">
            <h3 class="text-2xl font-bold text-brand-blue text-center mb-10">Common Returns Questions</h3>

            <div class="space-y-4">
                <!-- FAQ 1 -->
                <div class="border border-gray-200 rounded-2xl overflow-hidden">
                    <button class="w-full flex justify-between items-center p-6 bg-gray-50 hover:bg-brand-teal/5 transition-colors text-left focus:outline-none group" onclick="toggleFAQ(this)">
                        <span class="font-bold text-brand-blue text-sm md:text-base">Do I have to pay for delivery of the replacement?</span>
                        <i class="fas fa-chevron-down text-gray-400 transition-transform group-hover:text-brand-teal"></i>
                    </button>
                    <div class="hidden p-6 pt-0 text-gray-600 text-sm leading-relaxed bg-gray-50">
                        No. If the error is from our end (bad produce or wrong item), we cover the full cost of delivering the replacement to you.
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="border border-gray-200 rounded-2xl overflow-hidden">
                    <button class="w-full flex justify-between items-center p-6 bg-gray-50 hover:bg-brand-teal/5 transition-colors text-left focus:outline-none group" onclick="toggleFAQ(this)">
                        <span class="font-bold text-brand-blue text-sm md:text-base">Can I get a cash refund instead of wallet credit?</span>
                        <i class="fas fa-chevron-down text-gray-400 transition-transform group-hover:text-brand-teal"></i>
                    </button>
                    <div class="hidden p-6 pt-0 text-gray-600 text-sm leading-relaxed bg-gray-50">
                        Yes. While wallet credits are instant, bank transfer refunds are processed within 5-7 business days depending on your bank.
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="border border-gray-200 rounded-2xl overflow-hidden">
                    <button class="w-full flex justify-between items-center p-6 bg-gray-50 hover:bg-brand-teal/5 transition-colors text-left focus:outline-none group" onclick="toggleFAQ(this)">
                        <span class="font-bold text-brand-blue text-sm md:text-base">I changed my mind about an item. Can I return it?</span>
                        <i class="fas fa-chevron-down text-gray-400 transition-transform group-hover:text-brand-teal"></i>
                    </button>
                    <div class="hidden p-6 pt-0 text-gray-600 text-sm leading-relaxed bg-gray-50">
                        For hygiene reasons, we do not accept returns on food items simply because of a change of mind once they have been delivered and accepted. Please review your order carefully at checkout.
                    </div>
                </div>
            </div>

            <div class="mt-12 text-center">
                <p class="text-gray-500 mb-4">Still have an issue?</p>
                <a href="foodbox_contact.html" class="inline-block bg-brand-teal text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-brand-blue transition-colors">Contact Support</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-brand-blue text-white pt-20 pb-10">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                <!-- Brand -->
                <div>
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-8 h-8 bg-brand-teal rounded flex items-center justify-center text-white">
                            <i class="fas fa-leaf text-sm"></i>
                        </div>
                        <span class="text-xl font-bold">FoodBox<span class="text-brand-teal">NG</span></span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed mb-6">
                        Simplifying food shopping for Nigerian homes. Quality, Affordability, and Convenience delivered.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-brand-teal transition-colors"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-brand-teal transition-colors"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-brand-teal transition-colors"><i class="fab fa-facebook-f"></i></a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-bold mb-6 text-brand-gold">Company</h4>
                    <ul class="space-y-4 text-gray-400 text-sm">
                        <li><a href="foodbox_about.html" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="foodbox_careers.html" class="hover:text-white transition-colors">Careers</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
                        <li><a href="foodbox_contact.html" class="hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h4 class="text-lg font-bold mb-6 text-brand-gold">Support</h4>
                    <ul class="space-y-4 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-white transition-colors">FAQs</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Shipping Policy</a></li>
                        <li><a href="#" class="text-white font-bold transition-colors">Returns</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Terms of Service</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-lg font-bold mb-6 text-brand-gold">Contact Us</h4>
                    <ul class="space-y-4 text-gray-400 text-sm">
                        <li class="flex items-start gap-3">
                            <i class="fas fa-map-marker-alt mt-1 text-brand-teal"></i>
                            <span>12 Admiralty Way, Lekki Phase 1,<br>Lagos, Nigeria.</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-phone text-brand-teal"></i>
                            <span>+234 800 FOOD BOX</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-envelope text-brand-teal"></i>
                            <span>hello@foodbox.ng</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 pt-8 text-center text-gray-500 text-sm">
                <p>&copy; 2023 FoodBox NG. All rights reserved.</p>
            </div>
        </div>
    </footer>

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
            } else {
                content.classList.add('hidden');
                content.classList.remove('block');
                icon.classList.remove('rotate-180');
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