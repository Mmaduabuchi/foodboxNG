<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Login | FoodBox NG</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Tailwind Config (Reused) -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            teal: '#2A9D8F', // Primary Action/Highlight
                            blue: '#264653', // Deep Text/Background (Admin Primary)
                            gold: '#E9C46A', // Secondary Highlight
                            orange: '#F4A261', // Tertiary/Alert
                            red: '#E76F51',   // Error/Danger
                            grey: '#F4F6F8',  // Light Background
                        }
                    },
                    boxShadow: {
                        'soft': '0 10px 40px -10px rgba(0,0,0,0.08)',
                        'sm-brand': '0 4px 6px -1px rgba(42, 157, 143, 0.1), 0 2px 4px -2px rgba(42, 157, 143, 0.1)',
                        'xl-heavy': '0 20px 60px -15px rgba(38, 70, 83, 0.2)',
                    }
                }
            }
        }
    </script>

    <style>
        /* Input field styling */
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #D1D5DB; /* Light gray border */
            border-radius: 0.75rem;
            background-color: white;
            transition: all 0.2s;
            outline: none;
        }
        .form-input:focus {
            border-color: #264653; /* Admin Blue on focus */
            box-shadow: 0 0 0 2px rgba(38, 70, 83, 0.2);
        }

        /* Hero Background Styling for a clean, branded look */
        .admin-hero {
            /* Subtle blue-grey background gradient for authority */
            background: linear-gradient(135deg, #F4F6F8 0%, #E0E7E8 100%);
        }
    </style>
</head>
<body class="admin-hero text-brand-blue antialiased min-h-screen flex items-center justify-center p-4">

    <!-- Login Card Container -->
    <div class="w-full max-w-md bg-white p-8 md:p-12 rounded-3xl shadow-xl-heavy transition-all duration-500 hover:shadow-2xl">
        
        <!-- Header / Logo -->
        <div class="text-center mb-10">
            <!-- Branded Logo from previous files -->
            <div class="flex items-center justify-center gap-2 mb-3">
                <div class="w-12 h-12 bg-brand-blue rounded-xl flex items-center justify-center text-white shadow-lg shadow-brand-blue/30">
                    <i class="fas fa-user-shield text-2xl"></i>
                </div>
                <span class="text-3xl font-extrabold text-brand-blue tracking-tight">FoodBox<span class="text-brand-teal">NG</span></span>
            </div>

            <h1 class="text-2xl font-bold text-brand-blue mt-4">Super Admin Portal</h1>
            <p class="text-gray-500 text-sm">Please enter your credentials to access the console.</p>
        </div>

        <!-- Session Alerts -->
        @if(session('error'))
            <div class="mb-6 p-4 rounded-2xl bg-red-50 border border-red-100 flex items-center gap-4 text-red-700 shadow-sm">
                <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0 text-red-600">
                    <i class="fas fa-circle-exclamation text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs uppercase tracking-wider font-bold opacity-60 mb-0.5">Error</p>
                    <p class="text-sm font-semibold">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        @if(session('success'))
            <div class="mb-6 p-4 rounded-2xl bg-brand-teal/5 border border-brand-teal/10 flex items-center gap-4 text-brand-teal shadow-sm">
                <div class="w-10 h-10 rounded-xl bg-brand-teal/10 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-check-circle text-lg"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs uppercase tracking-wider font-bold opacity-60 mb-0.5">Success</p>
                    <p class="text-sm font-semibold">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Login Form -->
        <form action="{{ route('secure.login') }}" method="POST" id="admin-login-form" class="space-y-6">
            @csrf
            
            <!-- Email/Username Field -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                <div class="relative">
                    <input type="email" id="email" name="email" placeholder="admin@foodbox.ng" class="form-input pl-11" required>
                    <i class="fas fa-user absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>
            
            <!-- Password Field -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password" placeholder="••••••••" class="form-input pl-11" required>
                    <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>


            <!-- Login Button -->
            <button type="submit" id="loginBtn" class="w-full py-3 bg-brand-blue text-white font-bold rounded-xl hover:bg-brand-blue/90 transition-all duration-300 shadow-sm-brand flex items-center justify-center gap-2 text-lg uppercase tracking-wider">
                <i class="fas fa-sign-in-alt"></i>
                <span>Login Securely</span>
            </button>
        </form>

        <!-- Footer / Disclaimer -->
        <div class="mt-8 pt-6 border-t border-gray-100 text-center">
            <p class="text-xs text-gray-400">
                Authorized access only. All activity is logged and monitored.
            </p>
        </div>

    </div>

    <!-- Custom Alert Container -->
    <div id="alert-container" class="fixed top-4 right-4 z-[100]"></div>

    <!-- JavaScript for Form Handling and Custom Alert -->
    <script>
        // Custom Alert/Message Box function
        function alertMessage(message, type = 'info') {
            const container = document.getElementById('alert-container');
            
            // Remove existing alerts
            Array.from(container.children).forEach(child => child.remove());

            const colors = {
                success: { bg: 'bg-green-100', text: 'text-green-800', icon: 'fas fa-check-circle' },
                error: { bg: 'bg-red-100', text: 'text-red-800', icon: 'fas fa-times-circle' },
                info: { bg: 'bg-blue-100', text: 'text-blue-800', icon: 'fas fa-info-circle' }
            };
            const color = colors[type] || colors.info;

            const alertDiv = document.createElement('div');
            alertDiv.className = `max-w-xs w-full p-4 rounded-xl shadow-lg ${color.bg} ${color.text} flex items-center space-x-3 transition-opacity duration-300 ease-in-out opacity-0`;
            alertDiv.innerHTML = `
                <i class="${color.icon} text-xl"></i>
                <span class="font-medium text-sm">${message}</span>
                <button onclick="this.closest('div').remove()" class="ml-auto text-current opacity-70 hover:opacity-100">
                    <i class="fas fa-times"></i>
                </button>
            `;
            
            container.appendChild(alertDiv);
            
            // Show alert
            setTimeout(() => {
                alertDiv.classList.remove('opacity-0');
            }, 10);

            // Auto-dismiss after 5 seconds
            setTimeout(() => {
                alertDiv.classList.add('opacity-0');
                setTimeout(() => alertDiv.remove(), 300);
            }, 5000);
        }

        document.getElementById('admin-login-form').addEventListener('submit', function() {
            const btn = document.getElementById('loginBtn');
            const btnText = btn.querySelector('span');
            const icon = btn.querySelector('.fa-sign-in-alt');
            
            // Disable button
            btn.disabled = true;
            btn.classList.add('opacity-70', 'cursor-not-allowed');
            
            // Change icon and text
            if (icon) {
                icon.className = 'fas fa-circle-notch fa-spin';
            }
            btnText.textContent = 'Authenticating...';
        });


    </script>
</body>
</html>