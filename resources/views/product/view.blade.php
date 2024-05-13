<?php
    /** @var \Illuminate\Database\Eloquent\Collection $categories */
    ?>
<x-app-layout>
    <div class="">
        @foreach ($categories as $category)
            @if(count($category->products) > 0)
                <a href="{{ route('category.view', $category->slug) }}" class=""><p class="">{{__($category->title)}}</p></a>
            @endif
        @endforeach
    </div>
    
    <div  x-data="productItem({{ json_encode([
                    'id' => $product->id,
                    'slug' => $product->slug,
                    'image' => $product->image,
                    'title' => $product->title,
                    'price' => $product->price,
                    'addToCartUrl' => route('cart.add', $product)
                ]) }})" class="">
        <div class="">
            <div class="">
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
                    class=""
                >
                    <div class="">
                        <template x-for="image in images">
                            <div
                                x-show="activeImage === image"
                                class="aspect-w-3 aspect-h-2"
                            >
                                <img :src="image" alt="" class=""/>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
            <div class="">
                <a href="{{ route('category.view', $product->category?->slug) }}">
                    <p class="">{{__($product->category?->name)}}</p>
                </a>
                <h1>
                    {{ __($product->title) }}
                </h1>
                <div class="">
                    {{ __($product->description) }}
                </div>
                <!-- <label for="quantity" class="block font-bold mr-4">
                    Quantity
                </label> -->
                <div class="">
                    <div x-data="{value: 1}" class="">
                        ${{$product->price}}
                    </div>
                    <div class="">
                        <i class="fi fi-br-exclamation"></i>
                        <p class="">{{ __('Los pedidos se realizan con 48hs de anticipación') }}</p>
                    </div>

                    <div class="">
                        <a href="#"
                        data-product-title="{{ $product->title }}"
                        onclick="openWhatsApp(this)"
                        class="" >
                            <i class="fi fi-brands-whatsapp"></i>
                            <p class="">{{ __('Encargar por whatsapp') }}</p>
                        </a>
                        <div class="flex items-center content-center quantity">
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
                        </div>
                        <!-- Add to cart button -->
                        <div class="">
                            <button
                                @click="addToCart($refs.quantityEl.value)"
                                class=""
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
                                <div class="" x-text="message"></div>
                                Progress
                                <div class="relative">
                                    <div
                                        class=""
                                        :style="{'width': `${percent}%`}"
                                    ></div>
                                </div>
                            </div>
                        </div>
                        <!-- Add to cart button -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="products-carousel" class="">
        <div class="">
            <h2 class="">{{ __(('Más cosas ricas')) }}</h2>
        </div>
        <div class="splide__track">
            <ul class="splide__list">
                @foreach($products as $product)
                <li x-data="productItem({{ json_encode([
                    'id' => $product->id,
                    'slug' => $product->slug,
                    'image' => $product->image,
                    'title' => $product->title,
                    'price' => $product->price,
                    'addToCartUrl' => route('cart.add', $product)
                    ]) }})" class="splide__slide overflow-hidden">
                    <a href="{{ route('product.view', [$product->category?->slug, $product->slug ]) }}">
                        <img src="{{ $product->image }}" alt="{{$product->title}}" class="" />
                        <div class="">
                            <div class="">
                                <p class="">{{__($product->category?->name)}}</p>
                                <h3 class="">
                                    {{__($product->title)}}
                                </h3>
                            </div>
                            <div class="">
                                <h5>€ {{ $product->price }}</h5>
                            </div>
                            <div class="">
                                <p class="">{{$product->description}}</p>
                            </div>
                        </div>
                    </a>
                    <!-- Add to Cart -->
                    <div class="">
                        <button class="" @click="addToCart()">
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
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>

<script>
    
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
    //End Quantity 
</script>