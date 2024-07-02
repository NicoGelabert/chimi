<div class="flex flex-col gap-12">
    <div class="container flex flex-col gap-12 items-center">
        <div class="pretitle">
            <p>Portfolio</p>
        </div>
        <h3 class="text-center">Una ventana a nuestro mundo creativo</h3>
        <p class="text-center">Desde diseños innovadores hasta soluciones tecnológicas avanzadas, cada proyecto cuenta una historia única de creatividad, pasión y excelencia.</p>
    </div>

    <div id="portfolio" class="relative">
        <div id="main-carousel" class="splide mx-auto" aria-label="Portfolio">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach($projects as $project)
                    <li class="splide__slide">
                        <img src="{{ $project->image }}" alt="{{ $project->name }}">
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div
            id="thumbnail-carousel"
            class="splide"
            aria-label="Puede ver todos nuestros trabajos."
            >
            <div class="splide__track h-full">
                    <ul class="splide__list">
                        @foreach($projects as $project)
                        <li class="splide__slide">
                            <div class="flex flex-col items-center justify-between w-full max-w-screen-lg mx-auto md:flex-row h-5/6 md:h-full gap-8 py-16 md:py-8 md:py-0">
                                <div class="md:w-1/2 h-full flex items-center justify-center">
                                    <img src="{{ $project->image }}" alt="{{ $project->title }}">
                                </div>
                                <div class="text-white mx-8 md:w-1/2 h-auto flex flex-col justify-between gap-16">
                                    <div>
                                        <h3>{{ $project->title }}</h3>
                                        <ul>
                                            @foreach($project->clients as $client)
                                            <li class="text-sm">{{ $client->name }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <ul class="flex flex-wrap gap-2">
                                        @foreach($project->tags as $tag)
                                        <li class="mt-1 bg-gray-50 text-xxs w-fit rounded-full px-2 py-1 text-black">{{ $tag->name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
            </div>
        </div>
    </div>
    
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
      const portfolioSection = document.getElementById('portfolio');

      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            portfolioSection.style.height = `${window.innerHeight}px`;
          }
        });
      }, { threshold: 0.5 });

      observer.observe(portfolioSection);
    });
  </script>