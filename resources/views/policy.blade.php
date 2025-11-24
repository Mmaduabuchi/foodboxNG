<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Policy | FoodBox NG</title>
    
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
    <section class="relative pt-40 pb-20 bg-white overflow-hidden">
        <div class="absolute inset-0 pattern-grid z-0"></div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <span class="text-brand-teal font-bold tracking-wider uppercase text-sm mb-4 block">Logistics & Delivery</span>
            <h1 class="text-4xl md:text-6xl font-bold text-brand-blue mb-6">Shipping Policy</h1>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto leading-relaxed">
                We partner with top logistics providers to ensure your foodstuff arrives fresh and on time. Here is everything you need to know about how we get your box to you.
            </p>
        </div>
    </section>

    <!-- Delivery Zones & Rates -->
    <section class="py-16 bg-brand-grey relative z-20">
        <div class="container mx-auto px-6 max-w-6xl">
            <div class="text-center mb-12">
                <h3 class="text-2xl font-bold text-brand-blue">Where We Deliver</h3>
                <p class="text-gray-600 mt-2">Select your city to see delivery estimates.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                
                <!-- Zone 1: Lagos -->
                <div class="bg-white rounded-3xl shadow-soft overflow-hidden border-t-8 border-brand-teal">
                    <div class="p-8">
                        <div class="flex justify-between items-start mb-4">
                            <h4 class="text-xl font-bold text-brand-blue">Lagos State</h4>
                            <i class="fas fa-city text-brand-teal/20 text-3xl"></i>
                        </div>
                        <p class="text-gray-500 text-sm mb-6">Covering all Island and Mainland axes.</p>
                        
                        <div class="space-y-4">
                            <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                                <span class="text-gray-600 font-medium">Island Delivery</span>
                                <span class="font-bold text-brand-blue">₦1,500</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                                <span class="text-gray-600 font-medium">Mainland Delivery</span>
                                <span class="font-bold text-brand-blue">₦2,000</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 font-medium">Outskirts (Epe/Badagry)</span>
                                <span class="font-bold text-brand-blue">₦3,500</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-brand-teal/10 p-4 text-center text-brand-teal font-bold text-sm">
                        <i class="fas fa-clock mr-2"></i> 24-Hour Delivery
                    </div>
                </div>

                <!-- Zone 2: Abuja -->
                <div class="bg-white rounded-3xl shadow-soft overflow-hidden border-t-8 border-brand-gold">
                    <div class="p-8">
                        <div class="flex justify-between items-start mb-4">
                            <h4 class="text-xl font-bold text-brand-blue">Abuja (FCT)</h4>
                            <i class="fas fa-landmark text-brand-gold/20 text-3xl"></i>
                        </div>
                        <p class="text-gray-500 text-sm mb-6">Central Area and Satellite Towns.</p>
                        
                        <div class="space-y-4">
                            <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                                <span class="text-gray-600 font-medium">Central Business Dist.</span>
                                <span class="font-bold text-brand-blue">₦2,000</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                                <span class="text-gray-600 font-medium">Gwarinpa / Kubwa</span>
                                <span class="font-bold text-brand-blue">₦2,500</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 font-medium">Airport Road</span>
                                <span class="font-bold text-brand-blue">₦3,000</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-brand-gold/20 p-4 text-center text-brand-orange font-bold text-sm">
                        <i class="fas fa-clock mr-2"></i> Next Day Delivery
                    </div>
                </div>

                <!-- Zone 3: Other Cities -->
                <div class="bg-white rounded-3xl shadow-soft overflow-hidden border-t-8 border-brand-blue">
                    <div class="p-8">
                        <div class="flex justify-between items-start mb-4">
                            <h4 class="text-xl font-bold text-brand-blue">Interstate</h4>
                            <i class="fas fa-truck text-brand-blue/20 text-3xl"></i>
                        </div>
                        <p class="text-gray-500 text-sm mb-6">Ibadan, Port Harcourt & Enugu.</p>
                        
                        <div class="space-y-4">
                            <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                                <span class="text-gray-600 font-medium">Ibadan</span>
                                <span class="font-bold text-brand-blue">₦3,000</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                                <span class="text-gray-600 font-medium">Port Harcourt</span>
                                <span class="font-bold text-brand-blue">₦4,500</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 font-medium">Enugu</span>
                                <span class="font-bold text-brand-blue">₦4,500</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-brand-blue/10 p-4 text-center text-brand-blue font-bold text-sm">
                        <i class="fas fa-clock mr-2"></i> 2 - 3 Working Days
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Delivery Timelines & Process -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="flex flex-col md:flex-row items-center gap-12">
                <!-- Visuals -->
                <div class="md:w-1/2">
                    <div class="relative">
                        <!-- Connecting Line -->
                        <div class="absolute left-6 top-6 bottom-6 w-1 bg-gray-100 rounded-full"></div>

                        <!-- Step 1 -->
                        <div class="relative flex gap-6 mb-10">
                            <div class="w-12 h-12 bg-brand-teal text-white rounded-full flex items-center justify-center shrink-0 z-10 shadow-lg border-4 border-white">
                                <i class="fas fa-check"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-brand-blue">Order Confirmation</h4>
                                <p class="text-gray-500 text-sm mt-1">Orders placed before 2 PM are processed the same day. You will receive an email and SMS confirmation.</p>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="relative flex gap-6 mb-10">
                            <div class="w-12 h-12 bg-brand-gold text-white rounded-full flex items-center justify-center shrink-0 z-10 shadow-lg border-4 border-white">
                                <i class="fas fa-box-open"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-brand-blue">Packing & QA</h4>
                                <p class="text-gray-500 text-sm mt-1">Our team selects fresh items from the farm/warehouse. A Quality Assurance check is done before sealing.</p>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="relative flex gap-6 mb-10">
                            <div class="w-12 h-12 bg-brand-blue text-white rounded-full flex items-center justify-center shrink-0 z-10 shadow-lg border-4 border-white">
                                <i class="fas fa-motorcycle"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-brand-blue">Dispatch</h4>
                                <p class="text-gray-500 text-sm mt-1">The rider picks up your box. You receive a tracking link and the rider's phone number.</p>
                            </div>
                        </div>

                         <!-- Step 4 -->
                         <div class="relative flex gap-6">
                            <div class="w-12 h-12 bg-green-500 text-white rounded-full flex items-center justify-center shrink-0 z-10 shadow-lg border-4 border-white">
                                <i class="fas fa-home"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-brand-blue">Delivery</h4>
                                <p class="text-gray-500 text-sm mt-1">The rider arrives at your doorstep. Please ensure someone is available to receive and inspect the items.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Text -->
                <div class="md:w-1/2 bg-brand-grey rounded-3xl p-8 md:p-12">
                    <h3 class="text-2xl font-bold text-brand-blue mb-6">Important Delivery Notes</h3>
                    <ul class="space-y-4 text-gray-600">
                        <li class="flex items-start gap-3">
                            <i class="fas fa-info-circle text-brand-teal mt-1"></i>
                            <span><strong>Availability:</strong> Riders will call 30 minutes before arrival. If you are unavailable, please provide an alternative receiver.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-info-circle text-brand-teal mt-1"></i>
                            <span><strong>Failed Delivery:</strong> If delivery fails because you were unreachable, a re-delivery fee of ₦1,500 will apply.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-info-circle text-brand-teal mt-1"></i>
                            <span><strong>Gate Passes:</strong> If you live in an estate with strict entry rules, please arrange a gate pass for the rider beforehand to avoid delays.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-info-circle text-brand-teal mt-1"></i>
                            <span><strong>Inspection:</strong> Please inspect perishable items (tomatoes, meat, eggs) immediately upon receipt.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Shipping FAQ -->
    <section class="py-16 bg-brand-grey">
        <div class="container mx-auto px-6 max-w-3xl">
            <h3 class="text-2xl font-bold text-brand-blue text-center mb-10">Shipping FAQs</h3>

            <div class="space-y-4">
                <!-- FAQ 1 -->
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
                    <button class="w-full flex justify-between items-center p-6 hover:bg-gray-50 transition-colors text-left focus:outline-none group" onclick="toggleFAQ(this)">
                        <span class="font-bold text-brand-blue">Can I schedule a specific delivery date?</span>
                        <i class="fas fa-chevron-down text-gray-400 transition-transform group-hover:text-brand-teal"></i>
                    </button>
                    <div class="hidden p-6 pt-0 text-gray-600 text-sm leading-relaxed border-t border-gray-100 mt-2">
                        Yes! During checkout, you can select a preferred delivery date. For monthly subscriptions, we deliver on the first Saturday of every month unless you request otherwise.
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
                    <button class="w-full flex justify-between items-center p-6 hover:bg-gray-50 transition-colors text-left focus:outline-none group" onclick="toggleFAQ(this)">
                        <span class="font-bold text-brand-blue">Do you deliver on Sundays?</span>
                        <i class="fas fa-chevron-down text-gray-400 transition-transform group-hover:text-brand-teal"></i>
                    </button>
                    <div class="hidden p-6 pt-0 text-gray-600 text-sm leading-relaxed border-t border-gray-100 mt-2">
                        Currently, our standard delivery days are Monday to Saturday. Sunday deliveries are only available for "Emergency/Express" orders in Lagos and attract an extra fee.
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
                    <button class="w-full flex justify-between items-center p-6 hover:bg-gray-50 transition-colors text-left focus:outline-none group" onclick="toggleFAQ(this)">
                        <span class="font-bold text-brand-blue">My order is late. What should I do?</span>
                        <i class="fas fa-chevron-down text-gray-400 transition-transform group-hover:text-brand-teal"></i>
                    </button>
                    <div class="hidden p-6 pt-0 text-gray-600 text-sm leading-relaxed border-t border-gray-100 mt-2">
                        We apologize for delays. Traffic and weather can sometimes affect timelines. Please track your order via the link in your SMS or call our support line at +234 800 FOOD BOX.
                    </div>
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

        // Toggle FAQ Accordion
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

        // Navbar Scroll
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