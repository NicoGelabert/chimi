<div class="flex flex-col gap-8 bg-gray-200 dark:bg-zinc-800 mx-auto px-4 py-12 my-12  items-center">
    <div class="pretitle">
        <p>Confían en nosotros</p>
    </div>
    <h3 class="text-center">Nuestros clientes</h3>
    <p class="text-center">Desde pequeños emprendedores hasta grandes corporaciones, cada cliente es único.</p>
    <div class="flex items-center justify-center text-black">
        <ul class="flex flex-wrap gap-4">
            @foreach($clients as $client)
            <li class="max-w-20 h-auto">
                <img src="{{ $client->image }}" alt="{{ $client->name }}">
            </li>
            @endforeach
        </ul>
        
    </div>
</div>