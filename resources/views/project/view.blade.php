<x-app-layout>
    <div class="flex flex-col items-center justify-center pb-24">
        <div class="flex flex-col justify-center md:items-stretch gap-12 px-4 lg:px-0 pt-24 mx-auto md:flex-row overflow-hidden">
            <div class="md:w-1/2 mt-8">
                <img src="{{ $project->image }}" alt="">
            </div>
            <div class="flex flex-col justify-start gap-8 w-full md:w-1/2">
                <hr class="animate-hr border-t-2 border-black" />
                <div class="flex justify-between">
                    <h5 class="animate-h3 text-gray-300">Proyecto nº 0{{ $project->id }}</h5>
                    <i class="fi fi-br-arrow-up-left text-4xl animate-arrow overflow-hidden"></i>
                </div>
                <h1 class="animate-h1 text-6xl leading-tight dark:text-white">{{ $project->title }}</h1>
                <!-- INICIO PÁGINA WEB -->
                @if ($project->link)
                <div class="webpage">
                    @php
                        $url = $project->link;

                        // Para el href: agregar https:// si no está
                        $link = Str::startsWith($url, ['http://', 'https://']) ? $url : 'https://' . $url;

                        // Para el texto: eliminar protocolo y barra final
                        $display = preg_replace('/^https?:\/\//', '', $url);         // quita http:// o https://
                        $display = preg_replace('/^www\./', '', $display);           // Quita www. si existe al principio
                        $display = rtrim($display, '/');                             // quita barra final si existe
                    @endphp
                    <a href="{{ $link }}" class="flex gap-2 items-center" target="blank">
                        <p>{{ $display }}</p>
                        <x-icons.external-link class="h-4 w-4"/>
                    </a>
                </div>
                @endif
                <!-- FIN PÁGINA WEB -->
                <ul class="flex flex-wrap gap-2">
                    @foreach($project->tags as $tag)
                    <li class="mt-1 bg-slate-100 text-xs w-fit rounded-full px-3 py-2">{{ $tag->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <hr class="my-8 w-full"/>
        <div class="animate-p text-center">
            <p>{!! $project->short_description !!}</p>
        </div>
        @if ($project->images->count() > 1)
        <hr class="my-8 w-full"/>
        <div class="project_gallery">
            <x-image-gallery :images="$project->images" class="project_gallery_images"></x-image-gallery>
        </div>
        @endif
        @if ($project->client_review)
        <hr class="my-8 w-full"/>
        <p>{!! $project->client_review !!}</p>
        @endif
    </div>
</x-app-layout>