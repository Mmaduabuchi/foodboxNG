<footer class="bg-brand-blue text-white pt-20 pb-10">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
            <!-- Brand -->
            <div>
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-8 h-8 bg-brand-teal rounded flex items-center justify-center text-white">
                        <i class="fas fa-leaf text-sm"></i>
                    </div>
                    <span class="text-xl font-bold">FoodBox<span class="text-brand-teal">NG</span></span>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed mb-6">
                    Simplifying food shopping for Nigerian homes. Quality, Affordability, and Convenience delivered.
                </p>
                <div class="flex gap-4">
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-brand-teal transition-colors"><i
                            class="fab fa-twitter"></i></a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-brand-teal transition-colors"><i
                            class="fab fa-instagram"></i></a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-brand-teal transition-colors"><i
                            class="fab fa-facebook-f"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-bold mb-6 text-brand-gold">Company</h4>
                <ul class="space-y-4 text-gray-400 text-sm">
                    <li><a href="{{ route('about_us') }}" class="hover:text-white transition-colors">About Us</a></li>
                    <li><a href="{{ route('careers') }}" class="hover:text-white transition-colors">Careers</a></li>
                    <li><a href="{{ route('blog') }}" class="hover:text-white transition-colors">Blog</a></li>
                    <li><a href="{{ route('contact_us') }}" class="hover:text-white transition-colors">Contact</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h4 class="text-lg font-bold mb-6 text-brand-gold">Support</h4>
                <ul class="space-y-4 text-gray-400 text-sm">
                    <li><a href="{{ route('faqs') }}" class="hover:text-white transition-colors">FAQs</a></li>
                    <li><a href="{{ route('shipping_policy') }}" class="hover:text-white transition-colors">Shipping Policy</a></li>
                    <li><a href="{{ route('returns') }}" class="hover:text-white transition-colors">Returns</a></li>
                    <li><a href="{{ route('terms_of_service') }}" class="hover:text-white transition-colors">Terms of Service</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="text-lg font-bold mb-6 text-brand-gold">Contact Us</h4>
                <ul class="space-y-4 text-gray-400 text-sm">
                    <li class="flex items-start gap-3">
                        <i class="fas fa-map-marker-alt mt-1 text-brand-teal"></i>
                        <span>12 Admiralty Way, Lekki Phase 1,<br>Lagos, Nigeria.</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fas fa-phone text-brand-teal"></i>
                        <span>+234 800 FOOD BOX</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fas fa-envelope text-brand-teal"></i>
                        <span>hello@foodbox.ng</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-700 pt-8 text-center text-gray-500 text-sm">
            <p>&copy; 2023 FoodBox NG. All rights reserved.</p>
        </div>
    </div>
</footer>