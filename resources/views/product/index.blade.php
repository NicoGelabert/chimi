<?php
/** @var \Illuminate\Database\Eloquent\Collection $products */
?>

<x-app-layout>
    <?php if ($products->count() === 0): ?>
        <div class="text-center text-gray-600 py-16 text-xl h-screen">
            {{ __('No hay productos publicados') }}
        </div>
    <?php else: ?>
        <div
            class="grid gap-4 grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 lg:mx-12 pt-24 lg:pt-32"
        >
            @foreach($products as $product)
                <!-- Product Item -->
                <div x-data="productItem({{ json_encode([
                        'id' => $product->id,
                        'slug' => $product->slug,
                        'image' => $product->image,
                        'title' => $product->title,
                        'price' => $product->price,
                        'addToCartUrl' => route('cart.add', $product)
                    ]) }})"
                    class="border-transparent relative overflow-hidden rounded-lg bg-white flex">
                    <a href="{{ route('product.view', [$product->category?->slug, $product->slug]) }}"
                       class="aspect-w-3 aspect-h-2 block overflow-hidden">
                        <img
                            src="{{ $product->image }}"
                            alt=""
                            class="card-image object-cover hover:scale-105 hover:rotate-1 transition-transform"
                        />
                        <div class="p-4 card-listing">
                            <div>
                                <h3 class="underline-hover w-fit">
                                    {{ __($product->title)}}
                                </h3>
                            </div>
                            <!-- <div class="price-container relative flex justify-between my-4">
                                <span class="title font-number-label text-right">Price</span>
                                <h5 class="font-number pl-4 text-lg md:text-xl lg:text-2xl">${{$product->price}}</h5>
                            </div> -->
                            <div class="flex justify-center w-full gap-4">
                            @foreach ($product->prices as $price)
                                <p> ${{$price->number}} - ${{$price->size}}</p>
                            @endforeach
                            </div>

                        </div>
                    </a>
                    <button class="btn-primary absolute btn-cart-product" @click="addToCart()">
                        <!-- Add to Cart -->
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
                <!--/ Product Item -->
            @endforeach
        </div>
        <div class="m-8">
            {{$products->links()}}
        </div>
    <?php endif; ?>
</x-app-layout>
