<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;

use App\Livewire\SearchDropDown;
use GuzzleHttp\Psr7\Response;
use Symfony\Component\Console\Tester\Constraint\CommandIsSuccessful;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;

class ViewMoviesTest extends TestCase
{

    public function test(){

        http::fake([
            'https://api.themoviedb.org/3/movie/popular' => $this->FakePopularMovies(),
            'https://api.themoviedb.org/3/movie/now_playing' => $this->nowplayingmovies(),
        ]);


       

        $response = $this->get(route('movies.index'));
        $response->assertSuccessful();
        $response->assertSee('fakeMovie');
        $response->assertSee('wild');
        
    }

    public function testsearchdropdown(){

        http::fake([
            'https://api.themoviedb.org/3/search/movie?query=jumanji' => $this->fakesearchmovie(),
        ]);

        Livewire::test("SearchDropDown")
        ->assertDontSee('jumanji')
        ->set('search','jumanji')
        ->assertSee('jumanji');
    }

    private function fakesearchmovie  (){

        return http::response([

            "results" => [
                [
                    "adult" => false,
                    "backdrop_path" => "/pYw10zrqfkdm3yD9JTO6vEGQhKy.jpg",
                    "genre_ids" => [12, 14, 10751],
                    "id" => 8844,
                    "original_language" => "en",
                    "original_title" => "jumanji",
                    "overview" => "When siblings Judy and Peter
                     discover an enchanted board game that opens the
                      door to a magical world, they unwittingly invite Alan 
                      -- an adult who's been trapped inside the game for 26 years
                       -- into their living room. Alan's only hope for freedom is to
                        finish the game, which proves risky as all three find themselve
                        s running from giant rhinoceroses, evil monkeys and other terrifying creatures.",
                    "popularity" => 15.152,
                    "poster_path" => "/vgpXmVaVyUL7GGiDeiK1mKEKzcX.jpg",
                    "release_date" => "1995-12-15",
                    "title" => "jumanji",
                    "video" => false,
                    "vote_average" => 7.24,
                    "vote_count" => 9859
                ],
                // ... (other movie entries)
            ],
            "total_pages" => 1,
            "total_results" => 7
        ],200);





    }

    private function FakePopularMovies(){
        

        return http::response([

            "results" => [
                [
                    "adult" => false,
                    "backdrop_path" => "/628Dep6AxEtDxjZoGP78TsOxYbK.jpg",
                    "genre_ids" => [28, 53],
                    "id" => 575264,
                    "original_language" => "en",
                    "original_title" => "Mission: Impossible - Dead Reckoning Part One",
                    "overview" => "Ethan Hunt and his IMF team embark on their most dangerous mission yet: To track down a terrifying new weapon that threatens all of humanity before it falls into the wrong hands...",
                    "popularity" => 4961.526,
                    "poster_path" => "/NNxYkU70HPurnNCSiCjYAmacwm.jpg",
                    "release_date" => "2023-07-08",
                    "title" => "fakeMovie",
                    "video" => false,
                    "vote_average" => 7.7,
                    "vote_count" => 1580,
                ],
                // Repeat the structure for other movies...
                // ...
            ]
            

        ],200);


    }

    private function nowplayingmovies(){

        return http::response([

            "results" => [
                [
                    "adult" => false,
                    "backdrop_path" => "/cHNqobjzfLj88lpIYqkZpecwQEC.jpg",
                    "genre_ids" => [28, 53, 80, 18],
                    "id" => 926393,
                    "original_language" => "en",
                    "original_title" => "wild",
                    "overview" => "Robert McCall finds himself at home in Southern Italy but he discovers his friends are under the control of local crime bosses. As events turn deadly, McCall knows what he has to do: become his friends' protector by taking on the mafia.",
                    "popularity" => 3060.765,
                    "poster_path" => "/b0Ej6fnXAP8fK75hlyi2jKqdhHz.jpg",
                    "release_date" => "2023-08-30",
                    "title" => "wild",
                    "video" => false,
                    "vote_average" => 7.4,
                    "vote_count" => 715
                ],
                // Repeat the structure for other movies...
                // ...
            ]
            

        ],200);


    }


  

    

   
}