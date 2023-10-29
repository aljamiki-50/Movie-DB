    {{-- Be like water. --}}

    <div class="relative mt-3 " x-data="{ isOpen: true }" @click.away="isOpen = false">
        <input type="text" wire:model.live.debounce.500="search" @focus="isOpen = true"
            @keydown.escape.window="isOpen = false" x-ref="search"
            @keydown.window="
                if (event.keyCode === 191) {
                    event.preventDefault()
                    $refs.search.focus();
                }
            "
            {{-- @keydown.tab = "isOpen = false" --}} @keydown="isOpen=true"
            class=" bg-gray-500 rounded-full w-64 px-4 pl-8 
             focus:outline-none   focus:ring-4 "
            placeholder="search ( press ' / ' to focus)" class=" placeholder:to-blue-900 py-9" id="">
        <div class="absolute -top-1">
            <svg class="fill-current w-4  text-gray-400 mt-2 ml-2" viewBox="0 0 24 24">
                <path class="heroicon-ui"
                    d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z" />
            </svg>

        </div>
        <div wire:loading class="  spinner mr-4 mt-0 top-0 right-0">hey</div>



        <div class="absolute z-50 bg-gray-800 rounded w-64 mt-4" x-show.transition.oopacity="isOpen">

            @if ($searchresult->count() > 0)
                <ul class=" ">
                    @foreach ($searchresult as $result)
                        <li class=" border-b border-gray-700  ">

                            <a href="{{ route('movies.show', $result['id']) }}"
                                @if ($loop->last) @keydown.tab="isOpen=false" @endif
                                class=" px-3 py-4 grid grid-cols-2  items-center gap-4  hover:bg-gray-700">
                                @if ($result['poster_path'])
                                    <img class=" w-20"
                                        src="{{ 'https://image.tmdb.org/t/p/w92/' . $result['poster_path'] }}"
                                        alt="">
                                @else
                                    <img src="https//::via.placeholder.com/50x70" alt="poster">
                                @endif
                                <span>{{ $result['title'] }}
                                </span>
                            </a>
                        </li>
                    @endforeach

                </ul>
            @elseif (strlen($search) >= 2)
                <li class=" px-3 py-4 list-none"> No Results For <SPAN
                        class=" text-slate-400">{{ $search }}</SPAN></li>
            @endif


        </div>

    </div>
