<x-app-layout>

    <x-home-hero-banner :homeherobanners="$homeherobanners" />

    <x-services :services="$services"/>
    
    <hr class="divider" />
    
    <x-benefits :tags="$tags" />
    
    <hr class="divider" />
    
    <x-portfolio :projects="$projects" />
    
    <hr class="divider" />
    
    <x-features :features="$features"/>
    
    <x-clients :clients="$clients" />
    
    <hr class="divider" />
    
    <x-faq :faqs="$faqs"/>
    
    <hr class="divider" />

    <x-contact />
    
</x-app-layout>