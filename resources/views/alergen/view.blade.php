<x-app-layout>
    <div class="px-5 max-w-screen-xl flex items-center justify-evenly py-32 mx-auto w-full">
        <a href="{{ route('alergen.view', $alergen->slug) }}" class="flex items-center gap-4">
            <img src="{{ url($alergen?->image) }}" alt="{{$alergen->name}}" class="">
            <h4>{{$alergen->name}}</h4>
        </a>
    </div>
</x-app-layout>