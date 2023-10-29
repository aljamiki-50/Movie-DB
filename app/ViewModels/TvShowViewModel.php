<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class TvShowViewModel extends ViewModel
{
    public $tvshow;
    public function __construct($tvshow)
    {
        $this->tvshow = $tvshow;
    }





    public function tvshows()
    {
        foreach ($this->tvshow['credits']['cast'] as $cast) {

            $liam = $cast['profile_path'];
        }


        foreach ($this->tvshow['videos']['results'] as $video) {
           $liam = $video['key'];

        //    dump($liam);
        }


        $other = array_map(function ($video) {
            return $video['key'];
        }, $this->tvshow['videos']['results']);
        
       dump($other);

        


       


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
            "video" => $liam ?? null,
        ])->only([
            "poster_path", "id", "job", "genre_ids",
            "first_air_date", "title", "created_by",
            "vote_average", "overview", "release_date",
            "genres", "video", "image", "name", "crew", "cast", "images", "original_title"
        ]);
    }
    public function videos()
    {
        // dump($this->tvshow);
    }

    public function tv()
    {
        foreach ($this->tvshow['videos']['results']  as $t) {

            return  $t['key'] ??  $t['id'];
        }
    }

    public function tvvideo()
    {
        // dump($this->tvshows());
    }
}
