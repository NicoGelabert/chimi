<x-app-layout>
    <div class="py-32 flex flex-col gap-12">
        @foreach($categories as $category)
            @if(count($category->products) > 0)
                <div class="px-5 max-w-screen-xl splide mx-auto" id="splide_{{ str_replace(' ', '_', $category->name) }}">
                    <div class="my-8 text-center">
                        <h2>{{__($category->name)}}</h2>
                    </div>
                    <div class="splide__track mx-8">
                        <ul class="splide__list">
                            @foreach($category->products as $product)
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
                                                <p class="small">{{ __('Contains') }} {{ __($alergen?->name) }}</p>
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
                </div>
            @endif        
        @endforeach
    </div>
</x-app-layout>