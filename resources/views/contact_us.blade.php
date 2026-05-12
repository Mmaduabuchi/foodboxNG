<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | FoodBox NG</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Tailwind Config (Consistent with Brand) -->
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

    <!-- Hero / Header -->
    <section class="relative pt-40 pb-20 bg-white overflow-hidden">
        <div class="absolute inset-0 pattern-grid z-0"></div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <span class="text-brand-teal font-bold tracking-wider uppercase text-sm mb-4 block">Support Center</span>
            <h1 class="text-4xl md:text-6xl font-bold text-brand-blue mb-6">We'd Love to Hear From You</h1>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto leading-relaxed">
                Have a question about your subscription, a custom order request, or just want to say hello? Our team is ready to help.
            </p>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="py-16 bg-brand-grey">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-3 gap-10">
                
                <!-- Left Column: Contact Info -->
                <div class="lg:col-span-1 space-y-8">
                    <!-- Info Card -->
                    <div class="bg-white p-8 rounded-3xl shadow-soft">
                        <h3 class="text-2xl font-bold text-brand-blue mb-6">Get in Touch</h3>
                        
                        <div class="space-y-6">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-brand-teal/10 rounded-full flex items-center justify-center text-brand-teal shrink-0">
                                    <i class="fas fa-map-marker-alt text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-brand-blue">Head Office</h4>
                                    <p class="text-gray-500 text-sm leading-relaxed">12 Admiralty Way, Lekki Phase 1,<br>Lagos, Nigeria.</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-brand-gold/10 rounded-full flex items-center justify-center text-brand-orange shrink-0">
                                    <i class="fas fa-phone-alt text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-brand-blue">Phone Support</h4>
                                    <p class="text-gray-500 text-sm">+234 800 FOOD BOX</p>
                                    <p class="text-gray-400 text-xs mt-1">Mon - Sat, 8am - 6pm</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-brand-blue/10 rounded-full flex items-center justify-center text-brand-blue shrink-0">
                                    <i class="fas fa-envelope text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-brand-blue">Email Us</h4>
                                    <p class="text-gray-500 text-sm">hello@foodbox.ng</p>
                                    <p class="text-gray-500 text-sm">support@foodbox.ng</p>
                                </div>
                            </div>
                        </div>

                        <!-- Social Links -->
                        <div class="mt-8 pt-8 border-t border-gray-100">
                            <p class="text-sm font-bold text-gray-400 mb-4 uppercase tracking-wide">Follow Us</p>
                            <div class="flex gap-4">
                                <a href="#" class="w-10 h-10 rounded-full bg-brand-grey flex items-center justify-center text-brand-blue hover:bg-brand-teal hover:text-white transition-all"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="w-10 h-10 rounded-full bg-brand-grey flex items-center justify-center text-brand-blue hover:bg-brand-teal hover:text-white transition-all"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="w-10 h-10 rounded-full bg-brand-grey flex items-center justify-center text-brand-blue hover:bg-brand-teal hover:text-white transition-all"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="w-10 h-10 rounded-full bg-brand-grey flex items-center justify-center text-brand-blue hover:bg-brand-teal hover:text-white transition-all"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Map Preview (Static Image for Design) -->
                    <div class="rounded-3xl overflow-hidden shadow-soft h-64 relative group cursor-pointer">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors z-10 flex items-center justify-center">
                            <button class="bg-white text-brand-blue px-6 py-2 rounded-full font-bold text-sm shadow-lg transform translate-y-2 group-hover:translate-y-0 transition-transform">
                                <i class="fas fa-map-marked-alt mr-2"></i> View Map
                            </button>
                        </div>
                         <!-- Placeholder Map Image -->
                        <img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Map Location" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Right Column: Contact Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white p-8 md:p-10 rounded-3xl shadow-soft h-full">
                        <h3 class="text-2xl font-bold text-brand-blue mb-2">Send us a Message</h3>
                        <p class="text-gray-500 mb-8">Fill out the form below and we'll get back to you within 24 hours.</p>

                        <form action="#" class="space-y-6">
                            <div class="grid md:grid-cols-2 gap-6">
                                <!-- Name -->
                                <div class="space-y-2">
                                    <label for="name" class="text-sm font-bold text-gray-700">Full Name</label>
                                    <input type="text" id="name" placeholder="e.g. Tunde Bakare" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-teal focus:ring-2 focus:ring-brand-teal/20 outline-none transition-all bg-gray-50">
                                </div>
                                
                                <!-- Email -->
                                <div class="space-y-2">
                                    <label for="email" class="text-sm font-bold text-gray-700">Email Address</label>
                                    <input type="email" id="email" placeholder="e.g. tunde@example.com" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-teal focus:ring-2 focus:ring-brand-teal/20 outline-none transition-all bg-gray-50">
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <!-- Phone -->
                                <div class="space-y-2">
                                    <label for="phone" class="text-sm font-bold text-gray-700">Phone Number</label>
                                    <input type="tel" id="phone" placeholder="e.g. 0801 234 5678" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-teal focus:ring-2 focus:ring-brand-teal/20 outline-none transition-all bg-gray-50">
                                </div>

                                <!-- Subject -->
                                <div class="space-y-2">
                                    <label for="subject" class="text-sm font-bold text-gray-700">Subject</label>
                                    <select id="subject" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-teal focus:ring-2 focus:ring-brand-teal/20 outline-none transition-all bg-gray-50 text-gray-600">
                                        <option>General Inquiry</option>
                                        <option>Order Issue</option>
                                        <option>Subscription Help</option>
                                        <option>Partnership Proposal</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Message -->
                            <div class="space-y-2">
                                <label for="message" class="text-sm font-bold text-gray-700">Message</label>
                                <textarea id="message" rows="6" placeholder="How can we help you today?" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-brand-teal focus:ring-2 focus:ring-brand-teal/20 outline-none transition-all bg-gray-50 resize-none"></textarea>
                            </div>

                            <!-- Submit Button -->
                            <button type="button" class="w-full md:w-auto bg-brand-teal text-white px-8 py-4 rounded-xl font-bold text-lg shadow-xl shadow-brand-teal/30 hover:bg-brand-blue hover:scale-[1.02] transition-all duration-300 flex items-center justify-center gap-2">
                                <span>Send Message</span>
                                <i class="fas fa-paper-plane text-sm"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6 max-w-4xl">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-brand-blue mb-4">Frequently Asked Questions</h2>
                <p class="text-gray-600">Quick answers to common questions about FoodBox NG.</p>
            </div>

            <div class="space-y-4">
                <!-- FAQ Item 1 -->
                <div class="border border-gray-200 rounded-2xl overflow-hidden">
                    <button class="w-full flex justify-between items-center p-6 bg-gray-50 hover:bg-brand-teal/5 transition-colors text-left focus:outline-none group" onclick="toggleFAQ(this)">
                        <span class="font-bold text-brand-blue group-hover:text-brand-teal">Do you deliver outside Abuja?</span>
                        <i class="fas fa-chevron-down text-gray-400 transition-transform group-hover:text-brand-teal"></i>
                    </button>
                    <div class="hidden p-6 pt-0 text-gray-600 leading-relaxed bg-gray-50">
                        At the moment, we are currently operating only within Abuja to ensure fast and reliable delivery service. We’ll be expanding to more cities across Nigeria very soon.
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="border border-gray-200 rounded-2xl overflow-hidden">
                    <button class="w-full flex justify-between items-center p-6 bg-gray-50 hover:bg-brand-teal/5 transition-colors text-left focus:outline-none group" onclick="toggleFAQ(this)">
                        <span class="font-bold text-brand-blue group-hover:text-brand-teal">Can I customize my monthly package?</span>
                        <i class="fas fa-chevron-down text-gray-400 transition-transform group-hover:text-brand-teal"></i>
                    </button>
                    <div class="hidden p-6 pt-0 text-gray-600 leading-relaxed bg-gray-50">
                        Yes! We are currently working on a “Build Your Own” feature that will allow you to fully customize your monthly package by selecting the exact items and quantities you want. This feature will be available soon.
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="border border-gray-200 rounded-2xl overflow-hidden">
                    <button class="w-full flex justify-between items-center p-6 bg-gray-50 hover:bg-brand-teal/5 transition-colors text-left focus:outline-none group" onclick="toggleFAQ(this)">
                        <span class="font-bold text-brand-blue group-hover:text-brand-teal">What happens if the produce isn't fresh?</span>
                        <i class="fas fa-chevron-down text-gray-400 transition-transform group-hover:text-brand-teal"></i>
                    </button>
                    <div class="hidden p-6 pt-0 text-gray-600 leading-relaxed bg-gray-50">
                        We have a "Freshness Guarantee". If any item in your box is not up to standard, simply take a photo and send it to our support team within 24 hours for a full refund or replacement.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer (Consistent) -->
    @include('layouts.footer')

    <!-- Scripts -->
    <script>
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

        // Mobile Menu
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