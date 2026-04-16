<div
    x-data="carousel({{ json_encode($topsection) }})"
    x-init="init()"
    class="flex flex-col items-center py-16 bg-white relative overflow-hidden"
>
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-serif font-semibold text-gray-800 tracking-wide">
            Top Products
        </h2>
        <p class="text-gray-500 text-sm mt-2">Discover our most loved collections</p>
    </div>

    <div class="relative w-full max-w-7xl">
        <!-- Prev Button -->
        <button
            @click="prev()"
            class="absolute left-0 top-1/2 -translate-y-1/2 bg-primary hover:bg-primary/90 shadow-md py-2 px-3 z-10 text-secondary text-4xl -mt-4"
        >
            &lt;
        </button>

        <!-- Carousel Container -->
        <div class="overflow-hidden px-5">
            <div
                class="flex transition-transform duration-500 ease-in-out"
                :style="`transform: translateX(-${currentIndex * step}%);`"
            >
                <template x-for="(product, index) in products" :key="index">
                    <div
                        class="flex-shrink-0 w-full sm:w-1/2 md:w-1/4 px-4 flex flex-col items-center text-center group cursor-pointer"
                    >
                        <div class="w-60 h-60 overflow-hidden rounded-full shadow-md">
                            <img
                                :src="product.image"
                                :alt="product.name"
                                class="w-full h-full object-cover transform transition duration-500 group-hover:scale-110"
                            />
                        </div>
                        <h3
                            class="mt-4 text-lg font-medium text-gray-700"
                            x-text="product.name"
                        ></h3>
                        <a
                            :href="`/product-details/${product.slug}`"
                            class="mt-2 inline-block text-sm font-semibold text-primary hover:text-primary/90 transition"
                        >
                            Shop Now
                        </a>
                    </div>
                </template>
            </div>
        </div>

        <!-- Next Button -->
        <button
            @click="next()"
            class="absolute right-0 top-1/2 -translate-y-1/2 bg-primary hover:bg-primary/90 py-2 px-3 z-10 text-secondary text-4xl -mt-4"
        >
            &gt;
        </button>
    </div>
</div>

<script>
    function carousel(data) {
        return {
            products: data,
            currentIndex: 0,
            step: 100,
            visibleCards: 1,

            init() {
                this.updateStep();
                window.addEventListener('resize', () => this.updateStep());
            },

            updateStep() {
                if (window.innerWidth < 640) {
                    this.visibleCards = 1;
                    this.step = 100;
                } else if (window.innerWidth < 768) {
                    this.visibleCards = 2;
                    this.step = 50;
                } else {
                    this.visibleCards = 4;
                    this.step = 25;
                }
            },

            prev() {
                if (this.currentIndex > 0) this.currentIndex--;
            },

            next() {
                if (this.currentIndex < this.products.length - this.visibleCards) {
                    this.currentIndex++;
                }
            }
        }
    }
</script>
