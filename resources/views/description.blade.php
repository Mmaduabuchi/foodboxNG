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

    <!-- Breadcrumb -->
    <div class="pt-28 pb-4 bg-brand-grey border-b border-gray-200">
        <div class="container mx-auto px-6">
            <nav class="flex items-center gap-2 text-sm text-gray-500">
                <a href="/" class="hover:text-brand-teal transition-colors">Home</a>
                <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                <a href="/students" class="hover:text-brand-teal transition-colors">Packages</a>
                <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                <span class="text-brand-blue font-semibold">Semester Bulk Pack</span>
            </nav>
        </div>
    </div>

    <!-- ===== PRODUCT HERO SECTION ===== -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-14 items-start">

                <!-- LEFT: Image Gallery -->
                <div class="lg:w-5/12 w-full">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white ring-1 ring-gray-100 group" style="height: 440px;">
                        <img id="mainImage"
                            src="https://images.unsplash.com/photo-1586201375761-83865001e31c?auto=format&fit=crop&w=800&q=80"
                            alt="Semester Bulk Pack"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">

                        <!-- Badge -->
                        <div class="absolute top-5 left-5 bg-brand-teal text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-lg flex items-center gap-2">
                            <i class="fas fa-fire-alt"></i> Most Popular
                        </div>
                        <!-- Offer tag -->
                        <div class="absolute top-5 right-5 bg-brand-gold text-brand-blue text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">
                            Save 10%
                        </div>
                    </div>

                    <!-- Thumbnails -->
                    <div class="flex gap-3 mt-4">
                        <button onclick="changeImage(this, 'https://images.unsplash.com/photo-1586201375761-83865001e31c?auto=format&fit=crop&w=800&q=80')"
                            class="thumb-btn flex-1 h-20 rounded-xl overflow-hidden border-2 border-brand-teal ring-2 ring-brand-teal/30">
                            <img src="https://images.unsplash.com/photo-1586201375761-83865001e31c?auto=format&fit=crop&w=200&q=70" class="w-full h-full object-cover" alt="">
                        </button>
                        <button onclick="changeImage(this, 'https://images.unsplash.com/photo-1612929633738-8fe01f7c2725?auto=format&fit=crop&w=800&q=80')"
                            class="thumb-btn flex-1 h-20 rounded-xl overflow-hidden border-2 border-transparent hover:border-brand-teal transition-all">
                            <img src="https://images.unsplash.com/photo-1612929633738-8fe01f7c2725?auto=format&fit=crop&w=200&q=70" class="w-full h-full object-cover" alt="">
                        </button>
                        <button onclick="changeImage(this, 'https://images.unsplash.com/photo-1596450514735-1151fcfa115c?auto=format&fit=crop&w=800&q=80')"
                            class="thumb-btn flex-1 h-20 rounded-xl overflow-hidden border-2 border-transparent hover:border-brand-teal transition-all">
                            <img src="https://images.unsplash.com/photo-1596450514735-1151fcfa115c?auto=format&fit=crop&w=200&q=70" class="w-full h-full object-cover" alt="">
                        </button>
                        <button onclick="changeImage(this, 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=800&q=80')"
                            class="thumb-btn flex-1 h-20 rounded-xl overflow-hidden border-2 border-transparent hover:border-brand-teal transition-all">
                            <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=200&q=70" class="w-full h-full object-cover" alt="">
                        </button>
                    </div>
                </div>

                <!-- RIGHT: Product Info -->
                <div class="lg:w-7/12 w-full">

                    <!-- Category pill -->
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-brand-teal/10 text-brand-teal text-sm font-semibold border border-brand-teal/20 mb-4">
                        🎓 Student Package
                    </div>

                    <h1 class="text-3xl lg:text-4xl font-bold text-brand-blue leading-tight mb-3">
                        Semester Bulk Pack
                    </h1>

                    <!-- Rating Row -->
                    <div class="flex items-center gap-4 mb-5">
                        <div class="flex items-center gap-1 text-brand-gold">
                            <i class="fas fa-star text-sm"></i>
                            <i class="fas fa-star text-sm"></i>
                            <i class="fas fa-star text-sm"></i>
                            <i class="fas fa-star text-sm"></i>
                            <i class="fas fa-star-half-alt text-sm"></i>
                        </div>
                        <span class="text-sm text-gray-500 font-medium">4.8 (234 reviews)</span>
                        <span class="text-sm text-brand-teal font-semibold"><i class="fas fa-check-circle mr-1"></i>In Stock</span>
                    </div>

                    <!-- Description -->
                    <p class="text-gray-600 leading-relaxed mb-6 text-base">
                        The ultimate semester food stash designed for Nigerian university students. Packed with  premium staples including long-grain parboiled rice, oloyin beans, vegetable oil, spaghetti, and assorted canned goods — enough to last you a full semester without a single market run.
                    </p>

                    <!-- Key stats -->
                    <div class="grid grid-cols-3 gap-4 mb-7">
                        <div class="bg-brand-grey rounded-2xl p-4 text-center">
                            <p class="text-2xl font-bold text-brand-teal">14</p>
                            <p class="text-xs text-gray-500 mt-1 font-medium">Items Included</p>
                        </div>
                        <div class="bg-brand-grey rounded-2xl p-4 text-center">
                            <p class="text-2xl font-bold text-brand-teal">~60</p>
                            <p class="text-xs text-gray-500 mt-1 font-medium">Days Supply</p>
                        </div>
                        <div class="bg-brand-grey rounded-2xl p-4 text-center">
                            <p class="text-2xl font-bold text-brand-teal">Free</p>
                            <p class="text-xs text-gray-500 mt-1 font-medium">Delivery</p>
                        </div>
                    </div>

                    <!-- Price Block -->
                    <div class="flex items-end gap-4 mb-7">
                        <div>
                            <p class="text-sm text-gray-400 line-through mb-0.5">₦72,000</p>
                            <p class="text-4xl font-bold text-brand-blue">₦65,000</p>
                            <p class="text-xs text-brand-teal font-semibold mt-1">Monthly subscription · Cancel anytime</p>
                        </div>
                        <span class="mb-2 bg-red-50 text-red-500 text-sm font-bold px-3 py-1 rounded-full border border-red-100">
                            -10% OFF
                        </span>
                    </div>

                    <!-- Divider -->
                    <div class="border-t border-gray-100 mb-6"></div>

                    <!-- Quantity Selector -->
                    <div class="flex items-center gap-6 mb-6">
                        <label class="text-sm font-bold text-gray-600 uppercase tracking-wider">Quantity</label>
                        <div class="flex items-center border-2 border-gray-200 rounded-xl overflow-hidden">
                            <button onclick="decreaseQty()" class="px-4 py-3 bg-brand-grey text-brand-blue font-bold hover:bg-brand-teal hover:text-white transition-colors">
                                <i class="fas fa-minus text-xs"></i>
                            </button>
                            <span id="qtyDisplay" class="px-6 py-3 font-bold text-brand-blue text-lg border-x-2 border-gray-200 select-none">1</span>
                            <button onclick="increaseQty()" class="px-4 py-3 bg-brand-grey text-brand-blue font-bold hover:bg-brand-teal hover:text-white transition-colors">
                                <i class="fas fa-plus text-xs"></i>
                            </button>
                        </div>
                        <span class="text-sm text-gray-400">Max: 5 per order</span>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 mb-7">
                        <button id="addToCartBtn" onclick="addToCart()"
                            class="flex-1 py-4 rounded-2xl bg-brand-teal text-white font-bold text-lg shadow-xl shadow-brand-teal/30 hover:bg-brand-blue hover:scale-105 transition-all duration-300 flex items-center justify-center gap-3">
                            <i class="fas fa-shopping-cart"></i>
                            Add to Cart
                        </button>
                        <button class="flex-1 py-4 rounded-2xl border-2 border-brand-blue text-brand-blue font-bold text-lg hover:bg-brand-blue hover:text-white transition-all duration-300 flex items-center justify-center gap-3">
                            <i class="fas fa-bolt text-brand-gold"></i>
                            Buy Now
                        </button>
                        <button id="wishlistBtn" onclick="toggleWishlist(this)"
                            class="w-14 h-14 rounded-2xl border-2 border-gray-200 flex items-center justify-center text-gray-400 hover:border-red-400 hover:text-red-400 transition-all duration-300 flex-shrink-0">
                            <i class="far fa-heart text-lg"></i>
                        </button>
                    </div>

                    <!-- Trust Badges -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        <div class="flex items-center gap-2 bg-brand-grey rounded-xl px-3 py-2.5">
                            <i class="fas fa-truck text-brand-teal text-sm"></i>
                            <span class="text-xs font-semibold text-gray-600">Free Delivery</span>
                        </div>
                        <div class="flex items-center gap-2 bg-brand-grey rounded-xl px-3 py-2.5">
                            <i class="fas fa-shield-alt text-brand-teal text-sm"></i>
                            <span class="text-xs font-semibold text-gray-600">Secure Order</span>
                        </div>
                        <div class="flex items-center gap-2 bg-brand-grey rounded-xl px-3 py-2.5">
                            <i class="fas fa-undo text-brand-teal text-sm"></i>
                            <span class="text-xs font-semibold text-gray-600">Easy Returns</span>
                        </div>
                        <div class="flex items-center gap-2 bg-brand-grey rounded-xl px-3 py-2.5">
                            <i class="fas fa-headset text-brand-teal text-sm"></i>
                            <span class="text-xs font-semibold text-gray-600">24/7 Support</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== TABS: DETAILS / WHATS INCLUDED / DELIVERY / REVIEWS ===== -->
    <section class="py-16 bg-brand-grey">
        <div class="container mx-auto px-6">

            <!-- Tab Buttons -->
            <div class="flex flex-wrap gap-2 mb-10 bg-white p-2 rounded-2xl shadow-sm border border-gray-100 w-fit">
                <button onclick="switchTab('contents')" id="tab-contents"
                    class="tab-btn px-6 py-3 rounded-xl font-bold text-sm transition-all bg-brand-blue text-white shadow-lg">
                    📦 What's Inside
                </button>
                <button onclick="switchTab('details')" id="tab-details"
                    class="tab-btn px-6 py-3 rounded-xl font-bold text-sm transition-all text-gray-500 hover:text-brand-blue">
                    📋 Details
                </button>
                <button onclick="switchTab('delivery')" id="tab-delivery"
                    class="tab-btn px-6 py-3 rounded-xl font-bold text-sm transition-all text-gray-500 hover:text-brand-blue">
                    🚚 Delivery Info
                </button>
                <button onclick="switchTab('reviews')" id="tab-reviews"
                    class="tab-btn px-6 py-3 rounded-xl font-bold text-sm transition-all text-gray-500 hover:text-brand-blue">
                    ⭐ Reviews
                </button>
            </div>

            <!-- Tab: What's Inside -->
            <div id="panel-contents" class="tab-panel">
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Staples -->
                    <div class="bg-white rounded-3xl p-8 shadow-soft border border-gray-100">
                        <h3 class="text-xl font-bold text-brand-blue mb-6 flex items-center gap-3">
                            <span class="w-9 h-9 rounded-xl bg-brand-teal/10 text-brand-teal flex items-center justify-center"><i class="fas fa-drumstick-bite text-sm"></i></span>
                            Staple Foods
                        </h3>
                        <ul class="space-y-3">
                            <li class="flex items-center justify-between py-3 border-b border-gray-50">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-check-circle text-brand-teal"></i>
                                    <span class="font-medium text-gray-700">Long-Grain Parboiled Rice</span>
                                </div>
                                <span class="text-sm bg-brand-teal/10 text-brand-teal font-bold px-3 py-1 rounded-full">25 kg</span>
                            </li>
                            <li class="flex items-center justify-between py-3 border-b border-gray-50">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-check-circle text-brand-teal"></i>
                                    <span class="font-medium text-gray-700">Oloyin Beans</span>
                                </div>
                                <span class="text-sm bg-brand-teal/10 text-brand-teal font-bold px-3 py-1 rounded-full">5 kg</span>
                            </li>
                            <li class="flex items-center justify-between py-3 border-b border-gray-50">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-check-circle text-brand-teal"></i>
                                    <span class="font-medium text-gray-700">Vegetable Oil</span>
                                </div>
                                <span class="text-sm bg-brand-teal/10 text-brand-teal font-bold px-3 py-1 rounded-full">5 L</span>
                            </li>
                            <li class="flex items-center justify-between py-3 border-b border-gray-50">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-check-circle text-brand-teal"></i>
                                    <span class="font-medium text-gray-700">Spaghetti</span>
                                </div>
                                <span class="text-sm bg-brand-teal/10 text-brand-teal font-bold px-3 py-1 rounded-full">1 Carton</span>
                            </li>
                            <li class="flex items-center justify-between py-3">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-check-circle text-brand-teal"></i>
                                    <span class="font-medium text-gray-700">Garri Ijebu</span>
                                </div>
                                <span class="text-sm bg-brand-teal/10 text-brand-teal font-bold px-3 py-1 rounded-full">5 kg</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Provisions -->
                    <div class="bg-white rounded-3xl p-8 shadow-soft border border-gray-100">
                        <h3 class="text-xl font-bold text-brand-blue mb-6 flex items-center gap-3">
                            <span class="w-9 h-9 rounded-xl bg-brand-gold/20 text-brand-gold flex items-center justify-center"><i class="fas fa-shopping-basket text-sm"></i></span>
                            Provisions & Extras
                        </h3>
                        <ul class="space-y-3">
                            <li class="flex items-center justify-between py-3 border-b border-gray-50">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-check-circle text-brand-gold"></i>
                                    <span class="font-medium text-gray-700">Canned Sardines (Geisha)</span>
                                </div>
                                <span class="text-sm bg-brand-gold/15 text-brand-gold font-bold px-3 py-1 rounded-full">12 tins</span>
                            </li>
                            <li class="flex items-center justify-between py-3 border-b border-gray-50">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-check-circle text-brand-gold"></i>
                                    <span class="font-medium text-gray-700">Tin Tomatoes</span>
                                </div>
                                <span class="text-sm bg-brand-gold/15 text-brand-gold font-bold px-3 py-1 rounded-full">6 tins</span>
                            </li>
                            <li class="flex items-center justify-between py-3 border-b border-gray-50">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-check-circle text-brand-gold"></i>
                                    <span class="font-medium text-gray-700">Indomie Noodles Carton</span>
                                </div>
                                <span class="text-sm bg-brand-gold/15 text-brand-gold font-bold px-3 py-1 rounded-full">1 Carton</span>
                            </li>
                            <li class="flex items-center justify-between py-3 border-b border-gray-50">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-check-circle text-brand-gold"></i>
                                    <span class="font-medium text-gray-700">Peak Milk Tin (400g)</span>
                                </div>
                                <span class="text-sm bg-brand-gold/15 text-brand-gold font-bold px-3 py-1 rounded-full">2 tins</span>
                            </li>
                            <li class="flex items-center justify-between py-3">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-check-circle text-brand-gold"></i>
                                    <span class="font-medium text-gray-700">Sugar (1kg sachet)</span>
                                </div>
                                <span class="text-sm bg-brand-gold/15 text-brand-gold font-bold px-3 py-1 rounded-full">2 sachets</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Tab: Details -->
            <div id="panel-details" class="tab-panel hidden">
                <div class="bg-white rounded-3xl p-8 md:p-12 shadow-soft border border-gray-100 max-w-4xl">
                    <h3 class="text-2xl font-bold text-brand-blue mb-6">About this Package</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        The <strong>Semester Bulk Pack</strong> is thoughtfully curated for Nigerian university students who want to worry less about feeding and focus more on academics. Every item is sourced from trusted local suppliers to ensure top quality and freshness.
                    </p>
                    <p class="text-gray-600 leading-relaxed mb-8">
                        This pack covers your major cooking needs for an entire semester — from daily meals of rice & stew, beans porridge, spaghetti, noodles, to in-between snack provisions. All items are non-perishable, making them perfect for hostel storage.
                    </p>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        <div class="text-center p-4 bg-brand-grey rounded-2xl">
                            <i class="fas fa-weight-hanging text-2xl text-brand-teal mb-2"></i>
                            <p class="font-bold text-brand-blue">~45 kg</p>
                            <p class="text-xs text-gray-500">Total Weight</p>
                        </div>
                        <div class="text-center p-4 bg-brand-grey rounded-2xl">
                            <i class="fas fa-calendar-alt text-2xl text-brand-teal mb-2"></i>
                            <p class="font-bold text-brand-blue">~60 Days</p>
                            <p class="text-xs text-gray-500">Supply Duration</p>
                        </div>
                        <div class="text-center p-4 bg-brand-grey rounded-2xl">
                            <i class="fas fa-box-open text-2xl text-brand-teal mb-2"></i>
                            <p class="font-bold text-brand-blue">14 Items</p>
                            <p class="text-xs text-gray-500">Unique Products</p>
                        </div>
                        <div class="text-center p-4 bg-brand-grey rounded-2xl">
                            <i class="fas fa-users text-2xl text-brand-teal mb-2"></i>
                            <p class="font-bold text-brand-blue">1-3 People</p>
                            <p class="text-xs text-gray-500">Suitable For</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab: Delivery Info -->
            <div id="panel-delivery" class="tab-panel hidden">
                <div class="grid md:grid-cols-3 gap-6 max-w-5xl">
                    <div class="bg-white rounded-3xl p-8 shadow-soft border border-gray-100">
                        <div class="w-14 h-14 rounded-2xl bg-brand-teal/10 text-brand-teal flex items-center justify-center mb-5">
                            <i class="fas fa-truck text-2xl"></i>
                        </div>
                        <h4 class="font-bold text-brand-blue text-lg mb-3">Standard Delivery</h4>
                        <p class="text-gray-500 text-sm leading-relaxed mb-4">Available in all major cities across Nigeria. Delivered within 2–3 business days.</p>
                        <span class="inline-block bg-brand-teal/10 text-brand-teal text-sm font-bold px-4 py-1.5 rounded-full">Free</span>
                    </div>
                    <div class="bg-brand-blue rounded-3xl p-8 shadow-2xl text-white relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-brand-gold to-brand-teal"></div>
                        <div class="w-14 h-14 rounded-2xl bg-white/10 text-brand-gold flex items-center justify-center mb-5">
                            <i class="fas fa-bolt text-2xl"></i>
                        </div>
                        <h4 class="font-bold text-white text-lg mb-3">Express Delivery</h4>
                        <p class="text-gray-300 text-sm leading-relaxed mb-4">Same-day or next-day delivery to select campuses. Order before 12 PM.</p>
                        <span class="inline-block bg-brand-gold text-brand-blue text-sm font-bold px-4 py-1.5 rounded-full">₦1,500</span>
                    </div>
                    <div class="bg-white rounded-3xl p-8 shadow-soft border border-gray-100">
                        <div class="w-14 h-14 rounded-2xl bg-brand-gold/20 text-brand-gold flex items-center justify-center mb-5">
                            <i class="fas fa-map-marker-alt text-2xl"></i>
                        </div>
                        <h4 class="font-bold text-brand-blue text-lg mb-3">Pickup Available</h4>
                        <p class="text-gray-500 text-sm leading-relaxed mb-4">Collect your pack from our nearest dispatch hub. No extra charge.</p>
                        <span class="inline-block bg-brand-gold/20 text-brand-gold text-sm font-bold px-4 py-1.5 rounded-full">Free</span>
                    </div>
                </div>

                <!-- Campus coverage -->
                <div class="mt-8 bg-white rounded-3xl p-8 shadow-soft border border-gray-100 max-w-5xl">
                    <h4 class="font-bold text-brand-blue text-lg mb-5">Campus Coverage</h4>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        @foreach(['University of Ibadan', 'OAU Ile-Ife', 'UNILAG, Lagos', 'ABU Zaria', 'UNIBEN', 'LASU', 'FUTA', 'UNN'] as $campus)
                        <div class="flex items-center gap-2 bg-brand-grey rounded-xl px-4 py-3">
                            <i class="fas fa-university text-brand-teal text-xs"></i>
                            <span class="text-sm font-medium text-gray-600">{{ $campus }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Tab: Reviews -->
            <div id="panel-reviews" class="tab-panel hidden">
                <div class="max-w-4xl">
                    <!-- Summary -->
                    <div class="bg-white rounded-3xl p-8 shadow-soft border border-gray-100 mb-8 flex flex-col md:flex-row items-center gap-8">
                        <div class="text-center">
                            <p class="text-7xl font-bold text-brand-blue">4.8</p>
                            <div class="flex justify-center gap-1 text-brand-gold my-2">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                            </div>
                            <p class="text-sm text-gray-500">234 verified reviews</p>
                        </div>
                        <div class="flex-1 space-y-2 w-full">
                            @foreach([['5 stars', '78%'], ['4 stars', '14%'], ['3 stars', '5%'], ['2 stars', '2%'], ['1 star', '1%']] as $row)
                            <div class="flex items-center gap-3">
                                <span class="text-xs text-gray-500 w-14 text-right">{{ $row[0] }}</span>
                                <div class="flex-1 h-2 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-brand-gold rounded-full" style="width: {{ $row[1] }}"></div>
                                </div>
                                <span class="text-xs font-bold text-gray-500 w-8">{{ $row[1] }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Review Cards -->
                    <div class="space-y-5">
                        @foreach([
                            ['Chukwuemeka A.', 'OAU, 300L Engineering', '5', '2 days ago', 'This pack saved my semester! I ordered once and had food for almost 2 months. Rice quality is 🔥 and the beans were perfectly dried. Delivery was same day at my hostel gate.'],
                            ['Ngozi F.', 'University of Ibadan', '5', '1 week ago', 'Honestly the best value for money. I compared with buying from the market and I saved about ₦15,000. The noodles and sardines alone made it worth every kobo.'],
                            ['Tunde B.', 'UNILAG, 400L Law', '4', '2 weeks ago', 'Great pack overall. Delivery was slightly delayed but customer support was responsive. Would give 5 stars if delivery was faster. The items were all top quality though.']
                        ] as $review)
                        <div class="bg-white rounded-3xl p-7 shadow-soft border border-gray-100">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-brand-teal to-brand-blue flex items-center justify-center text-white font-bold text-lg">
                                        {{ substr($review[0], 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-brand-blue">{{ $review[0] }}</p>
                                        <p class="text-xs text-gray-400">{{ $review[1] }}</p>
                                    </div>
                                </div>
                                <span class="text-xs text-gray-400">{{ $review[3] }}</span>
                            </div>
                            <div class="flex gap-1 text-brand-gold mb-3">
                                @for($i = 0; $i < intval($review[2]); $i++)
                                <i class="fas fa-star text-xs"></i>
                                @endfor
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed">{{ $review[4] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== RELATED PACKAGES ===== -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-between mb-12">
                <div>
                    <span class="text-brand-teal font-bold tracking-wider text-sm uppercase">You May Also Like</span>
                    <h2 class="text-brand-blue text-3xl font-bold mt-2">Similar Packages</h2>
                </div>
                <a href="/students" class="hidden md:flex items-center gap-2 text-brand-teal font-semibold hover:gap-4 transition-all">
                    View All <i class="fas fa-arrow-right text-sm"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Related 1 -->
                <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group flex flex-col">
                    <div class="relative h-52 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1612929633738-8fe01f7c2725?auto=format&fit=crop&w=600&q=80" alt="Student Starter" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 right-4 bg-brand-gold text-brand-blue text-xs font-bold px-3 py-1 rounded-full">Best Value</div>
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <h3 class="font-bold text-brand-blue text-lg">Student Starter Pack</h3>
                        <p class="text-gray-400 text-sm mt-1 mb-4">Quick, affordable essentials for your campus stay.</p>
                        <div class="mt-auto flex items-center justify-between">
                            <span class="text-2xl font-bold text-brand-blue">₦18,500</span>
                            <button class="px-5 py-2.5 rounded-xl bg-brand-teal text-white text-sm font-bold hover:bg-brand-blue transition-colors flex items-center gap-2">
                                <i class="fas fa-cart-plus text-xs"></i> Add
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Related 2 -->
                <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group flex flex-col">
                    <div class="relative h-52 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1596450514735-1151fcfa115c?auto=format&fit=crop&w=600&q=80" alt="Hostel Essentials" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <h3 class="font-bold text-brand-blue text-lg">Hostel Essentials</h3>
                        <p class="text-gray-400 text-sm mt-1 mb-4">Non-perishable daily survival kit for hostel life.</p>
                        <div class="mt-auto flex items-center justify-between">
                            <span class="text-2xl font-bold text-brand-blue">₦32,000</span>
                            <button class="px-5 py-2.5 rounded-xl bg-brand-teal text-white text-sm font-bold hover:bg-brand-blue transition-colors flex items-center gap-2">
                                <i class="fas fa-cart-plus text-xs"></i> Add
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Related 3 -->
                <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group flex flex-col">
                    <div class="relative h-52 overflow-hidden bg-brand-grey flex items-center justify-center">
                        <i class="fas fa-magic text-6xl text-gray-300 group-hover:text-brand-teal transition-colors duration-300"></i>
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <h3 class="font-bold text-brand-blue text-lg">Build Your Own Pack</h3>
                        <p class="text-gray-400 text-sm mt-1 mb-4">Customize your perfect pack — your choices, your way.</p>
                        <div class="mt-auto flex items-center justify-between">
                            <span class="text-2xl font-bold text-brand-blue">From ₦10,000</span>
                            <button class="px-5 py-2.5 rounded-xl border-2 border-brand-blue text-brand-blue text-sm font-bold hover:bg-brand-blue hover:text-white transition-colors">
                                Customize
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cart notification toast -->
    <div id="cartToast" class="fixed bottom-8 right-8 bg-brand-blue text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-4 translate-y-24 opacity-0 transition-all duration-500 z-50 max-w-xs">
        <div class="w-10 h-10 rounded-xl bg-brand-teal flex items-center justify-center flex-shrink-0">
            <i class="fas fa-check text-white"></i>
        </div>
        <div>
            <p class="font-bold text-sm">Added to Cart!</p>
            <p class="text-xs text-gray-300">Semester Bulk Pack</p>
        </div>
        <button onclick="hideToast()" class="ml-2 text-gray-400 hover:text-white"><i class="fas fa-times text-xs"></i></button>
    </div>

    

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

        // ---- Tab Switching ----
        function switchTab(tabName) {
            document.querySelectorAll('.tab-panel').forEach(p => p.classList.add('hidden'));
            document.querySelectorAll('.tab-btn').forEach(b => {
                b.classList.remove('bg-brand-blue', 'text-white', 'shadow-lg');
                b.classList.add('text-gray-500');
            });
            document.getElementById('panel-' + tabName).classList.remove('hidden');
            const activeBtn = document.getElementById('tab-' + tabName);
            activeBtn.classList.add('bg-brand-blue', 'text-white', 'shadow-lg');
            activeBtn.classList.remove('text-gray-500');
        }

        // ---- Quantity Selector ----
        let qty = 1;
        function increaseQty() {
            if (qty < 5) { qty++; document.getElementById('qtyDisplay').textContent = qty; }
        }
        function decreaseQty() {
            if (qty > 1) { qty--; document.getElementById('qtyDisplay').textContent = qty; }
        }

        // ---- Image Gallery ----
        function changeImage(btn, src) {
            document.getElementById('mainImage').src = src;
            document.querySelectorAll('.thumb-btn').forEach(b => {
                b.classList.remove('border-brand-teal', 'ring-2', 'ring-brand-teal/30');
                b.classList.add('border-transparent');
            });
            btn.classList.add('border-brand-teal', 'ring-2', 'ring-brand-teal/30');
            btn.classList.remove('border-transparent');
        }

        // ---- Add to Cart Toast ----
        let toastTimer;
        function addToCart() {
            const toast = document.getElementById('cartToast');
            toast.classList.remove('translate-y-24', 'opacity-0');
            toast.classList.add('translate-y-0', 'opacity-100');
            clearTimeout(toastTimer);
            toastTimer = setTimeout(hideToast, 3500);
        }
        function hideToast() {
            const toast = document.getElementById('cartToast');
            toast.classList.add('translate-y-24', 'opacity-0');
            toast.classList.remove('translate-y-0', 'opacity-100');
        }

        // ---- Wishlist Toggle ----
        function toggleWishlist(btn) {
            const icon = btn.querySelector('i');
            if (icon.classList.contains('far')) {
                icon.classList.replace('far', 'fas');
                btn.classList.add('border-red-400', 'text-red-400');
                btn.classList.remove('border-gray-200', 'text-gray-400');
            } else {
                icon.classList.replace('fas', 'far');
                btn.classList.remove('border-red-400', 'text-red-400');
                btn.classList.add('border-gray-200', 'text-gray-400');
            }
        }
    </script>
</body>
</html>