<?php

namespace App\Http\Controllers;

use App\ViewModels\MovieViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\ViewName;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\Dump;
use Termwind\Components\Dd;
use App\Http\Controllers\PostViewModel;
use App\ViewModels\MoviesViewModel;
use App\ViewModels\YourViewModel;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // the first thing i did here that i import my api db use with token as below and dd below to see the results i got 
        // the first thing i did here that i import my api db use with token as below and dd below to see the results i got 

        $new = "eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI5YTZjMDhkMWY0YzlhOGJmOTk0Yzg5YWRhYzY0NGYyYSIsInN1YiI6IjY1MTY4NmFkOTY3Y2M3MDBmZjIyNjliZCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.zEbylydUj1PvaGWwrkFwBwP8UzrEapsGjEZ2VxsbQVE";

        $popularmovies = http::withToken($new)
            ->get('https://api.themoviedb.org/3/movie/popular')
            ->json()['results'];

        // dd($popularmovies);


        // $generarray = http::withToken('eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJmMzdkNTMxMGM3YzQ1ZjE3MWQxZDcyY2MzYzBlNzY4MCIsInN1YiI6IjY1MTY4NmFkOTY3Y2M3MDBmZjIyNjliZCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.ZTCm_6eKR2RkB5ce9YRFaIl5TshJOzeWk6kW4FjJlvA')
        //     ->get('https://api.themoviedb.org/3/genre/movie/list')
        //     ->json()['genres'];

        $genres = http::withToken($new)
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];


        // went through my array first of all collect it them map with keys through it and have my id s as a key and names as a value :

        // $genres = collect($generarray)->mapWithKeys(function ($liam) {

        //     return [$liam['id'] => $liam['name']];
        // });

        // the secon thing now we trying to fetch now playing movie which it  kindda of the same process as the prior on 
        // the secon thing now we trying to fetch now playing movie which it  kindda of the same process as the prior on 
        // the secon thing now we trying to fetch now playing movie which it  kindda of the same process as the prior on 

        $new = "eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI5YTZjMDhkMWY0YzlhOGJmOTk0Yzg5YWRhYzY0NGYyYSIsInN1YiI6IjY1MTY4NmFkOTY3Y2M3MDBmZjIyNjliZCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.zEbylydUj1PvaGWwrkFwBwP8UzrEapsGjEZ2VxsbQVE";

        // $NowPlayinMovies = http::withToken('eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJmMzdkNTMxMGM3YzQ1ZjE3MWQxZDcyY2MzYzBlNzY4MCIsInN1YiI6IjY1MTY4NmFkOTY3Y2M3MDBmZjIyNjliZCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.ZTCm_6eKR2RkB5ce9YRFaIl5TshJOzeWk6kW4FjJlvA')
        //     ->get('https://api.themoviedb.org/3/movie/now_playing')
        //     ->json()['results'];

        $NowPlayinMovies = http::withToken($new)
            ->get('https://api.themoviedb.org/3/movie/now_playing')
            ->json()['results'];

            // dd($NowPlayinMovies);





        //   Dump($NowPlayinMovies);

        // The other method try to bring it thorugh config file which below gonna be explored around but i could not get it 
        // The other method try to bring it thorugh config file which below gonna be explored around 
        // $popularmovies = http::withToken(config('services.tmdb.token'))
        // ->get('https://api.themoviedb.org/3/movie/popular')->json();  

        // dump($popularmovies);

        // return view('index', [
        //     'popularmovies' => $popularmovies,
        //     'genres' => $genres,
        //    "NowPlayinMovies"=> $NowPlayinMovies,

        // ]);

        $viewModel = new  MoviesViewModel(
            $popularmovies,
            $genres,
            $NowPlayinMovies,
        );

        return view('movies.index', $viewModel);
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
        //    we did here as we used append to response func later in link to get more of credits which it s better and savior code to avoid making other link 

        $new = "eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI5YTZjMDhkMWY0YzlhOGJmOTk0Yzg5YWRhYzY0NGYyYSIsInN1YiI6IjY1MTY4NmFkOTY3Y2M3MDBmZjIyNjliZCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.zEbylydUj1PvaGWwrkFwBwP8UzrEapsGjEZ2VxsbQVE";

        $movie = http::withToken('eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI5YTZjMDhkMWY0YzlhOGJmOTk0Yzg5YWRhYzY0NGYyYSIsInN1YiI6IjY1MTY4NmFkOTY3Y2M3MDBmZjIyNjliZCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.zEbylydUj1PvaGWwrkFwBwP8UzrEapsGjEZ2VxsbQVE')
            ->get('https://api.themoviedb.org/3/movie/' . $id . '?append_to_response=credits,videos,images')
            ->json();





        // so the other link below been made just for checking but it could be easy replace to append to responce if we looked forward  : 










        //     return view('show', [
        //         'movie' => $movies,
        //     ]);

        $viewmodel = new MovieViewModel($movie);


        return view('movies.show',  $viewmodel);
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
