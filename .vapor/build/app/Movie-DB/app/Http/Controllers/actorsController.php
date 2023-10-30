<?php

namespace App\Http\Controllers;


use App\ViewModels\actorsviewmodel;
use App\ViewModels\ActorViewmodel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Spatie\ViewModels\ViewModel;
use App\ViewModels\TvShowViewModel;

class actorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($page = 1)
    {
        abort_if($page > 500, 204);
        // grabbin the actorsController

        $new = "eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI5YTZjMDhkMWY0YzlhOGJmOTk0Yzg5YWRhYzY0NGYyYSIsInN1YiI6IjY1MTY4NmFkOTY3Y2M3MDBmZjIyNjliZCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.zEbylydUj1PvaGWwrkFwBwP8UzrEapsGjEZ2VxsbQVE";

        $populauractors = Http::withToken($new)
            ->get('https://api.themoviedb.org/3/person/popular?page=' . $page)
            ->json()['results'];

        // dump($populauractors);

        $ViewModel = new actorsviewmodel($populauractors, $page);



        return view("actors.index", $ViewModel);
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

        $new = "eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI5YTZjMDhkMWY0YzlhOGJmOTk0Yzg5YWRhYzY0NGYyYSIsInN1YiI6IjY1MTY4NmFkOTY3Y2M3MDBmZjIyNjliZCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.zEbylydUj1PvaGWwrkFwBwP8UzrEapsGjEZ2VxsbQVE";
        $apiKey = '9a6c08d1f4c9a8bf994c89adac644f2a';

        $actor = http::withToken($new)
            ->get('https://api.themoviedb.org/3/person/' . $id)
            ->json();

        $social = http::withToken($new)
            ->get('https://api.themoviedb.org/3/person/' . $id . '/external_ids')
            ->json();

        $credits = http::withToken($new)
            ->get('https://api.themoviedb.org/3/person/' . $id . '/combined_credits')
            ->json();


            $tvshow = Http::withToken($new)
            ->get('https://api.themoviedb.org/3/tv/'.$id.'?append_to_response=credits,videos,images')
            ->json();


        // $response = Http::get("https://api.themoviedb.org/3/movie/{$id}?token={$new}&append_to_response=credits,videos,images")->json();

        // dd($tvshow);











        $ViewModel = new ActorViewmodel($actor, $social, $credits,  $tvshow);

        return view("actors.show", $ViewModel);
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
