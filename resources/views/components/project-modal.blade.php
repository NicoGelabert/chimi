<div 
    x-show="isOpen"
    x-transition
    class="fixed inset-0 bg-black bg-opacity-70 z-50 flex items-center justify-center p-4"
    style="display: none;"
>
    <div 
        class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-xl max-w-3xl w-full relative"
        @click.away="isOpen = false"
    >
        <button 
            @click="isOpen = false"
            class="absolute top-2 right-2 text-black dark:text-white"
        >
            &times;
        </button>

        <img :src="currentImage" alt="" class="w-full h-64 object-cover mb-4 rounded-lg" />

        <h2 class="text-2xl font-semibold mb-2 dark:text-white" x-text="currentTitle"></h2>

        <p class="text-gray-700 dark:text-gray-300 mb-4" x-text="currentShortDescription"></p>

        <div class="flex flex-wrap gap-2 mb-4">
            <span 
                class="px-3 py-1 bg-gray-200 text-sm rounded-full dark:bg-gray-700 dark:text-white" 
                x-for="tag in currentTags"
                x-text="tag"
            ></span>
        </div>

        <div class="flex justify-between">
            <button 
                @click="prev"
                class="px-4 py-2 bg-gray-300 dark:bg-gray-700 rounded hover:bg-gray-400"
            >
                Anterior
            </button>
            <a 
                :href="computedUrl"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
            >
                Ver proyecto
            </a>
            <button 
                @click="next"
                class="px-4 py-2 bg-gray-300 dark:bg-gray-700 rounded hover:bg-gray-400"
            >
                Siguiente
            </button>
        </div>
    </div>
</div>
