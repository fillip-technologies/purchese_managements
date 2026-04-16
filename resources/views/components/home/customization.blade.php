<section id="customized" x-data="{ openForm: false }" class="relative bg-gradient-to-r from-primary to-primary py-16 text-center">
    <div class="max-w-5xl mx-auto px-6">
        <!-- Banner Content -->
        <h2 class="text-2xl md:text-3xl font-serif font-semibold text-secondary">
            Order Your Customized Gift
        </h2>
        <p class="mt-3 text-white text-sm md:text-base">
            Have a design in mind? Let our artisans craft your dream piece — just for you.
        </p>
        <button @click="openForm = true"
            class="mt-6 px-6 py-3 bg-secondary hover:bg-secondary/90 text-primary text-sm md:text-base rounded-full shadow-md transition duration-300">
            Create Your Design
        </button>
    </div>

    <!-- Modal -->
    <div x-show="openForm" x-transition.opacity x-cloak
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 overflow-y-auto">
        <div @click.away="openForm = false"
            class="bg-white w-11/12 md:w-1/3 p-6 rounded-2xl shadow-xl relative max-h-[90vh] overflow-y-auto">

            <!-- Close Button -->
            <button @click="openForm = false"
                class="absolute top-3 right-3 hover:text-primary/90 text-primary text-3xl">
                &times;
            </button>


            <div class="text-left">
                <h3 class="text-xl text-center font-semibold text-primary mb-1">Gift Customization Form</h3>
                <p class="text-xs md:text-sm text-secondary mb-4 text-center">
                    Fill out the details below <br> our expert team will contact you soon to bring your gift to
                    life.
                </p>
                <form class="space-y-4" action="{{ route('add.Customization') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label class="text-sm font-semibold text-gray-700">Full Name</label>
                        <input type="text" name="name" placeholder="Enter your name"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-primary focus:outline-none">
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Contact Details</label>
                        <input type="number" name="contact" placeholder="Enter mobile number"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-primary focus:outline-none">
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Material Preference</label>
                        <input type="text" name="material" placeholder="Wood, Metal..."
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-primary focus:outline-none">
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Description / Custom Request</label>
                        <textarea placeholder="Describe your dream gift..." name="description"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-primary focus:outline-none h-24"></textarea>
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Upload Reference Image</label>
                        <input type="file" name="images"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 cursor-pointer focus:ring-2 focus:ring-primary focus:outline-none">
                    </div>

                    <button type="submit"
                        class="w-full bg-primary hover:bg-primary/90 text-white font-semibold py-2 rounded-lg transition duration-300">
                        Submit Request
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>
