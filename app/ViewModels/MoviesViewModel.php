<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

use function PHPUnit\Framework\containsOnly;

class MoviesViewModel extends ViewModel
{
    public $popularmovies;
    public $genres;
    public $NowPlayinMovies;

    public function __construct($popularmovies, $genres, $NowPlayinMovies)
    {
        $this->popularmovies = $popularmovies;
        $this->genres = $genres;
        $this->NowPlayinMovies = $NowPlayinMovies;
    }

    public function popularmovies()
    {
        // one of the first method i used and follwed with new edge syntax for laravel 
        // return collect($this->popularmovies)->map(function ($movie) {
        //     return collect($movie)->merge([
        //         "poster_path" => 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'],
        //         "vote_average" => $movie['vote_average'] * 10 . '%',
        //         "release_date" => \carbon\carbon::parse($movie['release_date'])->format('M d, Y'),
        //         //    "vote-average" => "liam",
        //     ]);
        // })->dump();



        // one of the a bit old method i used and follwed with in a collect method  syntax for laravel 
        // return collect($this->popularmovies)->map(function ($movie) {
        //     return array_merge($movie, [
        //         "poster_path" => 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'],
        //     ]);
        // })->dump();

        // and lastly just usuing the one mehtod called it form to fall in coming vars and just recall it here  
        return $this->FormatMovies($this->popularmovies);
    }

    public function NowPlayinMovies()
    {
        // one of the a bit old method i used and follwed with in a collect method  syntax for laravel 
        // return collect($this->NowPlayinMovies)->map(function ($movie) {
        //     return collect($movie)->merge([
        //         "poster_path" => 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'],
        //         "vote_average" => $movie['vote_average'] * 10 . '%',
        //         "release_date" => \carbon\carbon::parse($movie['release_date'])->format('M d, Y'),
        //         //    "vote-average" => "liam",
        //     ]);
        // });
        // and lastly just usuing the one mehtod called it form to fall in coming vars and just recall it here  
        return $this->FormatMovies($this->NowPlayinMovies);
    }


    public function genres()
    {

        return  collect($this->genres)->mapWithKeys(function ($liam) {

            return [$liam['id'] => $liam['name']];
        });
    }


    // a private fun been set to accecpt coming vars which been passed form movie conreoller and declared around here 
    private function FormatMovies($movies)
    {

        return collect($movies)->map(function ($movie) {
            $genresFormatted = collect($movie["genre_ids"])->mapWithKeys(function ($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(',');

            return collect($movie)->merge([
                "poster_path" => 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'],
                "vote_average" => $movie['vote_average'] * 10 . '%',
                "release_date" => \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y'),
                "genres" => $genresFormatted,
            ])->only(["poster_path", "id", "genre_ids", "title", "vote_average", "overview", "release_date", "genres"]);
        });

        // as ya see we used and only method to pass certa
        //  attriv to a view in case we look forward to dumb 

    }
}
