<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification | FoodBox NG</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

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

<body class="bg-brand-blue font-sans text-brand-blue antialiased min-h-screen flex items-center justify-center px-4">

    <!-- Background Pattern -->
    <div class="absolute inset-0 pattern-grid opacity-20"></div>

    <!-- Card -->
    <div class="w-full max-w-md bg-white rounded-3xl shadow-xl-heavy p-8 md:p-10 z-10">

        <!-- Header -->
        <div class="text-center mb-8">
            <div class="flex items-center justify-center gap-2 mb-4">
                <div class="w-12 h-12 bg-brand-teal rounded-xl flex items-center justify-center text-white shadow-lg">
                    <i class="fas fa-shield-halved text-xl"></i>
                </div>
                <span class="text-3xl font-extrabold text-brand-blue">
                    FoodBox<span class="text-brand-teal">NG</span>
                </span>
            </div>

            <h2 class="text-2xl font-bold text-brand-blue">OTP Verification</h2>
            <p class="text-gray-500 text-sm mt-1">
                Enter the 6-digit code sent to your email
            </p>
        </div>

        <!-- Alerts -->
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-4">
                <ul class="text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- OTP Form -->
        <form action="{{ route('otp_verify') }}" method="POST" class="space-y-5">
            @csrf

            <!-- OTP Input -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">OTP Code</label>
                <div class="relative">
                    <i class="fas fa-key absolute left-4 top-1/2 transform -translate-y-1/2 text-brand-teal"></i>
                    <input type="text" name="otp" maxlength="6" placeholder="Enter 6-digit OTP" required class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:border-brand-teal focus:ring-2 focus:ring-brand-teal/20 outline-none transition-all text-center tracking-widest text-lg font-semibold">
                </div>
            </div>

            <!-- Submit Button -->
            <button id="verifyBtn" type="submit"
                class="w-full bg-brand-teal text-white font-bold py-3 rounded-xl hover:bg-brand-blue transition-colors shadow-lg shadow-brand-teal/30 flex items-center justify-center gap-2">

                <svg id="spinner" class="w-5 h-5 animate-spin hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="white" stroke-width="4"></circle>
                    <path class="opacity-75" fill="white"
                        d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                    </path>
                </svg>

                <span id="btnText">Verify OTP</span>
            </button>
        </form>

        <!-- Resend OTP -->
        <form action="{{ route('otp_resend') }}" method="POST">
            @csrf
            <div class="mt-6 text-center text-sm text-gray-600">
                Didn’t receive the code?
                <button type="submit" class="font-bold text-brand-orange hover:text-brand-red transition-colors">
                    Resend OTP
                </button>
            </div>
        </form>
        </div>

    </div>

    <!-- Script -->
    <script>
        document.querySelector('form').addEventListener('submit', function () {
            const btn = document.getElementById('verifyBtn');
            const spinner = document.getElementById('spinner');
            const text = document.getElementById('btnText');

            spinner.classList.remove('hidden');
            text.innerText = 'Verifying...';
            btn.disabled = true;
            btn.classList.add('opacity-70', 'cursor-not-allowed');
        });
    </script>

</body>
</html>