@php

    $liam = collect($populauractors)->implode(',');

@endphp


@extends('layouts.main')


@section('content')
    <div class=" container px-4 mx-auto py-16 ">
        {{-- <h2 class=" text-lg tracking-wider  text-orange-500 font-semibold">Popualr actors</h2> --}}


        <div class=" grid grid-cols-5 gap-8   ">
            @foreach ($populauractors as $actor)
                <div class="actor   mt-8">
                    <a href=" {{ route("actors.show",$actor['id']) }}">
                        @if ($actor['profile_path'])
                            <img src="{{ 'https://image.tmdb.org/t/p/w235_and_h235_face/' . $actor['profile_path'] }}"
                                class=" ring-1" alt="$actor['name']">
                        @else
                            <img src="{{ 'https://ui-avatars.com/api/?size=235&name=' . $actor['name'] }}"
                                class="" alt="$actor['name']"> '
                        @endif

                        {{-- require a review to a breif code below --}}
                        {{-- <img src="{{ $actor['profile_path'] }}" alt=""> --}}

                    </a>

                    <div class="   mt-2">
                        <a href=" {{ route("actors.show",$actor['id']) }}" class="text-lg  hover:text-gray-300">{{ $actor['name'] }}</a>

                        {{-- <div class="text-sm text-gray-400 truncate">
                            {{ implode(', ',collect($actor['known_for'])->pluck('title')->toArray()) }}+
                            {{ implode(', ',collect($actor['known_for'])->where('media_type', 'tv')->pluck('name')->toArray()) }}
                        </div> --}}
                        @if (count(collect($actor['known_for'])->where('media_type', 'tv')->pluck('name')->toArray()))
                            <div class="text-sm mt-2 text-gray-400 truncate">

                                {{ implode(', ',collect($actor['known_for'])->where('media_type', 'tv')->pluck('name')->toArray()) }}

                            </div>
                        @else
                            <div class="text-sm mt-2 text-gray-400 truncate">
                                <li>{{ implode(', ',collect($actor['known_for'])->where('media_type', 'movie')->pluck('title')->toArray()) }}+
                                    {{ implode(', ',collect($actor['known_for'])->where('media_type', 'tv')->pluck('name')->toArray()) }}
                                </li>

                            </div>
                        @endif

                        {{-- <div> 
                            // usuin the +  sign to union two array out and provide for movie and tv show as well  
                            {{ implode(
                                ', ',
                                collect($actor['known_for'])->where('media_type', 'tv')->pluck('name')->toArray() +
                                    collect($actor['known_for'])->where('media_type', 'movie')->pluck('title')->toArray(),
                            ) }}
                        </div> --}}

                    </div>
                </div>
            @endforeach
        </div>

        <div class="flex justify-between mt-16">
            @if ($previous)
                <a href="/actors/page/{{ $previous }}">previous</a>
            @else
                <div></div>
            @endif
            @if ($next)
                <a href="/actors/page/{{ $next }}">next</a>
            @endif

        </div>


        {{-- adding a contaier to inifn scroll and so on so it will be better when it scrolls   --}}
        {{-- adding a contaier to inifn scroll and so on so it will be better when it scrolls   --}}
        {{-- adding a contaier to inifn scroll and so on so it will be better when it scrolls   --}}
        <div class="  page-load-status my-8">
            <div class="flex justify-center">
                <div class="infinite-scroll-request spinner my-8 text-4xl">&nbsp;</div>
            </div>
            <p class="infinite-scroll-last text-center ring-4 py-4 px-10">End of content</p>
            <p class="infinite-scroll-error">Error</p> </div>
        </div>
        {{-- end a contaier to inifn scroll and so on so it will be better when it scrolls   --}}
        {{-- end a contaier to inifn scroll and so on so it will be better when it scrolls   --}}
        {{-- end a contaier to inifn scroll and so on so it will be better when it scrolls   --}}
    </div>
@endsection

{{-- // the old version before to be compacted with the latest one  --}}

{{-- @section('scripts')
<script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
<script>
    var elem = document.querySelector('.grid');
    var infScroll = new InfiniteScroll( elem, {
      path: '/actors/page/@{{#}}',
      append: '.actor',
      status: '.page-load-status',
      // history: false,
    });

</script>
@endsection --}}


{{-- // end of the old version before to be compacted with the latest one  --}}



@section('scripts')
<script src="https://unpkg.com/infinite-scroll@4.0.1/dist/infinite-scroll.pkgd.min.js"></script>
<script>
    var elem = document.querySelector('.grid');
    var infScroll = new InfiniteScroll(elem, {
        path: '/actors/page/@{{#}}',
        append: '.actor',
        status: '.page-load-status',
        history: false,
    });
</script>
@endsection

