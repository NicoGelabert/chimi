<x-app-layout>

    <x-home-hero-banner :homeherobanners="$homeherobanners" />

    <hr class="divider" />

    <x-features :features="$features"/>
    
    <hr class="divider" />

    <x-benefits />

    <x-clients />

    <x-services :services="$services"/>
    
    <hr class="divider" />
    
    <x-portfolio :portfolios="$portfolios"/>
    
    <hr class="divider" />

    <x-contact />
    
</x-app-layout>