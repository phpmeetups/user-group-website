@extends('layouts.public')
@section('content')
<div class="bg-gray-100">
    <div class="px-4 py-8 mx-auto max-w-7xl">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="lg:flex lg:items-center lg:justify-between">
            <div class="flex-1 min-w-0">
                <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    Events
                </h1>
                <div class="flex flex-col mt-1 sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6">
                </div>
            </div>
            <div class="flex mt-5 lg:mt-0 lg:ml-4">
                <!-- Dropdown -->
                <span class="relative ml-3 sm:hidden">
                    <button type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" id="mobile-menu" aria-expanded="false" aria-haspopup="true">
                        More
                        <!-- Heroicon name: solid/chevron-down -->
                        <svg class="w-5 h-5 ml-2 -mr-1 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    
                    <!--
                        Dropdown menu, show/hide based on menu state.
                        
                        Entering: "transition ease-out duration-200"
                        From: "transform opacity-0 scale-95"
                        To: "transform opacity-100 scale-100"
                        Leaving: "transition ease-in duration-75"
                        From: "transform opacity-100 scale-100"
                        To: "transform opacity-0 scale-95"
                    -->
                    <div class="absolute right-0 w-48 py-1 mt-2 -mr-1 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="mobile-menu">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Edit</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">View</a>
                    </div>
                </span>
            </div>
        </div>
    </div>
</div>
<div class="mx-auto max-w-7xl">
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="">
        @foreach($events as $event)
            <div class="flex items-center py-8">
                <div class="h-32 mr-12">
                    @if($event->photo)
                        <img class="object-cover w-64 h-32 rounded-lg shadow-lg" src="{{$event->photo}}" alt="">
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
