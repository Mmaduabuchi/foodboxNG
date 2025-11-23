<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | FoodBox NG</title>
    
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
        /* Custom Scrollbar (Same as other files) */
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

    <!-- Sign Up Card -->
    <div class="w-full max-w-md bg-white rounded-3xl shadow-xl-heavy p-8 md:p-10 relative z-10">
        
        <!-- Header/Logo -->
        <div class="text-center mb-8">
            <div class="flex items-center justify-center gap-2 mb-4">
                <div class="w-12 h-12 bg-brand-teal rounded-xl flex items-center justify-center text-white shadow-lg">
                    <i class="fas fa-leaf text-xl"></i>
                </div>
                <span class="text-3xl font-extrabold text-brand-blue tracking-tight">FoodBox<span class="text-brand-teal">NG</span></span>
            </div>
            <h2 class="text-2xl font-bold text-brand-blue">Create Your Account</h2>
            <p class="text-gray-500 text-sm">Join the FoodBox NG community and start ordering fresh.</p>
        </div>

        <!-- Social Signup -->
        <div class="space-y-3 mb-6">
            <button class="w-full flex items-center justify-center gap-3 bg-brand-blue/5 border border-brand-blue/10 text-brand-blue font-semibold py-3 rounded-xl hover:bg-brand-teal/10 transition-colors">
                <i class="fab fa-google text-lg text-red-500"></i>
                Sign Up with Google
            </button>
            <button class="w-full flex items-center justify-center gap-3 bg-brand-blue/5 border border-brand-blue/10 text-brand-blue font-semibold py-3 rounded-xl hover:bg-brand-teal/10 transition-colors">
                <i class="fab fa-facebook-f text-lg text-blue-600"></i>
                Sign Up with Facebook
            </button>
        </div>

        <!-- Divider -->
        <div class="flex items-center mb-6">
            <div class="flex-grow border-t border-gray-200"></div>
            <span class="flex-shrink mx-4 text-gray-400 text-xs uppercase font-medium">Or sign up with Email</span>
            <div class="flex-grow border-t border-gray-200"></div>
        </div>

        <!-- Sign Up Form -->
        <form class="space-y-4">
            
            <!-- Name Input -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <div class="relative">
                    <i class="fas fa-user absolute left-4 top-1/2 transform -translate-y-1/2 text-brand-teal"></i>
                    <input 
                        type="text" 
                        id="name" 
                        placeholder="John Doe"
                        required 
                        class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:border-brand-teal focus:ring-2 focus:ring-brand-teal/20 outline-none transition-all"
                    >
                </div>
            </div>

            <!-- Email Input -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <div class="relative">
                    <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-brand-teal"></i>
                    <input 
                        type="email" 
                        id="email" 
                        placeholder="you@example.com"
                        required 
                        class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:border-brand-teal focus:ring-2 focus:ring-brand-teal/20 outline-none transition-all"
                    >
                </div>
            </div>

            <!-- Password Input -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <div class="relative">
                    <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-brand-teal"></i>
                    <input 
                        type="password" 
                        id="password" 
                        placeholder="Min. 8 characters"
                        required 
                        class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:border-brand-teal focus:ring-2 focus:ring-brand-teal/20 outline-none transition-all"
                    >
                </div>
            </div>

            <!-- Terms Checkbox -->
            <div class="flex items-start text-xs pt-2">
                <input type="checkbox" id="terms" required class="h-4 w-4 text-brand-teal border-gray-300 rounded focus:ring-brand-teal mt-1">
                <label for="terms" class="ml-2 text-gray-600">
                    I agree to the <a href="foodbox_terms.html" class="font-bold text-brand-teal hover:text-brand-blue transition-colors underline">Terms of Service</a> and Privacy Policy.
                </label>
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                class="w-full bg-brand-orange text-white font-bold py-3 rounded-xl hover:bg-brand-red transition-colors shadow-lg shadow-brand-orange/30 active:translate-y-0.5 mt-6"
            >
                Create My Account
            </button>
        </form>

        <!-- Footer Link -->
        <div class="mt-6 text-center text-sm text-gray-600">
            Already have an account? 
            <a href="foodbox_login.html" class="font-bold text-brand-teal hover:text-brand-blue transition-colors">Log In</a>
        </div>
    </div>

    <!-- Note for Production Environment -->
    <!-- In a real application, you would handle the form submission and authentication logic here -->
    <script>
        // Placeholder for form submission handling
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            // In a real app, you'd send credentials to a server (e.g., Firebase Auth)
            console.log('Sign Up attempt submitted. Check console for details.');
        });
    </script>
</body>
</html>