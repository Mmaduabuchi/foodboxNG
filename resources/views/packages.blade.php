<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packages | FoodBox NG</title>
    
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
            <span class="text-brand-teal font-bold tracking-wider uppercase text-sm mb-4 block">Our Offerings</span>
            <h1 class="text-4xl md:text-6xl font-bold text-brand-blue mb-6">Choose Your Box</h1>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto leading-relaxed mb-8">
                From student survival kits to jumbo family baskets, we have a curated package for every budget and household size.
            </p>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-5xl mx-auto mt-10">

                <div class="bg-white rounded-2xl shadow-soft p-5 text-center border border-gray-100">
                    <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-brand-teal/10 flex items-center justify-center">
                        <i class="fas fa-box-open text-brand-teal text-xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-brand-blue">3</h3>
                    <p class="text-sm text-gray-500">Package Categories</p>
                </div>

                <div class="bg-white rounded-2xl shadow-soft p-5 text-center border border-gray-100">
                    <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-brand-gold/20 flex items-center justify-center">
                        <i class="fas fa-shopping-basket text-brand-gold text-xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-brand-blue">20+</h3>
                    <p class="text-sm text-gray-500">Curated Packages</p>
                </div>

                <div class="bg-white rounded-2xl shadow-soft p-5 text-center border border-gray-100">
                    <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-brand-orange/20 flex items-center justify-center">
                        <i class="fas fa-tags text-brand-orange text-xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-brand-blue">₦10,000</h3>
                    <p class="text-sm text-gray-500">Starting Price</p>
                </div>

                <div class="bg-white rounded-2xl shadow-soft p-5 text-center border border-gray-100">
                    <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-brand-blue/10 flex items-center justify-center">
                        <i class="fas fa-truck text-brand-blue text-xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-brand-blue">Abuja</h3>
                    <p class="text-sm text-gray-500">Doorstep Delivery</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Filter Tabs -->
    <section class="sticky top-[88px] z-30 bg-brand-grey/95 backdrop-blur-sm py-4 border-y border-gray-200">
        <div class="container mx-auto px-6">
            <div class="flex overflow-x-auto gap-4 md:justify-center pb-2 md:pb-0 no-scrollbar" id="filterTabs">
                <button class="px-6 py-2 rounded-full bg-brand-teal text-white font-bold shadow-lg shadow-brand-teal/20 whitespace-nowrap active-tab">All Packages</button>
                <a href="{{ route('student_packages') }}">
                    <button class="px-6 py-2 rounded-full bg-white text-gray-600 hover:bg-brand-teal/10 font-medium border border-gray-200 whitespace-nowrap transition-colors">Students</button>
                </a>
                <a href="{{ route('family_packages') }}">
                    <button class="px-6 py-2 rounded-full bg-white text-gray-600 hover:bg-brand-teal/10 font-medium border border-gray-200 whitespace-nowrap transition-colors">Families</button>
                </a>
                <a href="{{ route('bachelor_packages') }}">
                    <button class="px-6 py-2 rounded-full bg-white text-gray-600 hover:bg-brand-teal/10 font-medium border border-gray-200 whitespace-nowrap transition-colors">Bachelor Only</button>
                </a>
            </div>
        </div>
    </section>

    <!-- Packages Grid -->
    <section class="py-16 bg-brand-grey">
        <div class="container mx-auto px-6">
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

    <!-- Build Your Own Banner -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="bg-brand-blue rounded-[3rem] p-10 md:p-16 relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-10">
                
                <!-- Decor -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-brand-teal opacity-10 rounded-full translate-x-1/3 -translate-y-1/3"></div>
                <div class="absolute bottom-0 left-0 w-40 h-40 bg-brand-gold opacity-10 rounded-full -translate-x-1/3 translate-y-1/3"></div>

                <div class="relative z-10 max-w-2xl">
                    <span class="text-brand-gold font-bold tracking-wider text-sm uppercase mb-2 block">Want something specific?</span>
                    <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">Build Your Custom Box</h2>
                    <p class="text-gray-300 text-lg leading-relaxed">
                        Don't see exactly what you need? Use our "Build Your Own" tool to select individual items—from tubers of yam to bottles of oil—and create a package that fits your specific budget.
                    </p>
                </div>

                <div class="relative z-10">
                    <a href="{{ route('coming_soon') }}">
                        <button class="bg-brand-gold text-brand-blue px-10 py-5 rounded-full font-bold text-lg hover:bg-white transition-all shadow-xl transform hover:scale-105">
                            Start Building Now
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Guarantee -->
    <section class="py-16 bg-brand-grey border-t border-gray-200">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-8 text-center">
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-brand-teal shadow-sm mb-4">
                        <i class="fas fa-shipping-fast text-lg"></i>
                    </div>
                    <h4 class="font-bold text-brand-blue mb-2">Fast Delivery</h4>
                    <p class="text-sm text-gray-500">Abuja orders delivered within 24 hours.</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-brand-teal shadow-sm mb-4">
                        <i class="fas fa-shield-alt text-lg"></i>
                    </div>
                    <h4 class="font-bold text-brand-blue mb-2">Secure Payments</h4>
                    <p class="text-sm text-gray-500">Pay securely online.</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-brand-teal shadow-sm mb-4">
                        <i class="fas fa-undo text-lg"></i>
                    </div>
                    <h4 class="font-bold text-brand-blue mb-2">Easy Returns</h4>
                    <p class="text-sm text-gray-500">Not fresh? We'll replace it instantly.</p>
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

        // Simple Tab Highlighting (Visual only for this demo)
        const tabs = document.querySelectorAll('#filterTabs button');
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => {
                    t.classList.remove('bg-brand-teal', 'text-white', 'shadow-lg');
                    t.classList.add('bg-white', 'text-gray-600');
                });
                tab.classList.remove('bg-white', 'text-gray-600');
                tab.classList.add('bg-brand-teal', 'text-white', 'shadow-lg');
            });
        });
    </script>
</body>
</html>