<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Subscription | FoodBox NG</title>
    <meta name="description" content="Manage your FoodBox NG subscription — upgrade, pause, or cancel your plan and update delivery preferences.">
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
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
                        'sm-brand': '0 4px 6px -1px rgba(42, 157, 143, 0.1), 0 2px 4px -2px rgba(42, 157, 143, 0.1)',
                        'xl-heavy': '0 20px 60px -15px rgba(38, 70, 83, 0.2)',
                    }
                }
            }
        }
    </script>

    <style>
        /* ── Custom Scrollbar ── */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #E0E7E8; }
        ::-webkit-scrollbar-thumb { background: #2A9D8F; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #264653; }

        /* ── Sidebar ── */
        #sidebar {
            transition: transform 0.3s ease-in-out;
            z-index: 50;
        }
        @media (max-width: 1023px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.open { transform: translateX(0); }
        }
        @media (min-width: 1024px) {
            #sidebar { transform: translateX(0); }
        }
        #backdrop { transition: opacity 0.3s ease-in-out; }

        /* ── Layout ── */
        .main-content { padding-top: 5rem; }

        /* ── Nav active state ── */
        .nav-link.active {
            background-color: #2A9D8F;
            color: white;
            box-shadow: 0 5px 15px -5px rgba(42, 157, 143, 0.4);
        }
        .nav-link.active i { color: #E9C46A; }

        /* ── Plan Card ── */
        .plan-card {
            background: linear-gradient(135deg, #264653 0%, #2A9D8F 100%);
            position: relative;
            overflow: hidden;
        }
        .plan-card::before {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 220px; height: 220px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
        }
        .plan-card::after {
            content: '';
            position: absolute;
            bottom: -80px; left: -40px;
            width: 260px; height: 260px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
        }

        /* ── Progress bar animation ── */
        @keyframes progressFill {
            from { width: 0%; }
            to   { width: var(--progress-width, 65%); }
        }
        .progress-bar-fill {
            animation: progressFill 1.2s ease-out forwards;
        }

        /* ── Stat cards hover ── */
        .stat-card {
            transition: all 0.25s ease;
        }
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px -10px rgba(38,70,83,0.12);
        }

        /* ── Feature item ── */
        .feature-item { transition: background-color 0.2s; }
        .feature-item:hover { background-color: #F4F6F8; }

        /* ── Action buttons ── */
        .action-btn {
            transition: all 0.25s ease;
        }
        .action-btn:hover { transform: translateY(-2px); }

        /* ── Modal backdrop ── */
        .modal-overlay {
            transition: opacity 0.3s ease;
        }
        .modal-overlay.hidden { opacity: 0; pointer-events: none; }
        .modal-box {
            transition: transform 0.3s ease, opacity 0.3s ease;
        }
        .modal-overlay.hidden .modal-box {
            transform: scale(0.95);
            opacity: 0;
        }

        /* ── Delivery pref radio buttons ── */
        .freq-option input[type="radio"]:checked + label,
        .freq-option input[type="radio"]:checked + label * {
            color: #2A9D8F;
        }
        .freq-option input[type="radio"]:checked + label {
            border-color: #2A9D8F;
            background-color: rgba(42,157,143,0.08);
        }

        /* ── Toggle switch ── */
        .toggle-track {
            width: 44px; height: 24px;
            background: #D1D5DB;
            border-radius: 12px;
            position: relative;
            cursor: pointer;
            transition: background 0.3s;
        }
        .toggle-track.on { background: #2A9D8F; }
        .toggle-thumb {
            width: 18px; height: 18px;
            border-radius: 50%;
            background: #fff;
            position: absolute;
            top: 3px; left: 3px;
            transition: left 0.3s;
            box-shadow: 0 1px 4px rgba(0,0,0,0.2);
        }
        .toggle-track.on .toggle-thumb { left: 23px; }

        /* ── Timeline ── */
        .timeline-item:not(:last-child)::after {
            content: '';
            display: block;
            width: 2px;
            height: 100%;
            background: #E5E7EB;
            position: absolute;
            left: 11px;
            top: 28px;
        }
    </style>
</head>
<body class="bg-brand-grey text-brand-blue antialiased min-h-screen">

    @include('dashboard.header')

    <!-- ═══════════════════════════════════  MAIN CONTENT  ═══════════════════════════════════ -->
    <main class="p-4 mt-20 md:p-8 lg:ml-64 main-content">

        <!-- ── Page Header ── -->
        <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-brand-blue mb-1">Manage Subscription</h1>
                <p class="text-gray-500">Review your current plan, update preferences, and control your subscription.</p>
            </div>
            <a href="#" class="inline-flex items-center gap-2 bg-brand-teal text-white px-5 py-2.5 rounded-xl font-semibold text-sm shadow-sm-brand hover:bg-brand-teal/90 transition-colors action-btn">
                <i class="fas fa-arrow-up"></i> Upgrade Plan
            </a>
        </div>

        <!-- ═══════════ SECTION 1: Active Plan Hero Card ═══════════ -->
        <div class="plan-card rounded-3xl p-6 md:p-8 mb-8 shadow-xl-heavy">
            <div class="relative z-10 flex flex-col lg:flex-row justify-between items-start gap-6">

                <!-- Left: plan info -->
                <div class="flex-grow">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-white/15 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                            <i class="fas fa-crown text-brand-gold text-xl"></i>
                        </div>
                        <div>
                            <span class="text-xs font-semibold text-white/60 uppercase tracking-widest">Current Plan</span>
                            <h2 class="text-2xl font-extrabold text-white leading-tight">
                                {{ $activeSubscription->package->name ?? 'Premium Monthly Box' }}
                            </h2>
                        </div>
                    </div>

                    <!-- Price & billing -->
                    <div class="flex flex-wrap items-baseline gap-2 mb-5">
                        <span class="text-4xl font-extrabold text-white">
                            ₦{{ number_format($activeSubscription->package->price ?? 45000, 2) }}
                        </span>
                        <span class="text-white/60 text-base">
                            / {{ $activeSubscription->package->billing_cycle ?? 'month' }}
                        </span>
                        <span class="ml-2 px-3 py-1 bg-brand-gold text-brand-blue text-xs font-bold rounded-full shadow-sm">
                            {{ ucfirst($activeSubscription->status ?? 'Active') }}
                        </span>
                    </div>

                    <!-- Meta pills -->
                    <div class="flex flex-wrap gap-3 text-sm">
                        <span class="flex items-center gap-1.5 bg-white/10 text-white/90 px-3 py-1.5 rounded-full backdrop-blur-sm">
                            <i class="fas fa-calendar-alt text-brand-gold text-xs"></i>
                            Next renewal: <strong>{{ $activeSubscription->next_renewal_date ? \Carbon\Carbon::parse($activeSubscription->next_renewal_date)->format('M d, Y') : 'May 28, 2026' }}</strong>
                        </span>
                        <span class="flex items-center gap-1.5 bg-white/10 text-white/90 px-3 py-1.5 rounded-full backdrop-blur-sm">
                            <i class="fas fa-truck text-brand-gold text-xs"></i>
                            {{ ucfirst($activeSubscription->delivery_frequency ?? 'Weekly') }} delivery
                        </span>
                        <span class="flex items-center gap-1.5 bg-white/10 text-white/90 px-3 py-1.5 rounded-full backdrop-blur-sm">
                            <i class="fas fa-map-marker-alt text-brand-gold text-xs"></i>
                            {{ $activeSubscription->delivery_zone ?? 'Lagos Island' }}
                        </span>
                    </div>
                </div>

                <!-- Right: billing cycle progress -->
                <div class="w-full lg:w-56 bg-white/10 rounded-2xl p-5 backdrop-blur-sm flex-shrink-0">
                    <p class="text-xs font-semibold text-white/60 uppercase tracking-wide mb-2">Billing Cycle Progress</p>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-semibold text-white">Apr 28</span>
                        <span class="text-sm font-semibold text-white">May 28</span>
                    </div>
                    <div class="h-2.5 bg-white/20 rounded-full overflow-hidden mb-3">
                        <div class="h-full bg-brand-gold rounded-full progress-bar-fill" style="--progress-width: 3%"></div>
                    </div>
                    <p class="text-white/70 text-xs text-center">1 day used • 30 days total</p>

                    <div class="mt-4 pt-4 border-t border-white/10 space-y-1">
                        <div class="flex justify-between text-xs text-white/70">
                            <span>Deliveries this cycle</span>
                            <span class="font-semibold text-white">1 / 4</span>
                        </div>
                        <div class="flex justify-between text-xs text-white/70">
                            <span>Auto-renew</span>
                            <span class="font-semibold text-brand-gold">On</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ═══════════ SECTION 2: Quick Stats ═══════════ -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">

            <div class="stat-card bg-white rounded-2xl p-5 shadow-soft flex items-center gap-4">
                <div class="w-11 h-11 bg-brand-teal/10 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-box text-brand-teal"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Total Deliveries</p>
                    <p class="text-2xl font-bold text-brand-blue">{{ $totalDeliveries ?? 18 }}</p>
                </div>
            </div>

            <div class="stat-card bg-white rounded-2xl p-5 shadow-soft flex items-center gap-4">
                <div class="w-11 h-11 bg-brand-gold/20 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-calendar-check text-brand-gold"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Months Active</p>
                    <p class="text-2xl font-bold text-brand-blue">{{ $monthsActive ?? 5 }}</p>
                </div>
            </div>

            <div class="stat-card bg-white rounded-2xl p-5 shadow-soft flex items-center gap-4">
                <div class="w-11 h-11 bg-brand-orange/10 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-coins text-brand-orange"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Total Spent</p>
                    <p class="text-lg font-bold text-brand-blue">₦{{ number_format($totalSpent ?? 225000) }}</p>
                </div>
            </div>

            <div class="stat-card bg-white rounded-2xl p-5 shadow-soft flex items-center gap-4">
                <div class="w-11 h-11 bg-brand-red/10 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-clock text-brand-red"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Days to Renewal</p>
                    <p class="text-2xl font-bold text-brand-blue">{{ $daysToRenewal ?? 29 }}</p>
                </div>
            </div>

        </div>

        <!-- ═══════════ SECTION 3: Plan Details + Actions Row ═══════════ -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

            <!-- What's Included -->
            <div class="lg:col-span-2 bg-white rounded-3xl shadow-soft p-6 md:p-8">
                <h3 class="text-xl font-bold text-brand-blue mb-5 flex items-center gap-2">
                    <i class="fas fa-list-check text-brand-teal"></i> What's Included in Your Plan
                </h3>

                <div class="space-y-1">
                    @php
                        $features = [
                            ['icon' => 'fa-drumstick-bite',  'color' => 'text-brand-teal',   'label' => 'Fresh protein (chicken, fish, or beef)',       'included' => true],
                            ['icon' => 'fa-seedling',        'color' => 'text-green-500',     'label' => 'Seasonal vegetables & greens',                 'included' => true],
                            ['icon' => 'fa-bread-slice',     'color' => 'text-brand-gold',    'label' => 'Artisanal grains & staples',                   'included' => true],
                            ['icon' => 'fa-cookie-bite',     'color' => 'text-brand-orange',  'label' => 'Weekly snacks & extras',                       'included' => true],
                            ['icon' => 'fa-truck-fast',      'color' => 'text-brand-teal',    'label' => 'Free delivery to your zone',                   'included' => true],
                            ['icon' => 'fa-phone-alt',       'color' => 'text-brand-blue',    'label' => 'Dedicated customer support',                   'included' => true],
                            ['icon' => 'fa-gift',            'color' => 'text-brand-gold',    'label' => 'Monthly loyalty rewards',                      'included' => true],
                            ['icon' => 'fa-concierge-bell',  'color' => 'text-gray-400',      'label' => 'Chef specialty add-ons (Enterprise only)',   'included' => false],
                        ];
                    @endphp

                    @foreach($features as $feature)
                    <div class="feature-item flex items-center gap-3 px-3 py-3 rounded-xl">
                        <div class="w-8 h-8 rounded-lg {{ $feature['included'] ? 'bg-brand-teal/10' : 'bg-gray-100' }} flex items-center justify-center flex-shrink-0">
                            <i class="fas {{ $feature['icon'] }} text-sm {{ $feature['included'] ? $feature['color'] : 'text-gray-400' }}"></i>
                        </div>
                        <span class="text-sm font-medium {{ $feature['included'] ? 'text-brand-blue' : 'text-gray-400' }} flex-grow">
                            {{ $feature['label'] }}
                        </span>
                        <i class="fas {{ $feature['included'] ? 'fa-check-circle text-brand-teal' : 'fa-times-circle text-gray-300' }} text-base flex-shrink-0"></i>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Quick Actions Panel -->
            <div class="flex flex-col gap-4">

                <!-- Auto-Renew Toggle -->
                <div class="bg-white rounded-2xl shadow-soft p-5">
                    <div class="flex items-center justify-between mb-1">
                        <div>
                            <h4 class="font-bold text-brand-blue text-sm">Auto-Renew</h4>
                            <p class="text-xs text-gray-500 mt-0.5">Renews automatically on billing date</p>
                        </div>
                        <button id="autoRenewToggle" class="toggle-track on" onclick="toggleAutoRenew(this)" aria-label="Toggle auto-renew">
                            <div class="toggle-thumb"></div>
                        </button>
                    </div>
                </div>

                <!-- Delivery Notifications Toggle -->
                <div class="bg-white rounded-2xl shadow-soft p-5">
                    <div class="flex items-center justify-between mb-1">
                        <div>
                            <h4 class="font-bold text-brand-blue text-sm">Delivery Alerts</h4>
                            <p class="text-xs text-gray-500 mt-0.5">SMS & email when your box ships</p>
                        </div>
                        <button id="alertToggle" class="toggle-track on" onclick="toggleAutoRenew(this)" aria-label="Toggle delivery alerts">
                            <div class="toggle-thumb"></div>
                        </button>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="bg-white rounded-2xl shadow-soft p-5 space-y-3">
                    <h4 class="font-bold text-brand-blue text-sm mb-3">Subscription Actions</h4>

                    <button onclick="openModal('changeFreqModal')"
                        class="action-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl bg-brand-teal/10 text-brand-teal font-semibold text-sm hover:bg-brand-teal/20 transition-colors">
                        <i class="fas fa-calendar-alt w-4 text-center"></i>
                        Change Delivery Frequency
                    </button>

                    <button onclick="openModal('pauseModal')"
                        class="action-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl bg-brand-orange/10 text-brand-orange font-semibold text-sm hover:bg-brand-orange/20 transition-colors">
                        <i class="fas fa-pause-circle w-4 text-center"></i>
                        Pause Subscription
                    </button>

                    <button onclick="openModal('cancelModal')"
                        class="action-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl bg-brand-red/10 text-brand-red font-semibold text-sm hover:bg-brand-red/20 transition-colors">
                        <i class="fas fa-times-circle w-4 text-center"></i>
                        Cancel Subscription
                    </button>
                </div>

            </div>
        </div>

        <!-- ═══════════ SECTION 4: Delivery Preferences Card ═══════════ -->
        <div class="bg-white rounded-3xl shadow-soft p-6 md:p-8 mb-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-3">
                <h3 class="text-xl font-bold text-brand-blue flex items-center gap-2">
                    <i class="fas fa-sliders-h text-brand-teal"></i> Delivery Preferences
                </h3>
                <button id="savePrefsBtn" onclick="savePreferences()" class="action-btn inline-flex items-center gap-2 bg-brand-teal text-white px-5 py-2 rounded-xl font-semibold text-sm shadow-sm-brand hover:bg-brand-teal/90 transition-colors">
                    <i class="fas fa-save"></i> Save Preferences
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- Delivery Frequency -->
                <div>
                    <label class="block text-sm font-semibold text-brand-blue mb-3">Delivery Frequency</label>
                    <div class="space-y-3">
                        @php
                            $frequencies = [
                                ['value' => 'weekly',    'label' => 'Weekly',    'sub' => '4× deliveries per month', 'icon' => 'fa-bolt'],
                                // ['value' => 'biweekly',  'label' => 'Bi-Weekly', 'sub' => '2× deliveries per month', 'icon' => 'fa-calendar-week'],
                                ['value' => 'monthly',   'label' => 'Monthly',   'sub' => '1× delivery per month',   'icon' => 'fa-calendar'],
                            ];
                            $currentFreq = $activeSubscription->delivery_frequency ?? 'weekly';
                        @endphp
                        @foreach($frequencies as $freq)
                        <div class="freq-option">
                            <input type="radio" name="delivery_frequency" id="freq_{{ $freq['value'] }}"
                                value="{{ $freq['value'] }}" class="sr-only"
                                {{ $currentFreq === $freq['value'] ? 'checked' : '' }}>
                            <label for="freq_{{ $freq['value'] }}"
                                class="flex items-center gap-4 p-4 rounded-xl border-2 cursor-pointer transition-all
                                    {{ $currentFreq === $freq['value'] ? 'border-brand-teal bg-brand-teal/8' : 'border-gray-200 hover:border-brand-teal/40' }}">
                                <div class="w-9 h-9 rounded-lg {{ $currentFreq === $freq['value'] ? 'bg-brand-teal/15' : 'bg-brand-grey' }} flex items-center justify-center flex-shrink-0">
                                    <i class="fas {{ $freq['icon'] }} text-sm {{ $currentFreq === $freq['value'] ? 'text-brand-teal' : 'text-gray-400' }}"></i>
                                </div>
                                <div class="flex-grow">
                                    <p class="font-semibold text-brand-blue text-sm">{{ $freq['label'] }}</p>
                                    <p class="text-xs text-gray-500">{{ $freq['sub'] }}</p>
                                </div>
                                <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center flex-shrink-0
                                    {{ $currentFreq === $freq['value'] ? 'border-brand-teal' : 'border-gray-300' }}">
                                    @if($currentFreq === $freq['value'])
                                        <div class="w-2.5 h-2.5 rounded-full bg-brand-teal"></div>
                                    @endif
                                </div>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Delivery Zone & Window -->
                <div class="space-y-5">
                    <div>
                        <label for="deliveryZone" class="block text-sm font-semibold text-brand-blue mb-2">Delivery Zone</label>
                        <div class="relative">
                            <i class="fas fa-map-marker-alt absolute left-4 top-1/2 -translate-y-1/2 text-brand-teal"></i>
                            <select id="deliveryZone" name="delivery_zone"
                                class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl bg-white text-brand-blue focus:border-brand-teal focus:outline-none focus:ring-2 focus:ring-brand-teal/20 transition-all text-sm font-medium cursor-pointer">
                                @php
                                    $zones = ['Lagos Island', 'Lekki / Ajah', 'Victoria Island', 'Ikeja', 'Surulere', 'Ikorodu', 'Abuja — Wuse', 'Abuja — Garki', 'Port Harcourt'];
                                    $currentZone = $activeSubscription->delivery_zone ?? 'Lagos Island';
                                @endphp
                                @foreach($zones as $zone)
                                    <option value="{{ $zone }}" {{ $currentZone === $zone ? 'selected' : '' }}>{{ $zone }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="deliveryWindow" class="block text-sm font-semibold text-brand-blue mb-2">Preferred Delivery Window</label>
                        <div class="relative">
                            <i class="fas fa-clock absolute left-4 top-1/2 -translate-y-1/2 text-brand-teal"></i>
                            <select id="deliveryWindow" name="delivery_window"
                                class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl bg-white text-brand-blue focus:border-brand-teal focus:outline-none focus:ring-2 focus:ring-brand-teal/20 transition-all text-sm font-medium cursor-pointer">
                                <option value="morning">Morning (8:00 AM – 12:00 PM)</option>
                                <option value="afternoon" selected>Afternoon (12:00 PM – 4:00 PM)</option>
                                <option value="evening">Evening (4:00 PM – 8:00 PM)</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="specialNotes" class="block text-sm font-semibold text-brand-blue mb-2">Special Instructions</label>
                        <textarea id="specialNotes" name="special_notes" rows="3"
                            placeholder="E.g. Leave at gate, call before arrival, no beef…"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl bg-white text-brand-blue focus:border-brand-teal focus:outline-none focus:ring-2 focus:ring-brand-teal/20 transition-all text-sm resize-none">{{ $activeSubscription->special_notes ?? '' }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- ═══════════ SECTION 5: Billing History Timeline ═══════════ -->
        <div class="bg-white rounded-3xl shadow-soft p-6 md:p-8 mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
                <h3 class="text-xl font-bold text-brand-blue flex items-center gap-2">
                    <i class="fas fa-history text-brand-teal"></i> Recent Billing History
                </h3>
                <a href="{{ route('payment_history') }}" class="text-sm font-semibold text-brand-teal hover:underline flex items-center gap-1">
                    View All <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>

            <div class="space-y-0">
                @php
                    $billingHistory = [
                        ['date' => 'Apr 28, 2026', 'amount' => 45000, 'status' => 'paid',    'desc' => 'Premium Monthly Box — April',  'ref' => 'TXN-20260428'],
                        ['date' => 'Mar 28, 2026', 'amount' => 45000, 'status' => 'paid',    'desc' => 'Premium Monthly Box — March',  'ref' => 'TXN-20260328'],
                        ['date' => 'Feb 28, 2026', 'amount' => 45000, 'status' => 'paid',    'desc' => 'Premium Monthly Box — February','ref'=> 'TXN-20260228'],
                        ['date' => 'Jan 28, 2026', 'amount' => 45000, 'status' => 'paid',    'desc' => 'Premium Monthly Box — January', 'ref' => 'TXN-20260128'],
                        ['date' => 'Dec 28, 2025', 'amount' => 45000, 'status' => 'paid',    'desc' => 'Premium Monthly Box — December','ref'=> 'TXN-20251228'],
                    ];
                @endphp
                @foreach($billingHistory as $i => $bill)
                <div class="timeline-item relative flex gap-4 items-start py-4 {{ $i !== count($billingHistory)-1 ? 'border-b border-gray-100' : '' }}">
                    <!-- Dot -->
                    <div class="flex-shrink-0 w-6 h-6 rounded-full mt-0.5
                        {{ $bill['status'] === 'paid' ? 'bg-brand-teal' : ($bill['status'] === 'failed' ? 'bg-brand-red' : 'bg-brand-orange') }}
                        flex items-center justify-center shadow-sm">
                        <i class="fas {{ $bill['status'] === 'paid' ? 'fa-check' : ($bill['status'] === 'failed' ? 'fa-times' : 'fa-clock') }} text-white text-[9px]"></i>
                    </div>
                    <!-- Info -->
                    <div class="flex-grow min-w-0">
                        <p class="text-sm font-semibold text-brand-blue">{{ $bill['desc'] }}</p>
                        <p class="text-xs text-gray-500 mt-0.5">{{ $bill['date'] }} · Ref: <span class="font-mono">{{ $bill['ref'] }}</span></p>
                    </div>
                    <!-- Amount & badge -->
                    <div class="flex flex-col items-end gap-1 flex-shrink-0">
                        <span class="text-sm font-bold text-brand-blue">₦{{ number_format($bill['amount']) }}</span>
                        <span class="px-2 py-0.5 text-xs font-semibold rounded-full
                            {{ $bill['status'] === 'paid' ? 'bg-brand-teal/10 text-brand-teal' : ($bill['status'] === 'failed' ? 'bg-brand-red/10 text-brand-red' : 'bg-brand-orange/10 text-brand-orange') }}">
                            {{ ucfirst($bill['status']) }}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- ═══════════ SECTION 6: Explore Plans CTA ═══════════ -->
        <!-- <section class="mb-8 p-6 md:p-8 bg-brand-blue rounded-3xl text-white flex flex-col md:flex-row items-center justify-between shadow-xl-heavy gap-6">
            <div>
                <h3 class="text-xl font-bold flex items-center gap-2 mb-1">
                    <i class="fas fa-tag text-brand-gold"></i> Ready to Elevate Your Experience?
                </h3>
                <p class="text-white/70 text-sm">Upgrade to our Enterprise plan and unlock chef's specials, priority delivery, and more.</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                <button class="action-btn w-full md:w-auto bg-brand-teal text-white px-6 py-3 rounded-xl font-bold shadow-md shadow-brand-teal/40 hover:bg-brand-teal/90 transition-colors flex items-center justify-center gap-2">
                    <i class="fas fa-crown text-brand-gold"></i> Upgrade to Enterprise
                </button>
                <button class="action-btn w-full md:w-auto border border-white/30 text-white/80 px-6 py-3 rounded-xl font-semibold text-sm hover:bg-white/10 transition-colors flex items-center justify-center gap-2">
                    <i class="fas fa-info-circle"></i> Compare Plans
                </button>
            </div>
        </section> -->

        <div class="h-12"></div>
    </main>


    <!-- ══════════════════════  MODALS  ══════════════════════ -->

    <!-- Pause Modal -->
    <div id="pauseModal" class="modal-overlay hidden fixed inset-0 bg-black/50 z-[100] flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="modal-box bg-white rounded-3xl shadow-xl-heavy w-full max-w-md p-8">
            <div class="flex items-center gap-4 mb-5">
                <div class="w-14 h-14 bg-brand-orange/10 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-pause-circle text-3xl text-brand-orange"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-brand-blue">Pause Subscription</h3>
                    <p class="text-sm text-gray-500">Your deliveries will be held temporarily.</p>
                </div>
            </div>
            <p class="text-sm text-gray-600 mb-5 bg-brand-grey rounded-xl p-4">
                <i class="fas fa-info-circle text-brand-teal mr-2"></i>
                Pausing stops future deliveries but keeps your account active. You can resume at any time and pick up from your next billing date. <strong>You won't be charged while paused.</strong>
            </p>
            <div class="mb-5">
                <label class="block text-sm font-semibold text-brand-blue mb-2">Pause Duration</label>
                <select class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-brand-blue focus:border-brand-teal focus:outline-none transition-all text-sm">
                    <option>1 week</option>
                    <option>2 weeks</option>
                    <option selected>1 month</option>
                    <option>2 months</option>
                    <option>Until I resume manually</option>
                </select>
            </div>
            <div class="flex gap-3">
                <button onclick="closeModal('pauseModal')" class="flex-1 py-3 rounded-xl border-2 border-gray-200 text-brand-blue font-semibold text-sm hover:bg-brand-grey transition-colors">Cancel</button>
                <button class="flex-1 py-3 rounded-xl bg-brand-orange text-white font-semibold text-sm hover:bg-brand-orange/90 transition-colors shadow-md shadow-brand-orange/30">
                    <i class="fas fa-pause mr-2"></i> Pause Now
                </button>
            </div>
        </div>
    </div>

    <!-- Cancel Modal -->
    <div id="cancelModal" class="modal-overlay hidden fixed inset-0 bg-black/50 z-[100] flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="modal-box bg-white rounded-3xl shadow-xl-heavy w-full max-w-md p-8">
            <div class="flex items-center gap-4 mb-5">
                <div class="w-14 h-14 bg-brand-red/10 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-times-circle text-3xl text-brand-red"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-brand-blue">Cancel Subscription</h3>
                    <p class="text-sm text-gray-500">This action cannot be undone.</p>
                </div>
            </div>
            <div class="bg-brand-red/5 border border-brand-red/20 rounded-xl p-4 mb-5 text-sm text-brand-red space-y-1">
                <p><i class="fas fa-exclamation-triangle mr-2"></i><strong>You will lose access to:</strong></p>
                <ul class="list-disc list-inside text-gray-600 ml-4 mt-1 space-y-0.5">
                    <li>All remaining deliveries this cycle</li>
                    <li>Your loyalty rewards balance</li>
                    <li>Locked-in pricing on your current plan</li>
                </ul>
            </div>
            <div class="mb-5">
                <label class="block text-sm font-semibold text-brand-blue mb-2">Please tell us why you're leaving</label>
                <select class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-brand-blue focus:border-brand-red focus:outline-none transition-all text-sm">
                    <option>Too expensive</option>
                    <option>Deliveries are late</option>
                    <option>Quality issues</option>
                    <option>No longer need the service</option>
                    <option>Switching to another service</option>
                    <option>Other reason</option>
                </select>
            </div>
            <div class="flex gap-3">
                <button onclick="closeModal('cancelModal')" class="flex-1 py-3 rounded-xl border-2 border-gray-200 text-brand-blue font-semibold text-sm hover:bg-brand-grey transition-colors">Keep Plan</button>
                <button class="flex-1 py-3 rounded-xl bg-brand-red text-white font-semibold text-sm hover:bg-brand-red/90 transition-colors shadow-md shadow-brand-red/30">
                    <i class="fas fa-times mr-2"></i> Cancel Subscription
                </button>
            </div>
        </div>
    </div>

    <!-- Change Frequency Modal -->
    <div id="changeFreqModal" class="modal-overlay hidden fixed inset-0 bg-black/50 z-[100] flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="modal-box bg-white rounded-3xl shadow-xl-heavy w-full max-w-md p-8">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-14 h-14 bg-brand-teal/10 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-calendar-alt text-3xl text-brand-teal"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-brand-blue">Change Frequency</h3>
                    <p class="text-sm text-gray-500">Takes effect from your next billing cycle.</p>
                </div>
            </div>
            <div class="space-y-3 mb-6">
                @foreach($frequencies as $freq)
                <label for="modal_freq_{{ $freq['value'] }}"
                    class="flex items-center gap-4 p-4 rounded-xl border-2 border-gray-200 cursor-pointer hover:border-brand-teal/50 transition-all has-[:checked]:border-brand-teal has-[:checked]:bg-brand-teal/5">
                    <input type="radio" id="modal_freq_{{ $freq['value'] }}" name="modal_freq" value="{{ $freq['value'] }}"
                        class="accent-[#2A9D8F] w-4 h-4 flex-shrink-0"
                        {{ $currentFreq === $freq['value'] ? 'checked' : '' }}>
                    <div>
                        <p class="font-semibold text-brand-blue text-sm">{{ $freq['label'] }}</p>
                        <p class="text-xs text-gray-500">{{ $freq['sub'] }}</p>
                    </div>
                </label>
                @endforeach
            </div>
            <div class="flex gap-3">
                <button onclick="closeModal('changeFreqModal')" class="flex-1 py-3 rounded-xl border-2 border-gray-200 text-brand-blue font-semibold text-sm hover:bg-brand-grey transition-colors">Cancel</button>
                <button class="flex-1 py-3 rounded-xl bg-brand-teal text-white font-semibold text-sm hover:bg-brand-teal/90 transition-colors shadow-sm-brand">
                    <i class="fas fa-check mr-2"></i> Apply Change
                </button>
            </div>
        </div>
    </div>


    <!-- ══════════════════════  SCRIPTS  ══════════════════════ -->
    <script>
        // ── Sidebar Toggle ──
        const sidebar     = document.getElementById('sidebar');
        const menuToggle  = document.getElementById('menu-toggle');
        const backdrop    = document.getElementById('backdrop');

        function toggleSidebar() {
            const isOpen = sidebar.classList.toggle('open');
            backdrop.classList.toggle('hidden', !isOpen);
            if (isOpen) {
                backdrop.offsetWidth;
                backdrop.classList.remove('opacity-0');
            } else {
                backdrop.classList.add('opacity-0');
            }
        }

        menuToggle.addEventListener('click', toggleSidebar);
        backdrop.addEventListener('click', toggleSidebar);

        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024) { setTimeout(() => toggleSidebar(), 150); }
            });
        });

        // ── Modals ──
        function openModal(id) {
            const el = document.getElementById(id);
            el.classList.remove('hidden');
            setTimeout(() => el.classList.add('opacity-100'), 10);
        }
        function closeModal(id) {
            const el = document.getElementById(id);
            el.classList.add('hidden');
        }
        // Close on backdrop click
        document.querySelectorAll('.modal-overlay').forEach(overlay => {
            overlay.addEventListener('click', e => {
                if (e.target === overlay) closeModal(overlay.id);
            });
        });

        // ── Toggle switches ──
        function toggleAutoRenew(btn) {
            btn.classList.toggle('on');
        }

        // ── Delivery frequency radio — highlight label on click ──
        document.querySelectorAll('.freq-option input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', () => {
                document.querySelectorAll('.freq-option label').forEach(lbl => {
                    lbl.classList.remove('border-brand-teal', 'bg-brand-teal/8');
                    lbl.classList.add('border-gray-200');
                    const icon = lbl.querySelector('div:first-child');
                    icon.className = icon.className.replace('bg-brand-teal/15', 'bg-brand-grey');
                    const iconEl = icon.querySelector('i');
                    if (iconEl) { iconEl.classList.remove('text-brand-teal'); iconEl.classList.add('text-gray-400'); }
                    const dot  = lbl.querySelector('.rounded-full.border-2');
                    if (dot) { dot.classList.remove('border-brand-teal'); dot.classList.add('border-gray-300'); dot.innerHTML = ''; }
                });
                const lbl  = radio.nextElementSibling;
                lbl.classList.add('border-brand-teal', 'bg-brand-teal/8');
                lbl.classList.remove('border-gray-200');
                const icon = lbl.querySelector('div:first-child');
                icon.className = icon.className.replace('bg-brand-grey', 'bg-brand-teal/15');
                const iconEl = icon.querySelector('i');
                if (iconEl) { iconEl.classList.remove('text-gray-400'); iconEl.classList.add('text-brand-teal'); }
                const dot = lbl.querySelector('.rounded-full.border-2');
                if (dot) {
                    dot.classList.add('border-brand-teal');
                    dot.classList.remove('border-gray-300');
                    dot.innerHTML = '<div class="w-2.5 h-2.5 rounded-full bg-brand-teal"></div>';
                }
            });
        });

        function savePreferences() {
            let btn = document.getElementById('savePrefsBtn');            

            let data = {
                delivery_frequency: document.querySelector('input[name="delivery_frequency"]:checked')?.value,
                delivery_zone: document.getElementById('deliveryZone').value,
                delivery_window: document.getElementById('deliveryWindow').value,
                special_notes: document.getElementById('specialNotes').value,
            };

            btn.innerHTML = 'Saving...';
            btn.disabled = true;

            fetch("{{ route('subscription.preferences.update') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify(data)
            })
            .then(res => res.json())
            .then(res => {
                // alert(res.message);
                btn.innerHTML = '<i class="fas fa-check mr-2"></i> Saved!';
                btn.classList.remove('bg-brand-teal');
                btn.classList.add('bg-green-500');
                setTimeout(() => {
                    btn.innerHTML = '<i class="fas fa-save mr-2"></i> Save Preferences';
                    btn.classList.remove('bg-green-500');
                    btn.classList.add('bg-brand-teal');
                }, 2500);
                // btn.innerHTML = '<i class="fas fa-save"></i> Save Preferences';
                btn.disabled = false;
            })
            .catch(err => {
                console.error(err);
                alert("Something went wrong!");
                btn.innerHTML = '<i class="fas fa-save"></i> Save Preferences';
                btn.disabled = false;
            });
        }
    </script>
</body>
</html>