<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | FoodBox NG</title>
    
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
                        'xl-heavy': '0 20px 60px -15px rgba(38, 70, 83, 0.4)',
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
<body class="bg-brand-blue font-sans text-brand-blue antialiased selection:bg-brand-gold selection:text-brand-blue min-h-screen flex items-center justify-center py-12 px-4">

    <!-- Background Pattern -->
    <div class="absolute inset-0 pattern-grid opacity-20"></div>

    <!-- Login Card -->
    <div class="w-full max-w-md bg-white rounded-3xl shadow-xl-heavy p-8 md:p-10 relative z-10">
        
        <!-- Header/Logo -->
        <div class="text-center mb-8">
            <div class="flex items-center justify-center gap-2 mb-4">
                <div class="w-12 h-12 bg-brand-teal rounded-xl flex items-center justify-center text-white shadow-lg">
                    <i class="fas fa-leaf text-xl"></i>
                </div>
                <span class="text-3xl font-extrabold text-brand-blue tracking-tight">FoodBox<span class="text-brand-teal">NG</span></span>
            </div>
            <h2 class="text-2xl font-bold text-brand-blue">Welcome Back!</h2>
            <p class="text-gray-500 text-sm">Sign in to manage your fresh food deliveries.</p>
        </div>

        <!-- Social Login -->
        <div class="space-y-3 mb-6">
            <button class="w-full flex items-center justify-center gap-3 bg-brand-blue/5 border border-brand-blue/10 text-brand-blue font-semibold py-3 rounded-xl hover:bg-brand-teal/10 transition-colors">
                <i class="fab fa-google text-lg text-red-500"></i>
                Continue with Google
            </button>
        </div>

        <!-- Divider -->
        <div class="flex items-center mb-6">
            <div class="flex-grow border-t border-gray-200"></div>
            <span class="flex-shrink mx-4 text-gray-400 text-xs uppercase font-medium">Or log in with Email</span>
            <div class="flex-grow border-t border-gray-200"></div>
        </div>

        <!-- Alerts Section -->
        @if($errors->any())
            <div class="space-y-3 mb-6">
                @foreach($errors->all() as $error)
                    <div class="p-4 rounded-2xl bg-red-50 border border-red-100 flex items-center gap-4 text-red-700 shadow-sm animate-in fade-in slide-in-from-top-4 duration-300">
                        <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0 text-red-600">
                            <i class="fas fa-circle-exclamation text-lg"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-xs uppercase tracking-wider font-bold opacity-60 mb-0.5">Error</p>
                            <p class="text-sm font-semibold">{{ $error }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @if(session('success'))
            <div class="mb-6 p-4 rounded-2xl bg-green-50 border border-green-100 flex items-center gap-4 text-green-700 shadow-sm animate-in fade-in slide-in-from-top-4 duration-300">
                <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center flex-shrink-0 text-green-600">
                    <i class="fas fa-check-circle text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs uppercase tracking-wider font-bold opacity-60 mb-0.5">Success</p>
                    <p class="text-sm font-semibold">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Login Form -->
        <form action="{{ route('login.store') }}" method="POST" class="space-y-4">
            @csrf
            <!-- Email Input -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <div class="relative">
                    <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-brand-teal"></i>
                    <input type="email" name="email" id="email" placeholder="you@example.com" required class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:border-brand-teal focus:ring-2 focus:ring-brand-teal/20 outline-none transition-all">
                </div>
            </div>

            <!-- Password Input -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <div class="relative">
                    <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-brand-teal"></i>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required class="w-full pl-12 pr-12 py-3 border border-gray-300 rounded-xl focus:border-brand-teal focus:ring-2 focus:ring-brand-teal/20 outline-none transition-all">
                    <button type="button" onclick="toggleVisibility('password', 'toggleIcon1')" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-brand-teal transition-colors focus:outline-none">
                        <i id="toggleIcon1" class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <!-- Remember Me / Forgot Password -->
            <div class="flex justify-between items-center text-sm">
                <div class="flex items-center">
                    <input type="checkbox" id="remember" class="h-4 w-4 text-brand-teal border-gray-300 rounded focus:ring-brand-teal">
                    <label for="remember" class="ml-2 text-gray-600">Remember Me</label>
                </div>
                <a href="{{ route('forgotpassword') }}" class="font-medium text-brand-teal hover:text-brand-blue transition-colors">Forgot Password?</a>
            </div>

            <!-- Submit Button -->
            <button type="submit" id="loginBtn" class="w-full bg-brand-teal text-white font-bold py-3 rounded-xl hover:bg-brand-blue transition-colors shadow-lg shadow-brand-teal/30 active:translate-y-0.5">
                Log In
            </button>
        </form>

        <!-- Footer Link -->
        <div class="mt-6 text-center text-sm text-gray-600">
            Don't have an account? 
            <a href="{{ route('register.index') }}" class="font-bold text-brand-orange hover:text-brand-red transition-colors">Create Account</a>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function toggleVisibility(fieldId, iconId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
        
        document.querySelector('form').addEventListener('submit', function(e) {
            const btn = document.getElementById('loginBtn');
            btn.innerHTML = `
                <span class="flex items-center justify-center gap-2">
                    <svg class="animate-spin h-5 w-5 text-white" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" stroke="white" stroke-width="4" fill="none"/>
                    </svg>
                    Loading...
                </span>
            `;
            btn.disabled = true;
            btn.classList.add('opacity-70', 'cursor-not-allowed');
        });
    </script>
</body>
</html>