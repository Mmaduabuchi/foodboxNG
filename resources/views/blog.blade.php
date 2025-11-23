<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog | FoodBox NG</title>
    
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
                    <a href="#" class="text-brand-teal font-bold transition-colors">Blog</a> <!-- Active -->
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
                <a href="#" class="text-brand-teal font-bold" onclick="toggleMenu()">Blog</a>
                <a href="foodbox_landing.html#packages" class="bg-brand-teal text-white text-center py-3 rounded-lg font-bold shadow-md" onclick="toggleMenu()">Get Started</a>
            </div>
        </div>
    </nav>

    <!-- Header / Hero -->
    <section class="relative pt-40 pb-12 bg-white overflow-hidden">
        <div class="absolute inset-0 pattern-grid z-0"></div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <span class="text-brand-teal font-bold tracking-wider uppercase text-sm mb-4 block">Fresh Insights</span>
            <h1 class="text-4xl md:text-6xl font-bold text-brand-blue mb-6">The FoodBox Blog</h1>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto leading-relaxed mb-8">
                Tips on smart shopping, healthy Nigerian recipes, and updates from our partner farms.
            </p>
            
            <!-- Search Bar -->
            <div class="max-w-lg mx-auto relative">
                <input type="text" placeholder="Search articles (e.g. 'Jollof rice', 'Budget tips')..." class="w-full pl-12 pr-6 py-4 rounded-full border border-gray-200 shadow-lg focus:border-brand-teal focus:ring-2 focus:ring-brand-teal/20 outline-none transition-all">
                <i class="fas fa-search absolute left-5 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
        </div>
    </section>

    <!-- Featured Article -->
    <section class="py-12 bg-brand-grey">
        <div class="container mx-auto px-6">
            <div class="bg-white rounded-3xl shadow-soft overflow-hidden flex flex-col lg:flex-row group cursor-pointer hover:shadow-xl transition-shadow">
                <div class="lg:w-1/2 relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1543083115-633c33843e11?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Market Shopping" class="w-full h-64 lg:h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute top-6 left-6 bg-brand-gold text-brand-blue font-bold px-4 py-2 rounded-full text-sm shadow-md">Featured</div>
                </div>
                <div class="lg:w-1/2 p-8 lg:p-12 flex flex-col justify-center">
                    <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                        <span class="text-brand-teal font-bold uppercase tracking-wide">Money Saving</span>
                        <span>&bull;</span>
                        <span>Oct 24, 2023</span>
                    </div>
                    <h2 class="text-3xl font-bold text-brand-blue mb-4 group-hover:text-brand-teal transition-colors">5 Smart Ways to Cut Your Grocery Bill in Nigeria</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        With food inflation on the rise, shopping smart is more important than ever. Here are practical tips to keep your pantry full without breaking the bank, from bulk buying to seasonal selection.
                    </p>
                    <div class="flex items-center gap-3">
                        <img src="https://images.unsplash.com/photo-1531384441138-2736e62e0919?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" class="w-10 h-10 rounded-full object-cover">
                        <div>
                            <p class="text-sm font-bold text-brand-blue">Tobi Adebayo</p>
                            <p class="text-xs text-gray-500">Founder</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Grid -->
    <section class="py-12 bg-brand-grey">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-12">
                
                <!-- Article Grid (Left) -->
                <div class="lg:w-2/3">
                    <div class="grid md:grid-cols-2 gap-8">
                        
                        <!-- Post 1 -->
                        <article class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-lg transition-all group flex flex-col h-full">
                            <div class="h-48 overflow-hidden relative">
                                <img src="https://images.unsplash.com/photo-1604329760661-e71dc831d501?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <span class="absolute top-4 left-4 bg-brand-teal/90 text-white text-xs font-bold px-3 py-1 rounded-full">Recipes</span>
                            </div>
                            <div class="p-6 flex flex-col flex-1">
                                <h3 class="text-xl font-bold text-brand-blue mb-3 group-hover:text-brand-teal transition-colors line-clamp-2">The Secret Ingredient for Perfect Nigerian Jollof</h3>
                                <p class="text-gray-500 text-sm mb-4 line-clamp-3">It's not just about the firewood. Discover the spice blend that gives your rice that authentic party flavor at home.</p>
                                <div class="mt-auto flex justify-between items-center border-t border-gray-100 pt-4">
                                    <span class="text-xs text-gray-400">5 min read</span>
                                    <a href="#" class="text-brand-teal font-bold text-sm hover:underline">Read Article</a>
                                </div>
                            </div>
                        </article>

                        <!-- Post 2 -->
                        <article class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-lg transition-all group flex flex-col h-full">
                            <div class="h-48 overflow-hidden relative">
                                <img src="https://images.unsplash.com/photo-1598511726623-d21990428918?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <span class="absolute top-4 left-4 bg-brand-blue/90 text-white text-xs font-bold px-3 py-1 rounded-full">Company News</span>
                            </div>
                            <div class="p-6 flex flex-col flex-1">
                                <h3 class="text-xl font-bold text-brand-blue mb-3 group-hover:text-brand-teal transition-colors line-clamp-2">FoodBox Expands Delivery to Port Harcourt</h3>
                                <p class="text-gray-500 text-sm mb-4 line-clamp-3">We heard you! Starting next month, residents of the Garden City can enjoy our seamless food delivery service.</p>
                                <div class="mt-auto flex justify-between items-center border-t border-gray-100 pt-4">
                                    <span class="text-xs text-gray-400">3 min read</span>
                                    <a href="#" class="text-brand-teal font-bold text-sm hover:underline">Read Article</a>
                                </div>
                            </div>
                        </article>

                        <!-- Post 3 -->
                        <article class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-lg transition-all group flex flex-col h-full">
                            <div class="h-48 overflow-hidden relative">
                                <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <span class="absolute top-4 left-4 bg-green-600/90 text-white text-xs font-bold px-3 py-1 rounded-full">Healthy Living</span>
                            </div>
                            <div class="p-6 flex flex-col flex-1">
                                <h3 class="text-xl font-bold text-brand-blue mb-3 group-hover:text-brand-teal transition-colors line-clamp-2">Meal Prep 101: Healthy Lunches for Work</h3>
                                <p class="text-gray-500 text-sm mb-4 line-clamp-3">Stop buying expensive fast food. Learn how to prep a week's worth of healthy Nigerian lunches on Sunday.</p>
                                <div class="mt-auto flex justify-between items-center border-t border-gray-100 pt-4">
                                    <span class="text-xs text-gray-400">8 min read</span>
                                    <a href="#" class="text-brand-teal font-bold text-sm hover:underline">Read Article</a>
                                </div>
                            </div>
                        </article>

                        <!-- Post 4 -->
                        <article class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-lg transition-all group flex flex-col h-full">
                            <div class="h-48 overflow-hidden relative">
                                <img src="https://images.unsplash.com/photo-1592997571659-0b2e701199dd?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <span class="absolute top-4 left-4 bg-brand-gold/90 text-brand-blue text-xs font-bold px-3 py-1 rounded-full">Market Trends</span>
                            </div>
                            <div class="p-6 flex flex-col flex-1">
                                <h3 class="text-xl font-bold text-brand-blue mb-3 group-hover:text-brand-teal transition-colors line-clamp-2">Why Yam Prices are Rising (And When They'll Drop)</h3>
                                <p class="text-gray-500 text-sm mb-4 line-clamp-3">An analysis of the current harvest season and how transport costs are affecting the price of your favorite tuber.</p>
                                <div class="mt-auto flex justify-between items-center border-t border-gray-100 pt-4">
                                    <span class="text-xs text-gray-400">6 min read</span>
                                    <a href="#" class="text-brand-teal font-bold text-sm hover:underline">Read Article</a>
                                </div>
                            </div>
                        </article>

                    </div>

                    <!-- Pagination -->
                    <div class="mt-12 flex justify-center gap-2">
                        <button class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:border-brand-teal hover:text-brand-teal transition-colors"><i class="fas fa-chevron-left"></i></button>
                        <button class="w-10 h-10 rounded-full bg-brand-teal text-white font-bold flex items-center justify-center shadow-lg">1</button>
                        <button class="w-10 h-10 rounded-full border border-gray-200 text-gray-600 font-bold flex items-center justify-center hover:border-brand-teal hover:text-brand-teal transition-colors">2</button>
                        <button class="w-10 h-10 rounded-full border border-gray-200 text-gray-600 font-bold flex items-center justify-center hover:border-brand-teal hover:text-brand-teal transition-colors">3</button>
                        <button class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-600 hover:border-brand-teal hover:text-brand-teal transition-colors"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>

                <!-- Sidebar (Right) -->
                <div class="lg:w-1/3 space-y-8">
                    
                    <!-- Categories -->
                    <div class="bg-white rounded-3xl p-8 shadow-soft">
                        <h4 class="font-bold text-brand-blue mb-6 text-lg border-b border-gray-100 pb-2">Categories</h4>
                        <ul class="space-y-3 text-gray-600">
                            <li class="flex justify-between items-center group cursor-pointer">
                                <span class="group-hover:text-brand-teal transition-colors">Recipes & Cooking</span>
                                <span class="bg-gray-100 text-xs px-2 py-1 rounded-full group-hover:bg-brand-teal group-hover:text-white transition-colors">12</span>
                            </li>
                            <li class="flex justify-between items-center group cursor-pointer">
                                <span class="group-hover:text-brand-teal transition-colors">Money Saving Tips</span>
                                <span class="bg-gray-100 text-xs px-2 py-1 rounded-full group-hover:bg-brand-teal group-hover:text-white transition-colors">8</span>
                            </li>
                            <li class="flex justify-between items-center group cursor-pointer">
                                <span class="group-hover:text-brand-teal transition-colors">Healthy Living</span>
                                <span class="bg-gray-100 text-xs px-2 py-1 rounded-full group-hover:bg-brand-teal group-hover:text-white transition-colors">5</span>
                            </li>
                            <li class="flex justify-between items-center group cursor-pointer">
                                <span class="group-hover:text-brand-teal transition-colors">Company News</span>
                                <span class="bg-gray-100 text-xs px-2 py-1 rounded-full group-hover:bg-brand-teal group-hover:text-white transition-colors">3</span>
                            </li>
                            <li class="flex justify-between items-center group cursor-pointer">
                                <span class="group-hover:text-brand-teal transition-colors">Market Trends</span>
                                <span class="bg-gray-100 text-xs px-2 py-1 rounded-full group-hover:bg-brand-teal group-hover:text-white transition-colors">4</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Newsletter Signup -->
                    <div class="bg-brand-blue rounded-3xl p-8 shadow-soft text-white relative overflow-hidden">
                        <!-- Decor -->
                        <div class="absolute top-0 right-0 w-24 h-24 bg-brand-teal opacity-20 rounded-full translate-x-1/2 -translate-y-1/2"></div>
                        
                        <h4 class="font-bold text-xl mb-2 relative z-10">Don't Miss Out!</h4>
                        <p class="text-gray-300 text-sm mb-6 relative z-10">Get fresh recipes and exclusive discount codes delivered to your inbox weekly.</p>
                        
                        <form class="relative z-10 space-y-3">
                            <input type="email" placeholder="Your email address" class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:outline-none focus:border-brand-gold">
                            <button type="button" class="w-full bg-brand-gold text-brand-blue font-bold py-3 rounded-xl hover:bg-white transition-colors">Subscribe</button>
                        </form>
                    </div>

                    <!-- Tags -->
                    <div class="bg-white rounded-3xl p-8 shadow-soft">
                        <h4 class="font-bold text-brand-blue mb-6 text-lg border-b border-gray-100 pb-2">Popular Tags</h4>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 bg-gray-100 rounded-full text-sm text-gray-600 hover:bg-brand-teal hover:text-white cursor-pointer transition-colors">Rice</span>
                            <span class="px-3 py-1 bg-gray-100 rounded-full text-sm text-gray-600 hover:bg-brand-teal hover:text-white cursor-pointer transition-colors">Students</span>
                            <span class="px-3 py-1 bg-gray-100 rounded-full text-sm text-gray-600 hover:bg-brand-teal hover:text-white cursor-pointer transition-colors">Lagos</span>
                            <span class="px-3 py-1 bg-gray-100 rounded-full text-sm text-gray-600 hover:bg-brand-teal hover:text-white cursor-pointer transition-colors">Budget</span>
                            <span class="px-3 py-1 bg-gray-100 rounded-full text-sm text-gray-600 hover:bg-brand-teal hover:text-white cursor-pointer transition-colors">Family</span>
                            <span class="px-3 py-1 bg-gray-100 rounded-full text-sm text-gray-600 hover:bg-brand-teal hover:text-white cursor-pointer transition-colors">Delivery</span>
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
                        <li><a href="#" class="text-white font-bold transition-colors">Blog</a></li>
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
                        <li><a href="foodbox_terms.html" class="hover:text-white transition-colors">Terms of Service</a></li>
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

        // Navbar Scroll Effect
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