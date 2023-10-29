@extends('layouts.main')

@section('content')
    <div class="movie-info border-b box-border container mx-auto border-gray-800 ">
        <div class="container mx-auto px-32 py-16 box-border   grid  grid-cols-2 ">
            <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'] }}"
                class=" hover:opacity-75   transition-all duration-150 w-96" alt="">
            <div class="  over  box-border ">
                <h2 class=" text-4xl font-semibold">

                    {{ $movie['original_title'] }}
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
                    <span class="ml-1">{{ $movie['vote_average'] }} </span>
                    <span class="mx-2">|</span>
                    <span>{{ $movie['release_date'] }}</span>
                    <span class="mx-2">|</span>
                    <div class="text-gray-400">




                    </div>

                </div>
                <div
                    class="flex  flex-wrap to-gray-900   antialiased  tracking-wide  mt-2    prose 
                   shadow-md rounded-md">
                    <p
                        class=" to-gray-300  flex-wrap antialiased   prose 
                    max-w-2xl mx-auto bg-slate-400 ring-1 p-8 mt-4 shadow-md rounded-md ">
                        {{ $movie['overview'] }}
                    </p>
                </div>

                {{-- start of castin container here  --}}
                {{-- start of castin container here  --}}
                {{-- start of castin container here  --}}
                {{-- start of castin container here  --}}

                <div class="  mt-12">
                    <h4 class="text-white  uppercase text-xl tracking-wider antialiased font-semibold">Featured Crew </h4>
                    <div class="flex mt-4">
                        @foreach ($movie['crew'] as $crew)
                            {{-- @if ($loop->index < 2) --}}
                            <div class="mr-8">
                                <div>{{ $crew['name'] }}</div>
                                <div class="text-sm text-gray-400">{{ $crew['job'] }}</div>
                            </div>
                            {{-- @else
                        @break
                    @endif --}}
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
                                    <div class="modal-body px-4 py-8">
                                        <div class="responsive-container overflow-hidden relative pt-[56%]" style="">



                                            @if ($movie['videos'])
                                                <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full"
                                                    src="https://www.youtube.com/embed/{{ $movie['videos'] }}"
                                                    style="border:0;" allow="autoplay; encrypted-media"
                                                    allowfullscreen></iframe>
                                            @else
                                                <div class="  absolute  top-[30%] right-[25%]">
                                                    <p class=" text-3xl  font-bold">This video has no trailer in our web
                                                        site :)</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>




                </div>


                {{-- end of the all trainler  --}}
            </div>
        </div>
    </div>

    {{-- // end of class movie-info --}}
    {{-- // end of class movie-info --}}
    {{-- // end of class movie-info --}}
    {{-- // end of class movie-info --}}


    <div class="movie-cast border-b box-border border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl  antialiased uppercase font-semibold  font-boldfont-semibold">cast</h2>
            <div class="grid grid-cols-4 gap-x-8 ">
                @foreach ($movie['cast'] as $cast)
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
            @endforeach
        </div>
    </div>


</div>


{{-- endign of img cast line  --}}
{{-- ending of img cast line  --}}







{{-- start of img backdrops line  --}}
{{-- start of img backdrops line  --}}

<div class="movie-images" x-data="{ isOpen: false, image: '' }">
    <div class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-semibold">Images</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach ($movie['images'] as $image)
                {{-- @if ($loop->index < 9) --}}
                <div class="mt-8">
                    <a @click.prevent="
                            isOpen = true
                            image = '{{ 'https://image.tmdb.org/t/p/original/' . $image['file_path'] }}'     
                        "
                        href="{{ 'https://image.tmdb.org/t/p/w500/' . $image['file_path'] }}" class="w-64">
                        <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $image['file_path'] }}"
                            class="hover:opacity-75 transition-ease-in-out duration-150 hover:bg-black" alt="joker">
                    </a>
                </div>
                {{-- @else
            @break
        @endif --}}
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
