<?php
/** @var \Illuminate\Database\Eloquent\Collection $products */
?>

<x-app-layout>
    <?php if ($products->count() === 0): ?>
        <div class="">
            {{ __('No hay productos publicados') }}
        </div>
    <?php else: ?>
        <div
            class=""
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
                    class="">
                    <a href="{{ route('product.view', [$product->category?->slug, $product->slug]) }}"
                       class="aspect-w-3 aspect-h-2 block overflow-hidden">
                        <img
                            src="{{ $product->image }}"
                            alt=""
                            class=""
                        />
                        <div class="">
                            <div>
                                <h3 class="">
                                    {{ __($product->title)}}
                                </h3>
                            </div>
                        </div>
                    </a>
                    <button class="" @click="addToCart()">
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
        <div class="">
            {{$products->links()}}
        </div>
    <?php endif; ?>
</x-app-layout>
