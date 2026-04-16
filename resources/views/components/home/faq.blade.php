<section class="py-16 bg-white" id="faqs">
    <div class="max-w-4xl mx-auto px-6">
        <!-- Heading -->
        <div class="text-center mb-12">
            <h2 class="text-3xl font-serif font-semibold text-gray-800">Frequently Asked Questions</h2>
            <p class="mt-2 text-gray-500 text-sm">Your queries answered for a smooth gifting experience</p>
        </div>

        <!-- FAQ Items -->
        <div class="space-y-4">

            <div x-data="{ open: true }" class="border rounded-lg shadow-sm">
                <button @click="open = !open"
                    class="w-full flex justify-between items-center px-5 py-4 text-left font-medium focus:outline-none">
                    <span :class="open ? 'text-secondary' : 'text-primary'">
                        Can I customize my gift?
                    </span>
                    <i :class="open ? 'fa-solid fa-chevron-up text-secondary' : 'fa-solid fa-chevron-down text-primary'"></i>
                </button>
                <div x-show="open" x-transition class="px-5 pb-4 text-primary text-sm leading-relaxed">
                    Yes! You can fully personalize gifts by choosing colors, sizes, messages, and even adding your own photos or names. Each product page includes customization options before checkout.
                </div>
            </div>

            <div x-data="{ open: false }" class="border rounded-lg shadow-sm">
                <button @click="open = !open"
                    class="w-full flex justify-between items-center px-5 py-4 text-left font-medium focus:outline-none">
                    <span :class="open ? 'text-secondary' : 'text-primary'">
                        How long does it take to deliver a customized gift?
                    </span>
                    <i :class="open ? 'fa-solid fa-chevron-up text-secondary' : 'fa-solid fa-chevron-down text-primary'"></i>
                </button>
                <div x-show="open" x-transition class="px-5 pb-4 text-primary text-sm leading-relaxed">
                    Standard customized orders are delivered within 5–8 business days. Express delivery options are available for select products at checkout.
                </div>
            </div>

            <div x-data="{ open: false }" class="border rounded-lg shadow-sm">
                <button @click="open = !open"
                    class="w-full flex justify-between items-center px-5 py-4 text-left font-medium focus:outline-none">
                    <span :class="open ? 'text-secondary' : 'text-primary'">
                        Can I preview my customized product before placing the order?
                    </span>
                    <i :class="open ? 'fa-solid fa-chevron-up text-secondary' : 'fa-solid fa-chevron-down text-primary'"></i>
                </button>
                <div x-show="open" x-transition class="px-5 pb-4 text-primary text-sm leading-relaxed">
                    Yes, most of our products offer a live preview option where you can see how your text, photo, or design will appear before confirming your order.
                </div>
            </div>

            <div x-data="{ open: false }" class="border rounded-lg shadow-sm">
                <button @click="open = !open"
                    class="w-full flex justify-between items-center px-5 py-4 text-left font-medium focus:outline-none">
                    <span :class="open ? 'text-secondary' : 'text-primary'">
                        What is your return or replacement policy for customized gifts?
                    </span>
                    <i :class="open ? 'fa-solid fa-chevron-up text-secondary' : 'fa-solid fa-chevron-down text-primary'"></i>
                </button>
                <div x-show="open" x-transition class="px-5 pb-4 text-primary text-sm leading-relaxed">
                    Since customized products are made uniquely for you, we only accept returns for damaged, defective, or incorrect items. Please report any issues within 48 hours of delivery for a quick replacement.
                </div>
            </div>

            <div x-data="{ open: false }" class="border rounded-lg shadow-sm">
                <button @click="open = !open"
                    class="w-full flex justify-between items-center px-5 py-4 text-left font-medium focus:outline-none">
                    <span :class="open ? 'text-secondary' : 'text-primary'">
                        Do you offer bulk or corporate gift customization?
                    </span>
                    <i :class="open ? 'fa-solid fa-chevron-up text-secondary' : 'fa-solid fa-chevron-down text-primary'"></i>
                </button>
                <div x-show="open" x-transition class="px-5 pb-4 text-primary text-sm leading-relaxed">
                    Absolutely! We provide special pricing and design assistance for bulk or corporate gifting orders. You can contact our support team for personalized quotations and mockups.
                </div>
            </div>

        </div>
    </div>
</section>
