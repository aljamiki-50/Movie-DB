<?php

namespace App\Http\Controllers;

use App\ViewModels\TvShowViewModel;
use App\ViewModels\TvViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TvContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // $popularTv = Http::withToken('eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJmMzdkNTMxMGM3YzQ1ZjE3MWQxZDcyY2MzYzBlNzY4MCIsInN1YiI6IjY1MTY4NmFkOTY3Y2M3MDBmZjIyNjliZCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.ZTCm_6eKR2RkB5ce9YRFaIl5TshJOzeWk6kW4FjJlvA')
        $new = "eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI5YTZjMDhkMWY0YzlhOGJmOTk0Yzg5YWRhYzY0NGYyYSIsInN1YiI6IjY1MTY4NmFkOTY3Y2M3MDBmZjIyNjliZCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.zEbylydUj1PvaGWwrkFwBwP8UzrEapsGjEZ2VxsbQVE";
        $popularTv = Http::withToken($new)
            ->get('https://api.themoviedb.org/3/tv/popular')
            ->json()['results'];



        $TopRatedTv = Http::withToken($new)
            ->get('https://api.themoviedb.org/3/tv/top_rated')
            ->json();


        $genres = Http::withToken($new)
            ->get('https://api.themoviedb.org/3/genre/tv/list')
            ->json();


        // dump($genres);

        $viewmodel = new TvViewModel(

            $popularTv,
            $TopRatedTv,
            $genres,
        );


        return view("tv.index", $viewmodel);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $tvshow = http::withToken('eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJmMzdkNTMxMGM3YzQ1ZjE3MWQxZDcyY2MzYzBlNzY4MCIsInN1YiI6IjY1MTY4NmFkOTY3Y2M3MDBmZjIyNjliZCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.ZTCm_6eKR2RkB5ce9YRFaIl5TshJOzeWk6kW4FjJlvA')
        //     ->get('https://api.themoviedb.org/3/tv/' . $id . '?append_to_response=credits,videos,images')
        //     ->json();

        $new = "eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI5YTZjMDhkMWY0YzlhOGJmOTk0Yzg5YWRhYzY0NGYyYSIsInN1YiI6IjY1MTY4NmFkOTY3Y2M3MDBmZjIyNjliZCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.zEbylydUj1PvaGWwrkFwBwP8UzrEapsGjEZ2VxsbQVE";



        // $tvshow = http::withToken($new)
        //     ->get('https://api.themoviedb.org/3/tv/' . $id . '?append_to_response=credits,videos,images')
        //     ->json();

        $tvshow = Http::withToken($new)
        ->get('https://api.themoviedb.org/3/tv/'.$id.'?append_to_response=credits,videos,images')
        ->json();

        // https://api.themoviedb.org/3/movie/157336?api_key=9a6c08d1f4c9a8bf994c89adac644f2a&append_to_response=videos,images

            // dd($tvshow);



        // so the other link below been made just for checking but it could be easy replace to append to responce if we looked forward  : 

        // $hm = http::withToken('eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJmMzdkNTMxMGM3YzQ1ZjE3MWQxZDcyY2MzYzBlNzY4MCIsInN1YiI6IjY1MTY4NmFkOTY3Y2M3MDBmZjIyNjliZCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.ZTCm_6eKR2RkB5ce9YRFaIl5TshJOzeWk6kW4FjJlvA')
        // ->get('https://api.themoviedb.org/3/movie' .$id. 'credits')
        // ->json();
        // dump( $hm);



        // dump($tvshow);





        //     return view('show', [
        //         'movie' => $movies,
        //     ]);

        $viewmodel = new TvShowViewModel($tvshow);


        return view("tv.show",  $viewmodel);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
