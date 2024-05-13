<?php
    /** @var \Illuminate\Database\Eloquent\Collection $categories */
    ?>
<x-app-layout>
    <div class="flex flex-wrap justify-center gap-x-8 mt-24 md:mt-32">
        @foreach ($categories as $category)
            @if(count($category->products) > 0)
                <a href="{{ route('categories.view', $category->slug) }}" class="underline-hover"><p class="small">{{__($category->name)}}</p></a>
            @endif
        @endforeach
    </div>
    <hr class="my-4 h-px border-t-0 bg-transparent bg-gradient-to-r from-transparent via-neutral-500 to-transparent opacity-25 dark:opacity-100" />
    <div  x-data="productItem({{ json_encode([
                    'id' => $product->id,
                    'slug' => $product->slug,
                    'image' => $product->image,
                    'title' => $product->title,
                    'price' => $product->price,
                    'addToCartUrl' => route('cart.add', $product)
                ]) }})" class="mx-auto px-5 max-w-screen-xl flex flex-col md:flex-row items-center justify-center lg:pb-8">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="w-full md:w-1/2">
                <div
                    x-data="{
                      images: ['{{$product->image}}'],
                      activeImage: null,
                      prev() {
                          let index = this.images.indexOf(this.activeImage);
                          if (index === 0)
                              index = this.images.length;
                          this.activeImage = this.images[index - 1];
                      },
                      next() {
                          let index = this.images.indexOf(this.activeImage);
                          if (index === this.images.length - 1)
                              index = -1;
                          this.activeImage = this.images[index + 1];
                      },
                      init() {
                          this.activeImage = this.images.length > 0 ? this.images[0] : null
                      }
                    }"
                    class="max-w-fit flex flex-col-reverse lg:flex-row gap-4 md:sticky top-24" id="imagen"
                >
                    <!-- <div class="flex">
                        <template x-for="image in images">
                            <a
                                @click.prevent="activeImage = image"
                                class="cursor-pointer w-[80px] h-[80px] border flex items-center justify-center product-thumbnail"
                                :class="{'product-thumbnail-active': activeImage === image}"
                            >
                                <img :src="image" alt="" class=""/>
                            </a>
                        </template>
                    </div> -->
                    <div class="relative">
                        <template x-for="image in images">
                            <div
                                x-show="activeImage === image"
                                class="aspect-w-3 aspect-h-2"
                            >
                                <img :src="image" alt="" class="w-auto mx-auto"/>
                            </div>
                        </template>
                        <!-- <a
                            @click.prevent="prev"
                            class="cursor-pointer bg-black/30 text-white absolute left-0 top-1/2 -translate-y-1/2"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-10 w-10"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 19l-7-7 7-7"
                                />
                            </svg>
                        </a>
                        <a
                            @click.prevent="next"
                            class="cursor-pointer bg-black/30 text-white absolute right-0 top-1/2 -translate-y-1/2"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-10 w-10"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 5l7 7-7 7"
                                />
                            </svg>
                        </a> -->
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/2 product-view" id="texto">
                <a href="{{ route('categories.view', $product->category?->slug) }}">
                    <p class="small category_subtitle">{{__($product->category?->name)}}</p>
                </a>
                <h1>
                    {{ __($product->title) }}
                </h1>
                <div class="flex w-full gap-4">
                    @foreach ($product->alergens as $alergen)
                    <img src="{{ url($alergen?->image) }}" data-tooltip-target="tooltip-{{ $alergen?->name }}" alt="" class="h-6 w-auto">
                    <div id="tooltip-{{ $alergen?->name }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip tooltip_alergens">
                        <p class="small">{{__('Contiene')}} {{ __($alergen?->name) }}</p>
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                    @endforeach
                </div>
                <div class="text-gray-500 wysiwyg-content">
                    {{ __($product->description) }}
                </div>
                <!-- <label for="quantity" class="block font-bold mr-4">
                    Quantity
                </label> -->
                <div class="flex flex-col justify-between align-center my-8 gap-8">
                    <!-- <div x-data="{value: 1}" class="price">$    {{$product->price}}
                    </div> -->
                    <div class="flex flex-col gap-4">
                        @foreach ($product->prices as $price)
                        <!-- <div class="flex items-center gap-4" name="price" value="{{ $price?->id }}">
                            <input x-data="{value: 1}" type="radio" name="price" value="{{ $price?->id }}">
                            <div class="price flex items-center justify-center py-1 px-2 rounded-full w-auto bg-transparent">
                                <h5>€ {{ $price?->number }}</h5>
                            </div>
                            <p class="small price-size">{{ __($price?->size) }}</p>
                        </div> -->
                        <div class="flex items-center gap-4" name="price" value="{{ $price?->id }}">
                            <div class="price flex items-center justify-center py-1 px-2 rounded-full w-auto bg-transparent">
                                <h5>€ {{ $price?->number }}</h5>
                            </div>
                            <p class="small price-size">{{ __($price?->size) }}</p>
                        </div>
                        @endforeach
                    </div>

                    <div class="w-fit flex items-center h-10 gap-4 rounded-md bg-black/5 p-4 ring-1 ring-black/10 product-delivery">
                        <i class="fi fi-br-exclamation leading-none"></i>
                        <p class="small-text leading-4">{{ __('Los pedidos se realizan con 48hs de anticipación') }}</p>
                    </div>

                    <div class="encargo-ws">
                        <a href="#"
                        data-product-title="{{ $product->title }}"
                        onclick="openWhatsApp(this)"
                        class="flex items-center gap-4 h-10" >
                            <i class="flex text-2xl leading-none fi fi-brands-whatsapp"></i>
                            <p class="font-bold">{{ __('Encargar por whatsapp') }}</p>
                        </a>
                        <!-- <div class="flex items-center content-center quantity">
                            <button id="down" class="btn btn-default" onclick=" down('0')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="current" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                            <input
                                type="number"
                                name="quantity"
                                x-ref="quantityEl"
                                value="1"
                                min="1"
                                class="w-32 qty"
                                id="myNumber"
                            />
                            <button id="up" class="btn btn-default" onclick="up('10')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="current" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                        </div> -->
                        <!-- Add to cart button -->
                        <!-- <div class="add-to-cart-container flex items-center gap-6">
                            <button
                                @click="addToCart($refs.quantityEl.value)"
                                class="add-to-cart-button"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    id="icon-chat"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"
                                    />
                                </svg>
                            </button>
                            <div
                                x-data="toast"
                                x-show="visible"
                                x-transition
                                x-cloak
                                @notify.window="show($event.detail.message)"
                                class="flex flex-col gap-2"
                            >
                                <div class="product-toast small font-semibold" x-text="message"></div>
                                Progress
                                <div class="relative">
                                    <div
                                        class="absolute left-0 bottom-0 right-0 h-[3px] toast-progress"
                                        :style="{'width': `${percent}%`}"
                                    ></div>
                                </div>
                            </div>
                        </div> -->
                        <!-- Add to cart button -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="products-carousel" class="px-5 max-w-screen-xl splide my-16 mx-auto">
        <div class="mb-8 text-center">
            <h2 class="text-2xl text-3xl">{{ __(('Más cosas ricas')) }}</h2>
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
                                <p class="small category_subtitle">{{__($product->category?->name)}}</p>
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
                                <p class="small price-size">{{__($price?->size) }}</p>
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
    </div>
</x-app-layout>

<script>
    function openWhatsApp(element) {
    var productTitle = element.dataset.productTitle;
    var createdAt = element.dataset.createdAt;
    var message = encodeURIComponent("Hola! Me gustaría hacer un pedido de " + productTitle);
    var whatsappLink = "https://wa.me/34622406965?text=" + message;
    
    window.open(whatsappLink, "_blank");
    }
    //Quantity 
    function up(max) {
    document.getElementById("myNumber").value = parseInt(document.getElementById("myNumber").value) + 1;
    if (document.getElementById("myNumber").value >= parseInt(max)) {
        document.getElementById("myNumber").value = max;
    }
    }
    function down(min) {
        document.getElementById("myNumber").value = parseInt(document.getElementById("myNumber").value) - 1;
        if (document.getElementById("myNumber").value <= parseInt(min)) {
            document.getElementById("myNumber").value = min;
        }
    }
    //Fin Quantity 
</script>
<style>
    .quantity .qty {
        width: 50px;
        height: 40px;
        line-height: 40px;
        background-color:transparent;
        border: 0;
        text-align: center;
        margin-bottom: 0;
    }
    .quantity button{
        color:white;
        height:auto;
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>