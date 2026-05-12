<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming Soon | FoodBox NG</title>
    
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
                        'premium': '0 20px 50px -12px rgba(0,0,0,0.15)',
                    }
                }
            }
        }
    </script>

    <style>
        .hero-pattern {
            background-image: radial-gradient(#2A9D8F 1px, transparent 1px);
            background-size: 30px 30px;
            opacity: 0.05;
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .countdown-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(42, 157, 143, 0.1);
            border-radius: 1rem;
            padding: 1rem;
            box-shadow: 0 10px 40px -10px rgba(0,0,0,0.08);
            min-width: 80px;
        }
        @media (min-width: 768px) {
            .countdown-box {
                min-width: 100px;
            }
        }
    </style>
</head>
<body class="bg-brand-grey font-sans text-brand-blue antialiased overflow-hidden">

    <div class="flex flex-col lg:flex-row min-h-screen">
        
        <!-- Left Section: Content -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center p-8 md:p-16 lg:p-24 relative overflow-hidden bg-white">
            <div class="absolute inset-0 hero-pattern z-0"></div>
            
            <!-- Branding -->
            <div class="relative z-10 mb-12 animate-fade-in">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-12 h-12 bg-brand-teal rounded-xl flex items-center justify-center text-white shadow-lg group-hover:rotate-3 transition-transform">
                        <i class="fas fa-leaf text-2xl"></i>
                    </div>
                    <span class="text-3xl font-bold text-brand-blue tracking-tight">
                        FoodBox<span class="text-brand-teal">NG</span>
                    </span>
                </a>
            </div>

            <!-- Text Content -->
            <div class="relative z-10">
                <div class="inline-block px-4 py-1.5 rounded-full bg-brand-gold/10 text-brand-orange font-semibold text-sm mb-6 border border-brand-gold/20">
                    🚀 Something Delicious is Brewing
                </div>
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6 text-brand-blue">
                    Our New <span class="text-brand-teal underline decoration-brand-gold/40 underline-offset-8">Dashboard</span> <br> 
                    is Coming Soon
                </h1>
                <p class="text-lg text-gray-600 mb-10 leading-relaxed max-w-lg">
                    We're revamping our platform to give you the fastest and most seamless way to manage your food subscriptions in Nigeria. Get ready for a fresh experience!
                </p>

                <!-- Countdown Timer -->
                <div class="flex gap-3 md:gap-6 mb-12" id="countdown">
                    <div class="countdown-box">
                        <span id="days" class="text-2xl md:text-3xl font-bold text-brand-blue">00</span>
                        <span class="text-xs uppercase font-bold text-gray-400">Days</span>
                    </div>
                    <div class="countdown-box">
                        <span id="hours" class="text-2xl md:text-3xl font-bold text-brand-blue">00</span>
                        <span class="text-xs uppercase font-bold text-gray-400">Hours</span>
                    </div>
                    <div class="countdown-box">
                        <span id="minutes" class="text-2xl md:text-3xl font-bold text-brand-blue">00</span>
                        <span class="text-xs uppercase font-bold text-gray-400">Mins</span>
                    </div>
                    <div class="countdown-box">
                        <span id="seconds" class="text-2xl md:text-3xl font-bold text-brand-blue">00</span>
                        <span class="text-xs uppercase font-bold text-gray-400">Secs</span>
                    </div>
                </div>

                <!-- Notify Me Form -->
                <div class="max-w-md">
                    <p class="text-sm font-bold text-gray-500 mb-4 ml-1 italic">Want to be the first to know?</p>
                    <form action="#" class="relative">
                        <input type="email" placeholder="Enter your email address" class="w-full pl-6 pr-36 py-4 rounded-full border-2 border-brand-teal/10 focus:border-brand-teal focus:outline-none transition-colors shadow-soft">
                        <button type="submit" class="absolute right-2 top-2 bottom-2 px-6 bg-brand-teal text-white rounded-full font-bold hover:bg-brand-blue transition-all shadow-lg hover:shadow-brand-teal/30">
                            Notify Me
                        </button>
                    </form>
                </div>

                <!-- Social Links -->
                <div class="mt-12 flex items-center gap-6">
                    <span class="text-sm font-bold text-gray-400 uppercase tracking-widest">Follow Us</span>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-brand-teal/5 flex items-center justify-center text-brand-teal hover:bg-brand-teal hover:text-white transition-all">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-brand-teal/5 flex items-center justify-center text-brand-teal hover:bg-brand-teal hover:text-white transition-all">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-brand-teal/5 flex items-center justify-center text-brand-teal hover:bg-brand-teal hover:text-white transition-all">
                            <i class="fab fa-whatsapp text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Footer Text -->
            <div class="mt-auto pt-10 text-gray-400 text-sm font-medium">
                &copy; {{ date('Y') }} FoodBox NG. All rights reserved.
            </div>
        </div>

        <!-- Right Section: Image & Branding -->
        <div class="hidden lg:flex w-1/2 bg-brand-blue relative items-center justify-center overflow-hidden">
            <!-- Background Image -->
            <img src="{{ asset('assets/images/coming_soon_bg.png') }}" alt="FoodBox Fresh Food" class="absolute inset-0 w-full h-full object-cover opacity-60">
            
            <!-- Overlay Gradient -->
            <div class="absolute inset-0 bg-gradient-to-t from-brand-blue via-brand-blue/40 to-transparent"></div>

            <!-- Floating Decorative Element -->
            <div class="relative z-10 text-center px-12">
                <div class="w-24 h-24 bg-white/10 backdrop-blur-xl rounded-3xl mx-auto mb-8 flex items-center justify-center animate-float border border-white/20">
                    <i class="fas fa-box-open text-white text-5xl"></i>
                </div>
                <h2 class="text-4xl font-bold text-white mb-4">Quality Freshness</h2>
                <p class="text-white/70 text-lg max-w-xs mx-auto">Sourced from the best farms in Nigeria, delivered directly to you.</p>
                
                <!-- Trust Badge -->
                <div class="mt-12 flex items-center justify-center gap-8">
                    <div class="text-center">
                        <p class="text-3xl font-bold text-brand-gold">2k+</p>
                        <p class="text-xs text-white/50 uppercase font-bold tracking-widest mt-1">Families</p>
                    </div>
                    <div class="w-px h-10 bg-white/20"></div>
                    <div class="text-center">
                        <p class="text-3xl font-bold text-brand-gold">24h</p>
                        <p class="text-xs text-white/50 uppercase font-bold tracking-widest mt-1">Delivery</p>
                    </div>
                </div>
            </div>
            
            <!-- Abstract Shapes -->
            <div class="absolute -top-20 -right-20 w-80 h-80 bg-brand-teal/20 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-brand-gold/20 rounded-full blur-3xl"></div>
        </div>
    </div>

    <!-- Countdown Script -->
    <script>
        // Set the date we're counting down to (e.g., 14 days from now)
        const countdownDate = new Date();
        countdownDate.setDate(countdownDate.getDate() + 14);
        countdownDate.setHours(23, 59, 59);

        const updateCountdown = () => {
            const now = new Date().getTime();
            const distance = countdownDate.getTime() - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("days").innerText = days.toString().padStart(2, '0');
            document.getElementById("hours").innerText = hours.toString().padStart(2, '0');
            document.getElementById("minutes").innerText = minutes.toString().padStart(2, '0');
            document.getElementById("seconds").innerText = seconds.toString().padStart(2, '0');

            if (distance < 0) {
                clearInterval(interval);
                document.getElementById("countdown").innerHTML = "<div class='text-brand-teal font-bold text-2xl'>WE ARE LIVE!</div>";
            }
        };

        updateCountdown();
        const interval = setInterval(updateCountdown, 1000);
    </script>
</body>
</html>
