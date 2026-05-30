<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | FoodBox NG</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Tailwind Config (Same as Landing Page) -->
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
        
        .pattern-grid {
            background-image: radial-gradient(#E9C46A 1px, transparent 1px);
            background-size: 30px 30px;
            opacity: 0.15;
        }
    </style>
</head>
<body class="bg-brand-grey font-sans text-brand-blue antialiased selection:bg-brand-gold selection:text-brand-blue">

    <!-- Navigation -->
    @include('layouts.navbar')

    <!-- Header / Hero Section -->
    <section class="relative pt-40 pb-20 bg-brand-blue overflow-hidden">
        <div class="absolute inset-0 pattern-grid z-0"></div>
        
        <!-- Decorative Circles -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-brand-teal opacity-10 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-brand-gold opacity-10 rounded-full blur-3xl transform -translate-x-1/2 translate-y-1/2"></div>

        <div class="container mx-auto px-6 relative z-10 text-center">
            <span class="text-brand-gold font-bold tracking-wider uppercase text-sm mb-4 block">Who We Are</span>
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">Stocking Your Home,<br> One Box at a Time.</h1>
            <p class="text-gray-300 text-lg max-w-2xl mx-auto leading-relaxed">
                We are on a mission to simplify household shopping for Nigerians. No more supermarket runs, no more last-minute stress — just the essentials you need, packed and delivered right to your door.
            </p>
        </div>
    </section>

    <!-- Our Story Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <!-- Image Grid -->
                <div class="lg:w-1/2 grid grid-cols-2 gap-4">
                    <img src="https://images.unsplash.com/photo-1595853035070-59a39fe84de3?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="rounded-2xl shadow-lg w-full h-64 object-cover transform translate-y-8">
                    <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="rounded-2xl shadow-lg w-full h-64 object-cover">
                </div>

                <!-- Content -->
                <div class="lg:w-1/2">
                    <h2 class="text-3xl md:text-4xl font-bold text-brand-blue mb-6">It started with an Empty Shelf...</h2>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Our founder, Pinnacle, was a student living alone in ABUJA. Every few weeks, the same exhausting routine — hopping from one store to another just to stock up on rice, seasoning, toiletries, and other basics. One evening, after a long day, he opened his kitchen cabinet and found it completely empty. He thought, <span class="italic text-brand-blue font-semibold">"Why isn't there a simpler way to do this?"</span>
                    </p>
                    <p class="text-gray-600 leading-relaxed mb-8">
                        That question became FoodBox NG. We built a service that curates and delivers essential household and food items — dry goods, pantry staples, and everyday necessities — in tailored packages designed for students, bachelors, and families. No market runs. No cart abandonment. Just what you need, when you need it.
                    </p>
                    
                    <div class="flex gap-8">
                        <div>
                            <h4 class="text-3xl font-bold text-brand-teal">15k+</h4>
                            <p class="text-sm text-gray-500">Boxes Delivered</p>
                        </div>
                        <div>
                            <h4 class="text-3xl font-bold text-brand-teal">3</h4>
                            <p class="text-sm text-gray-500">Package Plans</p>
                        </div>
                        <div>
                            <h4 class="text-3xl font-bold text-brand-teal">5</h4>
                            <p class="text-sm text-gray-500">Cities Covered</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="py-20 bg-brand-grey">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Mission -->
                <div class="bg-white p-10 rounded-3xl shadow-soft border-l-8 border-brand-teal hover:transform hover:-translate-y-1 transition-all">
                    <div class="w-12 h-12 bg-brand-teal/10 text-brand-teal rounded-full flex items-center justify-center text-xl mb-6">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-brand-blue mb-4">Our Mission</h3>
                    <p class="text-gray-600 leading-relaxed">
                        To make household restocking stress-free and affordable for every Nigerian — from students in hostels to families at home — by delivering curated boxes of essential pantry and household items right to their doorstep.
                    </p>
                </div>

                <!-- Vision -->
                <div class="bg-white p-10 rounded-3xl shadow-soft border-l-8 border-brand-gold hover:transform hover:-translate-y-1 transition-all">
                    <div class="w-12 h-12 bg-brand-gold/10 text-brand-orange rounded-full flex items-center justify-center text-xl mb-6">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-brand-blue mb-4">Our Vision</h3>
                    <p class="text-gray-600 leading-relaxed">
                        To become Nigeria's most trusted household supply platform — a name every home reaches for when it's time to restock, with plans designed to fit every lifestyle and budget across West Africa.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-brand-blue mb-4">Our Core Values</h2>
                <p class="text-gray-600">The principles that guide every box we pack and every delivery we make.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Value 1 -->
                <div class="text-center p-6 rounded-2xl hover:bg-brand-grey transition-colors">
                    <div class="w-16 h-16 mx-auto bg-green-100 text-green-600 rounded-full flex items-center justify-center text-2xl mb-4">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <h4 class="text-xl font-bold text-brand-blue mb-2">Quality Always</h4>
                    <p class="text-sm text-gray-500">Every item in your box meets our quality standard — no expired, substandard, or second-rate products.</p>
                </div>

                <!-- Value 2 -->
                <div class="text-center p-6 rounded-2xl hover:bg-brand-grey transition-colors">
                    <div class="w-16 h-16 mx-auto bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-2xl mb-4">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4 class="text-xl font-bold text-brand-blue mb-2">Community</h4>
                    <p class="text-sm text-gray-500">We build relationships, not just transactions. Every customer matters to us personally.</p>
                </div>

                <!-- Value 3 -->
                <div class="text-center p-6 rounded-2xl hover:bg-brand-grey transition-colors">
                    <div class="w-16 h-16 mx-auto bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center text-2xl mb-4">
                        <i class="fas fa-check-double"></i>
                    </div>
                    <h4 class="text-xl font-bold text-brand-blue mb-2">Integrity</h4>
                    <p class="text-sm text-gray-500">No hidden fees. What you see on the site is exactly what you get — every single time.</p>
                </div>

                <!-- Value 4 -->
                <div class="text-center p-6 rounded-2xl hover:bg-brand-grey transition-colors">
                    <div class="w-16 h-16 mx-auto bg-red-100 text-red-600 rounded-full flex items-center justify-center text-2xl mb-4">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h4 class="text-xl font-bold text-brand-blue mb-2">Speed</h4>
                    <p class="text-sm text-gray-500">We value your time. Our logistics are optimized so your box arrives at your door without delay.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Meet The Team -->
    <section class="py-20 bg-brand-grey relative overflow-hidden">
        <!-- Decorative Background -->
        <div class="absolute top-0 left-0 w-full h-full opacity-5 pointer-events-none">
            <i class="fas fa-box absolute top-10 left-10 text-6xl rotate-12"></i>
            <i class="fas fa-shopping-basket absolute bottom-20 right-20 text-8xl -rotate-12"></i>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-brand-blue mb-4">Meet the Minds</h2>
                <p class="text-gray-600">The team working behind the scenes to keep your home stocked and running smoothly.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Team Member 1 -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-soft group">
                    <div class="h-64 overflow-hidden">
                        <img src="{{ asset('assets/images/0AA.jpeg') }}" alt="Pinnacle Emmanuel" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6 text-center">
                        <h4 class="text-xl font-bold text-brand-blue">Pinnacle Emmanuel</h4>
                        <p class="text-brand-teal font-medium text-sm mb-4">Founder & CEO</p>
                        <div class="flex justify-center gap-3">
                            <a href="#" class="text-gray-400 hover:text-brand-blue"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="text-gray-400 hover:text-brand-blue"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-soft group">
                    <div class="h-64 overflow-hidden bg-brand-grey flex items-center justify-center">
                        <img src="{{ asset('assets/images/0BB.jpeg') }}" alt="Position Open" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6 text-center">
                        <h4 class="text-xl font-bold text-brand-blue">Position Open</h4>
                        <p class="text-brand-teal font-medium text-sm mb-4">Head of Operations</p>
                        <div class="flex justify-center gap-3">
                            <a href="#" class="text-gray-400 hover:text-brand-blue"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="text-gray-400 hover:text-brand-blue"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-soft group">
                    <div class="h-64 overflow-hidden">
                        <img src="{{ asset('assets/images/0BB.jpeg') }}" alt="Position Open" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6 text-center">
                        <h4 class="text-xl font-bold text-brand-blue">Position Open</h4>
                        <p class="text-brand-teal font-medium text-sm mb-4">Logistics Lead</p>
                        <div class="flex justify-center gap-3">
                            <a href="#" class="text-gray-400 hover:text-brand-blue"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="text-gray-400 hover:text-brand-blue"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Team Member 4 -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-soft group">
                    <div class="h-64 overflow-hidden">
                        <img src="{{ asset('assets/images/0BB.jpeg') }}" alt="Position Open" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6 text-center">
                        <h4 class="text-xl font-bold text-brand-blue">Position Open</h4>
                        <p class="text-brand-teal font-medium text-sm mb-4">Customer Service</p>
                        <div class="flex justify-center gap-3">
                            <a href="#" class="text-gray-400 hover:text-brand-blue"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="text-gray-400 hover:text-brand-blue"><i class="fab fa-twitter"></i></a>
                        </div>
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