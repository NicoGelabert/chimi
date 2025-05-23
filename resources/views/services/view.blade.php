<x-app-layout>
<div class="flex flex-col items-center justify-center">
    <div class="flex flex-col justify-center md:items-stretch gap-12 px-4 pt-24 mx-auto md:flex-row overflow-hidden">
        <div class="flex flex-col justify-start gap-8 w-full md:w-1/2">
            <hr class="animate-hr border-t-2 border-black" />
            <div class="flex justify-between">
                <h3 class="animate-h3">0{{ $service->id }}</h3>
                <i class="fi fi-br-arrow-up-left text-4xl animate-arrow overflow-hidden"></i>
            </div>
            <h1 class="animate-h1 text-6xl leading-tight dark:text-white">{{ $service->name }}</h1>
            <p class="animate-p">{!! $service->description !!}</p>

            <div class="flex gap-4 justify-start flex-wrap">
                @foreach ($service_buttons as $service_button)
                    <div class="animate-button my-2">
                        <x-button href="{{ route('service.view', $service_button->slug) }}">
                            <i class="fi fi-rr-arrow-right arrow-to-right"></i>
                            <span>{{ $service_button->name }}</span>
                        </x-button>
                    </div>
                @endforeach
            </div>
        </div>
            
        <div class="flex w-full md:w-1/2 h-auto overflow-hidden">
            <ul class="flex flex-col gap-2">
                @foreach($service->attributes as $attribute)
                <div class="w-full p-4 flex justify-start gap-4 items-start animate-service-item">
                <i class="fi fi-sr-comment-alt-check"></i><li class="text-sm">{{ $attribute->text }}</li>
                </div>
                @endforeach
            </ul>
        </div>
    </div>
    
    <div class="max-w-screen-xl w-full">
        <x-project-modal :service="$service" :projects="$projects" :projectsJson="$projectsJson" />
    </div>
        
    <hr class="divider w-full" />
    
    <x-quotation :tags="$tags"/>
</div>

</x-app-layout>