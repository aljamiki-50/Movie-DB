<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;
use Illuminate\Support\Collection;

class TvViewModel extends ViewModel
{

    public $popularTv;
    public $TopRatedTv;
    public $genres;



    public function __construct($popularTv,  $TopRatedTv, $genres)
    {

        $this->popularTv = $popularTv;
        $this->TopRatedTv = $TopRatedTv;
        $this->genres = $genres;
    }


    public function Poptv()
    {

        // dump($liam->get());


        return collect($this->popularTv)->map(function ($tvshow) {

            $genresFormatted = collect($tvshow['genre_ids'])->mapWithKeys(function ($value) {

                foreach ($this->genres as $genre) {

                    $liam =  collect($genre)->mapWithKeys(function ($genre) {


                        return [$genre['id'] => $genre['name']];
                    });
                }







                return [$value => $liam->get($value)];
            })->implode(', ');

            // dump($genresFormatted);

            return collect($tvshow)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/' . $tvshow['poster_path'],
                'vote_average' => $tvshow['vote_average'] * 10 . '%',
                'first_air_date' => Carbon::parse($tvshow['first_air_date'])->format('M d, Y'),
                'genres' => $genresFormatted,
                'overview' => $tvshow['overview'],
                'id' => $tvshow['id'],
                // 'genre_ids' => collect($tvshow['genre_ids'])->implode(', '),
            ])->only([
                'poster_path', 'id', 'genre_ids', 'name', 'vote_average', 'overview', 'first_air_date', 'genres',
            ]);
        });
    }





    public function Toptv()
    {

        // dump($this->TopRatedTv['results']);
        // dump($this->popularTv);


        return collect($this->TopRatedTv['results'])->map(function ($topTV) {

            $genresFormatted = collect($topTV['genre_ids'])->mapWithKeys(function ($value) {


                // in this one here i toook the genre array and through the get method to extrcat the value later there 

                foreach ($this->genres as $genre) {

                    $liam =  collect($genre)->mapWithKeys(function ($genre) {


                        return [$genre['id'] => $genre['name']];
                    });
                }





                // if used this func before to debug in case didn t get what goin on around 
                // return [$value => $liam->has($value) ? $liam->get($value) : 'Unknown Genre'];


                return [$value => $liam->get($value)];


            })->implode(', ');

            // dump($genresFormatted);

            return collect($topTV)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/' . $topTV['poster_path'],
                'vote_average' => $topTV['vote_average'] * 10 . '%',
                'first_air_date' => Carbon::parse($topTV['first_air_date'])->format('M d, Y'),
                'genres' => $genresFormatted,
                'overview' => $topTV['overview'],
                // 'id' => $topTV['id'],
                // 'genre_ids' => collect($tvshow['genre_ids'])->implode(', '),
            ])->only([
                'poster_path', 'id', 'genre_ids', 'name', 'vote_average', 'overview', 'first_air_date', 'genres',
            ]);
        });
    }








    
}






    

    


   











    


    // public function formatTv($tv)
    // {


    //     return collect($tv)->map(function ($tvshow) {

    //         $genresFormatted = collect($tvshow['genre_ids'])->mapWithKeys(function ($value) {
    //             return [$value => $this->genres->get($value)];
    //         })->implode(', ');

    //         // dump($genresFormatted);

    //         return collect($tvshow)->merge([
    //             'poster_path' => 'https://image.tmdb.org/t/p/w500/' . $tvshow['poster_path'],
    //             'vote_average' => $tvshow['vote_average'] * 10 . '%',
    //             'first_air_date' => Carbon::parse($tvshow['first_air_date'])->format('M d, Y'),
    //             'genres' => $genresFormatted,
    //         ])->only([
    //             'poster_path', 'id', 'genre_ids', 'name', 'vote_average', 'overview', 'first_air_date', 'genres',
    //         ])->dump;
    //     });
    // }
