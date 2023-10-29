{{-- it s my show/tv blade here  --}}

@extends('layouts.main')


@section('content')
    <div class="tv-info border-b box-border container mx-auto border-gray-800 ">
        <div class="container mx-auto px-32 py-16 box-border   grid  grid-cols-2 ">
            <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $tvshow['poster_path'] }}"
                class=" hover:opacity-75   transition-all duration-150 w-96" alt="">

            <div class="  over  box-border ">



                <h2 class=" text-4xl font-semibold">

                    {{ $tvshow['name'] }}
                </h2>

                <div class="flex  items-center mt-2 text-gray-400">
                    <span> <svg class="fill-current text-orange-500 w-4" viewBox="0 0 24 24">
                            <g data-name="Layer 2">
                                <path
                                    d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1
                                                                                                                                                                                                                                                                                                                                                                        0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1
                                                                                                                                                                                                                                                                                                                                                                        0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1
                                                                                                                                                                                                                                                                                                                                                                        1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z"
                                    data-name="star" />
                            </g>
                        </svg>
                    </span>
                    <span class="ml-1">{{ $tvshow['vote_average'] }} </span>
                    <span class="mx-2">|</span>
                    <span>{{ $tvshow['first_air_date'] }}</span>
                    <span class="mx-2">|</span>
                    <div class="text-gray-400">




                    </div>

                </div>
                <div class="flex  flex-wrap ">
                    @if ($tvshow['overview'])
                        <p
                            class=" to-gray-300  flex-wrap   prose 
                            max-w-2xl mx-auto bg-slate-400 ring-1 p-8 mt-4 shadow-md rounded-md  ">
                            {{ $tvshow['overview'] }}
                        </p>
                    @endif

                </div>

                {{-- start of crew container here  --}}
                {{-- start of crew container here  --}}
                {{-- start of crew container here  --}}
                {{-- start of crew container here  --}}

                <div class="  mt-12">
                    <h4 class="text-white font-semibold">Featured Crew</h4>
                    <div class="flex mt-4">
                        @foreach ($tvshow['created_by'] as $show)
                            @if ($loop->index < 2)
                                <div class="mr-8">
                                    <div>{{ $show['name'] }}</div>
                                    <div class="text-sm  pt-2  font-bold text-gray-400">Creator</div>

                                </div>
                            @else
                            @breag
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- start of the all plaay trailer  --}}
            <div x-data="{ isOpen: false }">
                {{-- @if (count($movie['videos']['results']) > 0) --}}
                <div class="mt-12 ">
                    <button @click="isOpen = true"
                        class=" inline-flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150">


                        <svg class="w-6 fill-current" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                        </svg>
                        <span class="ml-2">Play Trailer</span>
                    </button>
                </div>

                <template x-if="isOpen">
                    <div style="background-color: rgba(0, 0, 0, .5);"
                        class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto">
                        <div class="container mx-auto  lg:px-32 rounded-lg overflow-y-auto">
                            <div class="bg-gray-900 rounded">
                                <div class="flex justify-end pr-4 pt-2">
                                    <button @click="isOpen = false" @keydown.escape.window="isOpen = false"
                                        class="text-3xl leading-none hover:text-gray-300">&times;
                                    </button>
                                </div>
                                <div class="responsive-container overflow-hidden relative pt-[58%]" style="">


                                    
                                    @if ($tvshow['videos']['results'])
                                        @foreach ($tvshow['videos']['results'] as $video)
                                            {{-- <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full"
                                                src="https://www.youtube.com/embed/{{ $tvshows['key'] }}"
                                                style="border:0;" allow="autoplay; encrypted-media"
                                                allowfullscreen></iframe> --}}
                                            <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full"
                                                src="https://www.youtube.com/embed/{{ $tvshows['video'] }}"
                                                style="border:0;" allow="autoplay; encrypted-media"
                                                allowfullscreen></iframe>
                                        @endforeach
                                    @else
                                        <div class="  absolute  top-[30%] right-[15%]">
                                            <p class=" text-3xl uppercase  font-bold">This video has no trailer in our web
                                                site :)</p>
                                        </div>
                                    @endif
                                </div>
                                {{-- @foreach ($tvshow['videos']['results'] as $video)
                                    <div class="modal-body px-4 py-8">
                                        <div class="responsive-container overflow-hidden relative pt-[56%]"
                                            style="">

                                            <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full"
                                                src="https://www.youtube.com/embed/{{ $video['id'] }}"
                                                style="border:0;" allow="autoplay; encrypted-media"
                                                allowfullscreen></iframe>

                                        </div>
                                @endforeach --}}
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        </template>
        {{-- @endif --}}


    </div>


    {{-- end of the all trainler  --}}

</div>
</div>
</div>

{{-- // end of class movie-info --}}
{{-- // end of class movie-info --}}
{{-- // end of class movie-info --}}
{{-- // end of class movie-info --}}


{{-- start of cast line for tv --}}
{{-- start of cast line for tv --}}
{{-- start of cast line for tv --}}


<div class="tv-cast border-b box-border border-gray-800" x-data="{ isOpen: false, image: '' }">
    <div class="container uppercase mx-auto px-4 py-16">
        <h2 class="text-4xl font-semibold">cast</h2>
        <div class="grid grid-cols-4 gap-x-8 ">
            @foreach ($tvshow['credits']['cast'] as $cast)
                @if ($cast['profile_path'])

                    @if ($loop->index < 8)
                        <div class="mt-8">
                            <a href="{{ route('actors.show', $cast['id']) }}">
                                <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $cast['profile_path'] }}"
                                    class="hover:opacity-75 transition-ease-in-out duration-150" alt="">
                            </a>
                            <div class=" mt-2">
                                <a href="" class="text-lg hover:text-gray-500">{{ $cast['name'] }}</a>
                            </div>
                            <div class="text-gray-400">{{ $cast['character'] }}</div>
                        </div>
                    @else
                    @break
                @endif
            @endif
        @endforeach
    </div>
</div>

<div style="background-color: rgba(0, 0, 0, .5);" x-show="isOpen"
    class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto">
    <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
        <div class="bg-gray-900 rounded">
            <div class="flex justify-end pr-4 pt-2">
                <button @click="isOpen = false" @keydown.escape.window="isOpen = false"
                    class="text-3xl leading-none hover:text-gray-300">&times;
                </button>
            </div>
            <div class="modal-body px-8 py-8">
                @if ($tvshow['videos']['results'])
                    <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                        <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full"
                            src="https://www.youtube.com/embed/{{ $tvshow['videos']['results'][0]['key'] }}"
                            {{ 'https://image.tmdb.org/t/p/w500/' . $cast['profile_path'] }} style="border:0;"
                            allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
                @else
                    break
                @endif


                {{-- @endforeach --}}
            </div>
        </div>
    </div>
</div>
</div>


{{-- endign of img cast line for tv  --}}
{{-- endign of img cast line for tv  --}}





{{-- start of img backdrops line  --}}
{{-- start of img backdrops line  --}}

<div class="movie-images" x-data="{ isOpen: false, image: '' }">
<div class="container mx-auto px-4 py-16">
    <h2 class="text-4xl font-semibold">Images</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @foreach ($tvshow['images']['backdrops'] as $backdrops)
            @if ($loop->index < 9)
                <div class="mt-8">
                    <a @click.prevent="
                                isOpen = true
                                image = '{{ 'https://image.tmdb.org/t/p/original/' . $backdrops['file_path'] }}'     
                            "
                        href="{{ 'https://image.tmdb.org/t/p/w500/' . $backdrops['file_path'] }}" class="w-64">
                        <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $backdrops['file_path'] }}"
                            class="hover:opacity-75 transition-ease-in-out duration-150 hover:bg-black"
                            alt="joker">
                    </a>
                </div>
            @else
            @break
        @endif
    @endforeach
</div>

<div style="background-color: rgba(0, 0, 0, .5);"
    class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto" x-show="isOpen"
    @click.away="isOpen = false">
    <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
        <div class="bg-gray-900 rounded">
            <div class="flex justify-end pr-4 pt-2">
                <button @click="isOpen = false" @keydown.escape.window="isOpen = false"
                    class="text-3xl leading-none hover:text-gray-300">&times;
                </button>
            </div>
            <div class="modal-body px-8 py-8">
                <img :src="image" alt="poster">
            </div>
        </div>
    </div>
</div>

</div>
</div>
@endsection
