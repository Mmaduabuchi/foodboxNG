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
            
            <!-- Search/Filter Bar -->
            <div class="max-w-lg mx-auto relative">
                <input type="text" placeholder="Search for items (e.g. Rice, Oil)..." class="w-full pl-12 pr-6 py-4 rounded-full border border-gray-200 shadow-lg focus:border-brand-teal focus:ring-2 focus:ring-brand-teal/20 outline-none">
                <i class="fas fa-search absolute left-5 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
        </div>
    </section>

    <!-- Filter Tabs -->
    <section class="sticky top-[88px] z-30 bg-brand-grey/95 backdrop-blur-sm py-4 border-y border-gray-200">
        <div class="container mx-auto px-6">
            <div class="flex overflow-x-auto gap-4 md:justify-center pb-2 md:pb-0 no-scrollbar" id="filterTabs">
                <button class="px-6 py-2 rounded-full bg-brand-teal text-white font-bold shadow-lg shadow-brand-teal/20 whitespace-nowrap active-tab">All Packages</button>
                <button class="px-6 py-2 rounded-full bg-white text-gray-600 hover:bg-brand-teal/10 font-medium border border-gray-200 whitespace-nowrap transition-colors">Students</button>
                <button class="px-6 py-2 rounded-full bg-white text-gray-600 hover:bg-brand-teal/10 font-medium border border-gray-200 whitespace-nowrap transition-colors">Families</button>
                <button class="px-6 py-2 rounded-full bg-white text-gray-600 hover:bg-brand-teal/10 font-medium border border-gray-200 whitespace-nowrap transition-colors">Bulk / Business</button>
                <button class="px-6 py-2 rounded-full bg-white text-gray-600 hover:bg-brand-teal/10 font-medium border border-gray-200 whitespace-nowrap transition-colors">Essentials Only</button>
            </div>
        </div>
    </section>

    <!-- Packages Grid -->
    <section class="py-16 bg-brand-grey">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Package 1: Student Starter -->
                <div class="bg-white rounded-3xl overflow-hidden hover:shadow-soft transition-all duration-300 group flex flex-col h-full border border-gray-100">
                    <div class="relative h-56 overflow-hidden">
                        <div class="absolute top-4 left-4 bg-brand-gold text-brand-blue text-xs font-bold px-3 py-1 rounded-full z-10">Best Seller</div>
                        <img src="https://images.unsplash.com/photo-1603048297172-c92544798d5e?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Student Pack" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-8 flex-1 flex flex-col">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-brand-blue">Student Starter</h3>
                            <span class="bg-blue-50 text-brand-blue text-xs font-bold px-2 py-1 rounded">1-Person</span>
                        </div>
                        <p class="text-gray-500 text-sm mb-6">The ultimate survival kit for students and corps members.</p>
                        
                        <div class="space-y-3 mb-8 flex-1">
                            <div class="flex items-center gap-3 text-sm text-gray-600 border-b border-dashed border-gray-100 pb-2">
                                <i class="fas fa-check-circle text-brand-teal"></i> <span>1 Carton Noodles (Indomie)</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-600 border-b border-dashed border-gray-100 pb-2">
                                <i class="fas fa-check-circle text-brand-teal"></i> <span>2kg Garri Ijebu</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-600 border-b border-dashed border-gray-100 pb-2">
                                <i class="fas fa-check-circle text-brand-teal"></i> <span>Milk & Sugar (500g each)</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-600 border-b border-dashed border-gray-100 pb-2">
                                <i class="fas fa-check-circle text-brand-teal"></i> <span>1L Groundnut Oil</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-600">
                                <i class="fas fa-plus text-gray-400"></i> <span>Tomato Paste Sachets (1 Roll)</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-auto pt-4">
                            <div>
                                <p class="text-xs text-gray-400 font-medium">Price</p>
                                <p class="text-2xl font-bold text-brand-blue">₦18,500</p>
                            </div>
                            <button class="bg-brand-blue text-white px-6 py-3 rounded-xl font-bold hover:bg-brand-teal transition-colors shadow-lg shadow-brand-blue/20">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Package 2: The Bachelor -->
                <div class="bg-white rounded-3xl overflow-hidden hover:shadow-soft transition-all duration-300 group flex flex-col h-full border border-gray-100">
                    <div class="relative h-56 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1620916297397-a4a5402a3c6c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Bachelor Pack" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-8 flex-1 flex flex-col">
                         <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-brand-blue">The Bachelor</h3>
                            <span class="bg-blue-50 text-brand-blue text-xs font-bold px-2 py-1 rounded">1-2 People</span>
                        </div>
                        <p class="text-gray-500 text-sm mb-6">Quick-to-cook meals for the busy working professional.</p>
                        
                        <div class="space-y-3 mb-8 flex-1">
                            <div class="flex items-center gap-3 text-sm text-gray-600 border-b border-dashed border-gray-100 pb-2">
                                <i class="fas fa-check-circle text-brand-teal"></i> <span>5kg Rice (Foreign)</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-600 border-b border-dashed border-gray-100 pb-2">
                                <i class="fas fa-check-circle text-brand-teal"></i> <span>2kg Semovita / Wheat</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-600 border-b border-dashed border-gray-100 pb-2">
                                <i class="fas fa-check-circle text-brand-teal"></i> <span>1 Carton Spaghetti</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-600 border-b border-dashed border-gray-100 pb-2">
                                <i class="fas fa-check-circle text-brand-teal"></i> <span>2L Vegetable Oil</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-600">
                                <i class="fas fa-plus text-gray-400"></i> <span>Cornflakes & Milk</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-auto pt-4">
                            <div>
                                <p class="text-xs text-gray-400 font-medium">Price</p>
                                <p class="text-2xl font-bold text-brand-blue">₦32,000</p>
                            </div>
                            <button class="bg-brand-blue text-white px-6 py-3 rounded-xl font-bold hover:bg-brand-teal transition-colors shadow-lg shadow-brand-blue/20">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Package 3: Family Standard -->
                <div class="bg-white rounded-3xl overflow-hidden hover:shadow-soft transition-all duration-300 group flex flex-col h-full border-2 border-brand-teal shadow-xl shadow-brand-teal/10 relative">
                     <div class="absolute top-0 left-0 w-full h-1 bg-brand-teal"></div>
                    <div class="relative h-56 overflow-hidden">
                        <div class="absolute top-4 left-4 bg-brand-teal text-white text-xs font-bold px-3 py-1 rounded-full z-10">Most Popular</div>
                        <img src="https://images.unsplash.com/photo-1584263347416-85a696b4eda7?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Family Pack" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-8 flex-1 flex flex-col">
                         <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-brand-blue">Family Standard</h3>
                            <span class="bg-teal-50 text-brand-teal text-xs font-bold px-2 py-1 rounded">3-4 People</span>
                        </div>
                        <p class="text-gray-500 text-sm mb-6">The monthly staple box for a standard family home.</p>
                        
                        <div class="space-y-3 mb-8 flex-1">
                            <div class="flex items-center gap-3 text-sm text-gray-600 border-b border-dashed border-gray-100 pb-2">
                                <i class="fas fa-check-circle text-brand-teal"></i> <span>25kg Rice (Premium)</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-600 border-b border-dashed border-gray-100 pb-2">
                                <i class="fas fa-check-circle text-brand-teal"></i> <span>5kg Beans (Oloyin)</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-600 border-b border-dashed border-gray-100 pb-2">
                                <i class="fas fa-check-circle text-brand-teal"></i> <span>5L Vegetable Oil</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-600 border-b border-dashed border-gray-100 pb-2">
                                <i class="fas fa-check-circle text-brand-teal"></i> <span>1 Crate of Eggs</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-600">
                                <i class="fas fa-plus text-gray-400"></i> <span>Spices & Seasoning Box</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-auto pt-4">
                            <div>
                                <p class="text-xs text-gray-400 font-medium">Price</p>
                                <p class="text-2xl font-bold text-brand-blue">₦65,000</p>
                            </div>
                            <button class="bg-brand-teal text-white px-6 py-3 rounded-xl font-bold hover:bg-brand-blue transition-colors shadow-lg shadow-brand-teal/20">
                                Subscribe
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Package 4: Soup Ingredients -->
                <div class="bg-white rounded-3xl overflow-hidden hover:shadow-soft transition-all duration-300 group flex flex-col h-full border border-gray-100">
                    <div class="relative h-56 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Soup Ingredients" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-8 flex-1 flex flex-col">
                         <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-brand-blue">Soup Essentials</h3>
                            <span class="bg-orange-50 text-brand-orange text-xs font-bold px-2 py-1 rounded">Add-on</span>
                        </div>
                        <p class="text-gray-500 text-sm mb-6">Everything you need for a rich pot of soup.</p>
                        
                        <div class="space-y-3 mb-8 flex-1">
                            <div class="flex items-center gap-3 text-sm text-gray-600 border-b border-dashed border-gray-100 pb-2">
                                <i class="fas fa-check-circle text-brand-teal"></i> <span>2kg Egusi / Ogbono</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-600 border-b border-dashed border-gray-100 pb-2">
                                <i class="fas fa-check-circle text-brand-teal"></i> <span>1L Palm Oil</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-600 border-b border-dashed border-gray-100 pb-2">
                                <i class="fas fa-check-circle text-brand-teal"></i> <span>Dry Fish & Crayfish Pack</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-600">
                                <i class="fas fa-plus text-gray-400"></i> <span>Stockfish Pieces</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-auto pt-4">
                            <div>
                                <p class="text-xs text-gray-400 font-medium">Price</p>
                                <p class="text-2xl font-bold text-brand-blue">₦25,000</p>
                            </div>
                            <button class="bg-brand-blue text-white px-6 py-3 rounded-xl font-bold hover:bg-brand-teal transition-colors shadow-lg shadow-brand-blue/20">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Package 5: Mega Jumbo -->
                <div class="bg-white rounded-3xl overflow-hidden hover:shadow-soft transition-all duration-300 group flex flex-col h-full border border-gray-100">
                    <div class="relative h-56 overflow-hidden">
                        <div class="absolute top-4 right-4 bg-brand-blue text-white text-xs font-bold px-3 py-1 rounded-full z-10">Bulk Deal</div>
                        <img src="https://images.unsplash.com/photo-1506484381205-f7945653044d?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Mega Jumbo" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-8 flex-1 flex flex-col">
                         <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-brand-blue">Mega Jumbo</h3>
                            <span class="bg-blue-50 text-brand-blue text-xs font-bold px-2 py-1 rounded">6+ People</span>
                        </div>
                        <p class="text-gray-500 text-sm mb-6">Stock up for a large family or small restaurant.</p>
                        
                        <div class="space-y-3 mb-8 flex-1">
                            <div class="flex items-center gap-3 text-sm text-gray-600 border-b border-dashed border-gray-100 pb-2">
                                <i class="fas fa-check-circle text-brand-teal"></i> <span>50kg Rice (Premium)</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-600 border-b border-dashed border-gray-100 pb-2">
                                <i class="fas fa-check-circle text-brand-teal"></i> <span>10kg Beans + 10kg Garri</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-600 border-b border-dashed border-gray-100 pb-2">
                                <i class="fas fa-check-circle text-brand-teal"></i> <span>10L Vegetable Oil</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-600 border-b border-dashed border-gray-100 pb-2">
                                <i class="fas fa-check-circle text-brand-teal"></i> <span>1 Carton Tomato Paste</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-600">
                                <i class="fas fa-plus text-gray-400"></i> <span>Tubers of Yam (5pcs)</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-auto pt-4">
                            <div>
                                <p class="text-xs text-gray-400 font-medium">Price</p>
                                <p class="text-2xl font-bold text-brand-blue">₦120,000</p>
                            </div>
                            <button class="bg-brand-blue text-white px-6 py-3 rounded-xl font-bold hover:bg-brand-teal transition-colors shadow-lg shadow-brand-blue/20">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Package 6: Breakfast Bundle -->
                <div class="bg-white rounded-3xl overflow-hidden hover:shadow-soft transition-all duration-300 group flex flex-col h-full border border-gray-100">
                    <div class="relative h-56 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1525351484163-7529414395d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Breakfast" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-8 flex-1 flex flex-col">
                         <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-brand-blue">Breakfast Bundle</h3>
                            <span class="bg-blue-50 text-brand-blue text-xs font-bold px-2 py-1 rounded">Kids Love It</span>
                        </div>
                        <p class="text-gray-500 text-sm mb-6">Essentials for a great morning start.</p>
                        
                        <div class="space-y-3 mb-8 flex-1">
                            <div class="flex items-center gap-3 text-sm text-gray-600 border-b border-dashed border-gray-100 pb-2">
                                <i class="fas fa-check-circle text-brand-teal"></i> <span>2 Packs Cornflakes / Oats</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-600 border-b border-dashed border-gray-100 pb-2">
                                <i class="fas fa-check-circle text-brand-teal"></i> <span>1kg Powdered Milk</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-600 border-b border-dashed border-gray-100 pb-2">
                                <i class="fas fa-check-circle text-brand-teal"></i> <span>1kg Milo / Chocolate Drink</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-600">
                                <i class="fas fa-plus text-gray-400"></i> <span>Sugar & Bread Spread</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-auto pt-4">
                            <div>
                                <p class="text-xs text-gray-400 font-medium">Price</p>
                                <p class="text-2xl font-bold text-brand-blue">₦15,000</p>
                            </div>
                            <button class="bg-brand-blue text-white px-6 py-3 rounded-xl font-bold hover:bg-brand-teal transition-colors shadow-lg shadow-brand-blue/20">
                                Add to Cart
                            </button>
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
                    <button class="bg-brand-gold text-brand-blue px-10 py-5 rounded-full font-bold text-lg hover:bg-white transition-all shadow-xl transform hover:scale-105">
                        Start Building Now
                    </button>
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
                    <p class="text-sm text-gray-500">Lagos orders delivered within 24 hours.</p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-brand-teal shadow-sm mb-4">
                        <i class="fas fa-shield-alt text-lg"></i>
                    </div>
                    <h4 class="font-bold text-brand-blue mb-2">Secure Payments</h4>
                    <p class="text-sm text-gray-500">Pay securely online or Pay on Delivery.</p>
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