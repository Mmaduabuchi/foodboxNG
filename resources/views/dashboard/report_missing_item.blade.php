<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Issue | FoodBox NG</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Tailwind Config (Reused from Dashboard) -->
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
            transform: translateX(-100%);
            z-index: 50;
        }
        #sidebar.open {
            transform: translateX(0);
        }
        
        /* Backdrop for mobile sidebar */
        #backdrop {
            transition: opacity 0.3s ease-in-out;
        }

        /* Styling for the main content area */
        .main-content {
            padding-top: 5rem; /* Space for the fixed header */
        }

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
            border-color: #2A9D8F; /* Brand Teal on focus */
            box-shadow: 0 0 0 2px rgba(42, 157, 143, 0.2);
        }

        /* Active link styling (My Packages is active here as it's the gateway) */
        .nav-link.active {
            background-color: #2A9D8F;
            color: white;
            box-shadow: 0 5px 15px -5px rgba(42, 157, 143, 0.4);
        }
        .nav-link.active i {
            color: #E9C46A; /* Gold icon when active */
        }

        /* Step Indicator Styling */
        .step-indicator {
            @apply flex items-center justify-center w-10 h-10 rounded-full font-bold text-lg transition-colors duration-300;
        }
        .step-active {
            @apply bg-brand-teal text-white shadow-md shadow-brand-teal/30;
        }
        .step-complete {
            @apply bg-brand-gold text-brand-blue/80;
        }
        .step-pending {
            @apply bg-gray-200 text-gray-500;
        }
    </style>
</head>
<body class="bg-brand-grey text-brand-blue antialiased min-h-screen">

    @include('dashboard.header')

    <!-- Main Content Area -->
    <main class="mt-20 p-4 md:p-8 main-content">
        
        <!-- Header Section -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-brand-blue mb-1">Report an Issue with a Package</h1>
                <p class="text-gray-600">Quickly file a report for missing items, damaged goods, or incorrect packages.</p>
            </div>
            <a href="foodbox_my_packages.html" class="hidden sm:inline-flex items-center text-brand-teal hover:text-brand-blue transition-colors font-medium">
                <i class="fas fa-arrow-left mr-2"></i> Back to My Packages
            </a>
        </div>

        <!-- Main Form Container -->
        <div class="bg-white p-6 md:p-10 rounded-3xl shadow-soft">
            
            <!-- Step Indicators -->
            <div class="flex justify-between items-center mb-10 max-w-lg mx-auto">
                <div class="text-center">
                    <div id="step-1-indicator" class="step-indicator step-active">1</div>
                    <p class="text-xs mt-1 font-medium text-brand-blue">Select Package</p>
                </div>
                <div class="flex-grow h-0.5 bg-gray-200 mx-2"></div>
                <div class="text-center">
                    <div id="step-2-indicator" class="step-indicator step-pending">2</div>
                    <p class="text-xs mt-1 font-medium text-gray-500">Identify Issue</p>
                </div>
                <div class="flex-grow h-0.5 bg-gray-200 mx-2"></div>
                <div class="text-center">
                    <div id="step-3-indicator" class="step-indicator step-pending">3</div>
                    <p class="text-xs mt-1 font-medium text-gray-500">Review & Submit</p>
                </div>
            </div>

            <!-- Form Content (Simulated Steps) -->
            <form id="report-form" onsubmit="event.preventDefault(); nextStep();">
                
                <!-- Step 1: Select Package (Current View) -->
                <div id="step-1" class="step-content">
                    <h3 class="text-xl font-semibold text-brand-blue mb-5 border-b border-brand-grey pb-3">Step 1: Which package has the issue?</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Package Option 1 (Recent) -->
                        <label class="block cursor-pointer">
                            <input type="radio" name="package_id" value="FB-5477" class="hidden" checked>
                            <div class="p-5 border-2 border-brand-teal/50 rounded-xl transition-all shadow-sm bg-brand-teal/5 hover:bg-brand-teal/10 radio-card">
                                <p class="text-lg font-bold text-brand-blue">#FB-5477 - Weekly Family Box</p>
                                <p class="text-sm text-gray-600 my-1">Delivered: Nov 27, 2025 at 3:15 PM</p>
                                <p class="text-xs font-medium text-brand-teal">Contents: Fish, Plantain, Peppers, Onions...</p>
                                <div class="mt-3 text-xs font-semibold px-2 py-0.5 w-max rounded-full bg-brand-gold/20 text-brand-gold">
                                    <i class="fas fa-truck mr-1"></i> Delivered 2 days ago
                                </div>
                            </div>
                        </label>
                        
                        <!-- Package Option 2 (Older) -->
                        <label class="block cursor-pointer">
                            <input type="radio" name="package_id" value="FB-5463" class="hidden">
                            <div class="p-5 border-2 border-gray-200 rounded-xl transition-all shadow-sm hover:bg-brand-grey/50 radio-card">
                                <p class="text-lg font-bold text-brand-blue">#FB-5463 - Keto Health Pack</p>
                                <p class="text-sm text-gray-600 my-1">Delivered: Nov 07, 2025 at 1:50 PM</p>
                                <p class="text-xs font-medium text-brand-blue/70">Contents: Beef, Avocados, Broccoli, Eggs...</p>
                                <div class="mt-3 text-xs font-semibold px-2 py-0.5 w-max rounded-full bg-gray-200 text-gray-600">
                                    <i class="fas fa-history mr-1"></i> Delivered 3 weeks ago
                                </div>
                            </div>
                        </label>
                    </div>

                    <div class="flex justify-end mt-8">
                        <button type="button" onclick="nextStep()" class="px-8 py-3 bg-brand-teal text-white font-semibold rounded-xl hover:bg-brand-teal/90 transition-colors shadow-sm-brand">
                            Next: Identify Issue <i class="fas fa-chevron-right ml-2 text-sm"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 2: Identify Issue (Hidden by default) -->
                <div id="step-2" class="step-content hidden">
                    <h3 class="text-xl font-semibold text-brand-blue mb-5 border-b border-brand-grey pb-3">Step 2: Describe the issue</h3>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="issue_type">What kind of issue are you reporting?</label>
                        <select id="issue_type" name="issue_type" class="form-input" required>
                            <option value="" disabled selected>Select an issue type</option>
                            <option value="missing">Missing Item(s) in Package</option>
                            <option value="damaged">Damaged or Spoiled Item(s)</option>
                            <option value="incorrect">Incorrect Item(s) Delivered</option>
                            <option value="other">Other Issue</option>
                        </select>
                    </div>

                    <div id="missing-item-section" class="mb-6 p-4 border border-brand-orange/50 bg-brand-orange/5 rounded-xl">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Which items are affected?</label>
                        <div class="space-y-3">
                            <!-- Mock Checklist of Items in Package FB-5477 -->
                            <div class="flex items-center">
                                <input id="item_fish" type="checkbox" name="affected_items" value="Fish" class="w-5 h-5 text-brand-teal border-gray-300 rounded focus:ring-brand-teal/50">
                                <label for="item_fish" class="ml-3 text-brand-blue font-medium">1kg of Tilapia Fish</label>
                            </div>
                            <div class="flex items-center">
                                <input id="item_plantain" type="checkbox" name="affected_items" value="Plantain" class="w-5 h-5 text-brand-teal border-gray-300 rounded focus:ring-brand-teal/50">
                                <label for="item_plantain" class="ml-3 text-brand-blue font-medium">Bunch of Ripe Plantains</label>
                            </div>
                            <div class="flex items-center">
                                <input id="item_peppers" type="checkbox" name="affected_items" value="Peppers" class="w-5 h-5 text-brand-teal border-gray-300 rounded focus:ring-brand-teal/50">
                                <label for="item_peppers" class="ml-3 text-brand-blue font-medium">Bag of Assorted Peppers</label>
                            </div>
                            <div class="flex items-center">
                                <input id="item_oil" type="checkbox" name="affected_items" value="Oil" class="w-5 h-5 text-brand-teal border-gray-300 rounded focus:ring-brand-teal/50">
                                <label for="item_oil" class="ml-3 text-brand-blue font-medium">1L Cooking Oil</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="detailed_description">Detailed Description <span class="text-gray-500">(Required)</span></label>
                        <textarea id="detailed_description" name="detailed_description" rows="4" class="form-input" placeholder="e.g., The 1kg of Tilapia Fish was missing, or the Plantains were bruised and spoiled." required></textarea>
                    </div>

                    <div class="flex justify-between mt-8">
                        <button type="button" onclick="prevStep()" class="px-6 py-3 bg-brand-blue/10 text-brand-blue font-semibold rounded-xl hover:bg-brand-blue/20 transition-colors">
                            <i class="fas fa-chevron-left mr-2 text-sm"></i> Back
                        </button>
                        <button type="button" onclick="nextStep()" class="px-8 py-3 bg-brand-teal text-white font-semibold rounded-xl hover:bg-brand-teal/90 transition-colors shadow-sm-brand">
                            Next: Review & Submit <i class="fas fa-chevron-right ml-2 text-sm"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 3: Review & Submit (Hidden by default) -->
                <div id="step-3" class="step-content hidden">
                    <h3 class="text-xl font-semibold text-brand-blue mb-5 border-b border-brand-grey pb-3">Step 3: Review your report</h3>
                    
                    <div class="space-y-4 p-5 border border-brand-teal/20 bg-brand-teal/5 rounded-xl mb-6">
                        <h4 class="text-lg font-bold text-brand-blue flex items-center gap-2"><i class="fas fa-box text-brand-teal"></i> Package Details</h4>
                        <div class="grid grid-cols-2 text-sm">
                            <p class="text-gray-600">Package ID:</p><p class="font-semibold" id="review-id">#FB-5477</p>
                            <p class="text-gray-600">Delivery Date:</p><p class="font-semibold" id="review-date">Nov 27, 2025</p>
                            <p class="text-gray-600">Subscription:</p><p class="font-semibold" id="review-sub">Weekly Family Box</p>
                        </div>
                        <h4 class="text-lg font-bold text-brand-blue flex items-center gap-2 pt-4 border-t border-brand-teal/10"><i class="fas fa-exclamation-triangle text-brand-orange"></i> Issue Summary</h4>
                        <div class="grid grid-cols-1 text-sm">
                            <p class="text-gray-600">Issue Type:</p><p class="font-semibold" id="review-type">Missing Item(s) in Package</p>
                            <p class="text-gray-600 mt-2">Affected Items:</p>
                            <ul id="review-items" class="list-disc list-inside ml-4 font-semibold">
                                <li>1kg of Tilapia Fish</li>
                            </ul>
                            <p class="text-gray-600 mt-2">Detailed Description:</p><p class="font-semibold italic" id="review-description">The 1kg of Tilapia Fish was missing from the box upon delivery. Everything else seems correct.</p>
                        </div>
                    </div>

                    <div class="flex justify-between mt-8">
                        <button type="button" onclick="prevStep()" class="px-6 py-3 bg-brand-blue/10 text-brand-blue font-semibold rounded-xl hover:bg-brand-blue/20 transition-colors">
                            <i class="fas fa-chevron-left mr-2 text-sm"></i> Back
                        </button>
                        <button type="submit" class="px-8 py-3 bg-brand-red text-white font-semibold rounded-xl hover:bg-brand-red/90 transition-colors shadow-lg shadow-brand-red/30">
                            <i class="fas fa-paper-plane mr-2"></i> Submit Report
                        </button>
                    </div>
                </div>

                <!-- Success Message (Hidden by default) -->
                <div id="step-success" class="step-content hidden text-center py-10">
                    <i class="fas fa-check-circle text-6xl text-brand-teal mb-4"></i>
                    <h3 class="text-2xl font-bold text-brand-blue mb-2">Report Submitted Successfully!</h3>
                    <p class="text-gray-600 max-w-md mx-auto">Your issue has been logged under reference number **R-20251129-9432**. Our support team will review it within 24 hours and contact you shortly regarding a resolution or refund.</p>
                    <a href="foodbox_my_packages.html" class="mt-6 inline-block px-6 py-3 bg-brand-teal text-white font-semibold rounded-xl hover:bg-brand-teal/90 transition-colors">
                        Return to My Packages
                    </a>
                </div>

            </form>

        </div>

        <!-- Footer Spacer -->
        <div class="h-12"></div>
    </main>

    <!-- JavaScript for Mobile Sidebar Toggle -->
    <script>
        // --- Sidebar Logic (Reused) ---
        const sidebar = document.getElementById('sidebar');
        const menuToggle = document.getElementById('menu-toggle');
        const backdrop = document.getElementById('backdrop');

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
                if (window.innerWidth < 1024) { 
                    toggleSidebar();
                }
            });
        });

        // --- Multi-Step Form Logic ---
        let currentStep = 1;
        const totalSteps = 3;

        const stepContents = {
            1: document.getElementById('step-1'),
            2: document.getElementById('step-2'),
            3: document.getElementById('step-3'),
            'success': document.getElementById('step-success')
        };
        
        const stepIndicators = {
            1: document.getElementById('step-1-indicator'),
            2: document.getElementById('step-2-indicator'),
            3: document.getElementById('step-3-indicator')
        };

        const form = document.getElementById('report-form');
        const radioCards = document.querySelectorAll('.radio-card');
        
        // Update radio card visual state on change
        document.querySelectorAll('input[name="package_id"]').forEach(radio => {
            radio.addEventListener('change', (e) => {
                radioCards.forEach(card => card.classList.remove('border-brand-teal/50', 'bg-brand-teal/5'));
                if (e.target.checked) {
                    e.target.closest('.radio-card').classList.add('border-brand-teal/50', 'bg-brand-teal/5');
                }
            });
        });

        function updateReview() {
            // Get data from Step 1
            const selectedPackage = document.querySelector('input[name="package_id"]:checked').closest('label').querySelector('.radio-card');
            const packageId = selectedPackage.querySelector('.text-lg').textContent.split(' - ')[0];
            const packageDate = selectedPackage.querySelector('.text-sm').textContent.replace('Delivered: ', '');
            const packageSub = selectedPackage.querySelector('.text-lg').textContent.split(' - ')[1];

            // Get data from Step 2
            const issueTypeEl = document.getElementById('issue_type');
            const issueType = issueTypeEl.options[issueTypeEl.selectedIndex].textContent;
            const description = document.getElementById('detailed_description').value;
            const affectedItems = Array.from(document.querySelectorAll('input[name="affected_items"]:checked'))
                                       .map(input => input.nextElementSibling.textContent);

            // Populate Step 3
            document.getElementById('review-id').textContent = packageId;
            document.getElementById('review-date').textContent = packageDate;
            document.getElementById('review-sub').textContent = packageSub;
            document.getElementById('review-type').textContent = issueType;
            document.getElementById('review-description').textContent = description;

            const reviewItemsList = document.getElementById('review-items');
            reviewItemsList.innerHTML = '';
            if (affectedItems.length > 0) {
                affectedItems.forEach(item => {
                    const li = document.createElement('li');
                    li.textContent = item;
                    reviewItemsList.appendChild(li);
                });
            } else {
                 const li = document.createElement('li');
                 li.textContent = 'No specific items selected (see description).';
                 reviewItemsList.appendChild(li);
            }
        }


        function updateStep(newStep) {
            // Hide all step content
            Object.values(stepContents).forEach(content => content.classList.add('hidden'));

            // Show current step content
            if (newStep <= totalSteps) {
                stepContents[newStep].classList.remove('hidden');
                currentStep = newStep;
            } else if (newStep === totalSteps + 1) {
                stepContents['success'].classList.remove('hidden');
                currentStep = 'success';
            }
            
            // Update indicators
            for (let i = 1; i <= totalSteps; i++) {
                const indicator = stepIndicators[i];
                indicator.classList.remove('step-active', 'step-complete', 'step-pending');
                if (i < newStep) {
                    indicator.classList.add('step-complete');
                    indicator.innerHTML = '<i class="fas fa-check"></i>'; // Use checkmark for complete steps
                } else if (i === newStep) {
                    indicator.classList.add('step-active');
                    indicator.textContent = i;
                } else {
                    indicator.classList.add('step-pending');
                    indicator.textContent = i;
                }
            }
        }

        function validateStep(step) {
            if (step === 1) {
                // Check if a package is selected (always one selected by default in this mock)
                return true;
            } else if (step === 2) {
                // Check if issue type and description are filled
                const issueType = document.getElementById('issue_type').value;
                const description = document.getElementById('detailed_description').value.trim();
                if (!issueType || !description) {
                    alert("Please select an issue type and provide a detailed description.");
                    return false;
                }
                return true;
            }
            return true;
        }

        function nextStep() {
            if (currentStep === 'success') return;

            if (validateStep(currentStep)) {
                if (currentStep === 2) {
                    updateReview(); // Prepare the review data before moving to step 3
                } else if (currentStep === 3) {
                    // This is the final submit, handled by form submit event
                    updateStep('success'); 
                    return;
                }
                updateStep(currentStep + 1);
            }
        }

        function prevStep() {
            if (currentStep > 1) {
                updateStep(currentStep - 1);
            }
        }

        // Initial setup for radio card styling
        radioCards[0].classList.add('border-brand-teal/50', 'bg-brand-teal/5');

    </script>
</body>
</html>