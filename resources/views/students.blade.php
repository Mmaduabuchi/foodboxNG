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
    @include('layouts.navbar')

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
                        🎓 Built for Nigerian Students
                    </div>
                    <h1 class="text-4xl lg:text-6xl font-bold leading-tight mb-6 text-brand-blue">
                        Feeding Campus Life, <br>
                        <span class="text-brand-teal relative">
                            One Pack at a Time
                            <svg class="absolute w-full h-3 -bottom-1 left-0 text-brand-gold opacity-60" viewBox="0 0 200 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.00025 6.99997C58.5002 2.49997 148.5 -2.5 198 6.99997" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg>
                        </span>
                    </h1>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed max-w-lg mx-auto lg:mx-0">
                        No more expensive market runs or empty hostel shelves. Get curated student food packs — noodles, garri, rice, provisions & more — delivered straight to your campus or hostel.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="#packages" class="bg-brand-teal text-white px-8 py-4 rounded-full font-bold text-lg shadow-xl shadow-brand-teal/30 hover:bg-brand-blue hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2">
                            Shop Student Packs <i class="fas fa-graduation-cap text-sm"></i>
                        </a>
                        <a href="#how-it-works" class="bg-white text-brand-blue border-2 border-brand-blue/10 px-8 py-4 rounded-full font-bold text-lg hover:border-brand-blue hover:bg-brand-grey transition-all duration-300">
                            How It Works
                        </a>
                    </div>
                    
                    <div class="mt-10 flex items-center justify-center lg:justify-start gap-6 text-gray-500 text-sm font-medium">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-brand-gold"></i> Same-Day Delivery
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-brand-gold"></i> Affordable Packs
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-brand-gold"></i> Hostel-Friendly
                        </div>
                    </div>
                </div>

                <!-- Image Content -->
                <div class="lg:w-1/2 relative">
                    <div class="relative z-10 rounded-3xl overflow-hidden shadow-2xl border-8 border-white transform rotate-2 hover:rotate-0 transition-transform duration-500">
                        <img src="{{ asset('assets/images/food_home.avif') }}" alt="Student Food Pack Delivery" class="w-full h-[500px] object-cover">
                        
                        <!-- Floating Card -->
                        <div class="absolute bottom-6 left-6 bg-white/95 backdrop-blur p-4 rounded-xl shadow-lg flex items-center gap-4 max-w-xs">
                            <div class="w-12 h-12 bg-brand-teal/20 rounded-full flex items-center justify-center text-brand-teal">
                                <i class="fas fa-box-open text-xl"></i>
                            </div>
                            <div>
                                <p class="font-bold text-brand-blue">Just Delivered! 🎉</p>
                                <p class="text-xs text-gray-500">Student Pack dropped at Moremi Hall, UI</p>
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

    <!-- Popular Packages -->
    <section id="packages" class="py-20 bg-white relative">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
                <div class="max-w-2xl">
                    <span class="text-brand-teal font-bold tracking-wider text-sm uppercase">Our Students Bestsellers</span>
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
                        <img src="https://images.unsplash.com/photo-1612929633738-8fe01f7c2725?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Student Pack" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
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

                <!-- Card 2: Semester Bulk Pack (Featured) -->
                <div class="bg-brand-blue rounded-3xl overflow-hidden shadow-2xl hover:-translate-y-2 transition-all duration-300 transform md:-mt-4 md:mb-4 relative flex flex-col h-full">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-brand-gold to-brand-teal"></div>
                    <div class="relative h-48 overflow-hidden">
                         <div class="absolute top-4 left-4 z-10 bg-brand-teal text-white text-xs font-bold px-3 py-1 rounded-full">Most Popular</div>
                        <img src="https://images.unsplash.com/photo-1586201375761-83865001e31c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Semester Bulk Pack" class="w-full h-full object-cover opacity-90 group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <h3 class="text-xl font-bold text-white">Semester Bulk Pack</h3>
                        <p class="text-gray-300 text-sm mt-2 mb-4">The perfect bulk stash for the whole semester.</p>
                        
                        <ul class="space-y-2 mb-6 text-sm text-gray-300">
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-gold"></i> 25kg Rice (Premium)</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-gold"></i> 5kg Beans (Oloyin)</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-gold"></i> 5L Vegetable Oil</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-gold"></i> 1 Carton Spaghetti</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-gold"></i> Canned Sardines & Geisha</li>
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

                <!-- Card 3: Hostel Essentials -->
                <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden hover:shadow-2xl transition-all duration-300 group flex flex-col h-full">
                    <div class="relative h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1596450514735-1151fcfa115c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Hostel Pack" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <h3 class="text-xl font-bold text-brand-blue">Hostel Essentials</h3>
                        <p class="text-gray-500 text-sm mt-2 mb-4">Quick and easy non-perishable meals for daily survival.</p>
                        
                        <ul class="space-y-2 mb-6 text-sm text-gray-600">
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> 5kg Rice</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> 2kg Semovita</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> 1/2 Carton Spaghetti</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> Tin Tomatoes Pack</li>
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
                        <h3 class="text-xl font-bold text-brand-blue">Campus Survival Pack</h3>
                        <p class="text-gray-500 text-sm mt-2 mb-4">Quick and easy non-perishable meals for daily survival.</p>
                        
                        <ul class="space-y-2 mb-6 text-sm text-gray-600">
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> 5kg Rice</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> 2kg Semovita</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> 1/2 Carton Spaghetti</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> Tin Tomatoes Pack</li>
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

            </div>
        </div>
    </section>




    <section id="packages" class="py-20 bg-white relative">
        <div class="container mx-auto px-6">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                
                <!-- Card 1: Student -->
                <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden hover:shadow-2xl transition-all duration-300 group flex flex-col h-full">
                    <div class="relative h-48 overflow-hidden">
                        <div class="absolute top-4 right-4 z-10 bg-brand-gold text-brand-blue text-xs font-bold px-3 py-1 rounded-full">Best Value</div>
                        <img src="https://images.unsplash.com/photo-1612929633738-8fe01f7c2725?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Student Pack" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <h3 class="text-xl font-bold text-brand-blue">Campus Survival Pack</h3>
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

                <!-- Card 2: Semester Bulk Pack (Featured) -->
                <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden hover:shadow-2xl transition-all duration-300 group flex flex-col h-full">
                    <div class="relative h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1586201375761-83865001e31c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Semester Bulk Pack" class="w-full h-full object-cover opacity-90 group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <h3 class="text-xl font-bold text-brand-blue">Campus Survival Pack</h3>
                        <p class="text-gray-500 text-sm mt-2 mb-4">The perfect bulk stash for the whole semester.</p>
                        
                        <ul class="space-y-2 mb-6 text-sm text-gray-600">
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> 25kg Rice (Premium)</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> 5kg Beans (Oloyin)</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> 5L Vegetable Oil</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> 1 Carton Spaghetti</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> Canned Sardines & Geisha</li>
                        </ul>

                        <div class="mt-auto pt-4 border-t border-gray-600">
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-gray-300 text-sm">Monthly</span>
                                <span class="text-2xl font-bold text-brand-blue">₦65,000</span>
                            </div>
                            <button class="w-full py-3 rounded-xl border-2 border-brand-blue text-brand-blue font-bold hover:bg-brand-blue hover:text-white transition-colors">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Hostel Essentials -->
                <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden hover:shadow-2xl transition-all duration-300 group flex flex-col h-full">
                    <div class="relative h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1596450514735-1151fcfa115c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Hostel Pack" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <h3 class="text-xl font-bold text-brand-blue">Student Value Bundle</h3>
                        <p class="text-gray-500 text-sm mt-2 mb-4">Quick and easy non-perishable meals for daily survival.</p>
                        
                        <ul class="space-y-2 mb-6 text-sm text-gray-600">
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> 5kg Rice</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> 2kg Semovita</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> 1/2 Carton Spaghetti</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> Tin Tomatoes Pack</li>
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
                        <p class="text-gray-500 text-sm mt-2 mb-4">Select exactly what you need for your hostel stash.</p>
                        
                        <ul class="space-y-2 mb-6 text-sm text-gray-600">
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> Full Customization</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> Flexible Quantities</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> Provisions (Beverages, Cereals)</li>
                            <li class="flex items-center gap-2"><i class="fas fa-check text-brand-teal"></i> Canned Foods (Sardines, Tomatoes)</li>
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

    

    <!-- Footer -->
    @include('layouts.footer')

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