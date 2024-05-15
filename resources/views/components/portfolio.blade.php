<div class="flex flex-col gap-12">
    <div class="container flex flex-col gap-12">
        <p class="text-xs text-center">
            <span class="p-1 before:block before:absolute before:-inset-1 before:-skew-y-3 before:bg-primary relative inline-block">
                <span class="relative text-white font-semibold">Portfolio</span>
            </span>
        </p>
        <h3 class="text-center">Una ventana a nuestro mundo creativo</h3>
        <p class="text-center">Desde diseños innovadores hasta soluciones tecnológicas avanzadas, cada proyecto cuenta una historia única de creatividad, pasión y excelencia.</p>
    </div>
    <div x-data="{ modalImage: null }">
        <div class="splide mb-12" id="portolio" aria-label="Portfolio">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach($portfolios as $portfolio)
                        <li class="splide__slide" @click="modalImage = '{{ $portfolio->image}}'">
                            <img class="w-80 h-96 object-cover" src="{{ $portfolio->image }}" alt="{{ $portfolio->title }}">
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div x-show="modalImage" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50">
            <div class="modal-content" @click.away="modalImage = null">
                <span @click="modalImage = null" class="absolute text-6xl cursor-pointer font-bold top-0 right-4 hover:text-white">&times;</span>
                <div class="modal-nav">
                    <button @click="prevImage()" class="modal-prev">Prev</button>
                    <img :src="modalImage" alt="Imagen en grande" class="max-h-[75vh]">
                    <button @click="nextImage()" class="modal-next">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    modalImage = null;
    currentIndex = 0; // Definir currentIndex en un alcance global

    images = [
        @foreach ($portfolios as $portfolio)
            '{{ url("$portfolio->image") }}',
        @endforeach
    ];

    function nextImage() {
        currentIndex = (currentIndex + 1) % images.length;
        modalImage = images[currentIndex];
        console.log(modalImage);
    }

    function prevImage() {
        console.log("Previous image clicked");
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        modalImage = images[currentIndex];
    }
</script>