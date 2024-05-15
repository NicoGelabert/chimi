<div class="container flex flex-col gap-8">
    <p class="text-xs text-center">
        <span class="p-1 before:block before:absolute before:-inset-1 before:-skew-y-3 before:bg-primary relative inline-block">
            <span class="relative text-white font-semibold">Cómo trabajamos</span>
        </span>
    </p>
    <h3 class="text-center">Convertimos sus ideas en realidad con un diseño gráfico y web único</h3>
    <div class="flex flex-col md:flex-row pt-12 gap-12">
        @foreach ($features as $feature)
            <div class="flex flex-col items-center justify-between gap-8 text-center w-full md:w-1/3">
                <i class="text-4xl {{ $feature->image }} text-primary   "></i>
                <h4 class="">{{ $feature->title }}</h4>
                <p>{{ $feature->description }}</p>
                <button>Ver más</button>
            </div>
        @endforeach
    </div>
</div>