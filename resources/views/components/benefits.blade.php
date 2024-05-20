 <div class="container flex flex-col md:flex-row items-end">
    <div class="w-full lg:w-1/2 flex flex-col justify-start gap-8">
        <div class="pretitle">
            <p>Beneficios</p>
        </div>
        <h3>Destaca con innovadoras soluciones de diseño</h3>
        <p>En nuestra agencia, combinamos creatividad y experiencia para ofrecer soluciones atractivas de diseño gráfico y web que ayuden a las empresas a tener éxito. Con nuestro enfoque único, nos aseguramos de que su marca se destaque de la competencia y cautive a su público objetivo.</p>
        <div class="flex gap-4">
            <div class="w-1/2 sm:w-1/4 lg:w-1/2">
                <h5 class="pb-4">Aptitudes</h5>
                <p class="text-sm">Nuestro equipo de diseñadores y desarrolladores capacitados hace realidad su visión con precisión y estilo.</p>
            </div>
            <div class="w-1/2 sm:w-1/4 lg:w-1/2">
                <h5 class="pb-4">Colaboración</h5>
                <p class="text-sm">Trabajamos estrechamente con nuestros clientes para comprender sus objetivos y ofrecer soluciones de diseño personalizadas.</p>
            </div>
            <div class="hidden sm:inline-block sm:w-2/4 lg:hidden">
                <img src="{{ asset('storage/benefits/website-builders.svg') }}" class="w-full lg:w-3/4" alt="">
            </div>
        </div>
        <x-button href="#">
            <i class="fi fi-rr-arrow-right arrow-to-right"></i> <span>{{__('ver más')}}</span>
        </x-button>

    </div>
    <div class="sm:hidden lg:flex lg:justify-end w-full my-8 lg:w-1/2">
        <img src="{{ asset('storage/benefits/website-builders.svg') }}" class="w-full lg:w-3/4" alt="">
    </div>
</div>