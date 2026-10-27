<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subPackage->name }} | FoodBox NG</title>
    <meta name="description" content="{{ $subPackage->short_description ?? $subPackage->description }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
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
                    boxShadow: { soft: '0 10px 40px -10px rgba(0,0,0,0.08)' },
                }
            }
        }
    </script>
    <style>
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #F4F6F8; }
        ::-webkit-scrollbar-thumb { background: #2A9D8F; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #264653; }
        .hero-pattern {
            background-image: radial-gradient(#2A9D8F 1px, transparent 1px);
            background-size: 22px 22px;
            opacity: 0.07;
        }
        .glass {
            background: rgba(255,255,255,0.72);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.5);
        }
        @keyframes fadeUp {
            0% { opacity: 0; transform: translateY(24px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
        .animate-fade-up { animation: fadeUp 0.6s ease both; }
        .animate-fade-in { animation: fadeIn 0.5s ease both; }
        .item-card { animation: fadeUp 0.5s ease both; }
        .item-card:nth-child(1)  { animation-delay:.05s }
        .item-card:nth-child(2)  { animation-delay:.10s }
        .item-card:nth-child(3)  { animation-delay:.15s }
        .item-card:nth-child(4)  { animation-delay:.20s }
        .item-card:nth-child(5)  { animation-delay:.25s }
        .item-card:nth-child(6)  { animation-delay:.30s }
        .item-card:nth-child(7)  { animation-delay:.35s }
        .item-card:nth-child(8)  { animation-delay:.40s }
        .item-card:nth-child(9)  { animation-delay:.45s }
        .item-card:nth-child(10) { animation-delay:.50s }
        @keyframes ping { 75%, 100% { transform: scale(1.5); opacity: 0; } }
        .badge-pulse::after {
            content: '';
            position: absolute; inset: -3px; border-radius: 9999px;
            border: 2px solid currentColor;
            animation: ping 1.5s cubic-bezier(0,0,.2,1) infinite;
            opacity: 0.4;
        }
    </style>
</head>
<body class="bg-brand-grey font-sans text-brand-blue antialiased selection:bg-brand-gold selection:text-brand-blue">

    @include('layouts.navbar')

    <!-- HERO BANNER -->
    <section class="relative pt-32 pb-0 overflow-hidden">
        <div class="absolute inset-0 hero-pattern z-0"></div>
        <div class="absolute top-10 right-0 w-80 h-80 bg-brand-gold/20 rounded-full blur-3xl -z-10"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-brand-teal/10 rounded-full blur-3xl -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <!-- Breadcrumb -->
            <nav class="flex items-center gap-2 text-sm text-gray-400 mb-8 animate-fade-in">
                <a href="{{ route('home') }}" class="hover:text-brand-teal transition-colors">Home</a>
                <i class="fas fa-chevron-right text-xs"></i>
                <a href="{{ route('family_packages') }}" class="hover:text-brand-teal transition-colors">Family Packages</a>
                <i class="fas fa-chevron-right text-xs"></i>
                <span class="text-brand-blue font-semibold truncate max-w-xs">{{ $subPackage->name }}</span>
            </nav>

            <!-- Two-column hero layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-end">

                <!-- Left: Info -->
                <div class="pb-12 animate-fade-up">
                    @if($subPackage->package)
                        <span class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-brand-teal bg-brand-teal/10 px-4 py-1.5 rounded-full mb-5">
                            <i class="fas fa-tag"></i> {{ $subPackage->package->name }}
                        </span>
                    @endif

                    <h1 class="text-4xl lg:text-5xl font-extrabold text-brand-blue leading-tight mb-4">
                        {{ $subPackage->name }}
                    </h1>

                    <p class="text-gray-500 text-lg leading-relaxed mb-8 max-w-lg">
                        {{ $subPackage->description ?? $subPackage->short_description }}
                    </p>

                    <!-- Stats row -->
                    <div class="flex flex-wrap items-center gap-6 mb-8">
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-widest mb-1">Price</p>
                            <p class="text-4xl font-extrabold text-brand-blue">&#8358;{{ number_format($subPackage->price, 0) }}</p>
                        </div>
                        <div class="h-12 w-px bg-gray-200"></div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-widest mb-1">Billing</p>
                            <span class="inline-flex items-center gap-2 bg-brand-gold/20 text-brand-blue font-semibold capitalize px-4 py-1.5 rounded-full text-sm">
                                <i class="fas fa-rotate"></i> {{ $subPackage->billing_cycle }}
                            </span>
                        </div>
                        <div class="h-12 w-px bg-gray-200"></div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-widest mb-1">Items</p>
                            <span class="text-2xl font-extrabold text-brand-teal">{{ $subPackage->items->count() }}</span>
                        </div>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-wrap gap-4">
                        <form action="{{ route('cart.add') }}" method="POST" class="cart-form">
                            @csrf
                            <input type="hidden" name="sub_package_id" value="{{ $subPackage->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="cart-submit-btn inline-flex items-center justify-center gap-3 px-8 py-4 bg-brand-blue text-white font-bold rounded-2xl hover:bg-brand-teal transition-all duration-300 shadow-lg hover:-translate-y-0.5 text-base">
                                <svg class="cart-spinner hidden animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                </svg>
                                <i class="fas fa-cart-plus cart-icon"></i>
                                <span class="cart-btn-text">Add to Cart</span>
                            </button>
                        </form>

                        <a href="{{ route('family_packages') }}"
                           class="inline-flex items-center gap-2 px-8 py-4 border-2 border-brand-blue text-brand-blue font-bold rounded-2xl hover:bg-brand-blue hover:text-white transition-all duration-300 text-base">
                            <i class="fas fa-arrow-left"></i> View All Plans
                        </a>
                    </div>
                </div>

                <!-- Right: Image -->
                <div class="relative flex justify-center lg:justify-end animate-fade-in">
                    <div class="relative w-full max-w-md">
                        <div class="absolute inset-0 rounded-3xl bg-gradient-to-br from-brand-teal/20 to-brand-gold/20 blur-2xl scale-105"></div>
                        <img src="{{ $subPackage->image ? asset('storage/' . $subPackage->image) : 'https://images.unsplash.com/photo-1586201375761-83865001e31c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}"
                             alt="{{ $subPackage->name }}"
                             class="relative w-full h-80 lg:h-96 object-cover rounded-3xl shadow-2xl">
                        <div class="absolute -top-4 -right-4">
                            <span class="relative inline-flex items-center justify-center w-20 h-20 rounded-full bg-brand-gold text-brand-blue font-extrabold text-lg shadow-xl badge-pulse">
                                <span class="text-center leading-tight">
                                    <span class="block text-xs font-semibold">SAVE</span>
                                    <span class="block text-base">20%</span>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ITEMS SECTION -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-14 animate-fade-up">
                <span class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-brand-teal bg-brand-teal/10 px-4 py-1.5 rounded-full mb-4">
                    <i class="fas fa-basket-shopping"></i> What's Inside
                </span>
                <h2 class="text-3xl lg:text-4xl font-extrabold text-brand-blue mt-2">
                    Items Included in This Package
                </h2>
                <p class="text-gray-400 mt-3 max-w-xl mx-auto">
                    Every item is carefully selected and delivered fresh to your doorstep.
                </p>
            </div>

            @if($subPackage->items->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                    @foreach($subPackage->items as $item)
                        <div class="item-card glass rounded-2xl p-5 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-brand-teal/20 to-brand-blue/10 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-leaf text-brand-teal text-lg"></i>
                            </div>
                            <h3 class="font-bold text-brand-blue text-base mb-1 leading-snug">{{ $item->item_name }}</h3>
                            <div class="flex items-center justify-between mt-3">
                                <span class="inline-flex items-center gap-1.5 bg-brand-gold/20 text-brand-blue text-sm font-semibold px-3 py-1 rounded-full">
                                    <i class="fas fa-scale-balanced text-xs"></i>
                                    {{ $item->quantity }} {{ $item->unit }}
                                </span>
                                @if($item->estimated_price)
                                    <span class="text-xs text-gray-400 font-medium">~&#8358;{{ number_format($item->estimated_price, 0) }}</span>
                                @endif
                            </div>
                            <div class="mt-4 h-0.5 w-0 group-hover:w-full bg-gradient-to-r from-brand-teal to-brand-gold rounded-full transition-all duration-500"></div>
                        </div>
                    @endforeach
                </div>

                <!-- Summary bar -->
                <div class="mt-12 glass rounded-2xl p-6 flex flex-wrap items-center justify-between gap-6 shadow-soft animate-fade-up">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-brand-blue flex items-center justify-center shadow-lg">
                            <i class="fas fa-box-open text-white text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-widest">Total Items</p>
                            <p class="text-2xl font-extrabold text-brand-blue">{{ $subPackage->items->count() }} products</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-brand-teal flex items-center justify-center shadow-lg">
                            <i class="fas fa-truck-fast text-white text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-widest">Delivery</p>
                            <p class="text-base font-bold text-brand-blue capitalize">{{ $subPackage->billing_cycle }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-brand-gold flex items-center justify-center shadow-lg">
                            <i class="fas fa-money-bill text-brand-blue text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-widest">Total Price</p>
                            <p class="text-2xl font-extrabold text-brand-blue">&#8358;{{ number_format($subPackage->price, 0) }}</p>
                        </div>
                    </div>
                    <form action="{{ route('cart.add') }}" method="POST" class="cart-form">
                        @csrf
                        <input type="hidden" name="sub_package_id" value="{{ $subPackage->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="cart-submit-btn inline-flex items-center gap-3 px-8 py-4 bg-brand-blue text-white font-bold rounded-2xl hover:bg-brand-teal transition-all duration-300 shadow-lg hover:-translate-y-0.5 whitespace-nowrap">
                            <svg class="cart-spinner hidden animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                            <i class="fas fa-cart-plus cart-icon"></i>
                            <span class="cart-btn-text">Add to Cart</span>
                        </button>
                    </form>
                </div>
            @else
                <div class="text-center py-20">
                    <div class="w-20 h-20 mx-auto rounded-full bg-gray-100 flex items-center justify-center mb-5">
                        <i class="fas fa-box-open text-3xl text-gray-300"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-400">No items listed yet</h3>
                    <p class="text-gray-400 mt-2">Check back soon – this package is being set up.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- WHY CHOOSE US STRIP -->
    <section class="bg-brand-blue py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center text-white">
                <div class="group animate-fade-up">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-white/10 flex items-center justify-center mb-3 group-hover:bg-brand-teal/40 transition-colors">
                        <i class="fas fa-shield-halved text-brand-gold text-lg"></i>
                    </div>
                    <h4 class="font-bold text-sm">Quality Guaranteed</h4>
                    <p class="text-gray-400 text-xs mt-1">Only fresh, premium produce</p>
                </div>
                <div class="group animate-fade-up" style="animation-delay:.1s">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-white/10 flex items-center justify-center mb-3 group-hover:bg-brand-teal/40 transition-colors">
                        <i class="fas fa-truck-fast text-brand-gold text-lg"></i>
                    </div>
                    <h4 class="font-bold text-sm">Fast Delivery</h4>
                    <p class="text-gray-400 text-xs mt-1">Right to your doorstep</p>
                </div>
                <div class="group animate-fade-up" style="animation-delay:.2s">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-white/10 flex items-center justify-center mb-3 group-hover:bg-brand-teal/40 transition-colors">
                        <i class="fas fa-rotate text-brand-gold text-lg"></i>
                    </div>
                    <h4 class="font-bold text-sm">Flexible Billing</h4>
                    <p class="text-gray-400 text-xs mt-1">Pause or cancel anytime</p>
                </div>
                <div class="group animate-fade-up" style="animation-delay:.3s">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-white/10 flex items-center justify-center mb-3 group-hover:bg-brand-teal/40 transition-colors">
                        <i class="fas fa-headset text-brand-gold text-lg"></i>
                    </div>
                    <h4 class="font-bold text-sm">24/7 Support</h4>
                    <p class="text-gray-400 text-xs mt-1">We are always here for you</p>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.footer')

    <script>
        document.querySelectorAll('.cart-form').forEach(function(form) {
            form.addEventListener('submit', function() {
                const btn     = form.querySelector('.cart-submit-btn');
                const spinner = form.querySelector('.cart-spinner');
                const label   = form.querySelector('.cart-btn-text');
                const icon    = form.querySelector('.cart-icon');
                btn.disabled = true;
                spinner.classList.remove('hidden');
                if (icon) icon.classList.add('hidden');
                label.textContent = 'Adding...';
                btn.classList.add('opacity-75', 'cursor-not-allowed');
            });
        });

        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (!navbar) return;
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