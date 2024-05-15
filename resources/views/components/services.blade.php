<div class="container flex flex-col gap-8">
    <p class="text-xs text-center">
        <span class="p-1 before:block before:absolute before:-inset-1 before:-skew-y-3 before:bg-primary relative inline-block">
            <span class="relative text-white font-semibold">Servicios</span>
        </span>
    </p>
    <h3 class="text-center">Soluciones de diseño</h3>
    <p class="text-center">Ofrecemos una gama de servicios de diseño creativo para satisfacer sus necesidades.</p>
    <div class="flex flex-col md:flex-row md:px-0 gap-12 md:gap-4">
        @foreach ($services as $service)
        <div class="flex flex-col items-start md:items-center gap-4 w-full md:w-1/3 p-12 md:p-8 border-2 rounded-xl transition-all delay-150 hover:border-primary">
            <div class="flex gap-4 md:justify-between">
                <i class="text-4xl {{ $service->image }} text-primary"></i>
                <h4 class="">{{ $service->title }}</h4>
            </div>
            <p class="md:text-center">{{ $service->description }}</p>
            <button>Ver más</button>
        </div>
        @endforeach
    </div>
</div>