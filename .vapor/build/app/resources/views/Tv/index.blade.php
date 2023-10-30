@extends('layouts.main')

@section('content')
    <div class=" popular tv container px-4 mx-auto pt-16 ">
        <div>
            <h2 class=" text-lg tracking-wider  text-orange-500 font-semibold">Popualr show </h2>
            <div class="grid grid-cols-5   gap-8 ">
                @foreach ($Poptv as $tvshows)
                    <x-Tvcard :tvshows=$tvshows />
                    {{-- {{ $tvshows['name'] }} --}}
                @endforeach
            </div>
        </div>
        


        <div class="Top-rated-shows py-24 ">
            <h2 class=" text-lg tracking-wider  text-orange-500 font-semibold">Top Rated Tv-show </h2>
            <div class="grid grid-cols-5 gap-8 ">
                {{-- about redundunxay at the code it self as we you see our passed param here is $toptv but as a tvshows since it holds seems argumens  --}}
                @foreach ($Toptv as $tvshows)
                    <x-Tvcard :tvshows=$tvshows />
                @endforeach
            </div>
        </div>
    </div>
@endsection
