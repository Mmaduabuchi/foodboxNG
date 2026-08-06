<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Support | FoodBox NG</title>
    
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
                            teal: '#2A9D8F', // Primary Action/Highlight
                            blue: '#264653', // Deep Text/Background
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
    </style>
</head>
<body class="bg-brand-grey text-brand-blue antialiased min-h-screen">

    @include('dashboard.header')

    <!-- Main Content Area -->
    <main class="p-4 mt-20 md:p-8 lg:ml-64 main-content">

        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl mb-6 shadow-sm flex items-center justify-between" role="alert">
                <div class="flex items-center gap-3">
                    <i class="fas fa-check-circle text-emerald-500 text-xl"></i>
                    <div>
                        <strong class="font-bold text-sm">Success!</strong>
                        <p class="text-xs text-emerald-700 mt-0.5">{{ session('success') }}</p>
                    </div>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800 text-sm">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 px-5 py-4 rounded-2xl mb-6 shadow-sm flex items-center justify-between" role="alert">
                <div class="flex items-center gap-3">
                    <i class="fas fa-exclamation-circle text-red-500 text-xl"></i>
                    <div>
                        <strong class="font-bold text-sm">Error!</strong>
                        <p class="text-xs text-red-700 mt-0.5">{{ session('error') }}</p>
                    </div>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-800 text-sm">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        <!-- Page Header & Description Banner -->
        <div class="bg-white p-6 md:p-8 rounded-2xl shadow-soft mb-8 border-l-4 border-brand-teal flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <span class="px-3 py-1 bg-brand-teal/10 text-brand-teal font-bold text-xs rounded-full uppercase tracking-wider">
                        Help & Support
                    </span>
                    <span class="text-xs text-gray-400 font-medium flex items-center gap-1">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Support Online
                    </span>
                </div>
                <h1 class="text-2xl md:text-3xl font-extrabold text-brand-blue tracking-tight">
                    Contact Customer Support
                </h1>
                <p class="text-gray-600 text-sm md:text-base mt-1 max-w-2xl leading-relaxed">
                    Have a question about your order, package subscription, or delivery? Submit a ticket below or track your recent support requests.
                </p>
            </div>

            <!-- Quick Support Stats / Info -->
            <div class="flex items-center gap-4 border-t md:border-t-0 md:border-l border-gray-100 pt-4 md:pt-0 md:pl-6 shrink-0">
                <div class="flex items-center gap-3 bg-brand-grey/60 px-4 py-3 rounded-xl">
                    <div class="w-10 h-10 rounded-lg bg-brand-teal/10 flex items-center justify-center text-brand-teal shrink-0">
                        <i class="fas fa-headset text-lg"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium">Avg Response Time</p>
                        <p class="text-sm font-bold text-brand-blue">&lt; 24 Hours</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
            
            <!-- Left Column: Support Ticket Form (2/3 width on desktop) -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white p-6 md:p-8 rounded-2xl shadow-soft">
                    
                    <div class="flex items-center justify-between pb-6 mb-6 border-b border-gray-100">
                        <div>
                            <h2 class="text-xl font-bold text-brand-blue flex items-center gap-2">
                                <i class="fas fa-ticket-alt text-brand-teal"></i> Create a Support Ticket
                            </h2>
                            <p class="text-xs text-gray-500 mt-1">Fill in the details below to reach our dedicated support desk.</p>
                        </div>
                        <span class="text-xs font-semibold text-gray-400">Step 1 of 1</span>
                    </div>

                    <!-- Support Form -->
                    <form action="{{ route('support.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" onsubmit="handleSupportSubmit(this)">
                        @csrf

                        <!-- Subject Dropdown & Priority Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            
                            <!-- Subject Dropdown -->
                            <div class="md:col-span-2 space-y-2">
                                <label for="subject" class="text-sm font-bold text-gray-700 flex items-center gap-1.5">
                                    Subject / Issue Category <span class="text-brand-red">*</span>
                                </label>
                                <div class="relative">
                                    <select id="subject" name="subject" required class="w-full px-4 py-3.5 rounded-xl border border-gray-200 focus:border-brand-teal focus:ring-2 focus:ring-brand-teal/20 outline-none transition-all bg-gray-50/80 text-gray-700 font-medium appearance-none cursor-pointer">
                                        <option value="" disabled selected>Select a subject or issue type...</option>
                                        <option value="Order Placement & Delivery Issue">Order Placement & Delivery Issue</option>
                                        <option value="Subscription Package & Billing">Subscription Package & Billing</option>
                                        <option value="Produce Quality & Freshness Guarantee">Produce Quality & Freshness Guarantee</option>
                                        <option value="Delivery Address Modification">Delivery Address Modification</option>
                                        <option value="Payment Confirmation & Receipts">Payment Confirmation & Receipts</option>
                                        <option value="Account Security & Login Help">Account Security & Login Help</option>
                                        <option value="General Inquiry or Feedback">General Inquiry or Feedback</option>
                                    </select>
                                    <i class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-xs"></i>
                                </div>
                            </div>

                            <!-- Priority Select -->
                            <div class="space-y-2">
                                <label for="priority" class="text-sm font-bold text-gray-700">
                                    Priority Level
                                </label>
                                <div class="relative">
                                    <select id="priority" name="priority" class="w-full px-4 py-3.5 rounded-xl border border-gray-200 focus:border-brand-teal focus:ring-2 focus:ring-brand-teal/20 outline-none transition-all bg-gray-50/80 text-gray-700 font-medium appearance-none cursor-pointer">
                                        <option value="Medium" selected>Medium Priority</option>
                                        <option value="Low">Low Priority</option>
                                        <option value="High">High / Urgent</option>
                                    </select>
                                    <i class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-xs"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Message Textarea -->
                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <label for="message" class="text-sm font-bold text-gray-700 flex items-center gap-1.5">
                                    Message Details <span class="text-brand-red">*</span>
                                </label>
                                <span class="text-xs text-gray-400">Include Order ID if relevant</span>
                            </div>
                            <textarea id="message" name="message" rows="5" required placeholder="Please describe your issue or question in detail. For order-related inquiries, include your Order ID or delivery address..." class="w-full px-4 py-3.5 rounded-xl border border-gray-200 focus:border-brand-teal focus:ring-2 focus:ring-brand-teal/20 outline-none transition-all bg-gray-50/80 text-gray-700 placeholder-gray-400 leading-relaxed resize-none"></textarea>
                        </div>

                        <!-- Optional File Upload Drop Zone -->
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-gray-700 flex items-center justify-between">
                                <span>Attach File / Image <span class="text-xs text-gray-400 font-normal">(Optional)</span></span>
                                <span class="text-xs text-gray-400">PNG, JPG, PDF up to 5MB</span>
                            </label>
                            
                            <div class="relative border-2 border-dashed border-gray-200 rounded-2xl p-6 text-center hover:border-brand-teal transition-all bg-gray-50/50 group cursor-pointer" onclick="document.getElementById('fileUpload').click()">
                                <input type="file" id="fileUpload" name="attachment" class="hidden" onchange="handleFileSelect(this)">
                                
                                <div id="uploadPlaceholder" class="space-y-2">
                                    <div class="w-12 h-12 rounded-full bg-brand-teal/10 text-brand-teal flex items-center justify-center mx-auto group-hover:scale-110 transition-transform">
                                        <i class="fas fa-cloud-upload-alt text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-brand-blue">
                                            Click to upload <span class="font-normal text-gray-500">or drag and drop</span>
                                        </p>
                                        <p class="text-xs text-gray-400 mt-1">Attach receipts, produce photos, or screenshots</p>
                                    </div>
                                </div>

                                <!-- File Selected Preview -->
                                <div id="filePreview" class="hidden flex items-center justify-between bg-white p-3 rounded-xl border border-gray-200 text-left">
                                    <div class="flex items-center gap-3 min-w-0">
                                        <div class="w-10 h-10 rounded-lg bg-brand-teal/10 text-brand-teal flex items-center justify-center shrink-0">
                                            <i class="fas fa-file-alt text-lg"></i>
                                        </div>
                                        <div class="min-w-0">
                                            <p id="fileName" class="text-sm font-bold text-brand-blue truncate">filename.jpg</p>
                                            <p id="fileSize" class="text-xs text-gray-400">2.4 MB</p>
                                        </div>
                                    </div>
                                    <button type="button" onclick="event.stopPropagation(); clearFile()" class="p-2 text-gray-400 hover:text-brand-red transition-colors">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-2 flex items-center justify-end">
                            <button type="submit" id="submitBtn" class="w-full sm:w-auto bg-brand-teal text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-brand-teal/30 hover:bg-brand-blue hover:scale-[1.01] active:scale-[0.99] transition-all duration-300 flex items-center justify-center gap-3 text-base disabled:opacity-75 disabled:cursor-not-allowed">
                                <span id="btnText">Submit Ticket</span>
                                <i id="btnIcon" class="fas fa-paper-plane text-sm"></i>
                                <i id="btnSpinner" class="fas fa-spinner fa-spin text-sm hidden"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Column: Direct Contact Info & FAQ Quick Cards (1/3 width on desktop) -->
            <div class="lg:col-span-1 space-y-6">
                
                <!-- Support Channels Card -->
                <div class="bg-white p-6 rounded-2xl shadow-soft">
                    <h3 class="text-lg font-bold text-brand-blue mb-4 flex items-center gap-2">
                        <i class="fas fa-life-ring text-brand-orange"></i> Direct Support Lines
                    </h3>

                    <div class="space-y-4">
                        <div class="flex items-start gap-4 p-3.5 rounded-xl bg-brand-grey/50 hover:bg-brand-grey transition-colors">
                            <div class="w-10 h-10 rounded-lg bg-brand-teal/10 text-brand-teal flex items-center justify-center shrink-0">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-sm text-brand-blue">Phone Support</h4>
                                <p class="text-xs text-gray-600 font-medium">+234 800 FOOD BOX</p>
                                <p class="text-[11px] text-gray-400 mt-0.5">Mon - Sat, 8:00 AM - 6:00 PM</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-3.5 rounded-xl bg-brand-grey/50 hover:bg-brand-grey transition-colors">
                            <div class="w-10 h-10 rounded-lg bg-brand-gold/20 text-brand-blue flex items-center justify-center shrink-0">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-sm text-brand-blue">Email Support</h4>
                                <p class="text-xs text-gray-600 font-medium">support@foodbox.ng</p>
                                <p class="text-[11px] text-gray-400 mt-0.5">24/7 Ticketing Response</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-3.5 rounded-xl bg-brand-grey/50 hover:bg-brand-grey transition-colors">
                            <div class="w-10 h-10 rounded-lg bg-brand-blue/10 text-brand-blue flex items-center justify-center shrink-0">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-sm text-brand-blue">Head Office</h4>
                                <p class="text-xs text-gray-600">12 Guzape hills, Abuja, FCT</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Freshness Guarantee Card -->
                <div class="bg-gradient-to-br from-brand-blue to-brand-blue/90 p-6 rounded-2xl shadow-soft text-white relative overflow-hidden">
                    <div class="absolute -right-4 -bottom-4 opacity-10 text-9xl">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="relative z-10 space-y-3">
                        <span class="inline-block px-3 py-1 rounded-full bg-brand-gold/20 text-brand-gold text-xs font-bold uppercase tracking-wider">
                            Freshness Guarantee
                        </span>
                        <h4 class="text-lg font-bold">100% Quality Replacement</h4>
                        <p class="text-xs text-white/80 leading-relaxed">
                            Received produce that doesn't meet your standards? Attach a photo in your ticket within 24 hours of delivery for an instant replacement or refund.
                        </p>
                    </div>
                </div>

            </div>
        </div>

        <!-- RECENT SUPPORT TICKETS SECTION -->
        <section class="bg-white p-6 md:p-8 rounded-2xl shadow-soft mb-12">
            
            <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 mb-6 border-b border-gray-100 gap-4">
                <div>
                    <div class="flex items-center gap-3">
                        <h2 class="text-xl font-bold text-brand-blue">Recent Support Tickets</h2>
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-brand-teal/10 text-brand-teal">
                            {{ isset($tickets) ? $tickets->total() : 0 }} {{ Str::plural('Ticket', isset($tickets) ? $tickets->total() : 0) }}
                        </span>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Track status and conversation history for your submitted tickets.</p>
                </div>
            </div>

            <!-- Tickets Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead>
                        <tr class="bg-brand-grey/60 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                            <th class="px-6 py-4 rounded-l-xl">Ticket ID</th>
                            <th class="px-6 py-4">Subject</th>
                            <th class="px-6 py-4">Priority</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Date</th>
                            <th class="px-6 py-4 text-right rounded-r-xl">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm font-medium text-brand-blue">
                        
                        @forelse($tickets as $ticket)
                            <tr class="hover:bg-brand-grey/40 transition-colors">
                                <td class="px-6 py-4 font-bold text-brand-teal whitespace-nowrap">
                                    #{{ $ticket->ticket_id }}
                                </td>
                                <td class="px-6 py-4 max-w-xs truncate">
                                    <span class="font-bold text-brand-blue block">{{ $ticket->subject }}</span>
                                    <span class="text-xs text-gray-400 truncate block max-w-xs">{{ Str::limit($ticket->message, 45) }}</span>
                                </td>
                                <td class="px-6 py-4 text-xs whitespace-nowrap">
                                    <span class="px-2.5 py-1 rounded-md text-[11px] font-bold 
                                        {{ $ticket->priority === 'High' ? 'bg-red-100 text-red-700' : ($ticket->priority === 'Low' ? 'bg-gray-100 text-gray-700' : 'bg-blue-50 text-blue-700') }}">
                                        {{ $ticket->priority ?? 'Medium' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($ticket->status === 'In Progress')
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700 flex items-center gap-1.5 w-fit">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> In Progress
                                        </span>
                                    @elseif($ticket->status === 'Resolved')
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700 flex items-center gap-1.5 w-fit">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Resolved
                                        </span>
                                    @elseif($ticket->status === 'Closed')
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-700 flex items-center gap-1.5 w-fit">
                                            <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span> Closed
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700 flex items-center gap-1.5 w-fit">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Open
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-xs text-gray-500 whitespace-nowrap">
                                    {{ $ticket->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <button type="button"
                                        onclick="openTicketModal(
                                            '#{{ $ticket->ticket_id }}', 
                                            '{{ addslashes($ticket->subject) }}', 
                                            '{{ $ticket->status }}', 
                                            '{{ $ticket->created_at->format('M d, Y \a\t h:i A') }}', 
                                            '{{ addslashes($ticket->message) }}',
                                            '{{ addslashes($ticket->admin_feedback ?? 'No response from support yet. Our team is actively processing your request.') }}',
                                            '{{ $ticket->attachment ? asset('storage/' . $ticket->attachment) : '' }}'
                                        )" 
                                        class="px-4 py-2 rounded-xl text-xs font-bold bg-brand-blue/10 text-brand-blue hover:bg-brand-teal hover:text-white transition-all duration-200"
                                    >
                                        View <i class="fas fa-chevron-right text-[10px] ml-1"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-10 text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 mb-3">
                                            <i class="fas fa-ticket-alt text-xl"></i>
                                        </div>
                                        <p class="font-bold text-gray-600">No support tickets found</p>
                                        <p class="text-xs text-gray-400 mt-1">Submit your first support request using the form above.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            @if(isset($tickets) && $tickets->hasPages())
                <div class="mt-6 pt-4 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-xs text-gray-500">
                        Showing <span class="font-bold text-brand-blue">{{ $tickets->firstItem() }}</span> to <span class="font-bold text-brand-blue">{{ $tickets->lastItem() }}</span> of <span class="font-bold text-brand-blue">{{ $tickets->total() }}</span> tickets
                    </p>
                    <div>
                        {{ $tickets->links() }}
                    </div>
                </div>
            @endif
        </section>

        <!-- Footer Spacer -->
        <div class="h-12"></div>
    </main>

    <!-- TICKET DETAIL VIEW MODAL -->
    <div id="ticketModal" class="fixed inset-0 bg-black/50 z-50 hidden opacity-0 transition-opacity duration-300 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 md:p-8 shadow-xl transform scale-95 transition-transform duration-300 space-y-6 max-h-[90vh] overflow-y-auto">
            
            <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                <div>
                    <span id="modalTicketId" class="text-xs font-extrabold text-brand-teal uppercase tracking-wider">#TKT-0000</span>
                    <h3 id="modalSubject" class="text-lg font-bold text-brand-blue mt-0.5">Ticket Subject</h3>
                </div>
                <button onclick="closeTicketModal()" class="w-8 h-8 rounded-full bg-gray-100 text-gray-400 hover:text-brand-blue flex items-center justify-center transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="space-y-4">
                <div class="flex items-center justify-between bg-brand-grey/60 p-3.5 rounded-xl">
                    <span class="text-xs text-gray-500 font-medium">Status:</span>
                    <span id="modalStatus" class="px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">In Progress</span>
                </div>
                <div class="flex items-center justify-between bg-brand-grey/60 p-3.5 rounded-xl">
                    <span class="text-xs text-gray-500 font-medium">Created On:</span>
                    <span id="modalDate" class="text-xs font-bold text-brand-blue">Aug 05, 2026</span>
                </div>

                <!-- User Message -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Your Message:</label>
                    <div id="modalUserMessage" class="p-4 rounded-xl bg-gray-50 border border-gray-200 text-sm text-gray-700 leading-relaxed whitespace-pre-line">
                        Message details...
                    </div>
                </div>

                <!-- Attachment Link -->
                <div id="modalAttachmentContainer" class="hidden">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider block mb-1">Attached Document:</label>
                    <a id="modalAttachmentLink" href="#" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-brand-teal/10 text-brand-teal font-bold text-xs rounded-xl hover:bg-brand-teal hover:text-white transition-colors">
                        <i class="fas fa-paperclip"></i> View Attached File
                    </a>
                </div>

                <!-- Support Response -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Support Team Response:</label>
                    <div id="modalAdminReply" class="p-4 rounded-xl bg-teal-50/70 border border-teal-100 text-sm text-brand-blue leading-relaxed whitespace-pre-line">
                        Support reply...
                    </div>
                </div>
            </div>

            <div class="pt-2 flex justify-end">
                <button onclick="closeTicketModal()" class="w-full sm:w-auto px-6 py-2.5 rounded-xl bg-brand-blue text-white font-bold text-sm hover:bg-brand-teal transition-colors">
                    Close Details
                </button>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Submit Button Loading State Handler
        function handleSupportSubmit(form) {
            const btn = document.getElementById('submitBtn');
            const text = document.getElementById('btnText');
            const icon = document.getElementById('btnIcon');
            const spinner = document.getElementById('btnSpinner');

            if (btn) {
                btn.disabled = true;
                if (text) text.innerText = 'Submitting...';
                if (icon) icon.classList.add('hidden');
                if (spinner) spinner.classList.remove('hidden');
            }
        }

        // File selection handler
        function handleFileSelect(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                document.getElementById('fileName').innerText = file.name;
                document.getElementById('fileSize').innerText = (file.size / (1024 * 1024)).toFixed(2) + ' MB';
                
                document.getElementById('uploadPlaceholder').classList.add('hidden');
                document.getElementById('filePreview').classList.remove('hidden');
            }
        }

        // Clear attached file
        function clearFile() {
            const input = document.getElementById('fileUpload');
            input.value = '';
            document.getElementById('uploadPlaceholder').classList.remove('hidden');
            document.getElementById('filePreview').classList.add('hidden');
        }

        // Modal Handler
        function openTicketModal(id, subject, status, date, userMsg, adminReply, attachmentUrl) {
            document.getElementById('modalTicketId').innerText = id;
            document.getElementById('modalSubject').innerText = subject;
            document.getElementById('modalStatus').innerText = status;
            document.getElementById('modalDate').innerText = date;
            document.getElementById('modalUserMessage').innerText = userMsg;
            document.getElementById('modalAdminReply').innerText = adminReply;

            const attachmentContainer = document.getElementById('modalAttachmentContainer');
            const attachmentLink = document.getElementById('modalAttachmentLink');
            if (attachmentUrl && attachmentUrl.trim() !== '') {
                attachmentLink.href = attachmentUrl;
                attachmentContainer.classList.remove('hidden');
            } else {
                attachmentContainer.classList.add('hidden');
            }

            const modal = document.getElementById('ticketModal');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
            }, 10);
        }

        function closeTicketModal() {
            const modal = document.getElementById('ticketModal');
            modal.classList.add('opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
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