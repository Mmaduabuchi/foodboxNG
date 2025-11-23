<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | FoodBox NG</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Tailwind Config (Same as Landing Page) -->
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
            background-image: radial-gradient(#E9C46A 1px, transparent 1px);
            background-size: 30px 30px;
            opacity: 0.15;
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
                    <a href="#" class="text-brand-teal font-bold transition-colors">About Us</a> <!-- Active Page -->
                    <a href="foodbox_landing.html#packages" class="hover:text-brand-teal transition-colors">Packages</a>
                    <a href="foodbox_landing.html#testimonials" class="hover:text-brand-teal transition-colors">Reviews</a>
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
                <a href="#" class="text-brand-teal font-bold" onclick="toggleMenu()">About Us</a>
                <a href="foodbox_landing.html#packages" class="text-gray-600 hover:text-brand-teal" onclick="toggleMenu()">Packages</a>
                <a href="foodbox_landing.html#packages" class="bg-brand-teal text-white text-center py-3 rounded-lg font-bold shadow-md" onclick="toggleMenu()">Get Started</a>
            </div>
        </div>
    </nav>

    <!-- Header / Hero Section -->
    <section class="relative pt-40 pb-20 bg-brand-blue overflow-hidden">
        <div class="absolute inset-0 pattern-grid z-0"></div>
        
        <!-- Decorative Circles -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-brand-teal opacity-10 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-brand-gold opacity-10 rounded-full blur-3xl transform -translate-x-1/2 translate-y-1/2"></div>

        <div class="container mx-auto px-6 relative z-10 text-center">
            <span class="text-brand-gold font-bold tracking-wider uppercase text-sm mb-4 block">Who We Are</span>
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">Feeding the Nation,<br> One Box at a Time.</h1>
            <p class="text-gray-300 text-lg max-w-2xl mx-auto leading-relaxed">
                We are on a mission to simplify food shopping for Nigerians. No more market stress, no more price haggling—just fresh food delivered home.
            </p>
        </div>
    </section>

    <!-- Our Story Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <!-- Image Grid -->
                <div class="lg:w-1/2 grid grid-cols-2 gap-4">
                    <img src="https://images.unsplash.com/photo-1595853035070-59a39fe84de3?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="rounded-2xl shadow-lg w-full h-64 object-cover transform translate-y-8">
                    <img src="https://images.unsplash.com/photo-1609139003551-ee404a8b72af?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="rounded-2xl shadow-lg w-full h-64 object-cover">
                </div>

                <!-- Content -->
                <div class="lg:w-1/2">
                    <h2 class="text-3xl md:text-4xl font-bold text-brand-blue mb-6">It started in a Traffic Jam...</h2>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        In 2021, our founder, Tobi, was stuck in Lagos traffic for 4 hours after a stressful trip to Mile 12 market. The tomatoes were crushed, the oil had spilled, and he was exhausted. He thought, <span class="italic text-brand-blue font-semibold">"There has to be a better way."</span>
                    </p>
                    <p class="text-gray-600 leading-relaxed mb-8">
                        FoodBox NG was born out of that frustration. We realized that while Nigerians love fresh food, the process of getting it is broken. We built a bridge between local farmers and city households, ensuring farmers get fair pay and you get fresh food without the headache.
                    </p>
                    
                    <div class="flex gap-8">
                        <div>
                            <h4 class="text-3xl font-bold text-brand-teal">15k+</h4>
                            <p class="text-sm text-gray-500">Boxes Delivered</p>
                        </div>
                        <div>
                            <h4 class="text-3xl font-bold text-brand-teal">50+</h4>
                            <p class="text-sm text-gray-500">Partner Farms</p>
                        </div>
                        <div>
                            <h4 class="text-3xl font-bold text-brand-teal">5</h4>
                            <p class="text-sm text-gray-500">Cities Covered</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="py-20 bg-brand-grey">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Mission -->
                <div class="bg-white p-10 rounded-3xl shadow-soft border-l-8 border-brand-teal hover:transform hover:-translate-y-1 transition-all">
                    <div class="w-12 h-12 bg-brand-teal/10 text-brand-teal rounded-full flex items-center justify-center text-xl mb-6">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-brand-blue mb-4">Our Mission</h3>
                    <p class="text-gray-600 leading-relaxed">
                        To provide affordable, high-quality food items to every Nigerian household through a seamless, technology-driven supply chain that eliminates waste and empowers local farmers.
                    </p>
                </div>

                <!-- Vision -->
                <div class="bg-white p-10 rounded-3xl shadow-soft border-l-8 border-brand-gold hover:transform hover:-translate-y-1 transition-all">
                    <div class="w-12 h-12 bg-brand-gold/10 text-brand-orange rounded-full flex items-center justify-center text-xl mb-6">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-brand-blue mb-4">Our Vision</h3>
                    <p class="text-gray-600 leading-relaxed">
                        To become the leading food logistics platform in West Africa, ensuring that no family has to worry about the availability or affordability of their next meal.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-brand-blue mb-4">Our Core Values</h2>
                <p class="text-gray-600">The principles that guide every box we pack and every delivery we make.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center p-6 rounded-2xl hover:bg-brand-grey transition-colors">
                    <div class="w-16 h-16 mx-auto bg-green-100 text-green-600 rounded-full flex items-center justify-center text-2xl mb-4">
                        <i class="fas fa-carrot"></i>
                    </div>
                    <h4 class="text-xl font-bold text-brand-blue mb-2">Freshness First</h4>
                    <p class="text-sm text-gray-500">If it's not fresh enough for our own mothers, we don't sell it.</p>
                </div>

                <div class="text-center p-6 rounded-2xl hover:bg-brand-grey transition-colors">
                    <div class="w-16 h-16 mx-auto bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-2xl mb-4">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4 class="text-xl font-bold text-brand-blue mb-2">Community</h4>
                    <p class="text-sm text-gray-500">We build relationships, not just transactions. We care about our customers.</p>
                </div>

                <div class="text-center p-6 rounded-2xl hover:bg-brand-grey transition-colors">
                    <div class="w-16 h-16 mx-auto bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center text-2xl mb-4">
                        <i class="fas fa-check-double"></i>
                    </div>
                    <h4 class="text-xl font-bold text-brand-blue mb-2">Integrity</h4>
                    <p class="text-sm text-gray-500">No hidden fees. What you see on the site is exactly what you get.</p>
                </div>

                <div class="text-center p-6 rounded-2xl hover:bg-brand-grey transition-colors">
                    <div class="w-16 h-16 mx-auto bg-red-100 text-red-600 rounded-full flex items-center justify-center text-2xl mb-4">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h4 class="text-xl font-bold text-brand-blue mb-2">Speed</h4>
                    <p class="text-sm text-gray-500">We value your time. Our logistics are optimized for 24-hour delivery.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Meet The Team -->
    <section class="py-20 bg-brand-grey relative overflow-hidden">
         <!-- Decorative Background -->
         <div class="absolute top-0 left-0 w-full h-full opacity-5 pointer-events-none">
            <i class="fas fa-leaf absolute top-10 left-10 text-6xl rotate-12"></i>
            <i class="fas fa-apple-alt absolute bottom-20 right-20 text-8xl -rotate-12"></i>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-brand-blue mb-4">Meet the Minds</h2>
                <p class="text-gray-600">The team working behind the scenes to keep your kitchen stocked.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Team Member 1 -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-soft group">
                    <div class="h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1531384441138-2736e62e0919?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Tobi" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6 text-center">
                        <h4 class="text-xl font-bold text-brand-blue">Tobi Adebayo</h4>
                        <p class="text-brand-teal font-medium text-sm mb-4">Founder & CEO</p>
                        <div class="flex justify-center gap-3">
                            <a href="#" class="text-gray-400 hover:text-brand-blue"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="text-gray-400 hover:text-brand-blue"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-soft group">
                    <div class="h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Nneka" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6 text-center">
                        <h4 class="text-xl font-bold text-brand-blue">Nneka Obi</h4>
                        <p class="text-brand-teal font-medium text-sm mb-4">Head of Operations</p>
                        <div class="flex justify-center gap-3">
                            <a href="#" class="text-gray-400 hover:text-brand-blue"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="text-gray-400 hover:text-brand-blue"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-soft group">
                    <div class="h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Ahmed" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6 text-center">
                        <h4 class="text-xl font-bold text-brand-blue">Ahmed Musa</h4>
                        <p class="text-brand-teal font-medium text-sm mb-4">Logistics Lead</p>
                        <div class="flex justify-center gap-3">
                            <a href="#" class="text-gray-400 hover:text-brand-blue"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="text-gray-400 hover:text-brand-blue"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Team Member 4 -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-soft group">
                    <div class="h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1589156280159-27698a70f29e?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Zainab" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6 text-center">
                        <h4 class="text-xl font-bold text-brand-blue">Zainab Yusuf</h4>
                        <p class="text-brand-teal font-medium text-sm mb-4">Customer Success</p>
                        <div class="flex justify-center gap-3">
                            <a href="#" class="text-gray-400 hover:text-brand-blue"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="text-gray-400 hover:text-brand-blue"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer (Same as Landing Page) -->
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
                        <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Careers</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h4 class="text-lg font-bold mb-6 text-brand-gold">Support</h4>
                    <ul class="space-y-4 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-white transition-colors">FAQs</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Shipping Policy</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Returns</a></li>
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