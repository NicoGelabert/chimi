@props(['images' => []])

@php
    // Excluir la primera imagen, resetear los índices y obtener solo la columna 'url'
    $filteredImages = $images->skip(1)->pluck('url')->values();
@endphp

<div x-data="{
    images: JSON.parse('{{ $filteredImages->toJson() }}'),
    imageIndex: 0, 
    open: false, 
    prev() {
        this.imageIndex = (this.imageIndex > 0) ? this.imageIndex - 1 : this.images.length - 1;
    },
    next() {
        this.imageIndex = (this.imageIndex < this.images.length - 1) ? this.imageIndex + 1 : 0;
    }
}">
    <!-- Splide Slider -->
    <div {{ $attributes->merge(['class' => 'splide']) }}>
        <div class="splide__track mx-10">
            <ul class="splide__list items-center">
                @foreach ($filteredImages as $index => $imageUrl)
                <li class="splide__slide">
                    <img src="{{ $imageUrl }}" 
                         @click="if (images.length) { open = true; imageIndex = {{ $index }} }" 
                         class="cursor-pointer">
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Lightbox -->
    <template x-if="open && images.length">
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-80 z-50" id="project_lightbox">
            <div class="relative w-full h-full flex items-center justify-center p-4">
                <!-- Imagen Actual -->
                <img :src="images[imageIndex]" class="max-w-full max-h-full">                
                <div class="absolute bottom-4 right-4 flex w-auto gap-2">
                    <!-- Flecha Anterior -->
                    <button @click="prev()" class=" w-12 h-12 bg-primary text-white p-2 rounded-full">❮</button>
                    
                    <!-- Flecha Siguiente -->
                    <button @click="next()" class="w-12 h-12 bg-primary text-white p-2 rounded-full">❯</button>

                    <!-- Botón Cerrar -->
                    <button @click="open = false" class="w-12 h-12 bg-black border-2 border-primary text-primary p-2 rounded-full ml-4">✕</button>
                </div>
            </div>
        </div>
    </template>
</div>
