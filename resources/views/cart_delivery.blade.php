<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodBox NG | Cart Delivery</title>

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
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #F4F6F8; }
        ::-webkit-scrollbar-thumb { background: #2A9D8F; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #264653; }

        /* Step indicator states */
        .step-done .step-dot { background: #2A9D8F; color: white; }
        .step-active .step-dot { background: #2A9D8F; color: white; border: 2px solid #2A9D8F; }
        .step-inactive .step-dot { background: #E5E7EB; color: #9CA3AF; }
        
        /* Address Card Active States */
        .address-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }
        .address-card.active {
            border-color: #2A9D8F;
            box-shadow: 0 10px 25px -5px rgba(42, 157, 143, 0.15);
            background-color: rgba(42, 157, 143, 0.02);
            transform: translateY(-2px);
        }
        
        /* Date / Slot Badge States */
        .date-badge, .slot-card, .method-card {
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .date-badge.active, .slot-card.active, .method-card.active {
            background-color: #264653;
            color: white;
            border-color: #264653;
        }

        /* Modal transitions */
        .modal {
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
        .modal.hidden {
            opacity: 0;
            pointer-events: none;
        }
        .modal-content {
            transition: transform 0.3s ease-out;
            transform: scale(0.95);
        }
        .modal.visible .modal-content {
            transform: scale(1);
        }
        
        /* Pulse for loading state */
        @keyframes pulse-soft {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.02); }
        }
        .btn-pulse { animation: pulse-soft 0.5s ease infinite; }
    </style>
</head>
<body class="bg-brand-grey font-sans text-brand-blue antialiased selection:bg-brand-gold selection:text-brand-blue">

    <!-- Navigation -->
    @include('layouts.navbar')

    <!-- Breadcrumb -->
    <div class="pt-28 pb-4 bg-brand-grey border-b border-gray-200">
        <div class="container mx-auto px-6">
            <nav class="flex items-center gap-2 text-sm text-gray-500">
                <a href="/" class="hover:text-brand-teal transition-colors">Home</a>
                <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                <a href="/carts" class="hover:text-brand-teal transition-colors">My Cart</a>
                <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                <span class="text-brand-blue font-semibold">Delivery Details</span>
            </nav>
        </div>
    </div>

    <!-- CHECKOUT PROGRESS STEPS -->
    <div class="bg-white border-b border-gray-100 py-5">
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-center max-w-lg mx-auto">
                <!-- Step 1 -->
                <div class="flex flex-col items-center step-done">
                    <div class="step-dot w-9 h-9 rounded-full flex items-center justify-center font-bold text-sm bg-brand-teal text-white shadow-md">
                        <i class="fas fa-check text-xs"></i>
                    </div>
                    <span class="text-xs font-bold text-brand-teal mt-1.5">Cart</span>
                </div>
                <!-- Line -->
                <div class="flex-1 h-1 mx-2 rounded-full bg-brand-teal"></div>
                <!-- Step 2 -->
                <div class="flex flex-col items-center step-active">
                    <div class="step-dot w-9 h-9 rounded-full flex items-center justify-center font-bold text-sm bg-brand-teal text-white shadow-md ring-4 ring-brand-teal/20">2</div>
                    <span class="text-xs font-bold text-brand-teal mt-1.5">Delivery</span>
                </div>
                <!-- Line -->
                <div class="flex-1 h-1 mx-2 rounded-full bg-gray-200"></div>
                <!-- Step 3 -->
                <div class="flex flex-col items-center step-inactive">
                    <div class="step-dot w-9 h-9 rounded-full flex items-center justify-center font-bold text-sm bg-gray-200 text-gray-400">3</div>
                    <span class="text-xs font-medium text-gray-400 mt-1.5">Payment</span>
                </div>
                <!-- Line -->
                <div class="flex-1 h-1 mx-2 rounded-full bg-gray-200"></div>
                <!-- Step 4 -->
                <div class="flex flex-col items-center step-inactive">
                    <div class="step-dot w-9 h-9 rounded-full flex items-center justify-center font-bold text-sm bg-gray-200 text-gray-400">4</div>
                    <span class="text-xs font-medium text-gray-400 mt-1.5">Done</span>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN DELIVERY SECTION -->
    <section class="py-12">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-8 items-start">
                
                <!-- LEFT COLUMN: Delivery Form and Address Selection -->
                <div class="flex-1 space-y-8 w-full">
                    
                    <!-- ADDRESS SELECTOR SECTION -->
                    <div class="bg-white rounded-3xl p-6 md:p-8 shadow-soft border border-gray-100">
                        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                            <div>
                                <h2 class="text-2xl font-bold text-brand-blue flex items-center gap-2">
                                    <i class="fas fa-map-marker-alt text-brand-teal"></i> Select Delivery Address
                                </h2>
                                <p class="text-sm text-gray-400 mt-1">Choose a saved address or add a new one for your package.</p>
                            </div>
                            <button onclick="openAddressModal()" class="px-5 py-2.5 bg-brand-teal/10 hover:bg-brand-teal hover:text-white text-brand-teal font-semibold text-sm rounded-xl transition-all duration-200 flex items-center gap-2">
                                <i class="fas fa-plus"></i> Add Address
                            </button>
                        </div>

                        <!-- Address Cards Grid -->
                        @if($addresses && $addresses->count() > 0)
                            <div id="addressGrid" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($addresses as $address)
                                    @php
                                        $labelUpper = strtoupper($address->label);
                                        $labelClass = 'bg-brand-teal/10 text-brand-teal';
                                        if (in_array($labelUpper, ['OFFICE', 'WORK', 'WORK OFFICE'])) {
                                            $labelClass = 'bg-brand-blue/5 text-brand-blue';
                                        } elseif ($labelUpper === 'HOSTEL') {
                                            $labelClass = 'bg-brand-gold/20 text-brand-blue';
                                        }
                                        $isDefaultOrSelected = ($address->is_default || ($loop->first && !$addresses->contains('is_default', true)));
                                    @endphp
                                    <div onclick="selectAddress(this, {{ $address->id }})" 
                                         class="address-card bg-white p-5 rounded-2xl border-2 {{ $isDefaultOrSelected ? 'active border-brand-teal' : 'border-gray-100' }} relative flex flex-col justify-between" 
                                         data-id="{{ $address->id }}">
                                        <div class="absolute top-4 right-4 text-brand-teal {{ $isDefaultOrSelected ? '' : 'hidden' }}" id="check-icon-{{ $address->id }}">
                                            <i class="fas fa-check-circle text-lg"></i>
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-2 mb-3">
                                                <span class="{{ $labelClass }} text-xs font-bold px-2.5 py-0.5 rounded-full">{{ $address->label }}</span>
                                                @if($address->is_default)
                                                    <span class="text-gray-400 text-xs font-semibold">DEFAULT</span>
                                                @endif
                                            </div>
                                            <h4 class="font-bold text-brand-blue text-base">{{ $address->recipient_name }}</h4>
                                            <p class="text-sm text-gray-500 font-medium mt-0.5"><i class="fas fa-phone-alt text-xs mr-1 text-gray-400"></i> {{ $address->phone }}</p>
                                            <p class="text-sm text-gray-600 mt-3 leading-relaxed">
                                                {{ $address->street_address }}, {{ $address->city }}, {{ $address->state }}, Nigeria.
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div id="emptyAddressState" class="text-center py-12 border-2 border-dashed border-gray-200 rounded-3xl bg-gray-50/50 w-full col-span-2">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-map-marked-alt text-2xl text-gray-400"></i>
                                </div>
                                <h4 class="font-bold text-brand-blue text-lg">No saved addresses yet</h4>
                                <p class="text-sm text-gray-400 max-w-xs mx-auto mt-1 mb-6">Please add a delivery address to complete your checkout.</p>
                                <button onclick="openAddressModal()" class="px-5 py-2.5 bg-brand-teal text-white font-semibold text-sm rounded-xl hover:bg-brand-blue transition-colors flex items-center gap-2 mx-auto">
                                    <i class="fas fa-plus"></i> Add First Address
                                </button>
                            </div>
                            <div id="addressGrid" class="grid grid-cols-1 md:grid-cols-2 gap-4 hidden">
                                <!-- Dynamic address cards added here -->
                            </div>
                        @endif
                    </div>

                    <!-- DELIVERY METHOD -->
                    <div class="bg-white rounded-3xl p-6 md:p-8 shadow-soft border border-gray-100">
                        <h2 class="text-2xl font-bold text-brand-blue mb-2 flex items-center gap-2">
                            <i class="fas fa-shipping-fast text-brand-teal"></i> Delivery Method
                        </h2>
                        <p class="text-sm text-gray-400 mb-6">Select how fast you want to receive your packages.</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Standard Delivery -->
                            <div onclick="selectDeliveryMethod(this, 'standard', 0)" class="method-card active p-5 rounded-2xl border-2 border-brand-teal bg-brand-teal/5 flex items-start gap-4" id="method-standard">
                                <div class="w-10 h-10 rounded-xl bg-brand-teal/10 flex items-center justify-center text-brand-teal mt-0.5 flex-shrink-0">
                                    <i class="fas fa-box"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <h4 class="font-bold text-brand-blue text-base">Standard Shipping</h4>
                                        <span class="text-brand-teal font-bold text-sm">FREE</span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">Delivery in 3 - 5 business days. Safe, secure, and reliable.</p>
                                </div>
                            </div>

                            <!-- Express Delivery -->
                            <div onclick="selectDeliveryMethod(this, 'express', 2000)" class="method-card p-5 rounded-2xl border-2 border-gray-100 flex items-start gap-4" id="method-express">
                                <div class="w-10 h-10 rounded-xl bg-brand-orange/10 flex items-center justify-center text-brand-orange mt-0.5 flex-shrink-0">
                                    <i class="fas fa-bolt"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <h4 class="font-bold text-brand-blue text-base">Express Delivery</h4>
                                        <span class="text-brand-blue font-bold text-sm">+₦2,000</span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">Delivery tomorrow. Best for urgent supplies or cravings.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SCHEDULING OPTIONS -->
                    <div class="bg-white rounded-3xl p-6 md:p-8 shadow-soft border border-gray-100">
                        <h2 class="text-2xl font-bold text-brand-blue mb-2 flex items-center gap-2">
                            <i class="fas fa-calendar-alt text-brand-teal"></i> Delivery Schedule
                        </h2>
                        <p class="text-sm text-gray-400 mb-6">Select a delivery date and time slot that works best for you.</p>

                        <!-- Horizontal Scrollable Dates -->
                        <!-- <h4 class="font-semibold text-brand-blue text-sm uppercase tracking-wider mb-3">1. Select Date</h4> -->
                        <!-- <div class="flex items-center gap-3 overflow-x-auto pb-4" id="dateList"> -->
                            <!-- JS will inject dynamic dates (Tomorrow + next 4 days) -->
                        <!-- </div> -->

                        <!-- Time Slots Grid -->
                        <h4 class="font-semibold text-brand-blue text-sm uppercase tracking-wider mt-4 mb-3">Select Preferred Time Slot</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div onclick="selectTimeSlot(this, 'Morning (8:00 AM - 12:00 PM)')" class="slot-card active p-4 rounded-xl border-2 border-brand-teal bg-brand-teal/5 text-center" id="slot-morning">
                                <p class="font-bold text-sm">Morning</p>
                                <p class="text-xs text-gray-500 mt-0.5">8:00 AM - 12:00 PM</p>
                            </div>
                            <div onclick="selectTimeSlot(this, 'Afternoon (12:00 PM - 4:00 PM)')" class="slot-card p-4 rounded-xl border-2 border-gray-100 text-center" id="slot-afternoon">
                                <p class="font-bold text-sm">Afternoon</p>
                                <p class="text-xs text-gray-500 mt-0.5">12:00 PM - 4:00 PM</p>
                            </div>
                            <div onclick="selectTimeSlot(this, 'Evening (4:00 PM - 8:00 PM)')" class="slot-card p-4 rounded-xl border-2 border-gray-100 text-center" id="slot-evening">
                                <p class="font-bold text-sm">Evening</p>
                                <p class="text-xs text-gray-500 mt-0.5">4:00 PM - 8:00 PM</p>
                            </div>
                        </div>

                        <!-- Special Instructions -->
                        <h4 class="font-semibold text-brand-blue text-sm uppercase tracking-wider mt-6 mb-3">Delivery Note / Instructions</h4>
                        <textarea id="deliveryNote" rows="3" placeholder="E.g., Please leave with security at the gatehouse, call me upon arrival..." 
                                  class="w-full border-2 border-gray-100 rounded-2xl p-4 text-sm font-medium text-brand-blue placeholder-gray-300 focus:outline-none focus:border-brand-teal focus:ring-4 focus:ring-brand-teal/10 transition-all duration-200 resize-none"></textarea>
                    </div>

                </div>

                <!-- RIGHT COLUMN: Order Summary -->
                <div class="w-full lg:w-96 flex-shrink-0 space-y-6 lg:sticky lg:top-28">
                    
                    <div class="bg-white rounded-3xl p-6 shadow-soft border border-gray-100">
                        <h3 class="font-bold text-brand-blue text-lg mb-6 flex items-center gap-2">
                            <i class="fas fa-receipt text-brand-teal"></i> Order Summary
                        </h3>

                        <div class="space-y-4">
                            <!-- Items Count -->
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-500 font-medium">Subtotal (<span id="itemCount">3</span> items)</span>
                                <span id="summarySubtotal" class="font-bold text-brand-blue">₦134,000</span>
                            </div>
                            <!-- Shipping Fee -->
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-500 font-medium">Delivery Fee</span>
                                <span id="summaryShipping" class="font-bold text-brand-teal">Free</span>
                            </div>
                            <!-- Discount -->
                            <div id="discountRow" class="flex justify-between items-center text-sm hidden">
                                <span class="text-gray-500 font-medium flex items-center gap-1">
                                    <i class="fas fa-tag text-xs text-brand-teal"></i> Promo Discount
                                </span>
                                <span id="summaryDiscount" class="font-bold text-green-500">-₦0</span>
                            </div>
                            
                            <!-- Divider -->
                            <div class="border-t-2 border-dashed border-gray-100 pt-4 flex justify-between items-center">
                                <span class="font-bold text-brand-blue text-base">Total</span>
                                <span id="summaryTotal" class="font-bold text-brand-blue text-2xl">₦134,000</span>
                            </div>
                        </div>

                        <!-- Address Summary Snippet -->
                        <div class="mt-5 bg-brand-grey rounded-2xl px-4 py-3 flex gap-3 items-start">
                            <div class="text-brand-teal mt-0.5"><i class="fas fa-map-marker-alt text-sm"></i></div>
                            <div>
                                <p class="text-xs font-bold text-brand-blue">Delivering to:</p>
                                <p class="text-xs text-gray-500 mt-0.5 line-clamp-2" id="summaryAddress">12, Admiralty Way, Lekki Phase 1, Lagos, Nigeria.</p>
                            </div>
                        </div>

                        <!-- Proceed to Payment -->
                        <button onclick="handlePaymentProceed()" id="paymentBtn"
                                class="w-full mt-6 py-4 rounded-2xl bg-brand-teal text-white font-bold text-lg shadow-xl shadow-brand-teal/30 hover:bg-brand-blue hover:scale-[1.02] transition-all duration-300 flex items-center justify-center gap-3">
                            <i class="fas fa-lock text-sm"></i>
                            Proceed to Payment
                        </button>

                        <!-- Trust row -->
                        <div class="flex items-center justify-center gap-5 mt-5">
                            <div class="flex items-center gap-1.5 text-xs text-gray-400 font-medium">
                                <i class="fas fa-shield-alt text-brand-teal"></i> Secure
                            </div>
                            <div class="flex items-center gap-1.5 text-xs text-gray-400 font-medium">
                                <i class="fas fa-undo text-brand-teal"></i> Cancel Anytime
                            </div>
                            <div class="flex items-center gap-1.5 text-xs text-gray-400 font-medium">
                                <i class="fas fa-truck text-brand-teal"></i> Guarantee
                            </div>
                        </div>
                    </div>

                    <!-- Helpful Contact Support -->
                    <div class="bg-white rounded-3xl p-5 shadow-soft border border-gray-100 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-brand-blue/5 flex items-center justify-center text-brand-blue flex-shrink-0">
                            <i class="fas fa-headset text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-brand-blue">Need help with checkout?</h4>
                            <p class="text-xs text-gray-400 mt-0.5">Chat with our delivery support team at support@foodbox.ng</p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- ADD ADDRESS MODAL -->
    <div id="addressModal" class="modal fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4 z-50 hidden">
        <div class="modal-content bg-white w-full max-w-lg rounded-3xl shadow-soft p-6 md:p-8 max-h-[90vh] overflow-y-auto" role="dialog" aria-modal="true" aria-labelledby="modal-title">
            <div class="flex justify-between items-center border-b border-gray-100 pb-4 mb-6">
                <h3 id="modal-title" class="text-2xl font-bold text-brand-blue">Add New Delivery Address</h3>
                <button onclick="closeAddressModal()" class="text-gray-400 hover:text-brand-red transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <form onsubmit="handleNewAddressSubmit(event)" class="space-y-4">
                <!-- Address Label -->
                <div>
                    <label for="address_label" class="block text-sm font-semibold text-gray-700 mb-1">Address Label</label>
                    <select id="address_label" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-sm font-medium text-brand-blue focus:outline-none focus:border-brand-teal transition-all" required>
                        <option value="">Select Label</option>
                        <option value="Home">Home</option>
                        <option value="Work Office">Work</option>
                        <option value="Mum's Place">Mum's Place</option>
                        <option value="Dad's Place">Dad's Place</option>
                        <option value="Hostel">Hostel</option>
                        <option value="Friend's Place">Friend's Place</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                
                <!-- Contact Name -->
                <div>
                    <label for="contact_name" class="block text-sm font-semibold text-gray-700 mb-1">Recipient Name</label>
                    <input type="text" id="contact_name" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-sm font-medium text-brand-blue focus:outline-none focus:border-brand-teal transition-all" placeholder="e.g. John Doe" required>
                </div>

                <!-- Phone Number -->
                <div>
                    <label for="phone_number" class="block text-sm font-semibold text-gray-700 mb-1">Phone Number</label>
                    <input type="tel" id="phone_number" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-sm font-medium text-brand-blue focus:outline-none focus:border-brand-teal transition-all" placeholder="+234 800 000 0000" required>
                </div>

                <!-- Street Address -->
                <div>
                    <label for="street_address" class="block text-sm font-semibold text-gray-700 mb-1">Street Address / nearest landmark</label>
                    <textarea id="street_address" rows="3" class="w-full border-2 border-gray-100 rounded-xl p-4 text-sm font-medium text-brand-blue focus:outline-none focus:border-brand-teal transition-all resize-none" placeholder="House number, Street Name, directions..." required></textarea>
                </div>

                <!-- City & State -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="city" class="block text-sm font-semibold text-gray-700 mb-1">City</label>
                        <input type="text" id="city" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-sm font-medium text-brand-blue focus:outline-none focus:border-brand-teal transition-all" placeholder="e.g. Lekki" required>
                    </div>
                    <div>
                        <label for="state" class="block text-sm font-semibold text-gray-700 mb-1">State</label>
                        <select id="state" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-sm font-medium text-brand-blue focus:outline-none focus:border-brand-teal transition-all" required>
                            <option value="Lagos">Lagos</option>
                            <option value="Abuja">Abuja FCT</option>
                            <option value="Rivers">Rivers</option>
                            <option value="Oyo">Oyo</option>
                        </select>
                    </div>
                </div>

                <!-- Set Default -->
                <div class="flex items-center justify-between pt-2">
                    <div>
                        <span class="font-semibold text-brand-blue text-sm">Set as Default Address</span>
                        <p class="text-xs text-gray-400 mt-0.5">Use this address automatically for future checkouts.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="is_default" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-brand-teal/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-teal"></div>
                    </label>
                </div>

                <!-- Submit -->
                <div class="pt-4">
                    <button type="submit" class="w-full py-3.5 bg-brand-teal hover:bg-brand-blue text-white font-bold rounded-xl shadow-lg transition-colors">
                        Save Address
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- PAYMENT & ORDER PLACEMENT MODAL -->
    <div id="paymentModal" class="modal fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4 z-50 hidden">
        <div class="modal-content bg-white w-full max-w-md rounded-3xl shadow-soft p-6 md:p-8 relative" role="dialog" aria-modal="true">
            
            <!-- Standard Payment Modal Screen -->
            <div id="paymentScreen">
                <div class="flex justify-between items-center border-b border-gray-100 pb-4 mb-6">
                    <h3 class="text-xl font-bold text-brand-blue flex items-center gap-2">
                        <i class="fas fa-credit-card text-brand-teal"></i> Select Payment Method
                    </h3>
                    <button onclick="closePaymentModal()" class="text-gray-400 hover:text-brand-red transition-colors">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>

                <!-- Total display -->
                <div class="bg-brand-grey rounded-2xl p-4 mb-6 text-center">
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Amount Due</span>
                    <h2 class="text-2xl font-extrabold text-brand-blue mt-1" id="paymentModalTotal">₦134,000</h2>
                </div>

                <!-- Payment Methods options -->
                <div class="space-y-3">
                    <!-- Paystack Card -->
                    <div onclick="selectPaymentOption(this, 'card')" class="payment-opt p-4 rounded-xl border-2 border-brand-teal bg-brand-teal/5 cursor-pointer flex items-center justify-between transition-all">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-brand-teal/10 flex items-center justify-center text-brand-teal">
                                <i class="fas fa-credit-card"></i>
                            </div>
                            <div>
                                <p class="font-bold text-sm text-brand-blue">Pay with Card</p>
                                <p class="text-xs text-gray-400">Debit or Credit Card via Paystack</p>
                            </div>
                        </div>
                        <i class="fas fa-circle-check text-brand-teal" id="pay-check-card"></i>
                    </div>

                    <!-- Bank Transfer -->
                    <div onclick="selectPaymentOption(this, 'transfer')" class="payment-opt p-4 rounded-xl border-2 border-gray-100 cursor-pointer flex items-center justify-between transition-all">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-brand-blue/5 flex items-center justify-center text-brand-blue">
                                <i class="fas fa-university"></i>
                            </div>
                            <div>
                                <p class="font-bold text-sm text-brand-blue">Bank Transfer</p>
                                <p class="text-xs text-gray-400">Simulate bank transfer payment</p>
                            </div>
                        </div>
                        <i class="fas fa-circle-check text-gray-200 hidden" id="pay-check-transfer"></i>
                    </div>
                </div>

                <!-- Inline details for card -->
                <div id="cardDetailsForm" class="mt-5 space-y-3">
                    <input type="text" placeholder="Card Number" value="4000 1234 5678 9010" 
                           class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-xs font-semibold text-brand-blue focus:outline-none focus:border-brand-teal">
                    <div class="grid grid-cols-2 gap-3">
                        <input type="text" placeholder="MM/YY" value="12/28" 
                               class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-xs font-semibold text-brand-blue focus:outline-none focus:border-brand-teal">
                        <input type="password" placeholder="CVV" value="123" 
                               class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-xs font-semibold text-brand-blue focus:outline-none focus:border-brand-teal">
                    </div>
                </div>

                <!-- Inline details for transfer -->
                <div id="transferDetailsForm" class="mt-5 bg-brand-grey rounded-2xl p-4 space-y-2 hidden">
                    <p class="text-xs text-gray-500 font-medium">Please transfer the total amount to the account below:</p>
                    <div class="flex justify-between items-center bg-white p-3 rounded-xl border border-gray-100 mt-2">
                        <div>
                            <p class="text-xs font-bold text-brand-blue">Wema Bank (FoodBox NG)</p>
                            <p class="text-sm font-extrabold text-brand-teal tracking-wide">0123456789</p>
                        </div>
                        <button onclick="alert('Account copied!')" class="text-xs font-bold text-brand-blue hover:text-brand-teal transition-colors">
                            Copy
                        </button>
                    </div>
                    <p class="text-[10px] text-gray-400 mt-2">After making the transfer, click the button below to confirm. Verification takes 5-10 seconds.</p>
                </div>

                <button onclick="triggerSimulatedPayment()" id="payNowBtn"
                        class="w-full mt-6 py-4 rounded-xl bg-brand-teal text-white font-bold text-base hover:bg-brand-blue transition-colors flex items-center justify-center gap-2">
                    <i class="fas fa-lock"></i> Pay & Place Order
                </button>
            </div>

            <!-- Confetti Success Screen -->
            <div id="successScreen" class="hidden text-center py-6">
                <div class="w-20 h-20 bg-green-100 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-check text-4xl"></i>
                </div>
                <span class="text-brand-teal font-bold uppercase tracking-wider text-xs">Congratulations!</span>
                <h3 class="text-2xl font-bold text-brand-blue mt-1">Order Placed Successfully</h3>
                
                <p class="text-sm text-gray-500 mt-3 max-w-xs mx-auto">
                    Your payment of <strong id="successTotal">₦134,000</strong> has been confirmed. Order number: <span class="font-mono font-bold text-brand-blue">#FBNG-782910</span>.
                </p>

                <div class="bg-brand-grey rounded-2xl p-4 my-6 text-left max-w-sm mx-auto">
                    <div class="flex items-start gap-2.5">
                        <i class="fas fa-truck text-brand-teal text-sm mt-0.5"></i>
                        <div>
                            <p class="text-xs font-bold text-brand-blue">Scheduled Delivery Date:</p>
                            <p class="text-xs text-gray-500 mt-0.5" id="successDate">Wednesday, Jul 8</p>
                        </div>
                    </div>
                </div>

                <a href="/dashboard" class="inline-block w-full py-4 bg-brand-blue text-white font-bold rounded-xl hover:bg-brand-teal transition-colors">
                    Go to Dashboard
                </a>
            </div>

        </div>
    </div>

    <!-- Footer -->
    @include('layouts.footer')

    <!-- SCRIPTS -->
    <script>
        // Mobile Menu Toggle
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

        // Navbar Scroll Effect
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


        
        /* STATE & CONFIG */
        @php
            $defaultAddress = $addresses->where('is_default', true)->first() ?? $addresses->first();
            $defaultAddressId = $defaultAddress?->id;
            $defaultAddressStr = $defaultAddress 
                ? ($defaultAddress->street_address . ', ' . $defaultAddress->city . ', ' . $defaultAddress->state . ', Nigeria.')
                : "Please select or add an address";
        @endphp
        let cartState = {
            itemCount: 3,
            subtotal: 134000,
            shippingFee: 0,
            discount: 0,
            promoActive: false,
            selectedAddressId: @json($defaultAddressId),
            selectedAddressStr: @json($defaultAddressStr),
            deliveryDate: "",
            deliveryTimeSlot: "Morning (8:00 AM - 12:00 PM)",
            paymentMethod: "card"
        };

        /* ON LOAD */
        document.addEventListener('DOMContentLoaded', () => {
            // Read from local storage if available from step 1
            if (localStorage.getItem('fb_cart_subtotal')) {
                cartState.subtotal = parseInt(localStorage.getItem('fb_cart_subtotal'));
            }
            if (localStorage.getItem('fb_cart_itemCount')) {
                cartState.itemCount = parseInt(localStorage.getItem('fb_cart_itemCount'));
            }
            if (localStorage.getItem('fb_cart_discount')) {
                cartState.discount = parseInt(localStorage.getItem('fb_cart_discount'));
                if (cartState.discount > 0) {
                    cartState.promoActive = true;
                }
            }

            renderDates();
            recalcSummary();
        });

        /* DATES RENDERER */
        // function renderDates() {
        //     const dateList = document.getElementById('dateList');
        //     dateList.innerHTML = '';
            
        //     const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        //     const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            
        //     // Generate Tomorrow + next 4 days
        //     for (let i = 1; i <= 5; i++) {
        //         const date = new Date();
        //         date.setDate(date.getDate() + i);
                
        //         const dayName = days[date.getDay()];
        //         const dayNum = date.getDate();
        //         const monthName = months[date.getMonth()];
        //         const formattedDate = `${dayName}, ${monthName} ${dayNum}`;
                
        //         if (i === 1) {
        //             cartState.deliveryDate = formattedDate; // default to tomorrow
        //         }

        //         const badge = document.createElement('div');
        //         badge.onclick = function() { selectDate(this, formattedDate); };
        //         badge.className = `date-badge flex-shrink-0 px-5 py-3.5 rounded-2xl border-2 text-center min-w-[110px] ${i === 1 ? 'active border-brand-blue bg-brand-blue text-white' : 'border-gray-100 bg-white text-brand-blue hover:border-gray-300'}`;
        //         badge.innerHTML = `
        //             <p class="text-[10px] font-bold tracking-wider uppercase opacity-75">${i === 1 ? 'Tomorrow' : dayName.substring(0, 3)}</p>
        //             <p class="text-lg font-extrabold mt-0.5">${dayNum}</p>
        //             <p class="text-[10px] font-bold opacity-75">${monthName}</p>
        //         `;
        //         dateList.appendChild(badge);
        //     }
        // }

        /* RECALCULATE SUMMARY */
        function recalcSummary() {
            const subtotal = cartState.subtotal;
            const shipping = cartState.shippingFee;
            const discount = cartState.discount;
            const total = subtotal + shipping - discount;

            document.getElementById('itemCount').textContent = cartState.itemCount;
            document.getElementById('summarySubtotal').textContent = '₦' + subtotal.toLocaleString('en-NG');
            
            if (shipping === 0) {
                document.getElementById('summaryShipping').textContent = 'Free';
                document.getElementById('summaryShipping').className = 'font-bold text-brand-teal';
            } else {
                document.getElementById('summaryShipping').textContent = '₦' + shipping.toLocaleString('en-NG');
                document.getElementById('summaryShipping').className = 'font-bold text-brand-blue';
            }

            if (discount > 0) {
                document.getElementById('discountRow').classList.remove('hidden');
                document.getElementById('summaryDiscount').textContent = '-₦' + discount.toLocaleString('en-NG');
            } else {
                document.getElementById('discountRow').classList.add('hidden');
            }

            document.getElementById('summaryTotal').textContent = '₦' + total.toLocaleString('en-NG');
            document.getElementById('summaryAddress').textContent = cartState.selectedAddressStr;
            document.getElementById('paymentModalTotal').textContent = '₦' + total.toLocaleString('en-NG');
            document.getElementById('successTotal').textContent = '₦' + total.toLocaleString('en-NG');
        }

        /* INTERACTIVE SELECTORS */
        function selectAddress(element, id) {
            document.querySelectorAll('.address-card').forEach(card => {
                card.classList.remove('active', 'border-brand-teal');
                card.classList.add('border-gray-100');
                const check = card.querySelector('div[id^="check-icon"]');
                if (check) check.classList.add('hidden');
            });

            element.classList.add('active', 'border-brand-teal');
            element.classList.remove('border-gray-100');
            const check = element.querySelector('div[id^="check-icon"]');
            if (check) check.classList.remove('hidden');

            cartState.selectedAddressId = id;
            cartState.selectedAddressStr = element.querySelector('p.text-gray-600').textContent.trim();
            recalcSummary();
        }

        function selectDeliveryMethod(element, method, fee) {
            document.querySelectorAll('.method-card').forEach(card => {
                card.classList.remove('active', 'border-brand-teal', 'bg-brand-teal/5');
                card.classList.add('border-gray-100');
            });

            element.classList.add('active', 'border-brand-teal', 'bg-brand-teal/5');
            element.classList.remove('border-gray-100');

            cartState.shippingFee = fee;
            recalcSummary();
        }

        function selectDate(element, dateStr) {
            document.querySelectorAll('.date-badge').forEach(badge => {
                badge.classList.remove('active', 'bg-brand-blue', 'text-white', 'border-brand-blue');
                badge.classList.add('border-gray-100', 'bg-white', 'text-brand-blue');
            });

            element.classList.add('active', 'bg-brand-blue', 'text-white', 'border-brand-blue');
            element.classList.remove('border-gray-100', 'bg-white', 'text-brand-blue');

            cartState.deliveryDate = dateStr;
        }

        function selectTimeSlot(element, slotName) {
            document.querySelectorAll('.slot-card').forEach(card => {
                card.classList.remove('active', 'border-brand-teal', 'bg-brand-teal/5');
                card.classList.add('border-gray-100');
            });

            element.classList.add('active', 'border-brand-teal', 'bg-brand-teal/5');
            element.classList.remove('border-gray-100');

            cartState.deliveryTimeSlot = slotName;
        }

        /* MODAL: ADD ADDRESS */
        function openAddressModal() {
            const modal = document.getElementById('addressModal');
            modal.classList.remove('hidden');
            setTimeout(() => modal.classList.add('visible'), 50);
            document.body.style.overflow = 'hidden';
        }

        function closeAddressModal() {
            const modal = document.getElementById('addressModal');
            modal.classList.remove('visible');
            setTimeout(() => modal.classList.add('hidden'), 300);
            document.body.style.overflow = '';
        }

        function handleNewAddressSubmit(event) {
            event.preventDefault();
            
            const submitBtn = event.target.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.innerHTML;
            
            const label = document.getElementById('address_label').value;
            const name = document.getElementById('contact_name').value;
            const phone = document.getElementById('phone_number').value;
            const street = document.getElementById('street_address').value;
            const city = document.getElementById('city').value;
            const state = document.getElementById('state').value;
            const isDefault = document.getElementById('is_default').checked;

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin text-sm mr-2"></i> Saving...';

            fetch('/addresses', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    label: label,
                    recipient_name: name,
                    phone: phone,
                    street_address: street,
                    city: city,
                    state: state,
                    is_default: isDefault
                })
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    const newId = data.address.id;
                    const addressString = `${street}, ${city}, ${state}, Nigeria.`;

                    // Hide empty state if active
                    const emptyState = document.getElementById('emptyAddressState');
                    const addressGrid = document.getElementById('addressGrid');
                    if (emptyState) {
                        emptyState.classList.add('hidden');
                    }
                    if (addressGrid) {
                        addressGrid.classList.remove('hidden');
                    }

                    // Create new address card HTML
                    const newCard = document.createElement('div');
                    newCard.className = 'address-card bg-white p-5 rounded-2xl border-2 border-gray-100 relative flex flex-col justify-between';
                    newCard.setAttribute('onclick', `selectAddress(this, ${newId})`);
                    newCard.setAttribute('data-id', newId);
                    
                    let labelClass = 'bg-brand-teal/10 text-brand-teal';
                    const labelUpper = label.toUpperCase();
                    if (['OFFICE', 'WORK', 'WORK OFFICE'].includes(labelUpper)) labelClass = 'bg-brand-blue/5 text-brand-blue';
                    if (labelUpper === 'HOSTEL') labelClass = 'bg-brand-gold/20 text-brand-blue';

                    newCard.innerHTML = `
                        <div class="absolute top-4 right-4 text-brand-teal hidden" id="check-icon-${newId}">
                            <i class="fas fa-check-circle text-lg"></i>
                        </div>
                        <div>
                            <div class="flex items-center gap-2 mb-3">
                                <span class="${labelClass} text-xs font-bold px-2.5 py-0.5 rounded-full">${label}</span>
                                ${isDefault ? '<span class="text-gray-400 text-xs font-semibold">DEFAULT</span>' : ''}
                            </div>
                            <h4 class="font-bold text-brand-blue text-base">${name}</h4>
                            <p class="text-sm text-gray-500 font-medium mt-0.5"><i class="fas fa-phone-alt text-xs mr-1 text-gray-400"></i> ${phone}</p>
                            <p class="text-sm text-gray-600 mt-3 leading-relaxed">${addressString}</p>
                        </div>
                    `;

                    // If default was checked, clear DEFAULT label on other cards
                    if (isDefault) {
                        document.querySelectorAll('.address-card').forEach(card => {
                            const labels = card.querySelectorAll('.text-gray-400.text-xs.font-semibold');
                            labels.forEach(lbl => {
                                if (lbl.textContent.trim() === 'DEFAULT') {
                                    lbl.remove();
                                }
                            });
                        });
                    }

                    addressGrid.appendChild(newCard);

                    // Select this new card
                    selectAddress(newCard, newId);
                    
                    // Clean & close modal
                    closeAddressModal();
                    event.target.reset();
                } else {
                    alert(data.message || 'Failed to save address.');
                }
            })
            .catch(error => {
                console.error('Error saving address:', error);
                if (error.errors) {
                    const errorMessages = Object.values(error.errors).flat().join('\n');
                    alert('Validation error(s):\n' + errorMessages);
                } else {
                    alert(error.message || 'An error occurred while saving the address.');
                }
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
            });
        }

        /* MODAL: PAYMENT */
        function handlePaymentProceed() {
            if (!cartState.selectedAddressId) {
                alert('Please select or add a delivery address first.');
                return;
            }
            const btn = document.getElementById('paymentBtn');
            btn.disabled = true;
            btn.classList.add('opacity-70', 'cursor-not-allowed', 'btn-pulse');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin text-sm"></i> Preparing Payment...';
            
            setTimeout(() => {
                btn.disabled = false;
                btn.classList.remove('opacity-70', 'cursor-not-allowed', 'btn-pulse');
                btn.innerHTML = '<i class="fas fa-lock text-sm"></i> Proceed to Payment';
                
                // Show modal
                const modal = document.getElementById('paymentModal');
                modal.classList.remove('hidden');
                setTimeout(() => modal.classList.add('visible'), 50);
                document.body.style.overflow = 'hidden';
            }, 1200);
        }

        function closePaymentModal() {
            const modal = document.getElementById('paymentModal');
            modal.classList.remove('visible');
            setTimeout(() => {
                modal.classList.add('hidden');
                document.getElementById('paymentScreen').classList.remove('hidden');
                document.getElementById('successScreen').classList.add('hidden');
            }, 300);
            document.body.style.overflow = '';
        }

        function selectPaymentOption(element, method) {
            document.querySelectorAll('.payment-opt').forEach(opt => {
                opt.classList.remove('border-brand-teal', 'bg-brand-teal/5');
                opt.classList.add('border-gray-100');
            });
            document.getElementById('pay-check-card').classList.add('hidden');
            document.getElementById('pay-check-transfer').classList.add('hidden');

            element.classList.add('border-brand-teal', 'bg-brand-teal/5');
            element.classList.remove('border-gray-100');

            if (method === 'card') {
                document.getElementById('pay-check-card').classList.remove('hidden');
                document.getElementById('cardDetailsForm').classList.remove('hidden');
                document.getElementById('transferDetailsForm').classList.add('hidden');
            } else {
                document.getElementById('pay-check-transfer').classList.remove('hidden');
                document.getElementById('cardDetailsForm').classList.add('hidden');
                document.getElementById('transferDetailsForm').classList.remove('hidden');
            }

            cartState.paymentMethod = method;
        }

        function triggerSimulatedPayment() {
            const btn = document.getElementById('payNowBtn');
            btn.disabled = true;
            btn.classList.add('opacity-70', 'cursor-not-allowed');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin text-sm"></i> Verifying transaction...';

            setTimeout(() => {
                // Clear cart from local storage since it was ordered
                localStorage.removeItem('fb_cart_subtotal');
                localStorage.removeItem('fb_cart_itemCount');
                localStorage.removeItem('fb_cart_discount');

                // Switch screen
                document.getElementById('paymentScreen').classList.add('hidden');
                document.getElementById('successScreen').classList.remove('hidden');
                document.getElementById('successDate').textContent = `${cartState.deliveryDate} during ${cartState.deliveryTimeSlot.split(' ')[0]} slot`;
            }, 2500);
        }
    </script>
</body>
</html>