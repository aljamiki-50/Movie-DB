@extends('layouts.main')

@section('content')
    <div class=" container px-4 mx-auto pt-16 ">
        <h2 class=" text-lg tracking-wider  text-orange-500 font-semibold">Popualr Movies

        </h2>
        <div class="grid grid-cols-5 gap-8 ">
            @foreach ($popularmovies as $movies)

        {{-- as you may noticed here i used components part and passed my movies and genres vars to them as i am usuing saptie/or view movies model both them cause eased thing  --}}
        {{-- and m just passin direct to my components it s a reminder here  :genres="$genres"
         --}}
               <x-movie-card :movie="$movies"  />
            @endforeach
        </div>
    </div>


    <div class=" container px-4 mx-auto pt-16 ">
        <h2 class=" text-lg tracking-wider  text-orange-500 font-semibold">now playing Movies

        </h2>
        <div class="grid grid-cols-5 gap-8 ">
            @foreach ($NowPlayinMovies as $movies)

        {{-- as you may noticed here i used components part and passed my movies and genres vars to them as i am usuing saptie/or view movies model both them cause eased thing  --}}
        {{-- and m just passin direct to my components it s a reminder here  :genres="$genres"
         --}}
               <x-movie-card :movie="$movies"  />
            @endforeach
        </div>
    </div>

   
    
    @endsection
