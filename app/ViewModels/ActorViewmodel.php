<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;
use App\ViewModels\TvShowViewModel;
// use App\ViewModels\TvShowViewModel;

class ActorViewmodel extends ViewModel
{
    public $actor;
    public $social;

    public $credits;

    public $TvShowViewModel;
    public  $tvshow;
    public function __construct($actor, $social, $credits, $tvshow)
    {
        $this->actor = $actor;
        $this->social = $social;
        $this->credits = $credits;
        $this->tvshow =  $tvshow;
    }

    public function render()
    {

        dump($this->knownForMovies());
    }

    public function vendo()
    {

        dump($this->actor());
    }

    public function wild()
    {

        dump($this->tvshow());
    }


    public function tvshow()
    {
        foreach ($this->tvshow['credits']['cast'] as $cast) {

            $liam = $cast['profile_path'];
        }

        foreach ($this->tvshow['videos']['results'] as $video) {
            $videokey = $video["key"];
        }

        $li = collect($this->tvshow['videos']['results'])->map(function ($video) {
            collect($video["key"])->mapwithkeys(function ($key, $value) {
                return [$key => $key];
            });
        });

        // dump($li);



        // $videoKeys is now an array containing the "key" values from each video result

        // dump($videokey);
        return collect($this->tvshow)->merge([

            "poster_path" => 'https://image.tmdb.org/t/p/w500/' . $this->tvshow['poster_path'],
            "vote_average" => $this->tvshow['vote_average'] * 10 . '%',
            "first_air_date" => \Carbon\Carbon::parse($this->tvshow["first_air_date"])->format('M d, Y'),
            "genres" => collect($this->tvshow['genres'])->pluck('name')->flatten(),
            "crew" => collect($this->tvshow['credits']['crew'])->take(2),
            // "cast" => collect($liam)->take(12),
            "images" => collect($this->tvshow['images']['backdrops'])->take(12),
            "img" => collect($this->tvshow['images']['backdrops'])->take(12),
            "name" => $this->tvshow['name'],
            // "video" => $videokey,
        ])->only([
            "poster_path", "id", "job", "genre_ids",
            "first_air_date", "title", "created_by",
            "vote_average", "overview", "release_date",
            "genres", "video", "image", "name", "crew", "cast", "images", "original_title"
        ])->dump();
    }







    // i used try and catch methood all over the rest code in case of 

    public function actor()
    {


        try {
            $birthdayFormatted = Carbon::parse($this->actor['birthday'])->format('M d, Y');
        } catch (\Exception $e) {
            $birthdayFormatted = null; // or handle the exception as needed
        }

        try {
            $ageformatted =  Carbon::parse($this->actor['birthday'])->diffInYears(Carbon::now());
        } catch (\Exception $e) {
            $ageformatted = null; // or handle the exception as needed
        }

        try {
            $profilePath = $this->actor["profile_path"]
                ? 'https://image.tmdb.org/t/p/w300/' . $this->actor['profile_path']
                : 'https://ui-avatars.com/api/?size=235&name=' . $this->actor['name'];
            // 'https://ui-avatars.com/api/?size=235&name='.$actor['name'] 
        } catch (\Exception $e) {
            $profilePath = $this->actor["profile_path"] ? 'https://ui-avatars.com/api/?size=235&name=' . $this->actor['name'] : 'https://ui-avatars.com/api/?size=235&name='; // Default value in case of an error
        }

        // foreach ($this->actor['credits']['casts'] as $cast) {
        //    $castor = $cast['profile_path'];
        // }


        return collect($this->actor)->merge([
            'birthday' => $birthdayFormatted,
            'age' => $ageformatted,
            'profile_path' => $profilePath,
            'id' => $this->actor['id'],
            'li' => "liam",
        ]);
    }



    public function social()
    {
        try {
            $twitterUrl = $this->social['twitter_id'] ? 'https://twitter.com/' . $this->social['twitter_id'] : null;
        } catch (\Exception $e) {
            $twitterUrl = null; // Default value in case of an error
        }

        try {
            $facebookUrl = $this->social['facebook_id'] ? 'https://facebook.com/' . $this->social['facebook_id'] : null;
        } catch (\Exception $e) {
            $facebookUrl = null; // Default value in case of an error
        }

        try {
            $instagramUrl = $this->social['instagram_id'] ? 'https://instagram.com/' . $this->social['instagram_id'] : null;
        } catch (\Exception $e) {
            $instagramUrl = null; // Default value in case of an error
        }

        return collect($this->social)->merge([
            'twitter' => $twitterUrl,
            'facebook' => $facebookUrl,
            'instagram' => $instagramUrl,
            // ... other properties
        ]);
    }


    // public function knownForMovies()
    // {
    //     $castMovies = collect($this->credits)->get('cast');

    //     return collect($castMovies)->sortByDesc('popularity')->take(5)->map(function ($movie) {
    //         try {
    //             if (isset($movie['title'])) {
    //                 $title = $movie['title'];
    //             } elseif (isset($movie['name'])) {
    //                 $title = $movie['name'];
    //             } else {
    //                 $title = 'Untitled';
    //             }

    //             return collect($movie)->merge([
    //                 'poster_path' => $movie['poster_path']
    //                     ? 'https://image.tmdb.org/t/p/w185' . $movie['poster_path']
    //                     : 'https://via.placeholder.com/185x278',
    //                 'title' => $title,
    //                 'linkToPage' => $movie['media_type'] === 'movie' ? route('movies.show', $movie['id']) : route('tv.show', $movie['id'])
    //             ])->only([
    //                 'poster_path', 'title', 'id', 'media_type', 'linkToPage',
    //             ]);
    //         } catch (\Exception $e) {
    //             // Handle the exception as needed
    //             // For example, you can log the error or set default values
    //             return collect([
    //                 'poster_path' => 'https://via.placeholder.com/185x278',
    //                 'title' => 'Untitled',
    //                 'id' => null,
    //                 'media_type' => null,
    //                 'linkToPage' => null,
    //             ]);
    //         }
    //     });
    // }

    public function knownForMovies()
    {
        $castMovies = collect($this->credits)->get('cast');

        return collect($castMovies)->sortByDesc('popularity')->take(5)->map(function ($movie) {
            if (isset($movie['title'])) {
                $title = $movie['title'];
            } elseif (isset($movie['name'])) {
                $title = $movie['name'];
            } else {
                $title = 'Untitled';
            }

            return collect($movie)->merge([
                'poster_path' => $movie['poster_path']
                    ? 'https://image.tmdb.org/t/p/w185' . $movie['poster_path']
                    : 'https://via.placeholder.com/185x278',
                'title' => $title,
                'linkToPage' => $movie['media_type'] === 'movie' ? route('movies.show', $movie['id']) : route('tv.show', $movie['id'])
                // ])->only([
                //     'poster_path', 'title', 'id', 'media_type', 'linkToPage',
            ]);
        });
    }


    public function credits()
    {
        $castMovies = collect($this->credits)->get('cast');
        // dump($castMovies);

        return collect($castMovies)->map(function ($movie) {
            if (isset($movie['release_date'])) {
                $releaseDate = $movie['release_date'];
            } elseif (isset($movie['first_air_date'])) {
                $releaseDate = $movie['first_air_date'];
            } else {
                $releaseDate = '';
            }

            if (isset($movie['title'])) {
                $title = $movie['title'];
            } elseif (isset($movie['name'])) {
                $title = $movie['name'];
            } else {
                $title = 'Untitled';
            }

            return collect($movie)->merge([
                'release_date' => $releaseDate,
                'release_year' => isset($releaseDate) ? Carbon::parse($releaseDate)->format('Y') : 'Future',
                'title' => $title,
                'character' => isset($movie['character']) ? $movie['character'] : '',
                // 'linkToPage' => $movie['media_type'] === 'movie' ? route('movies.show', $movie['id']) : route('tv.show', $movie['id']),
            ])->only([
                'release_date', 'release_year', 'title', 'character', 'linkToPage',
            ]);
        })->sortByDesc('release_date');
    }






    // return collect($this->social)->merge([

    //     'twitter' => $this->social['twitter_id'] ? 'https://twitter.com/' . $this->social['twitter_id'] : null,
    //     'facebook' => $this->social['facebook_id'] ? 'https://facebook.com/' . $this->social['facebook_id'] : "null",
    //     'instagram' => $this->social['instagram_id'] ? 'https://instagram.com/' . $this->social['instagram_id'] : null,



    // ])->dump();
    // }


    // public function credits()
    // {

    //     return collect($this->credits)->merge([
    //         // "facebook"=>$this->social['facebook'],
    //         // "twitter"=>$this->social['twitter'],
    //         // "website"=>$this->social['website'],

    //     ])->dump();
    // }
}
