@extends('layouts.public')
@section('content')
@if ($event->isCanceled())
    <div class="text-white bg-indigo-500">
        <div class="mx-auto max-w-7xl">
            <h2 class="py-4 text-3xl font-bold text-center">
                Event Canceled
            </h2>
        </div>
    </div>
@endif
<div class="bg-gray-100">
    <div class="px-4 py-8 mx-auto max-w-7xl">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="lg:flex lg:items-center lg:justify-between">
            <div class="flex-1 min-w-0">
                <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    {{$event->title}}
                </h1>
                <div class="flex flex-col mt-1 sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6">
                    <div class="flex items-center mt-2 text-sm text-gray-500">
                        <!-- Heroicon name: solid/calendar -->
                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                        {{$event->formatted_starts_at}}
                    </div>
                </div>
            </div>
            <div class="flex mt-5 lg:mt-0 lg:ml-4">
                @if ($event->isUpcoming())
                    <span class="hidden sm:block">
                        @if($event->canRSVP())
                            <button type="button" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <!-- Heroicon name: solid/check -->
                                <svg class="w-5 h-5 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 100 4v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2a2 2 0 100-4V6z" />
                                </svg>
                                RSVP
                            </button>
                        @else
                            <span class="text-gray-700">RSVP starts in {{ $event->rsvp_starts_at->diffForHumans() }}</span>
                        @endif
                    </span>
                @endif
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
<div class="py-8 bg-white">
    <div class="mx-auto max-w-7xl">
        <div class="flex">
            <div class="w-2/3 p-4">
                <div class="mr-12 aspect-w-16 aspect-h-9">
                    @if($event->photo)
                        <img class="object-cover rounded-lg shadow-lg" src="{{$event->photo}}" alt="">
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
                <div class="mt-8">
                    <div class="text-2xl">Description</div>
                    <div class="mt-2 prose">
                        {{$event->description}}
                    </div>
                </div>
                @if ($event->isOnline() || $event->isHybrid())
                    <div class="mt-8">
                        <div class="text-2xl">Online Instructions</div>
                        <div class="mt-2 prose">
                            {{$event->online_instructions}}
                        </div>
                    </div>
                @endif
            </div>
            <div class="w-1/3 p-4 space-y-4">
                <div class="p-4 bg-gray-100 rounded-lg">
                    <div class="font-bold tracking-wide text-gray-400 uppercase">Event Ended</div>
                    <div class="py-2">
                        Thanks to all attendees!
                    </div>
                </div>
                @if ($event->isUpcoming() || $event->isHappeningNow())
                    @if ($event->isOnline() || $event->isHybrid())
                        <div class="p-4 bg-gray-100 rounded-lg">
                            <div class="font-bold tracking-wide text-gray-400 uppercase">Join Online</div>
                            <div class="py-2">
                                @if (optional($user)->isAttendingEvent($event))
                                    <a href="{{$event->online_url}}">{{$event->online_url}}</a>
                                @else
                                    <span class="text-gray-700">Link visible for attendees</span>
                                @endif
                            </div>
                        </div>
                    @endif
                @endif
                @if ($event->isPhysical() || $event->isHybrid())
                    <div class="p-4 bg-gray-100 rounded-lg">
                        <div class="font-bold tracking-wide text-gray-400 uppercase">{{Str::plural('Venue', $event->venues()->count())}}</div>
                        <div class="py-2 space-y-4">
                            @foreach($event->venues as $venue)
                                <address class="text-gray-700">
                                    <div class="text-lg not-italic">{{$venue->name}}</div>
                                    <div>{{$venue->address['street']}}</div>
                                    <div>
                                        {{$venue->address['city']}}, {{$venue->address['region']}} {{$venue->address['postal_code']}}
                                    </div>
                                </address>
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="p-4 bg-gray-100 rounded-lg">
                    <div class="font-bold tracking-wide text-gray-400 uppercase">
                        Attendees ({{$event->yesRsvps()->count()}})
                    </div>
                    <div class="py-2 space-y-2">
                        @foreach($event->yesRsvps as $rsvp)
                            <div>{{$rsvp->user->name}}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection