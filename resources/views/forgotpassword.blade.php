<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | FoodBox NG</title>

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

    <!-- Card -->
    <div class="w-full max-w-md bg-white rounded-3xl shadow-xl-heavy p-8 md:p-10 relative z-10">

        <!-- Header/Logo -->
        <div class="text-center mb-8">
            <div class="flex items-center justify-center gap-2 mb-4">
                <div class="w-12 h-12 bg-brand-teal rounded-xl flex items-center justify-center text-white shadow-lg">
                    <i class="fas fa-leaf text-xl"></i>
                </div>
                <span class="text-3xl font-extrabold text-brand-blue tracking-tight">FoodBox<span class="text-brand-teal">NG</span></span>
            </div>
            <h2 class="text-2xl font-bold text-brand-blue">Forgot Password?</h2>
            <p class="text-gray-500 text-sm mt-1">Enter your email and we'll send you a reset link.</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-4">
                <ul class="text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Alerts -->
        @if (session('status'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('status') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Forgot Password Form -->
        <form action="{{ route('forgotpassword.store') }}" method="POST" class="space-y-4">
            @csrf
            <!-- Email Input -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <div class="relative">
                    <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-brand-teal"></i>
                    <input type="email" name="email" id="email" placeholder="you@example.com" required class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:border-brand-teal focus:ring-2 focus:ring-brand-teal/20 outline-none transition-all">
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" id="sendBtn" class="w-full bg-brand-teal text-white font-bold py-3 rounded-xl hover:bg-brand-blue transition-colors shadow-lg shadow-brand-teal/30 active:translate-y-0.5">
                Send Reset Link
            </button>
        </form>

        <!-- Back to Login -->
        <div class="mt-6 text-center text-sm text-gray-600">
            Remembered your password?
            <a href="{{ route('login') }}" class="font-bold text-brand-orange hover:text-brand-red transition-colors">Back to Login</a>
        </div>
    </div>

    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            const btn = document.getElementById('sendBtn');
            btn.innerHTML = `
                <span class="flex items-center justify-center gap-2">
                    <svg class="animate-spin h-5 w-5 text-white" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" stroke="white" stroke-width="4" fill="none"/>
                    </svg>
                    Sending...
                </span>
            `;
            btn.disabled = true;
            btn.classList.add('opacity-70', 'cursor-not-allowed');
        });
    </script>
</body>
</html>