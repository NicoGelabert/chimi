<div class="container mb-16 flex flex-col md:flex-row items-start gap-16" id="contact">
    <div class="w-full flex flex-col md:w-1/2 gap-8">
        <div class="flex justify-between items-start">
            <div class="hidden md:flex h-fit vertical-text ">
                <h2 class="text-center">Contacto</h2>
            </div>
            <div class="block md:hidden">
                <h2 class="text-left">Contacto</h2>
            </div>
            <i class="fi fi-br-arrow-up-left text-4xl overflow-hidden -rotate-90"></i>
        </div>
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-8">
            <p class="text-left text-2xl">Si tiene más consultas, no dude en ponerse en contacto con nosotros. </p>
            <x-social-icons class="md:flex-col" />
        </div>
    </div>
    <div class="flex flex-col w-full md:w-1/2">
        <form id="contactForm" action="{{ route('contact.store') }}" method="post" class="flex gap-2 w-full form">
            @csrf
            <div class="flex flex-col gap-6 w-full">
                <input id="nameInput" type="text" name="name" placeholder="Su nombre" required >
                <input id="emailInput" type="email" name="email" placeholder="Su correo electrónico" required >
                <input id="phoneInput" type="tel" name="phone" placeholder="Su teléfono" required pattern="[0-9]{9}">
                <select id="serviceInput" name="service" required>
                    <option value="">¿Qué necesita?</option>
                    <option value="Diseño web">Diseño web</option>
                    <option value="Diseño gráfico">Diseño gráfico</option>
                    <option value="Branding">Branding</option>
                </select>
                <textarea id="messageInput" name="message" placeholder="Déjenos un mensaje" rows="4" required ></textarea>
                <div class="g-recaptcha" data-sitekey="6LcjHtMpAAAAAII4PAM3Vh2hT-0RDntu6B-3a_pH"></div>
                <x-button id="subscribeBtn" type="submit">
                    <i class="fi fi-rr-arrow-right arrow-to-right"></i> <span>{{__('Enviar')}}</span>
                </x-button>
            </div>
        </form>
        <div id="successMessage" class="mx-auto" style="display: none;">
            <H4 class="text-center">Mensaje Enviado!</H4>
            <img src="{{ asset('storage/common/mensaje-enviado.gif')}}" alt="Mensaje enviado">
        </div>
        <div id="errorMessage" class="mx-auto" style="display: none;">
            El envío falló. Vuelva a intentar, por favor.
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('contactForm');
        const successMessage = document.getElementById('successMessage');
        const errorMessage = document.getElementById('errorMessage');
        form.addEventListener('submit', async function(event) {
            event.preventDefault(); // Prevent default form submission behavior
            const name = document.getElementById('nameInput').value;
            const email = document.getElementById('emailInput').value;
            const phone = document.getElementById('phoneInput').value;
            const service = document.getElementById('serviceInput').value;
            const message = document.getElementById('messageInput').value;
            console.log(typeof name)
            console.log(typeof service)
            try {
                const response = await fetch('{{ route("contact.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ name, email, phone, service, message })
                });
                const data = await response.json();
                if (response.ok) {
                    successMessage.style.display = 'block';
                    form.style.display = 'none';
                } else {
                    errorMessage.style.display = 'block';
                }
            } catch (error) {
                errorMessage.style.display = 'block';
            }
        });
    });
</script>