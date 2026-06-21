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
                        <img src="{{ asset('assets/images/food_home.avif') }}" alt="Food Box Delivery" class="w-full h-[500px] object-cover">
                        
                        <!-- Floating Card -->
                        <div class="absolute bottom-6 left-6 bg-white/95 backdrop-blur p-4 rounded-xl shadow-lg flex items-center gap-4 max-w-xs">
                            <div class="w-12 h-12 bg-brand-gold/20 rounded-full flex items-center justify-center text-brand-orange">
                                <i class="fas fa-truck-fast text-xl"></i>
                            </div>
                            <div>
                                <p class="font-bold text-brand-blue">On the way!</p>
                                <p class="text-xs text-gray-500">Order #2894 arriving in Gwarinpa</p>
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
            <p class="text-center text-gray-400 text-sm font-semibold uppercase tracking-wider mb-6">Where We Operate</p>
            <div class="flex flex-wrap justify-center items-center gap-4 md:gap-8">

                <!-- Abuja — Active -->
                <div class="flex items-center gap-2 bg-brand-teal/10 border border-brand-teal text-brand-teal px-5 py-2 rounded-full font-bold text-sm">
                    <span class="w-2 h-2 bg-brand-teal rounded-full animate-pulse"></span>
                    Abuja
                    <span class="text-xs font-medium bg-brand-teal text-white px-2 py-0.5 rounded-full">Active</span>
                </div>

                <!-- Coming Soon States -->
                <div class="flex items-center gap-2 bg-gray-100 text-gray-400 px-5 py-2 rounded-full font-bold text-sm cursor-not-allowed">
                    <span class="w-2 h-2 bg-gray-300 rounded-full"></span>
                    Lagos
                    <span class="text-xs font-medium bg-gray-200 text-gray-400 px-2 py-0.5 rounded-full">Soon</span>
                </div>

                <div class="flex items-center gap-2 bg-gray-100 text-gray-400 px-5 py-2 rounded-full font-bold text-sm cursor-not-allowed">
                    <span class="w-2 h-2 bg-gray-300 rounded-full"></span>
                    Port Harcourt
                    <span class="text-xs font-medium bg-gray-200 text-gray-400 px-2 py-0.5 rounded-full">Soon</span>
                </div>

                <div class="flex items-center gap-2 bg-gray-100 text-gray-400 px-5 py-2 rounded-full font-bold text-sm cursor-not-allowed">
                    <span class="w-2 h-2 bg-gray-300 rounded-full"></span>
                    Anambra
                    <span class="text-xs font-medium bg-gray-200 text-gray-400 px-2 py-0.5 rounded-full">Soon</span>
                </div>

                <div class="flex items-center gap-2 bg-gray-100 text-gray-400 px-5 py-2 rounded-full font-bold text-sm cursor-not-allowed">
                    <span class="w-2 h-2 bg-gray-300 rounded-full"></span>
                    Enugu
                    <span class="text-xs font-medium bg-gray-200 text-gray-400 px-2 py-0.5 rounded-full">Soon</span>
                </div>

            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section id="features" class="py-20 bg-brand-grey">
        <div class="container mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-brand-blue text-3xl md:text-4xl font-bold mb-4">Why Nigerians Love FoodBox</h2>
                <p class="text-gray-600">We take the stress out of restocking your home so you can focus on what really matters.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-3xl shadow-soft hover:-translate-y-2 transition-transform duration-300 group">
                    <div class="w-14 h-14 bg-brand-teal/10 text-brand-teal rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:bg-brand-teal group-hover:text-white transition-colors">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <h3 class="text-xl font-bold text-brand-blue mb-3">Curated Packages</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Choose a package that fits your lifestyle — Student, Bachelor, or Family. Everything you need, nothing you don't.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-3xl shadow-soft hover:-translate-y-2 transition-transform duration-300 group">
                    <div class="w-14 h-14 bg-brand-gold/10 text-brand-orange rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:bg-brand-gold group-hover:text-white transition-colors">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <h3 class="text-xl font-bold text-brand-blue mb-3">Affordable</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Better value than shopping item by item. We buy in bulk and pass the savings directly to you.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-3xl shadow-soft hover:-translate-y-2 transition-transform duration-300 group">
                    <div class="w-14 h-14 bg-brand-blue/10 text-brand-blue rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:bg-brand-blue group-hover:text-white transition-colors">
                        <i class="fas fa-motorcycle"></i>
                    </div>
                    <h3 class="text-xl font-bold text-brand-blue mb-3">Fast Delivery</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Order today, receive tomorrow. Our delivery network ensures your home never runs out of essentials.</p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white p-8 rounded-3xl shadow-soft hover:-translate-y-2 transition-transform duration-300 group">
                    <div class="w-14 h-14 bg-brand-red/10 text-brand-red rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:bg-brand-red group-hover:text-white transition-colors">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3 class="text-xl font-bold text-brand-blue mb-3">Easy Ordering</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Create an account, pick your package, and check out in minutes. Managing your orders is simple from your dashboard.</p>
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
                
                @foreach($packages as $package)
                    @if(strtolower($package->category) == 'family')
                        <!-- Family Standard (Featured) -->
                        <div class="bg-brand-blue rounded-3xl overflow-hidden shadow-2xl hover:-translate-y-2 transition-all duration-300 transform md:-mt-4 md:mb-4 relative flex flex-col h-full">
                            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-brand-gold to-brand-teal"></div>
                            <div class="relative h-48 overflow-hidden">
                                <div class="absolute top-4 left-4 z-10 bg-brand-teal text-white text-xs font-bold px-3 py-1 rounded-full">Most Popular</div>
                                <img src="{{ asset('assets/images/' . $package->image) }}" alt="{{ $package->name }}" class="w-full h-full object-cover opacity-90 group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <div class="p-6 flex-1 flex flex-col">
                                <h3 class="text-xl font-bold text-white">{{ $package->name }}</h3>
                                <p class="text-gray-300 text-sm mt-2 mb-4">{{ $package->description }}</p>
                                
                                <div class="mt-auto pt-4 border-t border-gray-600">
                                    <a href="{{ route('family_packages') }}">
                                        <button class="w-full py-3 rounded-xl bg-brand-gold text-brand-blue font-bold hover:bg-white transition-colors shadow-lg">Explore Packages</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Other Packages -->
                        <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden hover:shadow-2xl transition-all duration-300 group flex flex-col h-full">
                            <div class="relative h-48 overflow-hidden">
                                @if(strtolower($package->category) == 'student')
                                    <div class="absolute top-4 right-4 z-10 bg-brand-gold text-brand-blue text-xs font-bold px-3 py-1 rounded-full">Best Value</div>
                                @endif
                                <img src="{{ asset('assets/images/' . $package->image) }}" alt="{{ $package->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <div class="p-6 flex-1 flex flex-col">
                                <h3 class="text-xl font-bold text-brand-blue">{{ $package->name }}</h3>
                                <p class="text-gray-500 text-sm mt-2 mb-4">{{ $package->description }}</p>

                                <ul class="space-y-2 mb-6 text-sm text-gray-600">
                                    @foreach($package->subPackages as $subPackage)
                                        <li class="flex items-center gap-2">
                                            <i class="fas fa-check text-brand-teal"></i> 
                                            {{ $subPackage->name }}
                                        </li>
                                    @endforeach
                                </ul>
                                
                                <div class="mt-auto pt-4 border-t border-gray-100">
                                    @php
                                        $routeName = strtolower($package->category) . '_packages';
                                    @endphp
                                    <a href="{{ Route::has($routeName) ? route($routeName) : route('coming_soon') }}">
                                        <button class="w-full py-3 rounded-xl border-2 border-brand-blue text-brand-blue font-bold hover:bg-brand-blue hover:text-white transition-colors">Explore Packages</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                 <!-- Card: Custom Jumbo -->
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
                            <a href="{{ route('coming_soon') }}">
                                <button class="w-full py-3 rounded-xl border-2 border-brand-teal text-brand-teal font-bold hover:bg-brand-teal hover:text-white transition-colors">Customize</button>
                            </a>
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