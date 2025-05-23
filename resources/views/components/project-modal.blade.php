@props(['service', 'projects', 'projectsJson'])

<div>
    <script>
        function projectGallery() {
            return {
                isOpen: false,
                currentIndex: 0,
                projects: @json($projectsJson),
                get currentProject() {
                    return this.projects[this.currentIndex];
                },
                init() {},
                open(index) {
                    this.currentIndex = index;
                    this.isOpen = true;
                },
                next() {
                    if (this.currentIndex < this.projects.length - 1) this.currentIndex++;
                },
                prev() {
                    if (this.currentIndex > 0) this.currentIndex--;
                },
            };
        }
    </script>

    <div x-data="projectGallery()" x-init="init()" class="w-full" id="portfolio">
        @if($service->id === 2)
        <hr class="divider w-full" />
        <div id="portfolio_gallery" class="splide">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach($projects as $index => $project)
                    <li class="splide__slide" @click="open({{ $index }})">
                        <div class="portfolio_project">
                            <img src="{{ ($project->image) }}" class="" alt="{{ $project->title }}">
                            <div class="portfolio_project_content">
                                <x-icons.search />
                                <p>Proyecto Nº {{ $project->id }}</p>
                                <h6>{{ $project->title }}</h6>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @elseif($service->id === 1)
        <hr class="divider w-full" />
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($projects as $index => $project)
            <li @click="open({{ $index }})">
                <div class="portfolio_project">
                    <img src="{{ ($project->image) }}" class="" alt="{{ $project->title }}">
                    <div class="portfolio_project_content">
                        <x-icons.search />
                        <p>Proyecto Nº {{ $project->id }}</p>
                        <h6>{{ $project->title }}</h6>
                    </div>
                </div>
            </li>
            @endforeach
        </div>
        @endif

        <div x-show="isOpen" @click.away="isOpen = false" class="fixed inset-0 flex justify-center bg-black bg-opacity-75 z-50 overflow-auto">
            <div class="mx-8 my-8 lg:my-auto lg:flex lg:flex-row lg:gap-8 w-full h-[70vh] lg:max-w-screen-xl">
                <div class="lg:w-1/2 flex flex-col mb-4 justify-start items-start">
                    <img :src="currentProject.image" class="w-full h-auto object-contain max-h-[70vh]">
                </div>
                <div class="text-white lg:w-1/2 flex flex-col gap-4">
                    <div class="flex flex-col gap-2">
                        <h3 x-text="currentProject.title"></h3>
                        <p x-html="currentProject.short_description"></p>
                        <div>
                            <ul class="flex gap-2 flex-wrap">
                                <template x-for="tag in currentProject.tags" :key="tag">
                                    <li class="mt-1 bg-gray-50 text-xxs w-fit rounded-lg px-2 py-1 text-black" x-text="tag"></li>
                                </template>
                            </ul>
                        </div>
                    </div>
                    <a :href="`/servicios/${currentProject.service_slug}/${currentProject.slug}`" class="text-xs btn-primary">Ver proyecto completo</a>
                </div>
            </div>
            <div class="fixed bottom-4 right-4 flex w-auto gap-2">
                <!-- Flecha Anterior -->
                <button @click="prev" :class="currentIndex === 0 ? 'opacity-50 cursor-not-allowed pointer-events-none' : ''" class=" w-12 h-12 bg-primary text-white p-2 rounded-full">❮</button>
                
                <!-- Flecha Siguiente -->
                <button @click="next" :class="currentIndex === projects.length - 1 ? 'opacity-50 cursor-not-allowed pointer-events-none' : ''" class="w-12 h-12 bg-primary text-white p-2 rounded-full">❯</button>

                <!-- Botón Cerrar -->
                <button @click="isOpen = false" class="w-12 h-12 bg-black border-2 border-primary text-primary p-2 rounded-full ml-4">✕</button>
            </div>
        </div>
    </div>
</div>