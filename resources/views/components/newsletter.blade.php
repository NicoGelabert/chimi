<div class="subscribe relative overflow-hidden py-16 sm:py-24 lg:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="flex flex-col gap-16 md:flex-row">
            <div class="w-full md:w-1/2 ">
                
                <!-- <div class="mt-6 flex flex-col sm:flex-row w-full gap-4">
                    <input id="email-address" name="email" type="email" autocomplete="email" required class="account w-full" placeholder="Enter your email">
                    <button type="submit" class="btn-primary">{{__('Subscribe')}}</button>
                </div> -->
                <img src="{{ asset('storage/img/local.jpeg') }}" alt="">
            </div>
            <div class="w-full md:w-1/2 grid grid-cols-1 gap-x-8 gap-y-6 lg:pt-2">
                <h2 class="text-3xl sm:text-4xl">{{__('Dónde nos encuentras')}}</h2>
                <p class="text-lg leading-8 text-gray-600">{{__('Desde el año 2009 estamos en el corazón de Fuengirola, en la Costa del Sol.')}}</p>
                <p class="text-md leading-8 text-gray-600">Av. Ramón y Cajal 10, Fuengirola, Málaga.</p>
                <p class="text-sm font-bold leading-8">{{__('Horario de atención')}}<br>{{__('Lu - Vi')}} 10 a 20hs | {{__('Sa')}} 10 a 15hs.</p>
                <div class="flex gap-6 social-icons">
                    <a href="https://wa.me/34622406965" class="h-10 w-10 aspect-square rounded-md bg-black/5 p-2 ring-1 ring-black/10" target="_blank">
                        <i class="flex text-2xl leading-none fi fi-brands-whatsapp"></i>
                    </a>
                    <a href="https://www.instagram.com/puntosurfuengirola/?hl=es" class="h-10 w-10 aspect-square rounded-md bg-black/5 p-2 ring-1 ring-black/10" target="_blank">
                        <i class="flex text-2xl leading-none fi fi-brands-instagram"></i>
                    </a>
                    <a href="https://maps.app.goo.gl/22GUnZ2foJeEYud98" class="h-10 w-10 aspect-square rounded-md bg-black/5 p-2 ring-1 ring-black/10" target="_blank">
                        <i class="flex text-2xl leading-none fi fi-rs-map-marker"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>