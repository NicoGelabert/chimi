<div class="home-hero-banner splide" aria-label="Chimi Designs">
    <div class="splide__track">
        <ul class="splide__list">
            @foreach($homeherobanners as $homeherobanner)
            <li class="splide__slide mx-auto">
                <div class="flex flex-col justify-center md:items-stretch gap-12 max-w-screen-xl px-4 pt-24 mx-auto md:px-16 md:flex-row">
                    <div class="flex flex-col justify-start gap-8 w-full md:w-1/2">
                        <hr class="animate-hr" />
                        <div class="flex justify-between">
                            <h3 class="animate-h3">0{{ $homeherobanner->id }}</h3>
                            <i class="fi fi-br-arrow-up-left text-4xl animate-arrow overflow-hidden"></i>
                        </div>
                        <h1 class="animate-h1 text-6xl leading-tight dark:text-primary">{{ $homeherobanner->headline }}</h1>
                        <p class="animate-p">{{ $homeherobanner->description }}</p>
                        <div class="animate-button">
                            <x-button><i class="fi fi-rr-arrow-right arrow-to-right"></i><span>Conózcanos</span></x-button>
                        </div>
                    </div>
                    <div class="flex w-full md:w-1/2 h-auto overflow-hidden">
                        <div class="image-container flex flex-col justify-between">
                            <img src="{{ $homeherobanner->image }}" alt="{{ $homeherobanner->title }}" class="animate-img">
                            <p class="animate-caption text-xs text-right pt-2 font-bold">{{ $homeherobanner->title }}</p>
                        </div>
                        <div class="animate-border h-fit vertical-text ml-4 pr-2">
                            <h5 class="animate-h5">{{ $homeherobanner->service }}</h5>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
        <div class="splide__progress w-full py-8 md:py-12">
            <div class="splide__progress__bar bg-primary h-px">
            </div>
        </div>
    </div>
</div>