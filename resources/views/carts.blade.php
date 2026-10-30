<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FoodBox NG | Your Cart</title>

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
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #F4F6F8; }
        ::-webkit-scrollbar-thumb { background: #2A9D8F; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #264653; }

        /* Animated cart item removal */
        .cart-item { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
        .cart-item.removing {
            opacity: 0;
            transform: translateX(40px);
            max-height: 0;
            overflow: hidden;
        }

        /* Pulse animation for total */
        @keyframes pulse-soft {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.03); }
        }
        .price-pulse { animation: pulse-soft 0.3s ease; }

        /* Step indicator */
        .step-active .step-dot { background: #2A9D8F; color: white; }
        .step-done   .step-dot { background: #2A9D8F; color: white; }
        .step-inactive .step-dot { background: #E5E7EB; color: #9CA3AF; }
        .step-line-done { background: #2A9D8F; }
        .step-line-inactive { background: #E5E7EB; }

        /* Promo input focus ring */
        #promoInput:focus { outline: none; border-color: #2A9D8F; box-shadow: 0 0 0 3px rgba(42, 157, 143, 0.15); }

        /* Empty cart bounce */
        @keyframes bounce-gentle {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
        .cart-icon-empty { animation: bounce-gentle 2s ease-in-out infinite; }
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
                <span class="text-brand-blue font-semibold">My Cart</span>
            </nav>
        </div>
    </div>

    <!-- CHECKOUT PROGRESS STEPS -->
    <div class="bg-white border-b border-gray-100 py-5">
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-center max-w-lg mx-auto">
                <!-- Step 1 -->
                <div class="flex flex-col items-center step-active">
                    <div class="step-dot w-9 h-9 rounded-full flex items-center justify-center font-bold text-sm shadow-md transition-all">1</div>
                    <span class="text-xs font-bold text-brand-teal mt-1.5">Cart</span>
                </div>
                <!-- Line -->
                <div class="flex-1 h-1 mx-2 rounded-full step-line-inactive"></div>
                <!-- Step 2 -->
                <div class="flex flex-col items-center step-inactive">
                    <div class="step-dot w-9 h-9 rounded-full flex items-center justify-center font-bold text-sm transition-all">2</div>
                    <span class="text-xs font-medium text-gray-400 mt-1.5">Delivery</span>
                </div>
                <!-- Line -->
                <div class="flex-1 h-1 mx-2 rounded-full step-line-inactive"></div>
                <!-- Step 3 -->
                <div class="flex flex-col items-center step-inactive">
                    <div class="step-dot w-9 h-9 rounded-full flex items-center justify-center font-bold text-sm transition-all">3</div>
                    <span class="text-xs font-medium text-gray-400 mt-1.5">Payment</span>
                </div>
                <!-- Line -->
                <div class="flex-1 h-1 mx-2 rounded-full step-line-inactive"></div>
                <!-- Step 4 -->
                <div class="flex flex-col items-center step-inactive">
                    <div class="step-dot w-9 h-9 rounded-full flex items-center justify-center font-bold text-sm transition-all">4</div>
                    <span class="text-xs font-medium text-gray-400 mt-1.5">Done</span>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN CART CONTENT -->
    <section class="py-12">
        <div class="container mx-auto px-6">

            <div class="flex items-center gap-3 mb-8">
                <h1 class="text-3xl font-bold text-brand-blue">My Cart</h1>
                <span id="cartBadge" class="bg-brand-teal text-white text-sm font-bold px-3 py-1 rounded-full">
                    {{ $itemCount }} {{ Str::plural('item', $itemCount) }}
                </span>
            </div>

            <!-- CART ITEMS + SUMMARY GRID -->
            <div id="cartMainContent" class="flex flex-col lg:flex-row gap-8 items-start {{ $cart->items->isEmpty() ? 'hidden' : '' }}">

                <!-- LEFT: Cart Items -->
                <div class="flex-1 space-y-4" id="cartItemsList">
                    @forelse($cart->items as $item)
                        <div class="cart-item bg-white rounded-3xl p-5 shadow-soft border border-gray-100 flex gap-5 items-start" 
                             data-id="{{ $item->id }}" 
                             data-price="{{ (float) $item->unit_price }}">
                            
                            <a href="{{ route('subpackage.detail', $item->subPackage->slug) }}" class="w-24 h-24 rounded-2xl overflow-hidden flex-shrink-0 border-2 border-gray-100 group block">
                                <img src="{{ $item->subPackage && $item->subPackage->image ? asset('storage/' . $item->subPackage->image) : 'https://images.unsplash.com/photo-1586201375761-83865001e31c?auto=format&fit=crop&w=200&q=80' }}"
                                     alt="{{ $item->subPackage->name ?? 'Package Item' }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </a>

                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-3">
                                    <div>
                                        @if($item->subPackage && $item->subPackage->package)
                                            <span class="inline-block text-xs font-bold text-brand-teal bg-brand-teal/10 px-2.5 py-0.5 rounded-full mb-1">
                                                📦 {{ $item->subPackage->package->name }}
                                            </span>
                                        @endif
                                        <a href="{{ route('subpackage.detail', $item->subPackage->slug) }}" class="hover:text-brand-teal transition-colors block">
                                            <h3 class="font-bold text-brand-blue text-lg leading-tight">{{ $item->subPackage->name ?? 'Package Item' }}</h3>
                                        </a>
                                        <p class="text-sm text-gray-400 mt-0.5">
                                            @if($item->subPackage)
                                                {{ $item->subPackage->items->count() }} items · {{ ucfirst($item->subPackage->billing_cycle ?? 'Monthly') }} · Free Delivery
                                            @endif
                                        </p>
                                    </div>
                                    <button type="button" onclick="removeItem(this, {{ $item->id }})" class="w-9 h-9 flex-shrink-0 rounded-xl border-2 border-gray-100 flex items-center justify-center text-gray-300 hover:border-red-300 hover:text-red-400 transition-all duration-200" title="Remove item">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </div>

                                <div class="flex items-center justify-between mt-4 flex-wrap gap-3">
                                    <!-- Qty Controller -->
                                    <div class="flex items-center border-2 border-gray-100 rounded-xl overflow-hidden">
                                        <button type="button" onclick="changeQty(this, -1, {{ $item->id }})" class="qty-btn px-3.5 py-2.5 bg-brand-grey text-brand-blue font-bold hover:bg-brand-teal hover:text-white transition-colors text-sm">
                                            <i class="fas fa-minus text-xs"></i>
                                        </button>
                                        <span class="qty-display px-5 py-2.5 font-bold text-brand-blue border-x-2 border-gray-100 select-none text-sm">{{ $item->quantity }}</span>
                                        <button type="button" onclick="changeQty(this, 1, {{ $item->id }})" class="qty-btn px-3.5 py-2.5 bg-brand-grey text-brand-blue font-bold hover:bg-brand-teal hover:text-white transition-colors text-sm">
                                            <i class="fas fa-plus text-xs"></i>
                                        </button>
                                    </div>
                                    <div class="text-right">
                                        <p class="item-total text-xl font-bold text-brand-blue">₦{{ number_format($item->unit_price * $item->quantity, 0) }}</p>
                                        <p class="text-xs text-gray-400">₦{{ number_format($item->unit_price, 0) }} each</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse

                    <!-- Actions Row -->
                    <div class="flex flex-wrap items-center justify-between gap-4 pt-2">
                        <a href="{{ route('packages') }}" class="flex items-center gap-2 text-brand-teal font-semibold text-sm hover:gap-4 transition-all duration-200">
                            <i class="fas fa-arrow-left text-xs"></i> Continue Shopping
                        </a>
                        <button type="button" onclick="clearCart()" class="flex items-center gap-2 text-gray-400 font-semibold text-sm hover:text-red-400 transition-colors duration-200">
                            <i class="fas fa-trash-alt text-xs"></i> Clear Cart
                        </button>
                    </div>
                </div>

                <!-- RIGHT: Order Summary -->
                <div class="w-full lg:w-96 flex-shrink-0 space-y-5 lg:sticky lg:top-28">

                    <!-- Promo Code Card -->
                    <div class="bg-white rounded-3xl p-6 shadow-soft border border-gray-100">
                        <h3 class="font-bold text-brand-blue text-sm uppercase tracking-wider mb-4 flex items-center gap-2">
                            <i class="fas fa-tag text-brand-teal"></i> Promo Code
                        </h3>
                        <div class="flex gap-2">
                            <input id="promoInput" type="text" placeholder="Enter promo code"
                                   class="flex-1 border-2 border-gray-100 rounded-xl px-4 py-3 text-sm font-medium text-brand-blue placeholder-gray-300 transition-all duration-200">
                            <button onclick="applyPromo()" class="px-5 py-3 bg-brand-blue text-white text-sm font-bold rounded-xl hover:bg-brand-teal transition-colors duration-200 whitespace-nowrap">
                                Apply
                            </button>
                        </div>
                        <p id="promoMsg" class="text-xs mt-2 hidden"></p>
                    </div>

                    <!-- Order Summary Card -->
                    <div class="bg-white rounded-3xl p-6 shadow-soft border border-gray-100">
                        <h3 class="font-bold text-brand-blue text-lg mb-6 flex items-center gap-2">
                            <i class="fas fa-receipt text-brand-teal"></i> Order Summary
                        </h3>

                        <div class="space-y-4">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-500 font-medium">Subtotal (<span id="summaryItemCount">{{ $itemCount }}</span> items)</span>
                                <span id="summarySubtotal" class="font-bold text-brand-blue">₦{{ number_format($subtotal, 0) }}</span>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-500 font-medium">Delivery Fee</span>
                                <span class="font-bold text-brand-teal">Free</span>
                            </div>
                            <div id="discountRow" class="hidden flex justify-between items-center text-sm">
                                <span class="text-gray-500 font-medium flex items-center gap-1"><i class="fas fa-tag text-xs text-brand-teal"></i> Promo Discount</span>
                                <span id="discountAmount" class="font-bold text-green-500">-₦0</span>
                            </div>
                            <div class="border-t-2 border-dashed border-gray-100 pt-4 flex justify-between items-center">
                                <span class="font-bold text-brand-blue text-base">Total</span>
                                <span id="summaryTotal" class="font-bold text-brand-blue text-2xl">₦{{ number_format($subtotal, 0) }}</span>
                            </div>
                        </div>

                        <!-- CTA -->
                        <button onclick="proceedCheckout()" id="checkoutBtn" class="w-full mt-6 py-4 rounded-2xl bg-brand-teal text-white font-bold text-lg shadow-xl shadow-brand-teal/30 hover:bg-brand-blue hover:scale-105 transition-all duration-300 flex items-center justify-center gap-3">
                            <i class="fas fa-lock text-sm"></i>
                            Proceed to Checkout
                        </button>

                        <!-- Trust row -->
                        <div class="flex items-center justify-center gap-5 mt-5">
                            <div class="flex items-center gap-1.5 text-xs text-gray-400 font-medium">
                                <i class="fas fa-shield-alt text-brand-teal"></i> Secure
                            </div>
                            <div class="flex items-center gap-1.5 text-xs text-gray-400 font-medium">
                                <i class="fas fa-undo text-brand-teal"></i> Easy Returns
                            </div>
                            <div class="flex items-center gap-1.5 text-xs text-gray-400 font-medium">
                                <i class="fas fa-truck text-brand-teal"></i> Free Delivery
                            </div>
                        </div>
                    </div>

                    <!-- We Accept -->
                    <div class="bg-white rounded-3xl p-5 shadow-soft border border-gray-100">
                        <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mb-4 text-center">We Accept</p>
                        <div class="flex items-center justify-center gap-4 flex-wrap">
                            <div class="px-4 py-2 bg-brand-grey rounded-xl flex items-center gap-2">
                                <i class="fas fa-mobile-alt text-brand-teal"></i>
                                <span class="text-xs font-bold text-brand-blue">Paystack</span>
                            </div>
                            <div class="px-4 py-2 bg-brand-grey rounded-xl flex items-center gap-2">
                                <i class="fas fa-university text-brand-teal"></i>
                                <span class="text-xs font-bold text-brand-blue">Bank Transfer</span>
                            </div>
                            <div class="px-4 py-2 bg-brand-grey rounded-xl flex items-center gap-2">
                                <i class="fas fa-credit-card text-brand-teal"></i>
                                <span class="text-xs font-bold text-brand-blue">Card</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- EMPTY CART STATE -->
            <div id="emptyCart" class="{{ $cart->items->isEmpty() ? '' : 'hidden' }} py-24 text-center">
                <div class="cart-icon-empty inline-block mb-6">
                    <div class="w-28 h-28 rounded-full bg-brand-teal/10 flex items-center justify-center mx-auto">
                        <i class="fas fa-shopping-cart text-5xl text-brand-teal/30"></i>
                    </div>
                </div>
                <h2 class="text-2xl font-bold text-brand-blue mb-3">Your cart is empty</h2>
                <p class="text-gray-400 mb-8 max-w-sm mx-auto">Looks like you haven't added any food packages yet. Explore our top-rated packs and get the best value!</p>
                <a href="{{ route('packages') }}" class="inline-flex items-center gap-3 px-8 py-4 bg-brand-teal text-white font-bold rounded-2xl shadow-xl shadow-brand-teal/30 hover:bg-brand-blue transition-all duration-300">
                    <i class="fas fa-shopping-bag"></i> Browse Packages
                </a>
            </div>

        </div>
    </section>

    <!-- YOU MIGHT ALSO LIKE -->
    <section id="suggestionsSection" class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-between mb-10">
                <div>
                    <span class="text-brand-teal font-bold tracking-wider text-sm uppercase">Keep Adding</span>
                    <h2 class="text-brand-blue text-2xl font-bold mt-1">You Might Also Like</h2>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                @forelse($relatedSubPackages as $related)
                    <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group flex flex-col">
                        <a href="{{ route('subpackage.detail', $related->slug) }}" class="relative h-44 overflow-hidden block">
                            <img src="{{ $related->image ? asset('storage/' . $related->image) : 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=400&q=80' }}"
                                 alt="{{ $related->name }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @if($related->package)
                                <div class="absolute top-3 right-3 bg-brand-orange text-white text-xs font-bold px-2.5 py-1 rounded-full shadow">
                                    {{ $related->package->name }}
                                </div>
                            @endif
                        </a>
                        <div class="p-5 flex-1 flex flex-col">
                            <a href="{{ route('subpackage.detail', $related->slug) }}">
                                <h3 class="font-bold text-brand-blue text-base hover:text-brand-teal transition-colors line-clamp-1">
                                    {{ $related->name }}
                                </h3>
                            </a>
                            <p class="text-gray-400 text-xs mt-1 mb-3 line-clamp-2">
                                {{ $related->display_description ?: ($related->description ? Str::limit($related->description, 80) : 'Essential food items and staples.') }}
                            </p>
                            <div class="mt-auto flex items-center justify-between pt-3 border-t border-gray-100">
                                <div>
                                    <span class="text-lg font-bold text-brand-blue">₦{{ number_format($related->price, 0) }}</span>
                                    @if($related->billing_cycle)
                                        <span class="text-[10px] text-gray-400 block capitalize">/ {{ $related->billing_cycle }}</span>
                                    @endif
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <a href="{{ route('subpackage.detail', $related->slug) }}" class="p-2 rounded-xl border border-gray-200 text-gray-500 hover:text-brand-teal hover:border-brand-teal text-xs transition-colors" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('cart.add') }}" method="POST" class="cart-form inline">
                                        @csrf
                                        <input type="hidden" name="sub_package_id" value="{{ $related->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="cart-submit-btn px-3.5 py-2 rounded-xl bg-brand-teal text-white text-xs font-bold hover:bg-brand-blue transition-colors flex items-center gap-1.5 shadow-sm">
                                            <svg class="cart-spinner hidden animate-spin h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                            </svg>
                                            <i class="fas fa-cart-plus text-xs cart-btn-icon"></i>
                                            <span class="cart-btn-text">Add</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center text-gray-400 bg-gray-50 rounded-3xl border border-dashed border-gray-200">
                        <i class="fas fa-box-open text-3xl mb-2 text-gray-300"></i>
                        <p class="text-sm font-medium">No additional sub-packages available right now.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- TOAST NOTIFICATION -->
    <div id="cartToast" class="fixed bottom-8 right-8 bg-brand-blue text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-4 translate-y-24 opacity-0 transition-all duration-500 z-50 max-w-xs">
        <div class="w-10 h-10 rounded-xl bg-brand-teal flex items-center justify-center flex-shrink-0">
            <i class="fas fa-check text-white"></i>
        </div>
        <div>
            <p class="font-bold text-sm" id="toastHeaderMsg">Cart</p>
            <p id="toastMsg" class="text-xs text-gray-300">Done!</p>
        </div>
        <button onclick="hideToast()" class="ml-2 text-gray-400 hover:text-white">
            <i class="fas fa-times text-xs"></i>
        </button>
    </div>

    <!-- Footer -->
    @include('layouts.footer')

    <!-- SCRIPTS -->
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



        /* STATE */
        const PROMO_CODES = { 'FOODBOX10': 10, 'STUDENT5': 5 };
        let activePromo = null;

        /* UTILS */
        function formatNaira(n) {
            return '₦' + n.toLocaleString('en-NG');
        }

        function recalc() {
            let subtotal = 0;
            let totalQty = 0;
            document.querySelectorAll('.cart-item:not(.removing)').forEach(item => {
                const unitPrice = parseFloat(item.dataset.price) || 0;
                const qty = parseInt(item.querySelector('.qty-display').textContent) || 0;
                const lineTotal = unitPrice * qty;
                item.querySelector('.item-total').textContent = formatNaira(lineTotal);
                subtotal += lineTotal;
                totalQty += qty;
            });

            let discount = 0;
            if (activePromo) {
                discount = Math.round(subtotal * activePromo / 100);
                document.getElementById('discountRow').classList.remove('hidden');
                document.getElementById('discountAmount').textContent = '-' + formatNaira(discount);
            } else {
                document.getElementById('discountRow').classList.add('hidden');
            }

            const total = subtotal - discount;
            document.getElementById('summarySubtotal').textContent = formatNaira(subtotal);
            document.getElementById('summaryTotal').textContent = formatNaira(total);

            // Animate total
            const totalEl = document.getElementById('summaryTotal');
            totalEl.classList.add('price-pulse');
            setTimeout(() => totalEl.classList.remove('price-pulse'), 300);

            // Update badge & summary counts
            document.getElementById('summaryItemCount').textContent = totalQty;
            document.getElementById('cartBadge').textContent = totalQty + ' item' + (totalQty !== 1 ? 's' : '');

            // Show empty state if needed
            if (totalQty === 0) {
                setTimeout(() => {
                    const main = document.getElementById('cartMainContent');
                    if (main) main.classList.add('hidden');
                    const empty = document.getElementById('emptyCart');
                    if (empty) empty.classList.remove('hidden');
                    const badge = document.getElementById('cartBadge');
                    if (badge) badge.textContent = '0 items';
                }, 300);
            }
        }

        /* QTY CHANGE */
        let qtyTimers = {};
        function changeQty(btn, delta, itemId) {
            const item = btn.closest('.cart-item');
            const display = item.querySelector('.qty-display');
            let qty = parseInt(display.textContent) + delta;
            if (qty < 1) qty = 1;
            if (qty > 99) qty = 99;
            display.textContent = qty;
            recalc();

            if (itemId) {
                clearTimeout(qtyTimers[itemId]);
                qtyTimers[itemId] = setTimeout(() => {
                    fetch(`/cart/item/${itemId}`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ quantity: qty })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            showToast('Cart updated');
                        }
                    })
                    .catch(err => console.error('Error updating cart:', err));
                }, 350);
            }
        }

        /* REMOVE ITEM */
        function removeItem(btn, itemId) {
            const item = btn.closest('.cart-item');
            item.classList.add('removing');

            if (itemId) {
                fetch(`/cart/item/${itemId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    showToast('Item removed from cart');
                    item.remove();
                    recalc();
                })
                .catch(err => {
                    console.error('Error removing item:', err);
                    item.remove();
                    recalc();
                });
            } else {
                showToast('Item removed from cart');
                setTimeout(() => {
                    item.remove();
                    recalc();
                }, 400);
            }
        }

        /* CLEAR CART */
        function clearCart() {
            if (!confirm('Are you sure you want to clear your cart?')) return;
            
            fetch('/cart/clear', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                document.querySelectorAll('.cart-item').forEach(item => item.remove());
                showToast('Cart cleared');
                const main = document.getElementById('cartMainContent');
                if (main) main.classList.add('hidden');
                const empty = document.getElementById('emptyCart');
                if (empty) empty.classList.remove('hidden');
                const badge = document.getElementById('cartBadge');
                if (badge) badge.textContent = '0 items';
            })
            .catch(err => {
                console.error('Error clearing cart:', err);
                document.querySelectorAll('.cart-item').forEach(item => item.remove());
                recalc();
            });
        }

        /* PROMO CODE */
        function applyPromo() {
            const code = document.getElementById('promoInput').value.trim().toUpperCase();
            const msg = document.getElementById('promoMsg');
            msg.classList.remove('hidden', 'text-green-500', 'text-red-400');

            if (PROMO_CODES[code]) {
                activePromo = PROMO_CODES[code];
                msg.textContent = `✅ "${code}" applied — ${activePromo}% off your order!`;
                msg.classList.add('text-green-500');
            } else {
                activePromo = null;
                msg.textContent = '❌ Invalid promo code. Try FOODBOX10 or STUDENT5.';
                msg.classList.add('text-red-400');
            }
            msg.classList.remove('hidden');
            recalc();
        }

        /* CHECKOUT */
        // function proceedCheckout() {
        //     const btn = document.getElementById('checkoutBtn');
        //     btn.classList.add('opacity-70', 'cursor-not-allowed');
        //     btn.innerHTML = '<i class="fas fa-spinner fa-spin text-sm"></i> Processing...';
        //     // Redirect after brief delay (replace with actual route)
        //     setTimeout(() => { window.location.href = '/delivery_cart'; }, 1500);
        // }

        function proceedCheckout() {
            const btn = document.getElementById('checkoutBtn');

            if (!btn) return;

            btn.disabled = true;
            btn.classList.add('opacity-70', 'cursor-not-allowed');

            btn.innerHTML = `
                <i class="fas fa-spinner fa-spin text-sm"></i>
                Processing...
            `;

            window.location.href = "{{ route('delivery_cart') }}";
        }

        /* QUICK ADD (suggestions) */
        function quickAddToCart(btn, name) {
            btn.innerHTML = '<i class="fas fa-check text-xs"></i> Added';
            btn.classList.remove('bg-brand-teal');
            btn.classList.add('bg-green-500');
            showToast(name + ' added to cart!');
            setTimeout(() => {
                btn.innerHTML = '<i class="fas fa-cart-plus text-xs"></i> Add';
                btn.classList.add('bg-brand-teal');
                btn.classList.remove('bg-green-500');
            }, 2000);
        }

        /* TOAST */
        let toastTimer;
        function showToast(msg) {
            document.getElementById('toastMsg').textContent = msg;
            const toast = document.getElementById('cartToast');
            toast.classList.remove('translate-y-24', 'opacity-0');
            toast.classList.add('translate-y-0', 'opacity-100');
            clearTimeout(toastTimer);
            toastTimer = setTimeout(hideToast, 3000);
        }
        function hideToast() {
            const toast = document.getElementById('cartToast');
            toast.classList.add('translate-y-24', 'opacity-0');
            toast.classList.remove('translate-y-0', 'opacity-100');
        }

        /* NAVBAR SCROLL */
        window.addEventListener('scroll', function () {
            const navbar = document.getElementById('navbar');
            if (navbar) {
                if (window.scrollY > 50) {
                    navbar.classList.add('shadow-md');
                    navbar.classList.replace('py-4', 'py-2');
                } else {
                    navbar.classList.remove('shadow-md');
                    navbar.classList.replace('py-2', 'py-4');
                }
            }
        });

        // Add to Cart — spinner on submit
        document.querySelectorAll('.cart-form').forEach(function (form) {
            form.addEventListener('submit', function () {
                const btn     = form.querySelector('.cart-submit-btn');
                const spinner = form.querySelector('.cart-spinner');
                const icon    = form.querySelector('.cart-btn-icon');
                const label   = form.querySelector('.cart-btn-text');

                if (btn) {
                    btn.disabled = true;
                    btn.classList.add('opacity-75', 'cursor-not-allowed');
                }
                if (spinner) spinner.classList.remove('hidden');
                if (icon) icon.classList.add('hidden');
                if (label) label.textContent = 'Adding...';
            });
        });

        /* Flash session messages */
        @if(session('success'))
            showToast("{{ session('success') }}");
        @endif
        @if(session('error'))
            showToast("{{ session('error') }}");
        @endif

        /*INIT */
        recalc();
    </script>
</body>
</html>
