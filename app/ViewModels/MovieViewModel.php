<?php

namespace App\ViewModels;

use Illuminate\Support\Facades\Log;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $movie;
    public function __construct($movie)
    {
        $this->movie = $movie;
    }

    

    // public function video() {

    //     collect( $this->movie['videos']['results'])->map(function ($video) {

    //       return   $liam  =  $video['key'];
    // })

   

    // public function title() {
    //     dump($this->video());
    // }


    public function movie()
    {
        try {
            $posterPath = 'https://image.tmdb.org/t/p/w500/' . $this->movie['poster_path'];
        } catch (\Exception $e) {
            $posterPath = null; // Handle the exception as needed
        }

        try {
            $voteAverage = $this->movie['vote_average'] * 10 . '%';
        } catch (\Exception $e) {
            $voteAverage = null; // Handle the exception as needed
        }

        try {
            $releaseDate = \Carbon\Carbon::parse($this->movie['release_date'])->format('M d, Y');
        } catch (\Exception $e) {
            $releaseDate = null; // Handle the exception as needed
        }

        try {
            $genres = collect($this->movie['genres'])->pluck('name')->flatten();
        } catch (\Exception $e) {
            $genres = collect(); // Handle the exception as needed
        }

        try {
            $crew = collect($this->movie['credits']['crew'])->take(2);
        } catch (\Exception $e) {
            $crew = collect(); // Handle the exception as needed
        }

        try {
            $cast = collect($this->movie['credits']['cast'])->take(12);
        } catch (\Exception $e) {
            $cast = collect(); // Handle the exception as needed
        }

        try {
            $images = collect($this->movie['images']['backdrops'])->take(12);
        } catch (\Exception $e) {
            $images = collect(); // Handle the exception as needed
        }


        try {
            foreach ($this->movie['videos']['results'] as $vid) {
                $key = $vid['key'];
                // Perform any actions you need with $key here (e.g., store it in an array, use it in your application, etc.)
            }
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the loop
            // You can log or display an error message if needed
            // For example:
            Log::error('An error occurred: ' . $e->getMessage());
        }
        

        // foreach ($this->movie['videos']['results'] as $vid) {
        //    $key =  $vid['key'];
        //    dump($key);
        // }





        return collect($this->movie)->merge([
            "poster_path" => $posterPath,
            "vote_average" => $voteAverage,
            "release_date" => $releaseDate,
            "genres" => $genres,
            "original_title" => $this->movie["original_title"] ?? null,
            "overview" => $this->movie['overview'] ?? null,
            "videos" => $key ?? null,



            "crew" => $crew,
            "cast" => $cast,
            "images" => $images,

        ])->only(["poster_path", "id", "genre_ids", "title", "vote_average",
         "overview", "release_date", "genres", "videos", "image", "crew", "cast", "images", "original_title"]);
            
    }


    // public function movie()
    // {
    //     return collect($this->movie)->merge([

    //         "poster_path" => 'https://image.tmdb.org/t/p/w500/' . $this->movie['poster_path'],
    //         "vote_average" => $this->movie['vote_average'] * 10 . '%',
    //         "release_date" => \Carbon\Carbon::parse($this->movie['release_date'])->format('M d, Y'),
    //         "genres" => collect($this->movie['genres'])->pluck('name')->flatten(),
    //         "crew" => collect($this->movie['credits']['crew'])->take(2),
    //         "cast" => collect($this->movie['credits']['cast'])->take(12),
    //         "images" => collect($this->movie['images']['backdrops'])->take(12),

    //     ])->only(["poster_path", "id", "genre_ids", "title", "vote_average", "overview", "release_date", "genres", "videos", "image", "crew", "cast", "images", "original_title"]);
    // }
}
