<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Returns & Refunds | FoodBox NG</title>
    
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
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #F4F6F8; }
        ::-webkit-scrollbar-thumb { background: #2A9D8F; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #264653; }
        
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
    <section class="relative pt-40 pb-20 bg-white overflow-hidden">
        <div class="absolute inset-0 pattern-grid z-0"></div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <span class="text-brand-teal font-bold tracking-wider uppercase text-sm mb-4 block">Our Promise to You</span>
            <h1 class="text-4xl md:text-6xl font-bold text-brand-blue mb-6">Returns & Refunds</h1>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto leading-relaxed">
                We stand behind every item in your box. If something isn't right — wrong product, damaged packaging, or expired goods — we are committed to making it right, fast.
            </p>
        </div>
    </section>

    <!-- The Guarantee Card -->
    <section class="pb-12 -mt-10 relative z-20">
        <div class="container mx-auto px-6">
            <div class="bg-brand-blue text-white rounded-3xl p-8 md:p-12 shadow-xl max-w-4xl mx-auto flex flex-col md:flex-row items-center gap-8">
                <div class="w-24 h-24 bg-white/10 rounded-full flex items-center justify-center shrink-0">
                    <i class="fas fa-certificate text-4xl text-brand-gold"></i>
                </div>
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold mb-3">The FoodBox NG Quality Guarantee</h2>
                    <p class="text-gray-300 leading-relaxed">
                        Every package we deliver is curated and quality-checked before it leaves our facility. If you receive a damaged, expired, or incorrect item, we will replace it or refund you — no questions asked.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Policy Details -->
    <section class="py-16 bg-brand-grey">
        <div class="container mx-auto px-6 max-w-5xl">
            
            <!-- Section Title -->
            <div class="mb-12">
                <h3 class="text-2xl font-bold text-brand-blue mb-4 border-l-4 border-brand-teal pl-4">Return Windows</h3>
                <p class="text-gray-600">We deal in packaged goods, so returns must be reported promptly. Please adhere to the following timelines:</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 mb-16">

                <!-- Damaged / Incorrect Items -->
                <div class="bg-white p-8 rounded-3xl shadow-soft border-t-4 border-brand-red">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-12 h-12 bg-brand-red/10 rounded-xl flex items-center justify-center text-brand-red">
                            <i class="fas fa-box-open text-xl"></i>
                        </div>
                        <span class="bg-brand-red/10 text-brand-red px-3 py-1 rounded-full text-xs font-bold">Within 24 Hours</span>
                    </div>
                    <h4 class="text-xl font-bold text-brand-blue mb-3">Damaged or Wrong Items</h4>
                    <p class="text-sm text-gray-500 mb-4">Items that arrived broken, tampered with, or are different from what you ordered.</p>
                    <ul class="space-y-2 text-gray-600 text-sm">
                        <li class="flex items-start gap-2"><i class="fas fa-check text-green-500 mt-1"></i> Report items with broken or tampered seals immediately.</li>
                        <li class="flex items-start gap-2"><i class="fas fa-check text-green-500 mt-1"></i> Report wrong products (wrong brand, size, or item) on delivery.</li>
                        <li class="flex items-start gap-2"><i class="fas fa-times text-red-500 mt-1"></i> Reports made after 24 hours of delivery cannot be processed.</li>
                    </ul>
                </div>

                <!-- Expired / Substandard Items -->
                <div class="bg-white p-8 rounded-3xl shadow-soft border-t-4 border-brand-teal">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-12 h-12 bg-brand-teal/10 rounded-xl flex items-center justify-center text-brand-teal">
                            <i class="fas fa-calendar-times text-xl"></i>
                        </div>
                        <span class="bg-brand-teal/10 text-brand-teal px-3 py-1 rounded-full text-xs font-bold">Within 3 Days</span>
                    </div>
                    <h4 class="text-xl font-bold text-brand-blue mb-3">Expired or Substandard Items</h4>
                    <p class="text-sm text-gray-500 mb-4">Sealed goods, canned items, dry foods, toiletries, or household products with quality issues.</p>
                    <ul class="space-y-2 text-gray-600 text-sm">
                        <li class="flex items-start gap-2"><i class="fas fa-check text-green-500 mt-1"></i> Return if item is expired or close to expiry at time of delivery.</li>
                        <li class="flex items-start gap-2"><i class="fas fa-check text-green-500 mt-1"></i> Return if product quality clearly does not meet standard.</li>
                        <li class="flex items-start gap-2"><i class="fas fa-times text-red-500 mt-1"></i> Item must be unopened and in its original packaging to qualify.</li>
                    </ul>
                </div>
            </div>

            <!-- How it Works -->
            <div class="mb-12">
                <h3 class="text-2xl font-bold text-brand-blue mb-4 border-l-4 border-brand-gold pl-4">How to Request a Return</h3>
            </div>

            <div class="grid md:grid-cols-3 gap-8 relative">
                <!-- Connector Line (Desktop) -->
                <div class="hidden md:block absolute top-12 left-0 w-full h-0.5 bg-gray-200 -z-10"></div>

                <!-- Step 1 -->
                <div class="bg-white p-6 rounded-2xl shadow-sm text-center">
                    <div class="w-16 h-16 mx-auto bg-brand-blue text-white rounded-full flex items-center justify-center text-2xl mb-4 font-bold border-4 border-white">1</div>
                    <h5 class="font-bold text-brand-blue mb-2">Snap a Photo</h5>
                    <p class="text-sm text-gray-500">Take a clear photo of the damaged, expired, or incorrect item as soon as you receive your box.</p>
                </div>

                <!-- Step 2 -->
                <div class="bg-white p-6 rounded-2xl shadow-sm text-center">
                    <div class="w-16 h-16 mx-auto bg-brand-blue text-white rounded-full flex items-center justify-center text-2xl mb-4 font-bold border-4 border-white">2</div>
                    <h5 class="font-bold text-brand-blue mb-2">Contact Support</h5>
                    <p class="text-sm text-gray-500">Send the photo via WhatsApp to <strong>+234 800 FOOD BOX</strong> or email <strong>support@foodbox.ng</strong> with your Order ID.</p>
                </div>

                <!-- Step 3 -->
                <div class="bg-white p-6 rounded-2xl shadow-sm text-center">
                    <div class="w-16 h-16 mx-auto bg-brand-blue text-white rounded-full flex items-center justify-center text-2xl mb-4 font-bold border-4 border-white">3</div>
                    <h5 class="font-bold text-brand-blue mb-2">Get Resolved</h5>
                    <p class="text-sm text-gray-500">We will either dispatch a replacement within 48 hours or credit your FoodBox wallet instantly — your choice.</p>
                </div>
            </div>

        </div>
    </section>

    <!-- FAQ Specific to Returns -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6 max-w-3xl">
            <h3 class="text-2xl font-bold text-brand-blue text-center mb-10">Common Returns Questions</h3>

            <div class="space-y-4">
                <!-- FAQ 1 -->
                <div class="border border-gray-200 rounded-2xl overflow-hidden">
                    <button class="w-full flex justify-between items-center p-6 bg-gray-50 hover:bg-brand-teal/5 transition-colors text-left focus:outline-none group" onclick="toggleFAQ(this)">
                        <span class="font-bold text-brand-blue text-sm md:text-base">Do I have to pay for delivery of the replacement?</span>
                        <i class="fas fa-chevron-down text-gray-400 transition-transform group-hover:text-brand-teal"></i>
                    </button>
                    <div class="hidden p-6 pt-0 text-gray-600 text-sm leading-relaxed bg-gray-50">
                        No. If the issue is on our end — wrong item, damaged packaging, or expired product — we cover the full cost of delivering your replacement at no charge to you.
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="border border-gray-200 rounded-2xl overflow-hidden">
                    <button class="w-full flex justify-between items-center p-6 bg-gray-50 hover:bg-brand-teal/5 transition-colors text-left focus:outline-none group" onclick="toggleFAQ(this)">
                        <span class="font-bold text-brand-blue text-sm md:text-base">Can I get a cash refund instead of wallet credit?</span>
                        <i class="fas fa-chevron-down text-gray-400 transition-transform group-hover:text-brand-teal"></i>
                    </button>
                    <div class="hidden p-6 pt-0 text-gray-600 text-sm leading-relaxed bg-gray-50">
                        Yes. Wallet credits are processed instantly, while bank transfer refunds are completed within 5–7 business days depending on your bank.
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="border border-gray-200 rounded-2xl overflow-hidden">
                    <button class="w-full flex justify-between items-center p-6 bg-gray-50 hover:bg-brand-teal/5 transition-colors text-left focus:outline-none group" onclick="toggleFAQ(this)">
                        <span class="font-bold text-brand-blue text-sm md:text-base">I changed my mind about an item. Can I return it?</span>
                        <i class="fas fa-chevron-down text-gray-400 transition-transform group-hover:text-brand-teal"></i>
                    </button>
                    <div class="hidden p-6 pt-0 text-gray-600 text-sm leading-relaxed bg-gray-50">
                        Unfortunately, we do not accept returns based on a change of mind once an order has been delivered and accepted. We encourage you to review your selected package carefully before confirming your order at checkout.
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="border border-gray-200 rounded-2xl overflow-hidden">
                    <button class="w-full flex justify-between items-center p-6 bg-gray-50 hover:bg-brand-teal/5 transition-colors text-left focus:outline-none group" onclick="toggleFAQ(this)">
                        <span class="font-bold text-brand-blue text-sm md:text-base">What if only one item in my package is the problem?</span>
                        <i class="fas fa-chevron-down text-gray-400 transition-transform group-hover:text-brand-teal"></i>
                    </button>
                    <div class="hidden p-6 pt-0 text-gray-600 text-sm leading-relaxed bg-gray-50">
                        No need to return the entire box. Just report the specific item with a photo and your Order ID, and we will handle a partial replacement or refund for that item only.
                    </div>
                </div>
            </div>

            <div class="mt-12 text-center">
                <p class="text-gray-500 mb-4">Still have an issue?</p>
                <a href="{{ route('contact_us') }}" class="inline-block bg-brand-teal text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-brand-blue transition-colors">Contact Support</a>
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

        function toggleFAQ(button) {
            const content = button.nextElementSibling;
            const icon = button.querySelector('.fa-chevron-down');
            
            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                content.classList.add('block');
                icon.classList.add('rotate-180');
            } else {
                content.classList.add('hidden');
                content.classList.remove('block');
                icon.classList.remove('rotate-180');
            }
        }

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