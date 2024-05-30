<x-app-layout>

    <x-home-hero-banner :homeherobanners="$homeherobanners" />

    <x-services :services="$services"/>
    
    <hr class="divider" />
    
    <x-benefits />
    
    <x-clients />
    
    <x-features :features="$features"/>
        
    <hr class="divider" />
    
    <x-portfolio :portfolios="$portfolios"/>
    
    <hr class="divider" />
    
    <x-faq :faqs="$faqs"/>
    
    <hr class="divider" />

    <x-contact />
    
</x-app-layout>