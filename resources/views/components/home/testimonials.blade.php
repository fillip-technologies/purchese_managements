<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<section class="pt-8 bg-white">
    <div class="max-w-6xl mx-auto px-6">

        <div class="text-center mb-12">
            <h2 class="text-3xl font-serif font-semibold text-gray-800 tracking-wide">
                What Our Customers Say
            </h2>
            <p class="text-gray-500 text-sm mt-2">
                Real experiences from happy shoppers
            </p>
        </div>


        <div class="swiper">
            <div class="swiper-wrapper">

                <div class="swiper-slide">
                    <div
                        class="bg-white border rounded-md shadow-sm p-6 transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                        <div class="flex text-primary mb-3">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            “Loved the customized photo frame I ordered! The print quality was amazing and it was
                            delivered right on time. Perfect gifting experience.”
                        </p>
                        <h4 class="mt-4 text-gray-800 font-semibold text-sm">
                            — Neha Sinha
                        </h4>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div
                        class="bg-white border rounded-md shadow-sm p-6 transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                        <div class="flex text-primary mb-3">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            “I ordered a personalized mug for my parents’ anniversary — they absolutely loved it! The
                            customization was exactly as shown in the preview.”
                        </p>
                        <h4 class="mt-4 text-gray-800 font-semibold text-sm">
                            — Arjun Mehta
                        </h4>
                    </div>
                </div>

               

                <div class="swiper-slide">
                    <div
                        class="bg-white border rounded-md shadow-sm p-6 transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                        <div class="flex text-primary mb-3">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            “Amazing service! Ordered a customized cushion for my best friend’s birthday — the fabric,
                            color, and print were perfect. She loved it!”
                        </p>
                        <h4 class="mt-4 text-gray-800 font-semibold text-sm">
                            — Riya Malhotra
                        </h4>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div
                        class="bg-white border rounded-md shadow-sm p-6 transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                        <div class="flex text-primary mb-3">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            “Ordered bulk customized gifts for our company event — excellent quality, quick delivery,
                            and great support from the design team!”
                        </p>
                        <h4 class="mt-4 text-gray-800 font-semibold text-sm">
                            — Karan Gupta
                        </h4>
                    </div>
                </div>

            </div>

            <div class="swiper-pagination mt-16"></div>
        </div>

    </div>
</section>

<style>
    .swiper {
        padding-bottom: 2rem;
    }

    .swiper-pagination {
        bottom: 0 !important;
        text-align: center;
    }
</style>


<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    const swiper = new Swiper(".swiper", {
        slidesPerView: 1,
        spaceBetween: 20,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            768: {
                slidesPerView: 3,
            },
        },
    });
</script>
