<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Latest Delivery | FoodBox NG</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
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
                            teal: '#2A9D8F',  // Primary Action/Highlight
                            blue: '#264653',  // Deep Text/Background
                            gold: '#E9C46A',  // Secondary Highlight
                            orange: '#F4A261',// Tertiary/Alert
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
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #E0E7E8;
        }
        ::-webkit-scrollbar-thumb {
            background: #2A9D8F;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #264653;
        }

        /* Sidebar transition for smoother mobile opening/closing */
        #sidebar {
            transition: transform 0.3s ease-in-out;
            z-index: 50;
        }
        @media (max-width: 1023px) {
            #sidebar {
                transform: translateX(-100%);
            }
            #sidebar.open {
                transform: translateX(0);
            }
        }
        @media (min-width: 1024px) {
            #sidebar {
                transform: translateX(0);
            }
        }
        #backdrop {
            transition: opacity 0.3s ease-in-out;
        }

        .main-content {
            padding-top: 5rem;
        }
        .nav-link.active {
            background-color: #2A9D8F;
            color: white;
            box-shadow: 0 5px 15px -5px rgba(42, 157, 143, 0.4);
        }
        .nav-link.active i {
            color: #E9C46A;
        }

        /* Radar pulse ring animation */
        @keyframes pulse-ring {
            0% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(42, 157, 143, 0.7);
            }
            70% {
                transform: scale(1);
                box-shadow: 0 0 0 10px rgba(42, 157, 143, 0);
            }
            100% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(42, 157, 143, 0);
            }
        }
        .pulse-badge {
            animation: pulse-ring 2s infinite;
        }
    </style>
</head>
<body class="bg-brand-grey text-brand-blue antialiased min-h-screen">

    @include('dashboard.header')

    <!-- MAIN DASHBOARD CONTENT AREA -->
    <main class="lg:ml-64 main-content px-4 md:px-8 pb-16 max-w-7xl mx-auto space-y-8">
        
        <!-- PAGE TITLE & DESCRIPTION HEADER -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pt-2">
            <div>
                <div class="flex items-center gap-3">
                    <h1 class="text-2xl md:text-3xl font-extrabold text-brand-blue tracking-tight">Track Latest Delivery</h1>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200">
                        <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                        Live Delivery
                    </span>
                </div>
                <p class="text-sm text-gray-500 mt-1">Real-time status, courier details, and fulfillment timeline for your active FoodBox package.</p>
            </div>
            
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="px-4 py-2.5 rounded-xl bg-white text-gray-600 font-bold text-xs shadow-sm hover:bg-gray-100 transition-colors flex items-center gap-2 border border-gray-200">
                    <i class="fas fa-arrow-left"></i> Back to Dashboard
                </a>
                <button onclick="window.location.reload()" class="px-4 py-2.5 rounded-xl bg-brand-teal/10 text-brand-teal hover:bg-brand-teal hover:text-white font-bold text-xs transition-all flex items-center gap-2">
                    <i class="fas fa-sync-alt"></i> Refresh Status
                </button>
            </div>
        </div>

        <!-- 1. DELIVERY SUMMARY CARD (HERO CARD) -->
        <section class="bg-white rounded-3xl p-6 md:p-8 shadow-soft border border-gray-100 relative overflow-hidden">
            <!-- Top Gradient Bar -->
            <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-brand-teal via-brand-gold to-brand-orange"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 items-center">
                <!-- Order ID & Package -->
                <div class="space-y-1">
                    <span class="text-xs font-extrabold uppercase tracking-wider text-gray-400">Order Reference</span>
                    <div class="flex items-center gap-2">
                        <h2 class="text-xl font-extrabold text-brand-blue">#ORD-83921</h2>
                        <button onclick="navigator.clipboard.writeText('ORD-83921')" title="Copy Order ID" class="text-gray-400 hover:text-brand-teal text-xs transition-colors">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                    <p class="text-xs font-semibold text-brand-teal flex items-center gap-1.5 pt-1">
                        <i class="fas fa-box"></i> Family Mega Box Subscription
                    </p>
                </div>

                <!-- Estimated Arrival -->
                <div class="space-y-1 border-t md:border-t-0 md:border-l border-gray-100 md:pl-6 pt-4 md:pt-0">
                    <span class="text-xs font-extrabold uppercase tracking-wider text-gray-400">Estimated Arrival</span>
                    <div class="flex items-center gap-2">
                        <i class="far fa-clock text-brand-orange text-lg"></i>
                        <span class="text-lg font-bold text-brand-blue">Today, 2:30 PM - 3:15 PM</span>
                    </div>
                    <p class="text-xs text-gray-500">Dispatch Window: Morning Courier Batch</p>
                </div>

                <!-- Delivery Address -->
                <div class="space-y-1 border-t lg:border-t-0 lg:border-l border-gray-100 lg:pl-6 pt-4 lg:pt-0">
                    <span class="text-xs font-extrabold uppercase tracking-wider text-gray-400">Delivery Address</span>
                    <p class="text-sm font-bold text-brand-blue line-clamp-1 flex items-start gap-1.5">
                        <i class="fas fa-map-marker-alt text-brand-red mt-0.5 shrink-0"></i>
                        <span>Plot 14, Applewood Estate, Guzape, Abuja</span>
                    </p>
                    <p class="text-xs text-gray-500">Recipient: Emmanuel Pinnacle</p>
                </div>

                <!-- Current Status Pill -->
                <div class="border-t lg:border-t-0 lg:border-l border-gray-100 lg:pl-6 pt-4 lg:pt-0 flex flex-col justify-center items-start lg:items-end">
                    <span class="text-xs font-extrabold uppercase tracking-wider text-gray-400 mb-1">Current Status</span>
                    <div class="px-4 py-2 rounded-2xl bg-amber-500/10 border border-amber-500/20 text-amber-800 flex items-center gap-2.5 pulse-badge">
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-500 animate-ping shrink-0"></span>
                        <span class="text-sm font-extrabold tracking-wide">Out for Delivery</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- MAIN CONTENT GRID (2 COLUMNS: LEFT 2/3, RIGHT 1/3) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- LEFT COLUMN (PROGRESS TIMELINE, PACKAGE CONTENTS, LIVE UPDATES) -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- 2. MODERN VERTICAL DELIVERY PROGRESS TIMELINE -->
                <section class="bg-white rounded-3xl p-6 md:p-8 shadow-soft border border-gray-100">
                    <div class="flex items-center justify-between pb-6 mb-6 border-b border-gray-100">
                        <div>
                            <h2 class="text-lg font-bold text-brand-blue flex items-center gap-2">
                                <i class="fas fa-route text-brand-teal"></i> Delivery Progress Timeline
                            </h2>
                            <p class="text-xs text-gray-500 mt-1">Live tracking nodes for your scheduled box dispatch.</p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-brand-teal/10 text-brand-teal">
                            Step 4 of 5
                        </span>
                    </div>

                    <!-- Vertical Timeline Items -->
                    <div class="relative pl-6 sm:pl-8 space-y-8 before:absolute before:left-3 sm:before:left-4 before:top-3 before:bottom-3 before:w-0.5 before:bg-gray-200">
                        
                        <!-- Step 1: Order Confirmed (Completed) -->
                        <div class="relative flex items-start gap-4">
                            <div class="absolute -left-6 sm:-left-8 w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center text-xs font-bold ring-4 ring-white shadow-sm z-10">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="bg-gray-50/80 p-4 rounded-2xl border border-gray-100 flex-1 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                <div>
                                    <h3 class="font-bold text-brand-blue text-sm">Order Confirmed</h3>
                                    <p class="text-xs text-gray-500 mt-0.5">Your subscription box dispatch was logged into our automated queue.</p>
                                </div>
                                <span class="text-[11px] font-bold text-gray-400 shrink-0 bg-white px-2.5 py-1 rounded-lg border border-gray-100 w-fit">
                                    Aug 06, 09:00 AM
                                </span>
                            </div>
                        </div>

                        <!-- Step 2: Payment Verified (Completed) -->
                        <div class="relative flex items-start gap-4">
                            <div class="absolute -left-6 sm:-left-8 w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center text-xs font-bold ring-4 ring-white shadow-sm z-10">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="bg-gray-50/80 p-4 rounded-2xl border border-gray-100 flex-1 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                <div>
                                    <h3 class="font-bold text-brand-blue text-sm">Payment Verified</h3>
                                    <p class="text-xs text-gray-500 mt-0.5">Subscription wallet charge approved and receipt issued.</p>
                                </div>
                                <span class="text-[11px] font-bold text-gray-400 shrink-0 bg-white px-2.5 py-1 rounded-lg border border-gray-100 w-fit">
                                    Aug 06, 09:15 AM
                                </span>
                            </div>
                        </div>

                        <!-- Step 3: Package Being Prepared (Completed) -->
                        <div class="relative flex items-start gap-4">
                            <div class="absolute -left-6 sm:-left-8 w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center text-xs font-bold ring-4 ring-white shadow-sm z-10">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="bg-gray-50/80 p-4 rounded-2xl border border-gray-100 flex-1 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                <div>
                                    <h3 class="font-bold text-brand-blue text-sm">Package Being Prepared</h3>
                                    <p class="text-xs text-gray-500 mt-0.5">Fresh produce sorted, quality checked, and sealed at central warehouse.</p>
                                </div>
                                <span class="text-[11px] font-bold text-gray-400 shrink-0 bg-white px-2.5 py-1 rounded-lg border border-gray-100 w-fit">
                                    Aug 06, 11:30 AM
                                </span>
                            </div>
                        </div>

                        <!-- Step 4: Out for Delivery (Active Step) -->
                        <div class="relative flex items-start gap-4">
                            <div class="absolute -left-6 sm:-left-8 w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-brand-teal text-white flex items-center justify-center text-xs font-bold ring-4 ring-brand-teal/20 shadow-md z-10 animate-bounce">
                                <i class="fas fa-truck"></i>
                            </div>
                            <div class="bg-brand-teal/5 p-4 rounded-2xl border border-brand-teal/30 flex-1 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h3 class="font-extrabold text-brand-teal text-sm">Out for Delivery</h3>
                                        <span class="px-2 py-0.5 rounded text-[10px] font-extrabold bg-brand-teal text-white uppercase">In Transit</span>
                                    </div>
                                    <p class="text-xs text-brand-blue font-medium mt-1">Driver Musa Ibrahim is en route with your package in a refrigerated vehicle.</p>
                                </div>
                                <span class="text-[11px] font-extrabold text-brand-teal shrink-0 bg-white px-2.5 py-1 rounded-lg border border-brand-teal/20 w-fit">
                                    Aug 06, 01:45 PM
                                </span>
                            </div>
                        </div>

                        <!-- Step 5: Delivered (Pending) -->
                        <div class="relative flex items-start gap-4">
                            <div class="absolute -left-6 sm:-left-8 w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-gray-200 text-gray-400 flex items-center justify-center text-xs font-bold ring-4 ring-white z-10">
                                <i class="fas fa-home"></i>
                            </div>
                            <div class="bg-gray-50/50 p-4 rounded-2xl border border-gray-100 flex-1 flex flex-col sm:flex-row sm:items-center justify-between gap-2 opacity-60">
                                <div>
                                    <h3 class="font-bold text-gray-500 text-sm">Delivered</h3>
                                    <p class="text-xs text-gray-400 mt-0.5">Handover to recipient at delivery address upon arrival.</p>
                                </div>
                                <span class="text-[11px] font-bold text-gray-400 shrink-0 bg-white px-2.5 py-1 rounded-lg border border-gray-100 w-fit">
                                    Est. ~ 03:00 PM
                                </span>
                            </div>
                        </div>

                    </div>
                </section>

                <!-- 3. PACKAGE CONTENTS CARD -->
                <section class="bg-white rounded-3xl p-6 md:p-8 shadow-soft border border-gray-100">
                    <div class="flex items-center justify-between pb-4 mb-6 border-b border-gray-100">
                        <div>
                            <h2 class="text-lg font-bold text-brand-blue flex items-center gap-2">
                                <i class="fas fa-shopping-basket text-brand-teal"></i> Included Package Contents
                            </h2>
                            <p class="text-xs text-gray-500 mt-1">Items packaged inside your Family Mega Box dispatch.</p>
                        </div>
                        <span class="text-xs font-bold text-gray-400">6 Total Produce Items</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Item 1 -->
                        <div class="flex items-center gap-3.5 p-3.5 rounded-2xl bg-gray-50 border border-gray-100 hover:border-brand-teal/30 transition-all">
                            <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center font-bold text-base shrink-0">
                                🌾
                            </div>
                            <div class="min-w-0 flex-1">
                                <h4 class="text-sm font-bold text-brand-blue truncate">Royal Stallion Parboiled Rice</h4>
                                <p class="text-xs text-gray-400">Premium Grade • 50kg Bag</p>
                            </div>
                            <span class="px-2.5 py-1 rounded-lg bg-white text-xs font-extrabold text-brand-teal border border-gray-200">x1</span>
                        </div>

                        <!-- Item 2 -->
                        <div class="flex items-center gap-3.5 p-3.5 rounded-2xl bg-gray-50 border border-gray-100 hover:border-brand-teal/30 transition-all">
                            <div class="w-10 h-10 rounded-xl bg-yellow-100 text-yellow-700 flex items-center justify-center font-bold text-base shrink-0">
                                🍾
                            </div>
                            <div class="min-w-0 flex-1">
                                <h4 class="text-sm font-bold text-brand-blue truncate">Kings Pure Vegetable Oil</h4>
                                <p class="text-xs text-gray-400">Refined Oil • 5L Container</p>
                            </div>
                            <span class="px-2.5 py-1 rounded-lg bg-white text-xs font-extrabold text-brand-teal border border-gray-200">x1</span>
                        </div>

                        <!-- Item 3 -->
                        <div class="flex items-center gap-3.5 p-3.5 rounded-2xl bg-gray-50 border border-gray-100 hover:border-brand-teal/30 transition-all">
                            <div class="w-10 h-10 rounded-xl bg-red-100 text-red-700 flex items-center justify-center font-bold text-base shrink-0">
                                🍅
                            </div>
                            <div class="min-w-0 flex-1">
                                <h4 class="text-sm font-bold text-brand-blue truncate">Fresh Jos Farm Tomatoes</h4>
                                <p class="text-xs text-gray-400">Farm Fresh • 1 Full Carton</p>
                            </div>
                            <span class="px-2.5 py-1 rounded-lg bg-white text-xs font-extrabold text-brand-teal border border-gray-200">x1</span>
                        </div>

                        <!-- Item 4 -->
                        <div class="flex items-center gap-3.5 p-3.5 rounded-2xl bg-gray-50 border border-gray-100 hover:border-brand-teal/30 transition-all">
                            <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center font-bold text-base shrink-0">
                                🧅
                            </div>
                            <div class="min-w-0 flex-1">
                                <h4 class="text-sm font-bold text-brand-blue truncate">Red Dry Onions</h4>
                                <p class="text-xs text-gray-400">Sorted Medium • 25kg Bag</p>
                            </div>
                            <span class="px-2.5 py-1 rounded-lg bg-white text-xs font-extrabold text-brand-teal border border-gray-200">x1</span>
                        </div>

                        <!-- Item 5 -->
                        <div class="flex items-center gap-3.5 p-3.5 rounded-2xl bg-gray-50 border border-gray-100 hover:border-brand-teal/30 transition-all">
                            <div class="w-10 h-10 rounded-xl bg-orange-100 text-orange-700 flex items-center justify-center font-bold text-base shrink-0">
                                🌴
                            </div>
                            <div class="min-w-0 flex-1">
                                <h4 class="text-sm font-bold text-brand-blue truncate">Unrefined Red Palm Oil</h4>
                                <p class="text-xs text-gray-400">Pure Organic • 4L Tub</p>
                            </div>
                            <span class="px-2.5 py-1 rounded-lg bg-white text-xs font-extrabold text-brand-teal border border-gray-200">x1</span>
                        </div>

                        <!-- Item 6 -->
                        <div class="flex items-center gap-3.5 p-3.5 rounded-2xl bg-gray-50 border border-gray-100 hover:border-brand-teal/30 transition-all">
                            <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-base shrink-0">
                                🧂
                            </div>
                            <div class="min-w-0 flex-1">
                                <h4 class="text-sm font-bold text-brand-blue truncate">Knorr Seasoning Cubes</h4>
                                <p class="text-xs text-gray-400">Chicken Flavored • Pack of 80</p>
                            </div>
                            <span class="px-2.5 py-1 rounded-lg bg-white text-xs font-extrabold text-brand-teal border border-gray-200">x2</span>
                        </div>
                    </div>
                </section>

                <!-- 4. RECENT DELIVERY UPDATES LOG TIMELINE -->
                <section class="bg-white rounded-3xl p-6 md:p-8 shadow-soft border border-gray-100">
                    <div class="flex items-center justify-between pb-4 mb-6 border-b border-gray-100">
                        <div>
                            <h2 class="text-lg font-bold text-brand-blue flex items-center gap-2">
                                <i class="fas fa-stream text-brand-teal"></i> Real-time Activity Logs
                            </h2>
                            <p class="text-xs text-gray-500 mt-1">Automatic GPS updates from courier scanner.</p>
                        </div>
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                    </div>

                    <div class="space-y-4">
                        <!-- Log 1 -->
                        <div class="flex items-start gap-3.5 p-3.5 rounded-2xl bg-brand-teal/5 border border-brand-teal/20">
                            <div class="w-8 h-8 rounded-full bg-brand-teal text-white flex items-center justify-center text-xs shrink-0 mt-0.5">
                                <i class="fas fa-location-arrow"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-xs font-extrabold text-brand-teal">Courier Nearby</h4>
                                    <span class="text-[11px] font-bold text-gray-400">02:15 PM</span>
                                </div>
                                <p class="text-xs text-brand-blue mt-0.5">Driver Musa is 1.5km away near Guzape Hills Junction. Preparing for arrival.</p>
                            </div>
                        </div>

                        <!-- Log 2 -->
                        <div class="flex items-start gap-3.5 p-3.5 rounded-2xl bg-gray-50 border border-gray-100">
                            <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-xs shrink-0 mt-0.5">
                                <i class="fas fa-truck-loading"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-xs font-bold text-brand-blue">Dispatched from Hub</h4>
                                    <span class="text-[11px] font-bold text-gray-400">01:45 PM</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-0.5">Package loaded onto delivery vehicle #ABJ-492-XY at Central Dispatch Hub.</p>
                            </div>
                        </div>

                        <!-- Log 3 -->
                        <div class="flex items-start gap-3.5 p-3.5 rounded-2xl bg-gray-50 border border-gray-100">
                            <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-xs shrink-0 mt-0.5">
                                <i class="fas fa-clipboard-check"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-xs font-bold text-brand-blue">Quality Seal Approved</h4>
                                    <span class="text-[11px] font-bold text-gray-400">11:30 AM</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-0.5">Package inspected for fresh quality guarantee and tamper-proof sealed.</p>
                            </div>
                        </div>

                        <!-- Log 4 -->
                        <div class="flex items-start gap-3.5 p-3.5 rounded-2xl bg-gray-50 border border-gray-100">
                            <div class="w-8 h-8 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center text-xs shrink-0 mt-0.5">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-xs font-bold text-brand-blue">Order Processed</h4>
                                    <span class="text-[11px] font-bold text-gray-400">09:15 AM</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-0.5">Automated subscription order confirmed for today's delivery batch.</p>
                            </div>
                        </div>
                    </div>
                </section>

            </div>

            <!-- RIGHT COLUMN (DRIVER CARD, ACTION BUTTONS, DELIVERY DETAILS) -->
            <div class="space-y-8">
                
                <!-- 5. DRIVER INFORMATION CARD -->
                <section class="bg-white rounded-3xl p-6 shadow-soft border border-gray-100 text-center space-y-5 relative overflow-hidden">
                    <!-- Top subtle badge -->
                    <div class="bg-brand-teal/10 -mx-6 -mt-6 p-4 border-b border-brand-teal/10 flex items-center justify-between px-6">
                        <span class="text-xs font-extrabold text-brand-teal uppercase tracking-wider">Assigned Courier</span>
                        <span class="px-2 py-0.5 rounded text-[10px] font-extrabold bg-emerald-100 text-emerald-700 flex items-center gap-1">
                            <i class="fas fa-shield-alt"></i> Verified
                        </span>
                    </div>

                    <!-- Driver Avatar & Info -->
                    <div class="pt-2">
                        <div class="relative w-24 h-24 mx-auto mb-3">
                            <div class="w-24 h-24 rounded-full bg-gradient-to-tr from-brand-blue to-brand-teal p-1 shadow-lg">
                                <div class="w-full h-full rounded-full bg-gray-100 flex items-center justify-center text-3xl font-extrabold text-brand-blue overflow-hidden border-2 border-white">
                                    <!-- Styled Avatar placeholder -->
                                    <span class="bg-brand-blue text-brand-gold w-full h-full flex items-center justify-center">MI</span>
                                </div>
                            </div>
                            <span class="absolute bottom-1 right-1 w-6 h-6 rounded-full bg-emerald-500 border-2 border-white flex items-center justify-center text-white text-[10px]" title="Driver Online">
                                <i class="fas fa-check"></i>
                            </span>
                        </div>
                        <h3 class="text-lg font-extrabold text-brand-blue">Musa Ibrahim</h3>
                        <p class="text-xs font-semibold text-gray-400">Senior Express Delivery Officer</p>
                        
                        <!-- Driver Rating Badge -->
                        <div class="flex items-center justify-center gap-1 mt-2">
                            <span class="px-3 py-1 rounded-full bg-amber-50 text-amber-700 text-xs font-extrabold flex items-center gap-1 border border-amber-200">
                                <i class="fas fa-star text-amber-500"></i> 4.9 <span class="text-gray-400 font-medium">(142 deliveries)</span>
                            </span>
                        </div>
                    </div>

                    <!-- Vehicle Specs -->
                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 text-left space-y-2">
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-400 font-medium">Vehicle Type:</span>
                            <span class="font-bold text-brand-blue flex items-center gap-1.5">
                                <i class="fas fa-shuttle-van text-brand-teal"></i> Toyota HiAce Van
                            </span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-400 font-medium">Plate Number:</span>
                            <span class="font-extrabold bg-white px-2 py-0.5 rounded border border-gray-200 text-brand-blue tracking-wider">ABJ-492-XY</span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-400 font-medium">Phone Contact:</span>
                            <span class="font-bold text-brand-blue">+234 812 345 6789</span>
                        </div>
                    </div>
                </section>

                <!-- 6. PRIMARY ACTION BUTTONS CARD -->
                <section class="bg-white rounded-3xl p-6 shadow-soft border border-gray-100 space-y-3">
                    <h3 class="text-xs font-extrabold uppercase tracking-wider text-gray-400 mb-2">Quick Delivery Actions</h3>

                    <!-- Contact Driver Button -->
                    <a href="tel:+2348123456789" class="w-full bg-brand-teal text-white font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-brand-teal/20 hover:bg-brand-blue hover:scale-[1.01] active:scale-[0.99] transition-all duration-200 flex items-center justify-center gap-2.5 text-sm">
                        <i class="fas fa-phone-alt"></i>
                        <span>Contact Driver Musa</span>
                    </a>

                    <!-- Contact Support Button -->
                    <a href="{{ route('support') }}" class="w-full bg-brand-blue/10 text-brand-blue font-bold py-3.5 px-4 rounded-xl hover:bg-brand-blue hover:text-white transition-all duration-200 flex items-center justify-center gap-2.5 text-sm">
                        <i class="fas fa-headset"></i>
                        <span>Contact Help Desk</span>
                    </a>

                    <!-- Report Delivery Issue Button -->
                    <button type="button" onclick="openReportModal()" class="w-full bg-red-50 text-brand-red font-bold py-3.5 px-4 rounded-xl hover:bg-brand-red hover:text-white transition-all duration-200 flex items-center justify-center gap-2.5 text-sm border border-red-100">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>Report Delivery Issue</span>
                    </button>
                </section>

                <!-- 7. DELIVERY DETAILS CARD -->
                <section class="bg-white rounded-3xl p-6 shadow-soft border border-gray-100 space-y-4">
                    <div class="pb-3 border-b border-gray-100">
                        <h3 class="text-sm font-bold text-brand-blue flex items-center gap-2">
                            <i class="fas fa-info-circle text-brand-teal"></i> Delivery Specifications
                        </h3>
                    </div>

                    <div class="space-y-3 text-xs">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-400 font-medium">Dispatch Date:</span>
                            <span class="font-bold text-brand-blue">August 06, 2026</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-gray-400 font-medium">Payment Method:</span>
                            <span class="font-bold text-brand-blue flex items-center gap-1">
                                <i class="fas fa-wallet text-brand-teal"></i> Subscription Wallet
                            </span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-gray-400 font-medium">Fulfillment Type:</span>
                            <span class="font-bold text-brand-blue">Bi-Weekly Dispatch</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-gray-400 font-medium">Temperature Control:</span>
                            <span class="font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded">Cold Storage Box</span>
                        </div>

                        <div class="pt-2 border-t border-gray-100 space-y-1">
                            <span class="text-gray-400 font-medium block">Special Delivery Notes:</span>
                            <p class="bg-gray-50 p-3 rounded-xl border border-gray-100 text-gray-600 leading-relaxed font-medium italic">
                                "Please hand over to main security gate guard if recipient does not pick up phone within 5 minutes."
                            </p>
                        </div>
                    </div>
                </section>

            </div>

        </div>

        <!-- FOOTER SPACER -->
        <div class="h-8"></div>
    </main>

    <!-- REPORT DELIVERY ISSUE MODAL -->
    <div id="reportModal" class="fixed inset-0 bg-black/50 z-50 hidden opacity-0 transition-opacity duration-300 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 md:p-8 shadow-xl transform scale-95 transition-transform duration-300 space-y-6">
            
            <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                <div class="flex items-center gap-2.5">
                    <div class="w-10 h-10 rounded-xl bg-red-100 text-brand-red flex items-center justify-center text-lg">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-extrabold text-brand-blue">Report Delivery Issue</h3>
                        <p class="text-xs text-gray-400">Order Reference #ORD-83921</p>
                    </div>
                </div>
                <button onclick="closeReportModal()" class="text-gray-400 hover:text-gray-600 p-2">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Modal Body Form -->
            <form onsubmit="handleReportSubmit(event)" class="space-y-4">
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-gray-700">Select Issue Category</label>
                    <select required class="w-full px-4 py-3 rounded-xl border border-gray-200 text-xs font-medium focus:border-brand-teal outline-none bg-gray-50">
                        <option value="" disabled selected>What seems to be the problem?</option>
                        <option value="delay">Driver is delayed / Taking too long</option>
                        <option value="contact">Driver phone number unreachable</option>
                        <option value="address">Delivery address issue</option>
                        <option value="damage">Damaged or missing box item</option>
                        <option value="other">Other delivery concern</option>
                    </select>
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-gray-700">Issue Description</label>
                    <textarea rows="3" required placeholder="Provide additional details for our support team..." class="w-full px-4 py-3 rounded-xl border border-gray-200 text-xs focus:border-brand-teal outline-none bg-gray-50 resize-none"></textarea>
                </div>

                <div id="reportSuccessAlert" class="hidden p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold flex items-center gap-2">
                    <i class="fas fa-check-circle text-emerald-600"></i>
                    <span>Issue reported successfully! Our support desk has been alerted.</span>
                </div>

                <div class="flex items-center justify-end gap-3 pt-2">
                    <button type="button" onclick="closeReportModal()" class="px-5 py-2.5 rounded-xl bg-gray-100 text-gray-600 font-bold text-xs hover:bg-gray-200 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" id="reportSubmitBtn" class="px-6 py-2.5 rounded-xl bg-brand-red text-white font-bold text-xs hover:bg-brand-blue transition-colors flex items-center gap-2">
                        <span>Submit Report</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script>
        function openReportModal() {
            const modal = document.getElementById('reportModal');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
            }, 10);
        }

        function closeReportModal() {
            const modal = document.getElementById('reportModal');
            modal.classList.add('opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
                document.getElementById('reportSuccessAlert').classList.add('hidden');
            }, 300);
        }

        function handleReportSubmit(e) {
            e.preventDefault();
            const btn = document.getElementById('reportSubmitBtn');
            const alert = document.getElementById('reportSuccessAlert');
            
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';

            setTimeout(() => {
                btn.disabled = false;
                btn.innerHTML = 'Submitted';
                alert.classList.remove('hidden');
                setTimeout(() => {
                    closeReportModal();
                }, 2000);
            }, 1000);
        }

        // Mobile Sidebar Toggle
        const sidebar = document.getElementById('sidebar');
        const menuToggle = document.getElementById('menu-toggle');
        const backdrop = document.getElementById('backdrop');

        function toggleSidebar() {
            if (sidebar && backdrop) {
                const isOpen = sidebar.classList.toggle('open');
                backdrop.classList.toggle('hidden', !isOpen);
                if (isOpen) {
                    backdrop.offsetWidth; 
                    backdrop.classList.remove('opacity-0');
                } else {
                    backdrop.classList.add('opacity-0');
                }
            }
        }

        if (menuToggle) {
            menuToggle.addEventListener('click', toggleSidebar);
        }
        if (backdrop) {
            backdrop.addEventListener('click', toggleSidebar);
        }
    </script>
</body>
</html>