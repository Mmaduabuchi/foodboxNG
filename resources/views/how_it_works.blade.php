<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How It Works | FoodBox NG - Abuja Essentials Delivery</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Tailwind Config (Matching FoodBox Brand Identity) -->
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
                            dark: '#1D353E',
                        }
                    },
                    boxShadow: {
                        'soft': '0 10px 40px -10px rgba(0,0,0,0.06)',
                        'card': '0 15px 35px -5px rgba(38,70,83,0.08)',
                        'hover': '0 25px 50px -12px rgba(42,157,143,0.25)',
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
        
        .pattern-dots {
            background-image: radial-gradient(#2A9D8F 1.2px, transparent 1.2px);
            background-size: 24px 24px;
            opacity: 0.12;
        }

        .gradient-border {
            background: linear-gradient(135deg, rgba(42,157,143,0.3) 0%, rgba(233,196,106,0.3) 100%);
        }

        .step-glow:hover {
            box-shadow: 0 20px 40px -15px rgba(42, 157, 143, 0.2);
        }
    </style>
</head>
<body class="bg-brand-grey font-sans text-brand-blue antialiased selection:bg-brand-gold selection:text-brand-blue">

    <!-- Navigation -->
    @include('layouts.navbar')

    <!-- 1. Hero Section -->
    <section class="relative pt-36 pb-20 lg:pt-44 lg:pb-28 bg-white overflow-hidden border-b border-gray-100">
        <div class="absolute inset-0 pattern-dots z-0"></div>
        
        <!-- Decorative Ambient Blurs -->
        <div class="absolute top-12 right-10 w-96 h-96 bg-brand-gold/15 rounded-full blur-3xl -z-10 pointer-events-none"></div>
        <div class="absolute bottom-0 left-10 w-80 h-80 bg-brand-teal/10 rounded-full blur-3xl -z-10 pointer-events-none"></div>

        <div class="container mx-auto px-6 relative z-10 text-center max-w-4xl">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand-teal/10 text-brand-teal font-bold text-xs sm:text-sm mb-6 border border-brand-teal/20 shadow-sm">
                <span class="w-2 h-2 rounded-full bg-brand-teal animate-pulse"></span>
                <span>Simple 4-Step Process in Abuja, Nigeria</span>
            </div>

            <!-- Main Heading -->
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-brand-blue tracking-tight leading-tight mb-6">
                Market Runs Made <br class="hidden sm:inline">
                <span class="text-brand-teal relative inline-block">
                    Simple, Fast & Stress-Free
                    <svg class="absolute w-full h-3.5 -bottom-2 left-0 text-brand-gold opacity-80" viewBox="0 0 200 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.00025 6.99997C58.5002 2.49997 148.5 -2.5 198 6.99997" stroke="currentColor" stroke-width="3.5" stroke-linecap="round"/>
                    </svg>
                </span>
            </h1>

            <!-- Subtitle -->
            <p class="text-gray-600 text-lg sm:text-xl max-w-2xl mx-auto leading-relaxed mb-10">
                No more haggling under the hot Abuja sun or spending hours in Utako market traffic. Choose your preferred essentials box and get fresh groceries delivered to your doorstep.
            </p>

            <!-- Hero Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('packages') }}" class="w-full sm:w-auto bg-brand-teal text-white px-8 py-4 rounded-full font-bold text-base shadow-xl shadow-brand-teal/25 hover:bg-brand-blue hover:scale-[1.02] transition-all duration-300 flex items-center justify-center gap-3">
                    <span>Explore Our Packages</span>
                    <i class="fas fa-arrow-right text-sm"></i>
                </a>
                <a href="#faq-section" class="w-full sm:w-auto bg-white text-brand-blue border-2 border-gray-200 px-8 py-4 rounded-full font-bold text-base hover:border-brand-teal hover:text-brand-teal hover:bg-teal-50/30 transition-all duration-300 flex items-center justify-center gap-2">
                    <i class="fas fa-question-circle text-gray-400"></i>
                    <span>Read FAQs</span>
                </a>
            </div>

            <!-- Trust Points -->
            <div class="mt-14 pt-8 border-t border-gray-100 grid grid-cols-2 md:grid-cols-4 gap-6 text-gray-500 text-xs sm:text-sm font-semibold">
                <div class="flex items-center justify-center gap-2">
                    <i class="fas fa-shield-halved text-brand-teal text-base"></i>
                    <span>100% Quality Guarantee</span>
                </div>
                <div class="flex items-center justify-center gap-2">
                    <i class="fas fa-truck-fast text-brand-gold text-base"></i>
                    <span>Express Abuja Delivery</span>
                </div>
                <div class="flex items-center justify-center gap-2">
                    <i class="fas fa-lock text-brand-blue text-base"></i>
                    <span>Secure Paystack Checkout</span>
                </div>
                <div class="flex items-center justify-center gap-2">
                    <i class="fas fa-hand-holding-dollar text-brand-orange text-base"></i>
                    <span>Save up to 25% vs Retail</span>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Four Steps Section -->
    <section class="py-24 bg-brand-grey relative overflow-hidden">
        <div class="container mx-auto px-6 max-w-7xl">
            
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto mb-20">
                <span class="text-brand-teal font-bold tracking-wider uppercase text-xs sm:text-sm block mb-3">How It Works</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-blue mb-4">From Selection to Your Door in 4 Steps</h2>
                <p class="text-gray-600 text-base leading-relaxed">
                    Designed for busy professionals, students, and families living in Abuja who value their time and fresh food.
                </p>
            </div>

            <!-- Steps Grid (4 Clean Rounded Cards) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 relative">

                <!-- Step Card 1: Create an Account -->
                <div class="bg-white rounded-3xl p-8 shadow-card hover:-translate-y-2 transition-all duration-300 border border-gray-100 flex flex-col justify-between group step-glow relative">
                    <!-- Step Pill Number -->
                    <div class="flex items-center justify-between mb-8">
                        <div class="w-16 h-16 rounded-2xl bg-teal-50 text-brand-teal flex items-center justify-center text-2xl group-hover:bg-brand-teal group-hover:text-white transition-all duration-300 shadow-sm">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <span class="text-3xl font-black text-gray-200 group-hover:text-brand-teal/30 transition-colors font-mono">01</span>
                    </div>

                    <div>
                        <span class="inline-block px-3 py-1 rounded-md text-[11px] font-bold bg-teal-50 text-brand-teal uppercase tracking-wider mb-3">Step 1</span>
                        <h3 class="text-xl font-bold text-brand-blue mb-3 group-hover:text-brand-teal transition-colors">Create an Account</h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-6">
                            Sign up in less than 60 seconds. Set up your profile, household dietary preferences, and primary Abuja delivery address.
                        </p>
                    </div>

                    <!-- Micro Feature Tags -->
                    <div class="pt-4 border-t border-gray-100 space-y-2">
                        <div class="flex items-center gap-2 text-xs text-gray-600 font-medium">
                            <i class="fas fa-check-circle text-brand-teal text-xs"></i>
                            <span>Quick phone & email signup</span>
                        </div>
                        <div class="flex items-center gap-2 text-xs text-gray-600 font-medium">
                            <i class="fas fa-check-circle text-brand-teal text-xs"></i>
                            <span>Save multiple delivery spots</span>
                        </div>
                    </div>
                </div>

                <!-- Step Card 2: Choose a Package -->
                <div class="bg-white rounded-3xl p-8 shadow-card hover:-translate-y-2 transition-all duration-300 border border-gray-100 flex flex-col justify-between group step-glow relative">
                    <!-- Step Pill Number -->
                    <div class="flex items-center justify-between mb-8">
                        <div class="w-16 h-16 rounded-2xl bg-amber-50 text-brand-orange flex items-center justify-center text-2xl group-hover:bg-brand-orange group-hover:text-white transition-all duration-300 shadow-sm">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <span class="text-3xl font-black text-gray-200 group-hover:text-brand-orange/30 transition-colors font-mono">02</span>
                    </div>

                    <div>
                        <span class="inline-block px-3 py-1 rounded-md text-[11px] font-bold bg-amber-50 text-brand-orange uppercase tracking-wider mb-3">Step 2</span>
                        <h3 class="text-xl font-bold text-brand-blue mb-3 group-hover:text-brand-orange transition-colors">Choose a Package</h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-6">
                            Pick from curated food bundles designed for Students, Bachelors, or Families, or customize package items to match your exact appetite.
                        </p>
                    </div>

                    <!-- Micro Feature Tags -->
                    <div class="pt-4 border-t border-gray-100 space-y-2">
                        <div class="flex items-center gap-2 text-xs text-gray-600 font-medium">
                            <i class="fas fa-check-circle text-brand-orange text-xs"></i>
                            <span>Student, Bachelor & Family boxes</span>
                        </div>
                        <div class="flex items-center gap-2 text-xs text-gray-600 font-medium">
                            <i class="fas fa-check-circle text-brand-orange text-xs"></i>
                            <span>Rice, grains, tubers & proteins</span>
                        </div>
                    </div>
                </div>

                <!-- Step Card 3: Make Payment -->
                <div class="bg-white rounded-3xl p-8 shadow-card hover:-translate-y-2 transition-all duration-300 border border-gray-100 flex flex-col justify-between group step-glow relative">
                    <!-- Step Pill Number -->
                    <div class="flex items-center justify-between mb-8">
                        <div class="w-16 h-16 rounded-2xl bg-blue-50 text-brand-blue flex items-center justify-center text-2xl group-hover:bg-brand-blue group-hover:text-white transition-all duration-300 shadow-sm">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <span class="text-3xl font-black text-gray-200 group-hover:text-brand-blue/30 transition-colors font-mono">03</span>
                    </div>

                    <div>
                        <span class="inline-block px-3 py-1 rounded-md text-[11px] font-bold bg-blue-50 text-brand-blue uppercase tracking-wider mb-3">Step 3</span>
                        <h3 class="text-xl font-bold text-brand-blue mb-3 group-hover:text-brand-teal transition-colors">Make Payment</h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-6">
                            Pay securely via Paystack, debit/credit cards, instant bank transfers, or schedule automatic bi-weekly/monthly subscriptions with zero hassle.
                        </p>
                    </div>

                    <!-- Micro Feature Tags -->
                    <div class="pt-4 border-t border-gray-100 space-y-2">
                        <div class="flex items-center gap-2 text-xs text-gray-600 font-medium">
                            <i class="fas fa-check-circle text-brand-blue text-xs"></i>
                            <span>Encrypted Paystack integration</span>
                        </div>
                        <div class="flex items-center gap-2 text-xs text-gray-600 font-medium">
                            <i class="fas fa-check-circle text-brand-blue text-xs"></i>
                            <span>Flexible one-time or subscription</span>
                        </div>
                    </div>
                </div>

                <!-- Step Card 4: We Deliver to Your Doorstep -->
                <div class="bg-white rounded-3xl p-8 shadow-card hover:-translate-y-2 transition-all duration-300 border border-gray-100 flex flex-col justify-between group step-glow relative">
                    <!-- Step Pill Number -->
                    <div class="flex items-center justify-between mb-8">
                        <div class="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300 shadow-sm">
                            <i class="fas fa-truck-fast"></i>
                        </div>
                        <span class="text-3xl font-black text-gray-200 group-hover:text-emerald-600/30 transition-colors font-mono">04</span>
                    </div>

                    <div>
                        <span class="inline-block px-3 py-1 rounded-md text-[11px] font-bold bg-emerald-50 text-emerald-600 uppercase tracking-wider mb-3">Step 4</span>
                        <h3 class="text-xl font-bold text-brand-blue mb-3 group-hover:text-emerald-600 transition-colors">Doorstep Delivery</h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-6">
                            Our couriers pick, hygienically pack, and deliver fresh foodstuff right to your gate with real-time dispatch tracking and live updates.
                        </p>
                    </div>

                    <!-- Micro Feature Tags -->
                    <div class="pt-4 border-t border-gray-100 space-y-2">
                        <div class="flex items-center gap-2 text-xs text-gray-600 font-medium">
                            <i class="fas fa-check-circle text-emerald-600 text-xs"></i>
                            <span>Hygienic sealed packaging</span>
                        </div>
                        <div class="flex items-center gap-2 text-xs text-gray-600 font-medium">
                            <i class="fas fa-check-circle text-emerald-600 text-xs"></i>
                            <span>Real-time delivery notifications</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- 3. Abuja Coverage & Highlights Banner -->
    <section class="py-16 bg-white border-y border-gray-100">
        <div class="container mx-auto px-6 max-w-7xl">
            <div class="bg-gradient-to-br from-brand-blue via-brand-dark to-brand-blue rounded-3xl p-8 sm:p-12 text-white shadow-2xl relative overflow-hidden">
                <!-- Background Geometric Glows -->
                <div class="absolute -top-24 -right-24 w-80 h-80 bg-brand-teal/20 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-brand-gold/10 rounded-full blur-3xl"></div>

                <div class="relative z-10 grid lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-6">
                        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 text-brand-gold font-bold text-xs mb-4 border border-white/10">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Abuja Service Coverage</span>
                        </div>
                        <h3 class="text-2xl sm:text-3xl font-extrabold text-white mb-4">
                            We Deliver Across All Major Districts in Abuja
                        </h3>
                        <p class="text-gray-300 text-sm sm:text-base leading-relaxed mb-6">
                            From Gwarinpa and Maitama to Jabi, Apo, and Life Camp, our dedicated logistics fleet ensures your kitchen stays stocked on schedule.
                        </p>
                        <div class="flex items-center gap-3 text-xs sm:text-sm text-brand-gold font-semibold">
                            <i class="fas fa-bolt"></i>
                            <span>Order before 2:00 PM for priority next-day dispatch</span>
                        </div>
                    </div>

                    <div class="lg:col-span-6">
                        <p class="text-xs uppercase tracking-wider font-bold text-gray-400 mb-3">Popular Active Delivery Zones:</p>
                        <div class="flex flex-wrap gap-2.5">
                            <span class="px-4 py-2 rounded-xl bg-white/10 text-white text-xs font-semibold hover:bg-brand-teal transition-colors cursor-default border border-white/10">📍 Gwarinpa</span>
                            <span class="px-4 py-2 rounded-xl bg-white/10 text-white text-xs font-semibold hover:bg-brand-teal transition-colors cursor-default border border-white/10">📍 Maitama</span>
                            <span class="px-4 py-2 rounded-xl bg-white/10 text-white text-xs font-semibold hover:bg-brand-teal transition-colors cursor-default border border-white/10">📍 Wuse I & II</span>
                            <span class="px-4 py-2 rounded-xl bg-white/10 text-white text-xs font-semibold hover:bg-brand-teal transition-colors cursor-default border border-white/10">📍 Jabi</span>
                            <span class="px-4 py-2 rounded-xl bg-white/10 text-white text-xs font-semibold hover:bg-brand-teal transition-colors cursor-default border border-white/10">📍 Life Camp</span>
                            <span class="px-4 py-2 rounded-xl bg-white/10 text-white text-xs font-semibold hover:bg-brand-teal transition-colors cursor-default border border-white/10">📍 Apo & Guzape</span>
                            <span class="px-4 py-2 rounded-xl bg-white/10 text-white text-xs font-semibold hover:bg-brand-teal transition-colors cursor-default border border-white/10">📍 Garki Area 1-11</span>
                            <span class="px-4 py-2 rounded-xl bg-white/10 text-white text-xs font-semibold hover:bg-brand-teal transition-colors cursor-default border border-white/10">📍 Asokoro</span>
                            <span class="px-4 py-2 rounded-xl bg-white/10 text-white text-xs font-semibold hover:bg-brand-teal transition-colors cursor-default border border-white/10">📍 Utako</span>
                            <span class="px-4 py-2 rounded-xl bg-white/10 text-white text-xs font-semibold hover:bg-brand-teal transition-colors cursor-default border border-white/10">📍 Kubwa & Lugbe</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Why FoodBox vs Traditional Market (Comparison) -->
    <section class="py-20 bg-brand-grey">
        <div class="container mx-auto px-6 max-w-6xl">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-brand-teal font-bold tracking-wider uppercase text-xs sm:text-sm block mb-3">The Smarter Choice</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-blue mb-4">Why FoodBox Beats Market Stress</h2>
                <p class="text-gray-600 text-sm sm:text-base">Compare how we save you 4+ hours every weekend and keep your budget in check.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 items-stretch">
                <!-- Market Shopping Card -->
                <div class="bg-white rounded-3xl p-8 border border-red-100 shadow-soft flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 rounded-2xl bg-red-50 text-brand-red flex items-center justify-center text-xl">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-brand-blue">Traditional Market Runs</h3>
                                <p class="text-xs text-gray-400">The tiring old-fashioned way</p>
                            </div>
                        </div>
                        
                        <ul class="space-y-4 text-sm text-gray-600">
                            <li class="flex items-start gap-3">
                                <i class="fas fa-times text-brand-red mt-1 shrink-0"></i>
                                <span>3–5 hours wasted in hot sun, muddy aisles, and heavy traffic.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fas fa-times text-brand-red mt-1 shrink-0"></i>
                                <span>Unpredictable price inflation and unfair bargaining tactics.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fas fa-times text-brand-red mt-1 shrink-0"></i>
                                <span>Risk of dirty grains, stone-filled rice, and bruised produce.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fas fa-times text-brand-red mt-1 shrink-0"></i>
                                <span>Heavy lifting of bulky bags to your car or public transport.</span>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="mt-8 pt-4 border-t border-gray-100 text-xs text-red-500 font-semibold">
                        ❌ High stress, lost time & fatigue
                    </div>
                </div>

                <!-- FoodBox NG Card -->
                <div class="bg-white rounded-3xl p-8 border-2 border-brand-teal shadow-card relative overflow-hidden flex flex-col justify-between">
                    <div class="absolute top-0 right-0 bg-brand-teal text-white text-[10px] font-extrabold uppercase tracking-widest px-4 py-1.5 rounded-bl-2xl">
                        Recommended
                    </div>

                    <div>
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 rounded-2xl bg-teal-50 text-brand-teal flex items-center justify-center text-xl">
                                <i class="fas fa-leaf"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-brand-blue">FoodBox NG Delivery</h3>
                                <p class="text-xs text-brand-teal font-semibold">The modern curated experience</p>
                            </div>
                        </div>
                        
                        <ul class="space-y-4 text-sm text-gray-600">
                            <li class="flex items-start gap-3">
                                <i class="fas fa-check-circle text-brand-teal mt-1 shrink-0"></i>
                                <span>Order in 2 minutes from your phone, anytime and anywhere.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fas fa-check-circle text-brand-teal mt-1 shrink-0"></i>
                                <span>Transparent wholesale-direct pricing with zero hidden fees.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fas fa-check-circle text-brand-teal mt-1 shrink-0"></i>
                                <span>Stone-free premium rice, clean beans & hand-sorted fresh tubers.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fas fa-check-circle text-brand-teal mt-1 shrink-0"></i>
                                <span>Direct delivery to your doorstep by courteous dispatch drivers.</span>
                            </li>
                        </ul>
                    </div>

                    <div class="mt-8 pt-4 border-t border-teal-100 text-xs text-brand-teal font-bold flex items-center justify-between">
                        <span>✨ Total peace of mind & fresh guarantee</span>
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. Frequently Asked Questions (FAQ) Section -->
    <section id="faq-section" class="py-24 bg-white border-t border-gray-100">
        <div class="container mx-auto px-6 max-w-4xl">
            
            <!-- FAQ Header -->
            <div class="text-center mb-16">
                <span class="text-brand-teal font-bold tracking-wider uppercase text-xs sm:text-sm block mb-3">Got Questions?</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-blue mb-4">Frequently Asked Questions</h2>
                <p class="text-gray-600 text-base leading-relaxed">
                    Everything you need to know about our packages, delivery schedule, and billing.
                </p>
            </div>

            <!-- Accordion List -->
            <div class="space-y-4">

                <!-- FAQ 1 -->
                <div class="border border-gray-200 rounded-2xl overflow-hidden transition-all duration-200 hover:border-brand-teal/50">
                    <button onclick="toggleFaq(1)" class="w-full p-6 text-left font-bold text-brand-blue flex justify-between items-center bg-white hover:bg-gray-50/50 transition-colors focus:outline-none">
                        <span class="text-base sm:text-lg">Which locations in Abuja do you deliver to?</span>
                        <div id="faq-icon-1" class="w-8 h-8 rounded-full bg-brand-grey flex items-center justify-center text-gray-500 transition-transform duration-300 shrink-0 ml-4">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </button>
                    <div id="faq-answer-1" class="hidden px-6 pb-6 text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-4 bg-teal-50/20">
                        We deliver to all major locations across Abuja including Gwarinpa, Maitama, Wuse I & II, Jabi, Utako, Life Camp, Garki, Apo, Guzape, Asokoro, Kubwa, and Lugbe. When checking out, enter your specific street address and landmark for swift delivery.
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="border border-gray-200 rounded-2xl overflow-hidden transition-all duration-200 hover:border-brand-teal/50">
                    <button onclick="toggleFaq(2)" class="w-full p-6 text-left font-bold text-brand-blue flex justify-between items-center bg-white hover:bg-gray-50/50 transition-colors focus:outline-none">
                        <span class="text-base sm:text-lg">What items are included inside a FoodBox package?</span>
                        <div id="faq-icon-2" class="w-8 h-8 rounded-full bg-brand-grey flex items-center justify-center text-gray-500 transition-transform duration-300 shrink-0 ml-4">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </button>
                    <div id="faq-answer-2" class="hidden px-6 pb-6 text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-4 bg-teal-50/20">
                        Our packages contain curated home essentials including premium stone-free rice (foreign or local parboiled), honey beans, garri (white/yellow), tubers (yam, sweet potatoes), cooking oils (vegetable & pure palm oil), seasonings, tomato paste, proteins (fish/meat options), and basic household cleaning supplies.
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="border border-gray-200 rounded-2xl overflow-hidden transition-all duration-200 hover:border-brand-teal/50">
                    <button onclick="toggleFaq(3)" class="w-full p-6 text-left font-bold text-brand-blue flex justify-between items-center bg-white hover:bg-gray-50/50 transition-colors focus:outline-none">
                        <span class="text-base sm:text-lg">Can I customize or swap items in my package?</span>
                        <div id="faq-icon-3" class="w-8 h-8 rounded-full bg-brand-grey flex items-center justify-center text-gray-500 transition-transform duration-300 shrink-0 ml-4">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </button>
                    <div id="faq-answer-3" class="hidden px-6 pb-6 text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-4 bg-teal-50/20">
                        Yes! While our preset bundles (Student, Bachelor, Family) are optimized for value, you can customize your item quantities or choose our "Build Your Own" box to select exactly what your household consumes.
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="border border-gray-200 rounded-2xl overflow-hidden transition-all duration-200 hover:border-brand-teal/50">
                    <button onclick="toggleFaq(4)" class="w-full p-6 text-left font-bold text-brand-blue flex justify-between items-center bg-white hover:bg-gray-50/50 transition-colors focus:outline-none">
                        <span class="text-base sm:text-lg">How do subscriptions work and can I pause anytime?</span>
                        <div id="faq-icon-4" class="w-8 h-8 rounded-full bg-brand-grey flex items-center justify-center text-gray-500 transition-transform duration-300 shrink-0 ml-4">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </button>
                    <div id="faq-answer-4" class="hidden px-6 pb-6 text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-4 bg-teal-50/20">
                        Subscriptions automate your pantry restocks on a bi-weekly or monthly basis. You can pause, skip an upcoming delivery, change your delivery address, or cancel anytime with one click directly from your user dashboard.
                    </div>
                </div>

                <!-- FAQ 5 -->
                <div class="border border-gray-200 rounded-2xl overflow-hidden transition-all duration-200 hover:border-brand-teal/50">
                    <button onclick="toggleFaq(5)" class="w-full p-6 text-left font-bold text-brand-blue flex justify-between items-center bg-white hover:bg-gray-50/50 transition-colors focus:outline-none">
                        <span class="text-base sm:text-lg">What if an item arrives damaged or not fresh?</span>
                        <div id="faq-icon-5" class="w-8 h-8 rounded-full bg-brand-grey flex items-center justify-center text-gray-500 transition-transform duration-300 shrink-0 ml-4">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </button>
                    <div id="faq-answer-5" class="hidden px-6 pb-6 text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-4 bg-teal-50/20">
                        We take quality very seriously. If any package item arrives compromised, report the issue via your dashboard or contact our support team within 24 hours for a prompt, free replacement or full refund.
                    </div>
                </div>

                <!-- FAQ 6 -->
                <div class="border border-gray-200 rounded-2xl overflow-hidden transition-all duration-200 hover:border-brand-teal/50">
                    <button onclick="toggleFaq(6)" class="w-full p-6 text-left font-bold text-brand-blue flex justify-between items-center bg-white hover:bg-gray-50/50 transition-colors focus:outline-none">
                        <span class="text-base sm:text-lg">Which payment methods are accepted?</span>
                        <div id="faq-icon-6" class="w-8 h-8 rounded-full bg-brand-grey flex items-center justify-center text-gray-500 transition-transform duration-300 shrink-0 ml-4">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </button>
                    <div id="faq-answer-6" class="hidden px-6 pb-6 text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-4 bg-teal-50/20">
                        We accept all Nigerian debit and credit cards (Mastercard, Visa, Verve) via secure Paystack processing, as well as direct bank transfers and dashboard wallet payments.
                    </div>
                </div>

            </div>

            <!-- Still have questions footer card -->
            <div class="mt-12 p-6 rounded-2xl bg-brand-grey text-center flex flex-col sm:flex-row items-center justify-between gap-4 border border-gray-200/60">
                <div class="text-left">
                    <h4 class="font-bold text-brand-blue text-sm">Have a specific question not answered here?</h4>
                    <p class="text-xs text-gray-500">Our customer support team is on standby to help you.</p>
                </div>
                <a href="{{ route('contact_us') }}" class="px-6 py-2.5 rounded-full bg-brand-blue text-white text-xs font-bold hover:bg-brand-teal transition-colors shrink-0 shadow-md">
                    Contact Support
                </a>
            </div>

        </div>
    </section>

    <!-- 6. Call to Action Banner -->
    <section class="py-20 bg-brand-grey">
        <div class="container mx-auto px-6 max-w-6xl">
            <div class="bg-brand-teal rounded-[3rem] p-10 md:p-16 text-center relative overflow-hidden shadow-2xl">
                <!-- Background Decorative Circles -->
                <div class="absolute top-0 left-0 w-72 h-72 bg-white opacity-10 rounded-full -translate-x-1/3 -translate-y-1/3 pointer-events-none"></div>
                <div class="absolute bottom-0 right-0 w-72 h-72 bg-brand-blue opacity-25 rounded-full translate-x-1/3 translate-y-1/3 pointer-events-none"></div>

                <div class="relative z-10 max-w-2xl mx-auto">
                    <div class="inline-block px-4 py-1 rounded-full bg-white/20 text-white font-bold text-xs uppercase tracking-wider mb-4">
                        Join 2,000+ Happy Abuja Households
                    </div>
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white mb-6 leading-tight">
                        Ready to Skip Market Stress For Good?
                    </h2>
                    <p class="text-white/90 text-base sm:text-lg mb-8 leading-relaxed">
                        Choose your package today and enjoy fresh foodstuff and household essentials delivered straight to your door in Abuja.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('packages') }}" class="bg-white text-brand-teal px-8 py-4 rounded-full font-bold text-base hover:bg-brand-gold hover:text-brand-blue transition-all shadow-xl hover:scale-105">
                            Browse All Packages
                        </a>
                        <a href="{{ route('register.index') }}" class="border-2 border-white text-white px-8 py-4 rounded-full font-bold text-base hover:bg-white/10 transition-all">
                            Create Free Account
                        </a>
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
            
            if (menu && icon) {
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
        }

        // Accordion Toggle for FAQ Section
        function toggleFaq(id) {
            const answer = document.getElementById('faq-answer-' + id);
            const icon = document.getElementById('faq-icon-' + id);
            
            if (answer && icon) {
                const isHidden = answer.classList.contains('hidden');
                
                // Close all other FAQs
                for (let i = 1; i <= 6; i++) {
                    const otherAnswer = document.getElementById('faq-answer-' + i);
                    const otherIcon = document.getElementById('faq-icon-' + i);
                    if (otherAnswer && otherIcon) {
                        otherAnswer.classList.add('hidden');
                        otherIcon.classList.remove('rotate-180', 'text-brand-teal', 'bg-teal-50');
                    }
                }

                // If it was hidden, open it
                if (isHidden) {
                    answer.classList.remove('hidden');
                    icon.classList.add('rotate-180', 'text-brand-teal', 'bg-teal-50');
                }
            }
        }

        // Navbar Scroll Shadow Effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (navbar) {
                if (window.scrollY > 30) {
                    navbar.classList.add('shadow-md');
                } else {
                    navbar.classList.remove('shadow-md');
                }
            }
        });
    </script>
</body>
</html>