@extends('layouts.public')
@section('content')
<div class="mx-auto max-w-7xl">
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="">
        @foreach($events as $event)
            <div class="flex items-center py-8">
                <div class="h-32 mr-12">
                    @if($event->featured_photo_url)
                        <img class="object-cover w-64 h-32 rounded-lg shadow-lg" src="https://picsum.photos/seed/{{$event->id}}/200/300" alt="">
                    @else
                        <div class="relative flex items-center justify-center w-64 h-32 overflow-hidden bg-gray-400 rounded-lg shadow-lg">
                            <svg class="w-24 h-24 text-gray-300 opacity-30" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <div class="absolute inset-0 flex items-center justify-center text-4xl font-bold text-gray-700">
                                {{ $event->starts_at->format('M j') }}
                            </div>
                        </div>
                    @endif
                </div>
                <div class="flex-1 h-32">
                    <div class="text-xs text-gray-600">{{ $event->formatted_starts_at }}</div>
                    <a href="/events/{{$event->uuid}}" class="text-2xl font-bold text-gray-800 hover:underline">{{$event->title}}</a>
                    <p class="text-gray-600 text-normal line-clamp-2">
                        {{$event->description}}
                    </p>
                    <p class="mt-1 text-xs text-gray-600">4 people attending</p>
                    {{-- <div class="flex items-center mt-2 overflow-hidden">
                        <img class="inline-block w-6 h-6 rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixqx=fGMdh7IRZo&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        <img class="inline-block w-6 h-6 -ml-1 rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        <img class="inline-block w-6 h-6 -ml-1 rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&ixqx=fGMdh7IRZo&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.25&w=256&h=256&q=80" alt="">
                        <img class="inline-block w-6 h-6 -ml-1 rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixqx=fGMdh7IRZo&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        <p class="ml-2 text-xs text-gray-600">and 8 more</p>
                    </div> --}}
                </div>
            </div>
        @endforeach
        {{ $events->links() }}
    </div>
</div>
@endsection
