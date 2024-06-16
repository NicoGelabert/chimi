<div class="container flex flex-col gap-8 items-center" id="services">
    <div class="pretitle">
        <p>Servicios</p>
    </div>
    <h3 class="text-center">Soluciones de diseño</h3>
    <p class="text-center">Ofrecemos una gama de servicios de diseño creativo para satisfacer sus necesidades.</p>
    <div class="w-full flex flex-col md:flex-row md:px-0 gap-12 md:gap-4 items-start">
    @foreach ($services as $service)
        <div class="card" style="background-image:url({{ $service->image }})" x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false">
            <div class="card-content">
                <div class="flex justify-between items-center w-full">
                    <h2 class="text-right border-b-2 pb-4 border-primary">0{{ $service->id }}</h2>
                    <i class="text-4xl {{ $service->icon }} text-primary"></i>
                </div>
                <h4>{{ $service->name }}</h4>
                <div :class="{ 'visible': hover }" class="description">{!! $service->description !!}</div>
                <x-button href="{{ route('service.view', $service->slug) }}">
                    <i class="fi fi-rr-arrow-right"></i> <span>{{__('Ver más')}}</span>
                </x-button>
            </div>
        </div>
    @endforeach

    </div>
</div>