<div class="container flex flex-col md:flex-row items-start gap-16">
    <div class="w-full md:w-1/2 flex flex-col justify-start gap-8">
        <p class="text-xs">
            <span class="p-1 before:block before:absolute before:-inset-1 before:-skew-y-3 before:bg-primary relative inline-block">
                <span class="relative text-white font-semibold">Contáctenos</span>
            </span>
        </p>
        <h3 class="">Estemos en contacto
        </h3>
        <p class="">No dudes en ponerte en contacto con nosotros. Estamos ansiosos por escuchar de ti y trabajar juntos en tus proyectos. ¡Esperamos tu mensaje!</p>
        <div class="max-w-32">
            <x-social-icons />
        </div>
    </div>
    <div class="flex flex-col w-full md:w-1/2">
        <form id="subscriptionForm" action="" method="post" class="flex gap-2 w-full form">
            @csrf
            <div class="flex flex-col gap-6 w-full">
                <input id="nameInput" type="text" name="name" placeholder="Su nombre" required >
                <input id="emailInput" type="email" name="email" placeholder="Su correo electrónico" required >
                <input id="phoneInput" type="tel" name="phone" placeholder="Su teléfono" required pattern="[0-9]{9}">
                <select name="area" required id="areaInput">
                    <option value="">¿Qué necesita?</option>
                    <option value="Diseño web">Diseño web</option>
                    <option value="Diseño gráfico">Diseño gráfico</option>
                    <option value="Branding">Branding</option>
                </select>
                <textarea id="messageInput" name="message" placeholder="Déjenos un mensaje" rows="4" required ></textarea>
                <div class="g-recaptcha" data-sitekey="6LcjHtMpAAAAAII4PAM3Vh2hT-0RDntu6B-3a_pH"></div>
                <x-button id="subscribeBtn" type="submit">
                    <i class="fi fi-rr-arrow-right"></i> <span>{{__('Enviar')}}</span>
                </x-button>
            </div>
        </form>
        
    </div>

</div>