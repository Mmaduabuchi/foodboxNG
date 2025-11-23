<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Service | FoodBox NG</title>
    
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
            <span class="text-brand-teal font-bold tracking-wider uppercase text-sm mb-4 block">Legal Documentation</span>
            <h1 class="text-4xl md:text-6xl font-bold text-brand-blue mb-6">Terms of Service</h1>
            <p class="text-gray-500 text-sm font-medium">
                Last Updated: <span class="text-brand-blue">October 24, 2023</span>
            </p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-12 bg-brand-grey">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-12">
                
                <!-- Sidebar Navigation (Sticky) -->
                <div class="hidden lg:block w-1/4">
                    <div class="sticky top-32 bg-white rounded-2xl shadow-soft p-6">
                        <h4 class="font-bold text-brand-blue mb-4 border-b border-gray-100 pb-2">Table of Contents</h4>
                        <ul class="space-y-3 text-sm text-gray-600">
                            <li><a href="#acceptance" class="hover:text-brand-teal transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-xs text-brand-gold"></i> Acceptance of Terms</a></li>
                            <li><a href="#accounts" class="hover:text-brand-teal transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-xs text-gray-300"></i> User Accounts</a></li>
                            <li><a href="#ordering" class="hover:text-brand-teal transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-xs text-gray-300"></i> Ordering & Subscriptions</a></li>
                            <li><a href="#delivery" class="hover:text-brand-teal transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-xs text-gray-300"></i> Delivery Policy</a></li>
                            <li><a href="#returns" class="hover:text-brand-teal transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-xs text-gray-300"></i> Returns & Refunds</a></li>
                            <li><a href="#conduct" class="hover:text-brand-teal transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-xs text-gray-300"></i> User Conduct</a></li>
                            <li><a href="#liability" class="hover:text-brand-teal transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-xs text-gray-300"></i> Limitation of Liability</a></li>
                            <li><a href="#law" class="hover:text-brand-teal transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-xs text-gray-300"></i> Governing Law</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="lg:w-3/4">
                    <div class="bg-white rounded-3xl shadow-soft p-8 md:p-12 space-y-12">
                        
                        <!-- Introduction -->
                        <div id="acceptance">
                            <h2 class="text-2xl font-bold text-brand-blue mb-4">1. Acceptance of Terms</h2>
                            <p class="text-gray-600 leading-relaxed mb-4">
                                Welcome to FoodBox NG. By accessing our website, mobile application, or using our services, you agree to be bound by these Terms of Service ("Terms") and our Privacy Policy. If you do not agree to these Terms, please do not use our services.
                            </p>
                            <p class="text-gray-600 leading-relaxed">
                                We reserve the right to update or modify these Terms at any time without prior notice. Your continued use of the service after any changes constitutes your acceptance of the new Terms.
                            </p>
                        </div>

                        <!-- Accounts -->
                        <div id="accounts">
                            <h2 class="text-2xl font-bold text-brand-blue mb-4">2. User Accounts</h2>
                            <p class="text-gray-600 leading-relaxed mb-4">
                                To access certain features of FoodBox NG, you may be required to create an account. You agree to provide accurate, current, and complete information during the registration process.
                            </p>
                            <ul class="list-disc list-inside space-y-2 text-gray-600 ml-4">
                                <li>You are responsible for safeguarding your password.</li>
                                <li>You agree not to disclose your password to any third party.</li>
                                <li>You must notify us immediately upon becoming aware of any breach of security or unauthorized use of your account.</li>
                            </ul>
                        </div>

                        <!-- Ordering -->
                        <div id="ordering">
                            <h2 class="text-2xl font-bold text-brand-blue mb-4">3. Ordering & Subscriptions</h2>
                            <p class="text-gray-600 leading-relaxed mb-4">
                                <strong>Pricing:</strong> All prices listed on the FoodBox NG website are in Nigerian Naira (₦) and are inclusive of VAT unless otherwise stated. Delivery fees are calculated separately at checkout.
                            </p>
                            <p class="text-gray-600 leading-relaxed mb-4">
                                <strong>Subscriptions:</strong> Monthly subscriptions are billed in advance. You may cancel or pause your subscription at any time through your account dashboard. Cancellations must be made at least 48 hours before the next billing cycle to avoid being charged for the subsequent month.
                            </p>
                            <p class="text-gray-600 leading-relaxed">
                                <strong>Product Availability:</strong> We make every effort to ensure product availability. However, due to the seasonal nature of farm produce, we reserve the right to substitute unavailable items with products of equal or greater value.
                            </p>
                        </div>

                        <!-- Delivery -->
                        <div id="delivery">
                            <h2 class="text-2xl font-bold text-brand-blue mb-4">4. Delivery Policy</h2>
                            <p class="text-gray-600 leading-relaxed mb-4">
                                FoodBox NG partners with third-party logistics providers to deliver your orders. While we strive for 24-hour delivery in Lagos and standard timelines for other cities, delivery times are estimates and cannot be guaranteed.
                            </p>
                            <p class="text-gray-600 leading-relaxed">
                                It is your responsibility to ensure someone is available to receive the order at the provided address. Failed delivery attempts caused by customer unavailability may attract a re-delivery fee.
                            </p>
                        </div>

                        <!-- Returns -->
                        <div id="returns">
                            <h2 class="text-2xl font-bold text-brand-blue mb-4">5. Returns & Refunds</h2>
                            <p class="text-gray-600 leading-relaxed mb-4">
                                Our <a href="foodbox_returns.html" class="text-brand-teal font-bold hover:underline">Returns Policy</a> is an integral part of these Terms. 
                            </p>
                            <p class="text-gray-600 leading-relaxed">
                                <strong>Freshness Guarantee:</strong> Perishable items must be inspected upon delivery. Complaints regarding spoilage or damage must be reported within 24 hours of receipt with photographic evidence. Refunds are processed to your FoodBox wallet or original payment method at our discretion.
                            </p>
                        </div>

                        <!-- Conduct -->
                        <div id="conduct">
                            <h2 class="text-2xl font-bold text-brand-blue mb-4">6. User Conduct</h2>
                            <p class="text-gray-600 leading-relaxed mb-4">
                                You agree not to misuse the FoodBox NG services. Prohibited actions include:
                            </p>
                            <ul class="list-disc list-inside space-y-2 text-gray-600 ml-4">
                                <li>Using the service for any illegal purpose.</li>
                                <li>Attempting to interfere with the proper working of the website.</li>
                                <li>Creating multiple accounts to abuse promotional codes or referral programs.</li>
                                <li>Harassing or abusing our support staff or delivery riders.</li>
                            </ul>
                        </div>

                        <!-- Liability -->
                        <div id="liability">
                            <h2 class="text-2xl font-bold text-brand-blue mb-4">7. Limitation of Liability</h2>
                            <p class="text-gray-600 leading-relaxed mb-4">
                                To the maximum extent permitted by law, FoodBox NG shall not be liable for any indirect, incidental, special, consequential, or punitive damages, or any loss of profits or revenues, whether incurred directly or indirectly, or any loss of data, use, goodwill, or other intangible losses.
                            </p>
                        </div>

                        <!-- Governing Law -->
                        <div id="law">
                            <h2 class="text-2xl font-bold text-brand-blue mb-4">8. Governing Law</h2>
                            <p class="text-gray-600 leading-relaxed mb-4">
                                These Terms shall be governed and construed in accordance with the laws of the Federal Republic of Nigeria, without regard to its conflict of law provisions.
                            </p>
                            <div class="bg-brand-teal/5 border-l-4 border-brand-teal p-6 rounded-r-xl mt-6">
                                <h5 class="font-bold text-brand-blue mb-2">Contact Us</h5>
                                <p class="text-gray-600 text-sm mb-2">If you have any questions about these Terms, please contact us at:</p>
                                <p class="text-brand-teal font-bold">legal@foodbox.ng</p>
                            </div>
                        </div>

                    </div>
                </div>
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
                        <li><a href="foodbox_faq.html" class="hover:text-white transition-colors">FAQs</a></li>
                        <li><a href="foodbox_shipping.html" class="hover:text-white transition-colors">Shipping Policy</a></li>
                        <li><a href="foodbox_returns.html" class="hover:text-white transition-colors">Returns</a></li>
                        <li><a href="#" class="text-white font-bold transition-colors">Terms of Service</a></li>
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