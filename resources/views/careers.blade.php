<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Careers | FoodBox NG</title>
    
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
            <span class="text-brand-teal font-bold tracking-wider uppercase text-sm mb-4 block">Join Our Team</span>
            <h1 class="text-4xl md:text-6xl font-bold text-brand-blue mb-6">Help Feed the Nation</h1>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto leading-relaxed mb-8">
                We're building the future of food logistics in Africa. Join a team of passionate problem-solvers, foodies, and innovators.
            </p>
            <a href="#openings" class="inline-block bg-brand-gold text-brand-blue px-8 py-4 rounded-full font-bold text-lg hover:bg-brand-blue hover:text-white transition-all shadow-lg">
                View Open Roles
            </a>
        </div>
    </section>

    <!-- Image Gallery / Culture -->
    <section class="py-12 bg-white border-b border-gray-100">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="h-64 rounded-2xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover hover:scale-110 transition-transform duration-700">
                </div>
                <div class="h-64 rounded-2xl overflow-hidden md:mt-8">
                    <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover hover:scale-110 transition-transform duration-700">
                </div>
                <div class="h-64 rounded-2xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover hover:scale-110 transition-transform duration-700">
                </div>
                <div class="h-64 rounded-2xl overflow-hidden md:mt-8">
                    <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover hover:scale-110 transition-transform duration-700">
                </div>
            </div>
        </div>
    </section>

    <!-- Perks & Benefits -->
    <section class="py-20 bg-brand-grey">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-brand-blue mb-4">Why Work With Us?</h2>
                <p class="text-gray-600">We take care of our people so they can take care of our customers.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Perk 1 -->
                <div class="bg-white p-8 rounded-3xl shadow-soft hover:-translate-y-1 transition-transform">
                    <div class="w-12 h-12 bg-brand-teal/10 text-brand-teal rounded-xl flex items-center justify-center text-xl mb-4">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <h3 class="text-xl font-bold text-brand-blue mb-2">Free Monthly FoodBox</h3>
                    <p class="text-sm text-gray-500">Every employee gets a curated "Family Standard" package monthly. Never worry about grocery shopping again.</p>
                </div>

                <!-- Perk 2 -->
                <div class="bg-white p-8 rounded-3xl shadow-soft hover:-translate-y-1 transition-transform">
                    <div class="w-12 h-12 bg-brand-gold/10 text-brand-orange rounded-xl flex items-center justify-center text-xl mb-4">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <h3 class="text-xl font-bold text-brand-blue mb-2">Health Insurance</h3>
                    <p class="text-sm text-gray-500">Comprehensive HMO coverage for you and your immediate family members.</p>
                </div>

                <!-- Perk 3 -->
                <div class="bg-white p-8 rounded-3xl shadow-soft hover:-translate-y-1 transition-transform">
                    <div class="w-12 h-12 bg-brand-blue/10 text-brand-blue rounded-xl flex items-center justify-center text-xl mb-4">
                        <i class="fas fa-laptop-house"></i>
                    </div>
                    <h3 class="text-xl font-bold text-brand-blue mb-2">Flexible Work</h3>
                    <p class="text-sm text-gray-500">Hybrid work policy for office roles. We focus on output, not hours spent at a desk.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Job Openings -->
    <section id="openings" class="py-20 bg-white">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="flex flex-col md:flex-row justify-between items-end mb-10 border-b border-gray-100 pb-4">
                <div>
                    <h2 class="text-3xl font-bold text-brand-blue">Current Openings</h2>
                    <p class="text-gray-500 mt-2">We are currently hiring for the following roles.</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <select class="px-4 py-2 rounded-lg border border-gray-200 text-sm text-gray-600 focus:outline-none focus:border-brand-teal">
                        <option>All Departments</option>
                        <option>Engineering</option>
                        <option>Operations</option>
                        <option>Marketing</option>
                    </select>
                </div>
            </div>

            <div class="space-y-4">
                
                <!-- Job Card 1 -->
                <div class="group border border-gray-200 rounded-2xl p-6 hover:border-brand-teal transition-all hover:shadow-lg bg-white flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h3 class="text-xl font-bold text-brand-blue group-hover:text-brand-teal transition-colors">Logistics Coordinator</h3>
                        <div class="flex flex-wrap gap-3 mt-2 text-sm text-gray-500">
                            <span class="flex items-center gap-1"><i class="fas fa-briefcase"></i> Operations</span>
                            <span class="flex items-center gap-1"><i class="fas fa-map-marker-alt"></i> Lagos (Lekki)</span>
                            <span class="flex items-center gap-1"><i class="fas fa-clock"></i> Full-time</span>
                        </div>
                    </div>
                    <a href="#" class="px-6 py-2 rounded-full border border-brand-blue text-brand-blue font-bold text-sm hover:bg-brand-blue hover:text-white transition-colors whitespace-nowrap">
                        Apply Now
                    </a>
                </div>

                <!-- Job Card 2 -->
                <div class="group border border-gray-200 rounded-2xl p-6 hover:border-brand-teal transition-all hover:shadow-lg bg-white flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h3 class="text-xl font-bold text-brand-blue group-hover:text-brand-teal transition-colors">Frontend Engineer (React)</h3>
                        <div class="flex flex-wrap gap-3 mt-2 text-sm text-gray-500">
                            <span class="flex items-center gap-1"><i class="fas fa-code"></i> Engineering</span>
                            <span class="flex items-center gap-1"><i class="fas fa-globe"></i> Remote (Nigeria)</span>
                            <span class="flex items-center gap-1"><i class="fas fa-clock"></i> Full-time</span>
                        </div>
                    </div>
                    <a href="#" class="px-6 py-2 rounded-full border border-brand-blue text-brand-blue font-bold text-sm hover:bg-brand-blue hover:text-white transition-colors whitespace-nowrap">
                        Apply Now
                    </a>
                </div>

                <!-- Job Card 3 -->
                <div class="group border border-gray-200 rounded-2xl p-6 hover:border-brand-teal transition-all hover:shadow-lg bg-white flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h3 class="text-xl font-bold text-brand-blue group-hover:text-brand-teal transition-colors">Customer Success Associate</h3>
                        <div class="flex flex-wrap gap-3 mt-2 text-sm text-gray-500">
                            <span class="flex items-center gap-1"><i class="fas fa-headset"></i> Support</span>
                            <span class="flex items-center gap-1"><i class="fas fa-map-marker-alt"></i> Lagos (Ikeja)</span>
                            <span class="flex items-center gap-1"><i class="fas fa-clock"></i> Full-time</span>
                        </div>
                    </div>
                    <a href="#" class="px-6 py-2 rounded-full border border-brand-blue text-brand-blue font-bold text-sm hover:bg-brand-blue hover:text-white transition-colors whitespace-nowrap">
                        Apply Now
                    </a>
                </div>

                <!-- Job Card 4 -->
                <div class="group border border-gray-200 rounded-2xl p-6 hover:border-brand-teal transition-all hover:shadow-lg bg-white flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h3 class="text-xl font-bold text-brand-blue group-hover:text-brand-teal transition-colors">Social Media Manager</h3>
                        <div class="flex flex-wrap gap-3 mt-2 text-sm text-gray-500">
                            <span class="flex items-center gap-1"><i class="fas fa-hashtag"></i> Marketing</span>
                            <span class="flex items-center gap-1"><i class="fas fa-laptop-house"></i> Hybrid</span>
                            <span class="flex items-center gap-1"><i class="fas fa-clock"></i> Full-time</span>
                        </div>
                    </div>
                    <a href="#" class="px-6 py-2 rounded-full border border-brand-blue text-brand-blue font-bold text-sm hover:bg-brand-blue hover:text-white transition-colors whitespace-nowrap">
                        Apply Now
                    </a>
                </div>

            </div>

            <!-- Empty State (Hidden by default, but good for layout) -->
            <div class="mt-8 p-8 bg-gray-50 rounded-2xl text-center hidden">
                <p class="text-gray-500">No open roles in this department currently.</p>
            </div>
            
            <div class="mt-10 text-center">
                <p class="text-gray-600 text-sm">Don't see your role? Send your CV to <a href="mailto:careers@foodbox.ng" class="text-brand-teal font-bold hover:underline">careers@foodbox.ng</a></p>
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