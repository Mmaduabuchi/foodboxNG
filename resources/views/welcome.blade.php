<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodBox NG | Fresh Foodstuff Delivered</title>
    
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
        
        .hero-pattern {
            background-image: radial-gradient(#2A9D8F 1px, transparent 1px);
            background-size: 20px 20px;
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
                <a href="#" class="flex items-center gap-2 group">
                    <div class="w-10 h-10 bg-brand-teal rounded-lg flex items-center justify-center text-white shadow-lg group-hover:rotate-3 transition-transform">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <span class="text-2xl font-bold text-brand-blue tracking-tight">FoodBox<span class="text-brand-teal">NG</span></span>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-8 font-medium text-gray-600">
                    <a href="#home" class="hover:text-brand-teal transition-colors">Home</a>
                    <a href="#packages" class="hover:text-brand-teal transition-colors">Packages</a>
                    <a href="#features" class="hover:text-brand-teal transition-colors">Why Us</a>
                    <a href="#testimonials" class="hover:text-brand-teal transition-colors">Reviews</a>
                </div>

                <!-- CTA Button -->
                <div class="hidden md:block">
                    <a href="#packages" class="bg-brand-blue text-white px-6 py-2.5 rounded-full font-semibold hover:bg-brand-teal transition-all shadow-lg shadow-brand-blue/20 hover:shadow-brand-teal/30">
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

    <!-- Hero Section -->
    <section id="home" class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="absolute inset-0 hero-pattern z-0"></div>
        
        <!-- Decorative blobs -->
        <div class="absolute top-20 right-0 w-96 h-96 bg-brand-gold/20 rounded-full blur-3xl -z-10"></div>
        <div class="absolute bottom-0 left-0 w-72 h-72 bg-brand-teal/10 rounded-full blur-3xl -z-10"></div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
                
                <!-- Text Content -->
                <div class="lg:w-1/2 text-center lg:text-left">
                    <div class="inline-block px-4 py-1.5 rounded-full bg-brand-teal/10 text-brand-teal font-semibold text-sm mb-6 border border-brand-teal/20">
                        🇳🇬 #1 Food Subscription in Nigeria
                    </div>
                    <h1 class="text-4xl lg:text-6xl font-bold leading-tight mb-6 text-brand-blue">
                        Market Runs Made <br>
                        <span class="text-brand-teal relative">
                            Simple & Cheap
                            <svg class="absolute w-full h-3 -bottom-1 left-0 text-brand-gold opacity-60" viewBox="0 0 200 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.00025 6.99997C58.5002 2.49997 148.5 -2.5 198 6.99997" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg>
                        </span>
                    </h1>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed max-w-lg mx-auto lg:mx-0">
                        Skip the market stress. Get fresh curated foodstuff packages—rice, beans, oil, and essentials—delivered directly to your doorstep anywhere in Lagos & Abuja.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="#packages" class="bg-brand-teal text-white px-8 py-4 rounded-full font-bold text-lg shadow-xl shadow-brand-teal/30 hover:bg-brand-blue hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2">
                            Browse Packages <i class="fas fa-arrow-right text-sm"></i>
                        </a>
                        <a href="#" class="bg-white text-brand-blue border-2 border-brand-blue/10 px-8 py-4 rounded-full font-bold text-lg hover:border-brand-blue hover:bg-brand-grey transition-all duration-300">
                            How It Works
                        </a>
                    </div>
                    
                    <div class="mt-10 flex items-center justify-center lg:justify-start gap-6 text-gray-500 text-sm font-medium">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-brand-gold"></i> 24h Delivery
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-brand-gold"></i> Pay on Delivery
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-brand-gold"></i> Verified Fresh
                        </div>
                    </div>
                </div>

                <!-- Image Content -->
                <div class="lg:w-1/2 relative">
                    <div class="relative z-10 rounded-3xl overflow-hidden shadow-2xl border-8 border-white transform rotate-2 hover:rotate-0 transition-transform duration-500">
                        <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Food Box Delivery" class="w-full h-[500px] object-cover">
                        
                        <!-- Floating Card -->
                        <div class="absolute bottom-6 left-6 bg-white/95 backdrop-blur p-4 rounded-xl shadow-lg flex items-center gap-4 max-w-xs">
                            <div class="w-12 h-12 bg-brand-gold/20 rounded-full flex items-center justify-center text-brand-orange">
                                <i class="fas fa-truck-fast text-xl"></i>
                            </div>
                            <div>
                                <p class="font-bold text-brand-blue">On the way!</p>
                                <p class="text-xs text-gray-500">Order #2894 arriving in Lekki</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Background graphic elements -->
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-brand-gold rounded-full opacity-20 blur-2xl"></div>
                    <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-brand-blue rounded-full opacity-20 blur-2xl"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Brands/Social Proof -->
    <section class="py-10 border-y border-gray-200 bg-white">
        <div class="container mx-auto px-6">
            <p class="text-center text-gray-400 text-sm font-semibold uppercase tracking-wider mb-6">Trusted by families in</p>
            <div class="flex flex-wrap justify-center gap-8 md:gap-16 opacity-60 grayscale hover:grayscale-0 transition-all duration-500">
                <span class="text-xl font-bold text-gray-600">Lagos</span>
                <span class="text-xl font-bold text-gray-600">Abuja</span>
                <span class="text-xl font-bold text-gray-600">Port Harcourt</span>
                <span class="text-xl font-bold text-gray-600">Ibadan</span>
                <span class="text-xl font-bold text-gray-600">Enugu</span>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section id="features" class="py-20 bg-brand-grey">
        <div class="container mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-brand-blue text-3xl md:text-4xl font-bold mb-4">Why Nigerians Love FoodBox</h2>
                <p class="text-gray-600">We take the hassle out of grocery shopping so you can focus on what really matters.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-3xl shadow-soft hover:-translate-y-2 transition-transform duration-300 group">
                    <div class="w-14 h-14 bg-brand-teal/10 text-brand-teal rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:bg-brand-teal group-hover:text-white transition-colors">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3 class="text-xl font-bold text-brand-blue mb-3">Farm Fresh</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Sourced directly from local farms. No preservatives, just pure natural goodness delivered fresh.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-3xl shadow-soft hover:-translate-y-2 transition-transform duration-300 group">
                    <div class="w-14 h-14 bg-brand-gold/10 text-brand-orange rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:bg-brand-gold group-hover:text-white transition-colors">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <h3 class="text-xl font-bold text-brand-blue mb-3">Affordable</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Cheaper than open market prices. We buy in bulk and pass the savings directly to you.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-3xl shadow-soft hover:-translate-y-2 transition-transform duration-300 group">
                    <div class="w-14 h-14 bg-brand-blue/10 text-brand-blue rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:bg-brand-blue group-hover:text-white transition-colors">
                        <i class="fas fa-motorcycle"></i>
                    </div>
                    <h3 class="text-xl font-bold text-brand-blue mb-3">Fast Delivery</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Order today, receive tomorrow. Our logistics network ensures your pot never runs dry.</p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white p-8 rounded-3xl shadow-soft hover:-translate-y-2 transition-transform duration-300 group">
                    <div class="w-14 h-14 bg-brand-red/10 text-brand-red rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:bg-brand-red group-hover:text-white transition-colors">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3 class="text-xl font-bold text-brand-blue mb-3">Easy Ordering</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Subscribe monthly or buy one-off. Manage your subscription easily from your dashboard.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Packages -->
    <section id="packages" class="py-20 bg-white relative">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
                <div class="max-w-2xl">
                    <span class="text-brand-teal font-bold tracking-wider text-sm uppercase">Our Bestsellers</span>
                    <h2 class="text-brand-blue text-3xl md:text-4xl font-bold mt-2">Curated Packages for You</h2>
                </div>
                <div class="flex gap-2">
                   <!-- Toggle Switch for Monthly/One-time could go here -->
                   <span class="text-sm text-gray-500">Save 10% on monthly subscriptions!</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                
                <!-- Card 1: Student -->
                <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden hover:shadow-2xl transition-all duration-300 group flex flex-col h-full">
                    <div class="relative h-48 overflow-hidden">
                        <div class="absolute top-4 right-4 z-10 bg-brand-gold text-brand-blue text-xs font-bold px-3 py-1 rounded-full">Best Value</div>
                        <img src="https://images.unsplash.com/photo-1603048297172-c92544798d5e?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Student Pack" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <h3 class="text-xl font-bold text-brand-blue">Student Starter</h3>
                        <p class="text-gray-500 text-sm mt-2 mb-4">Perfect for heavy deadlines. Instant food & essentials.</p>
                        
                        <ul class="space-y-2 mb-6 text-sm text-gray-600">
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> 1 Carton Noodles</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> 2kg Garri Ijebu</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> Milk & Sugar Pack</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> 1L Groundnut Oil</li>
                        </ul>

                        <div class="mt-auto pt-4 border-t border-gray-100">
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-gray-400 text-sm">Monthly</span>
                                <span class="text-2xl font-bold text-brand-blue">₦18,500</span>
                            </div>
                            <button class="w-full py-3 rounded-xl border-2 border-brand-blue text-brand-blue font-bold hover:bg-brand-blue hover:text-white transition-colors">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Family Standard (Featured) -->
                <div class="bg-brand-blue rounded-3xl overflow-hidden shadow-2xl hover:-translate-y-2 transition-all duration-300 transform md:-mt-4 md:mb-4 relative flex flex-col h-full">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-brand-gold to-brand-teal"></div>
                    <div class="relative h-48 overflow-hidden">
                         <div class="absolute top-4 left-4 z-10 bg-brand-teal text-white text-xs font-bold px-3 py-1 rounded-full">Most Popular</div>
                        <img src="https://images.unsplash.com/photo-1584263347416-85a696b4eda7?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Family Pack" class="w-full h-full object-cover opacity-90 group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <h3 class="text-xl font-bold text-white">Family Standard</h3>
                        <p class="text-gray-300 text-sm mt-2 mb-4">The monthly staple for a family of 3-4.</p>
                        
                        <ul class="space-y-2 mb-6 text-sm text-gray-300">
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-gold"></i> 25kg Rice (Premium)</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-gold"></i> 5kg Beans (Oloyin)</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-gold"></i> 5L Vegetable Oil</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-gold"></i> 1 Crate of Eggs</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-gold"></i> Spices Combo</li>
                        </ul>

                        <div class="mt-auto pt-4 border-t border-gray-600">
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-gray-300 text-sm">Monthly</span>
                                <span class="text-2xl font-bold text-brand-gold">₦65,000</span>
                            </div>
                            <button class="w-full py-3 rounded-xl bg-brand-gold text-brand-blue font-bold hover:bg-white transition-colors shadow-lg">Subscribe Now</button>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Single Professional -->
                <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden hover:shadow-2xl transition-all duration-300 group flex flex-col h-full">
                    <div class="relative h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1620916297397-a4a5402a3c6c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Single Pack" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <h3 class="text-xl font-bold text-brand-blue">The Bachelor</h3>
                        <p class="text-gray-500 text-sm mt-2 mb-4">Quick meals for the busy working class.</p>
                        
                        <ul class="space-y-2 mb-6 text-sm text-gray-600">
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> 5kg Rice</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> 2kg Semovita</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> 1 Carton Spaghetti</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> Tomato Paste Pack</li>
                        </ul>

                        <div class="mt-auto pt-4 border-t border-gray-100">
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-gray-400 text-sm">Monthly</span>
                                <span class="text-2xl font-bold text-brand-blue">₦32,000</span>
                            </div>
                            <button class="w-full py-3 rounded-xl border-2 border-brand-blue text-brand-blue font-bold hover:bg-brand-blue hover:text-white transition-colors">Add to Cart</button>
                        </div>
                    </div>
                </div>

                 <!-- Card 4: Custom Jumbo -->
                 <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden hover:shadow-2xl transition-all duration-300 group flex flex-col h-full">
                    <div class="relative h-48 overflow-hidden bg-brand-grey flex items-center justify-center">
                         <i class="fas fa-shopping-basket text-6xl text-gray-300 group-hover:text-brand-teal transition-colors"></i>
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <h3 class="text-xl font-bold text-brand-blue">Build Your Own</h3>
                        <p class="text-gray-500 text-sm mt-2 mb-4">Select exactly what you need from our inventory.</p>
                        
                        <ul class="space-y-2 mb-6 text-sm text-gray-600">
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> Full Customization</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> Flexible Quantities</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> Tubers (Yam, Potato)</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> Proteins (Fish, Meat)</li>
                        </ul>

                        <div class="mt-auto pt-4 border-t border-gray-100">
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-gray-400 text-sm">From</span>
                                <span class="text-2xl font-bold text-brand-blue">₦10,000</span>
                            </div>
                            <button class="w-full py-3 rounded-xl border-2 border-brand-teal text-brand-teal font-bold hover:bg-brand-teal hover:text-white transition-colors">Customize</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section id="testimonials" class="py-20 bg-brand-blue text-white overflow-hidden relative">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0">
             <div class="absolute top-10 right-20 text-9xl text-white opacity-5 font-serif">"</div>
             <div class="absolute bottom-10 left-20 text-9xl text-white opacity-5 font-serif">"</div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Happy Customers</h2>
                <p class="text-gray-300">Join 2,000+ Nigerians eating fresh.</p>
            </div>

            <div class="flex flex-col md:flex-row gap-6 overflow-x-auto pb-8 snap-x">
                <!-- Review 1 -->
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-2xl border border-white/10 flex-1 min-w-[300px] snap-center">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 bg-brand-gold rounded-full flex items-center justify-center text-brand-blue font-bold text-xl">C</div>
                        <div>
                            <h4 class="font-bold">Chidinma O.</h4>
                            <div class="text-brand-gold text-xs">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-200 italic">"The Student Pack saved me during exam week! Delivery was surprising fast. I didn't have to go to the market."</p>
                </div>

                <!-- Review 2 -->
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-2xl border border-white/10 flex-1 min-w-[300px] snap-center">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 bg-brand-teal rounded-full flex items-center justify-center text-white font-bold text-xl">T</div>
                        <div>
                            <h4 class="font-bold">Tunde A.</h4>
                            <div class="text-brand-gold text-xs">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-200 italic">"My mum loves the Family Pack. The rice quality is actually premium, not the ones with stones. Highly recommended."</p>
                </div>

                <!-- Review 3 -->
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-2xl border border-white/10 flex-1 min-w-[300px] snap-center">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center text-white font-bold text-xl">F</div>
                        <div>
                            <h4 class="font-bold">Fatima B.</h4>
                            <div class="text-brand-gold text-xs">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-200 italic">"Great service. I use the subscription for my elderly parents in Lagos while I'm in the UK. It's reliable."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="bg-brand-teal rounded-[3rem] p-10 md:p-16 text-center relative overflow-hidden">
                <!-- Circles -->
                <div class="absolute top-0 left-0 w-64 h-64 bg-white opacity-10 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
                <div class="absolute bottom-0 right-0 w-64 h-64 bg-brand-blue opacity-20 rounded-full translate-x-1/2 translate-y-1/2"></div>

                <div class="relative z-10 max-w-2xl mx-auto">
                    <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">Ready to fill your pantry?</h2>
                    <p class="text-white/90 mb-8 text-lg">Stop stressing about market runs. Subscribe today and get your first delivery within 24 hours.</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <button class="bg-white text-brand-teal px-8 py-4 rounded-full font-bold hover:bg-brand-gold hover:text-brand-blue transition-all shadow-xl">Get Started Now</button>
                        <button class="border-2 border-white text-white px-8 py-4 rounded-full font-bold hover:bg-white/10 transition-all">View All Prices</button>
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

    <!-- Interactive Scripts -->
    <script>
        // Mobile Menu Toggle
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