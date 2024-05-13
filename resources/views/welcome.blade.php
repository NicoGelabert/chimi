
    <x-app-layout>
        <div id="hero_banner" class="mx-auto max-w-screen-xl flex flex-col gap-y-8 md:flex-row md:flex-wrap items-center justify-around md:justify-center relative h-auto lg:h-screen splide">
            <div class="w-full relative isolatemd:pt-0 md:pb-0 splide__track pt-24 md:pt-16 ">
                <ul class="splide__list max-w-[1024px] !mx-auto">
                    @foreach ($homeHeroBanners as $homeHeroBanner)
                    <li class="splide__slide slider bg-gradient flex flex-col sm:flex-row items-center justify-evenly md:justify-center {{$homeHeroBanner -> background}} px-8">
                        <div class="text-left slide-in-left">
                            <h1>{{ __($homeHeroBanner -> headline)}}</h1>
                            <p class="mt-2 text-md md:text-lg leading-8 text-gray-600 w-full">{{ __($homeHeroBanner -> description) }}</p>
                            <div class="flex gap-3 my-6 md:justify-start">
                                <a href="{{$homeHeroBanner -> link}}" class="btn-primary">
                                {{ __('Ver más') }}
                                </a>
                            </div>
                        </div>            
                        <div class="">
                            <img class="image_slide max-h-[450px] sm:max-h-[500px] w-full mx-auto" src="{{$homeHeroBanner -> image}}" alt="">
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <ul class="splide__pagination"></ul>
        </div>

        <div class="px-5 max-w-screen-xl mx-auto flex flex-col md:flex-row gap-20 md:gap-10 justify-evenly items-center my-20">
            <div class="btns-port-web flex justify-center items-center w-1/2">
                <div class="rounded-full absolute w-full max-w-[200px] sm:max-w-[300px] md:max-w-[300px]">
                    <img src="{{ asset('storage/img/piece-of-brownie-cake-filled.jpeg') }}" class="rounded-full " alt="brownie" />
                </div>
                <div class="text-rotate md:tracking-wide">
                    <svg viewBox="0 0 100 100">
                        <path d="M 0,50 a 50,50 0 1,1 0,1 z" id="circle" />
                        <text>
                            <textPath xlink:href="#circle">
                            {{__('La felicidad está en un trozo de tarta')}} ♥
                            </textPath>
                        </text>
                    </svg>
                </div>
            </div>
            <div id="categorybuttons">
                @foreach ($categories as $category)
                    @if(count($category->products) > 0)
                        <a href="{{ route('categories.view', $category->slug) }}" class="" alt="">
                            <div class="h-full flex flex-wrap flex-col justify-evenly px-2 lg:px-4">
                                <img src="{{$category -> image}}" alt="{{ __($category -> name)}}">
                                <h5>{{__($category -> name)}}</h5>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>

        <section id="image-carousel" class="px-5 max-w-screen-xl splide my-16 mx-auto" aria-label="Latest products">
            <div class="mb-8 text-center">
                <h2 class="text-2xl text-3xl">{{__('Últimos productos')}}
            </div>
            <div class="splide__track mx-8">
                <ul class="splide__list">
                    @foreach($products as $product)
                    <li x-data="productItem({{ json_encode([
                        'id' => $product->id,
                        'slug' => $product->slug,
                        'image' => $product->image,
                        'title' => $product->title,
                        'price' => $product->price,
                        'addToCartUrl' => route('cart.add', $product)
                        ]) }})" class="splide__slide border-transparent rounded-lg underline-hover flex flex-col justify-between shadow-md bg-white/50 overflow-hidden mb-4">
                        <a href="{{ route('product.view', [$product->category?->slug, $product->slug ]) }}" class="aspect-w-3 aspect-h-2 block">
                            <img src="{{ $product->image }}" alt="{{$product->title}}" class="card-image object-cover hover:scale-105 hover:rotate-1 transition-transform" />
                            <hr class="mb-4 h-px border-t-0 bg-transparent bg-gradient-to-r from-transparent via-neutral-500 to-transparent opacity-25 dark:opacity-100" />
                            <div class="p-4 card-listing">
                                <div class="flex justify-center w-full gap-4">
                                    @foreach ($product->alergens as $alergen)
                                    <img src="{{ url($alergen?->image) }}" data-tooltip-target="tooltip-{{ $alergen?->name }}" alt="" class="h-6 w-auto">
                                    <div id="tooltip-{{ $alergen?->name }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip tooltip_alergens">
                                        <p class="small">{{__('Contiene')}} {{ __($alergen?->name) }}</p>
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="flex flex-col items-center justify-center">
                                    <p class="small category_subtitle">{{ __($product->category?->name) }}</p>
                                    <h3 class="w-fit">
                                        {{__($product->title)}}
                                    </h3>
                                </div>
                                <ul class="flex flex-col gap-4">
                                @foreach ($product->prices as $price)
                                    <li class="flex flex-col items-center gap-1" name="price" value="{{ $price?->id }}">
                                    <div class="price flex items-center justify-center py-1 px-2 rounded-full">
                                        <h5>€ {{ $price?->number }}</h5>
                                    </div>
                                    <p class="small price-size">{{ __($price?->size) }}</p>
                                @endforeach
                                </ul>
                                <!-- <div class="relative flex">
                                    <p class="small">{{$product->description}}</p>
                                </div> -->
                            </div>
                        </a>
                        <!-- Add to Cart -->
                        <!-- <div class="flex justify-center mb-5">
                            <button class="btn-cart-product" @click="addToCart()">
                                <svg
                                xmlns="http://www.w3.org/2000/svg"
                                
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1"
                                >
                                    <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"
                                    />
                                </svg>
                            </button>
                        </div> -->
                    </li>
                    @endforeach
                </ul>
            </div>
        </section>
        
        <hr class="mt-24 h-px border-t-0 bg-transparent bg-gradient-to-r from-transparent via-neutral-500 to-transparent opacity-25 dark:opacity-100" />

        <x-newsletter />
        
    </x-app-layout>
<style>
    /* Home Hero Banner */
    @keyframes rotateAnimation {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
    }

    /* Aplicar la animación de rotación */
    .rotating {
        animation: rotateAnimation 0.25s linear 1;
    }
    /* Animaciones de movimiento */
    /* Animación para botón activo */
    .active-animation {
        transition: transform 0.3s ease; /* Duración y tipo de transición */
        transform: translateX(10px); /* Desplazamiento inicial */
    }

    /* Animación para revertir */
    .active-animation.revert {
        transform: translateX(0); /* Desplazamiento de regreso a su posición original */
    }
    /* Fin Home Hero Banner */

    /* Texto Felicidad */
    .btns-port-web-img{
        width:100%;
        max-width:200px;
    }
    .btns-port-web .text-rotate svg {
		overflow: visible;
		animation: circular-text-rotate 5s linear paused infinite;
        width:100%;
		max-width: 300px;
        font-family: 'Mount-Hills';
		font-weight:bold;
        animation-duration: 15s;
        animation-iteration-count: infinite;
        animation-play-state: running;
	}
	.btns-port-web .text-rotate svg:hover {
	}
	.btns-port-web .text-rotate path {
		fill: none;
	}
	.btns-port-web .text-rotate text {
		fill:#6C4852;
	}
	@keyframes circular-text-rotate {
		to {
		transform: rotate(-1turn);
		}
	}
    /* Fin Texto Felicidad */
</style>
<script>
    const buttonsContainer = document.getElementById("categorybuttons");
    const childrenButtons = buttonsContainer.querySelectorAll("a");
    childrenButtons.forEach((item,index) =>{
        (index > 0 && index < 4) ? item.classList.add('btn-primary') : item.classList.add('btn-secondary');
    })

</script>
