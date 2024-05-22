<x-app-layout>
    <div class="h-screen flex items-center">
        @foreach($services as $service)
        <a href="{{ route('service.view', $service->slug) }}">
            <h1>{{ $service->title }}</h1>
        </a>
        @endforeach
    </div>
</x-app-layout>